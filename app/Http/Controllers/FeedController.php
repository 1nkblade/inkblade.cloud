<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class FeedController extends Controller
{
    public function index()
    {
        // Cache articles for 15 minutes
        $articles = Cache::remember('rss_articles', 900, function () {
            $feedUrls = $this->getFeedUrls();
            return $this->parseFeeds($feedUrls);
        });
        
        return view('feed.index', compact('articles'));
    }
    
    public function refresh()
    {
        Cache::forget('rss_articles');
        return redirect()->route('feed')->with('success', 'Feed refreshed successfully!');
    }
    
    public function debug()
    {
        $feedUrls = $this->getFeedUrls();
        $debugInfo = [];
        
        foreach ($feedUrls as $url) {
            try {
                $xml = @file_get_contents($url);
                if ($xml) {
                    $feed = @simplexml_load_string($xml);
                    if ($feed) {
                        $items = $feed->channel->item ?? $feed->item ?? [];
                        $itemCount = count($items);
                        $imageCount = 0;
                        
                        foreach ($items as $item) {
                            if ($this->extractImage($item)) {
                                $imageCount++;
                            }
                        }
                        
                        $debugInfo[] = [
                            'url' => $url,
                            'items' => $itemCount,
                            'images' => $imageCount,
                            'first_item' => $itemCount > 0 ? [
                                'title' => (string) $items[0]->title,
                                'has_description' => !empty($items[0]->description),
                                'has_enclosure' => isset($items[0]->enclosure),
                                'has_media' => !empty($items[0]->children('media', true)),
                                'image_found' => $this->extractImage($items[0])
                            ] : null
                        ];
                    }
                }
            } catch (\Exception $e) {
                $debugInfo[] = [
                    'url' => $url,
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return response()->json($debugInfo, 200, [], JSON_PRETTY_PRINT);
    }
    
    private function getFeedUrls()
    {
        $filePath = base_path('rss_feeds.txt');
        
        if (!File::exists($filePath)) {
            return [];
        }
        
        $content = File::get($filePath);
        $urls = array_filter(array_map('trim', explode("\n", $content)));
        
        return $urls;
    }
    
    private function parseFeeds($feedUrls)
    {
        $articles = [];
        
        foreach ($feedUrls as $url) {
            try {
                $feedData = $this->parseFeed($url);
                if ($feedData) {
                    $articles = array_merge($articles, $feedData);
                }
            } catch (\Exception $e) {
                // Skip invalid feeds
                continue;
            }
        }
        
        // Sort by date (newest first)
        usort($articles, function($a, $b) {
            return strtotime($b['pubDate']) - strtotime($a['pubDate']);
        });
        
        // Limit to 20 articles for faster loading
        return array_slice($articles, 0, 20);
    }
    
    private function parseFeed($url)
    {
        $context = stream_context_create([
            'http' => [
                'timeout' => 10,
                'user_agent' => 'Mozilla/5.0 (compatible; RSS Reader)'
            ]
        ]);
        
        $xml = @file_get_contents($url, false, $context);
        
        if (!$xml) {
            return null;
        }
        
        $feed = @simplexml_load_string($xml);
        
        if (!$feed) {
            return null;
        }
        
        $articles = [];
        $items = $feed->channel->item ?? $feed->item ?? [];
        
        foreach ($items as $item) {
            $imageUrl = $this->extractImage($item);
            
            // Use cat placeholder if no image found
            if (!$imageUrl) {
                $imageUrl = 'https://cataas.com/cat/orange?width=300&height=150&t=' . time();
            }
            
            $articles[] = [
                'title' => (string) $item->title,
                'description' => $this->cleanDescription((string) $item->description),
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
                'source' => $this->extractDomain($url),
                'sourceUrl' => $url,
                'image' => $imageUrl
            ];
        }
        
        return $articles;
    }
    
    private function cleanDescription($description)
    {
        // Remove HTML tags and limit length
        $clean = strip_tags($description);
        $clean = html_entity_decode($clean, ENT_QUOTES, 'UTF-8');
        
        if (strlen($clean) > 200) {
            $clean = substr($clean, 0, 200) . '...';
        }
        
        return $clean;
    }
    
    private function extractDomain($url)
    {
        $domain = parse_url($url, PHP_URL_HOST);
        return str_replace('www.', '', $domain);
    }
    
    private function extractImage($item)
    {
        // Try different image sources
        $imageSources = [];
        
        // Check enclosure
        if (isset($item->enclosure) && isset($item->enclosure['type']) && strpos($item->enclosure['type'], 'image') !== false) {
            $imageSources[] = (string) $item->enclosure['url'];
        }
        
        // Check media:content
        $mediaContent = $item->children('media', true)->content;
        if ($mediaContent && isset($mediaContent['url'])) {
            $imageSources[] = (string) $mediaContent['url'];
        }
        
        // Check media:thumbnail
        $mediaThumbnail = $item->children('media', true)->thumbnail;
        if ($mediaThumbnail && isset($mediaThumbnail['url'])) {
            $imageSources[] = (string) $mediaThumbnail['url'];
        }
        
        // Check direct image tag
        if (isset($item->image)) {
            $imageSources[] = (string) $item->image;
        }
        
        // Extract from description HTML
        $descImage = $this->extractImageFromDescription((string) $item->description);
        if ($descImage) {
            $imageSources[] = $descImage;
        }
        
        // Try to find any img tag in the entire item
        $itemXml = $item->asXML();
        $itemImage = $this->extractImageFromDescription($itemXml);
        if ($itemImage) {
            $imageSources[] = $itemImage;
        }
        
        // Try to extract from content:encoded
        if (isset($item->children('content', true)->encoded)) {
            $contentImage = $this->extractImageFromDescription((string) $item->children('content', true)->encoded);
            if ($contentImage) {
                $imageSources[] = $contentImage;
            }
        }
        
        // Try to extract from summary
        if (isset($item->summary)) {
            $summaryImage = $this->extractImageFromDescription((string) $item->summary);
            if ($summaryImage) {
                $imageSources[] = $summaryImage;
            }
        }
        
        // Debug: Log what we found
        if (!empty($imageSources)) {
            \Log::info('Image sources found: ' . json_encode($imageSources));
        }
        
        foreach ($imageSources as $source) {
            if (!empty($source) && $this->isValidImageUrl($source)) {
                \Log::info('Using image: ' . $source);
                return $source;
            }
        }
        
        return null;
    }
    
    private function extractImageFromDescription($description)
    {
        // Try different patterns for image extraction
        $patterns = [
            '/<img[^>]+src="([^"]+)"/',           // Standard img tag
            '/<img[^>]+src=\'([^\']+)\'/',        // Single quotes
            '/<img[^>]+src=([^"\s>]+)/',          // No quotes
            '/background-image:\s*url\(["\']?([^"\')\s]+)["\']?\)/', // CSS background
            '/<img[^>]+data-src="([^"]+)"/',      // Lazy loading
            '/<img[^>]+data-original="([^"]+)"/', // Lazy loading alt
        ];
        
        foreach ($patterns as $pattern) {
            preg_match($pattern, $description, $matches);
            if (isset($matches[1]) && !empty($matches[1])) {
                $url = trim($matches[1]);
                if ($this->isValidImageUrl($url)) {
                    return $url;
                }
            }
        }
        
        return null;
    }
    
    private function isValidImageUrl($url)
    {
        // Basic URL validation
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }
        
        // Check if URL looks like an image
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH));
        
        if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), $imageExtensions)) {
            return true;
        }
        
        // Check for common image hosting domains
        $imageDomains = ['imgur.com', 'i.imgur.com', 'cdn.', 'images.', 'static.', 'media.'];
        $host = parse_url($url, PHP_URL_HOST);
        
        foreach ($imageDomains as $domain) {
            if (strpos($host, $domain) !== false) {
                return true;
            }
        }
        
        return true; // Allow all valid URLs for now
    }
}