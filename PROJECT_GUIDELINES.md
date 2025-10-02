# 📋 Linee Guida per la Creazione di Progetti - Inkblade.cloud

## 🎯 Panoramica

Questo documento definisce le regole e le best practices per la creazione di nuovi progetti nel sistema Inkblade.cloud. Seguire queste linee guida garantisce coerenza, manutenibilità e scalabilità del portfolio.

## 📁 Struttura delle Cartelle

### 🗂️ Organizzazione Progetti

Ogni progetto deve seguire questa struttura:

```
resources/views/projects/
├── index.blade.php              # Lista di tutti i progetti
└── {project-name}/              # Cartella dedicata al progetto
    └── index.blade.php          # Pagina principale del progetto
```

### 📝 Nomenclatura

- **Cartella progetto**: `kebab-case` (es. `my-awesome-project`)
- **File Blade**: Sempre `index.blade.php` come punto di ingresso
- **ID database**: Corrisponde al nome della cartella

## 🗄️ Integrazione Database

### 📊 Struttura Tabella `projects`

```sql
- id (auto-increment)
- title (string)
- description (text)
- status (string: 'planning', 'in-progress', 'completed')
- technologies (json array)
- github_url (string, nullable)
- demo_url (string, nullable)
- image_url (string, nullable)
- sort_order (integer)
- is_featured (boolean)
- created_at/updated_at (timestamps)
```

### 🌱 Aggiunta al Seeder

1. **Modifica** `database/seeders/ProjectSeeder.php`
2. **Aggiungi** il nuovo progetto all'array `$projects`
3. **Esegui** il seeder:
   ```bash
   php artisan tinker --execute="App\Models\Project::truncate();"
   php artisan db:seed --class=ProjectSeeder
   ```

### 🔗 Esempio Seeder Entry

```php
[
    'title' => 'My Awesome Project',
    'description' => 'A brief description of what the project does',
    'status' => 'completed',
    'technologies' => ['Laravel', 'PHP', 'JavaScript', 'CSS3'],
    'github_url' => 'https://github.com/username/repo',
    'demo_url' => '/projects/my-awesome-project',
    'image_url' => '/icons/project-icon.png',
    'sort_order' => 1,
    'is_featured' => true
]
```

## 🎨 Template Base Progetto

### 📄 Struttura File Blade

```blade
@extends('layouts.app')

@section('title', 'Project Name - Inkblade.cloud')

@push('styles')
<style>
    /* Stili specifici del progetto */
    .project-container {
        padding: 80px 20px 40px;
        min-height: calc(100vh - 70px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: linear-gradient(135deg, #002b36 0%, #073642 100%);
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .project-container {
            padding: 60px 15px 30px;
        }
    }
</style>
@endpush

@section('content')
<div class="project-container">
    <div class="project-header">
        <h1 class="project-title">🎯 Project Name</h1>
        <p class="project-subtitle">Brief project description</p>
    </div>
    
    <!-- Contenuto principale del progetto -->
    <div class="project-content">
        <!-- Qui va il contenuto specifico -->
    </div>

    <!-- Informazioni progetto -->
    <div class="project-info">
        <h3>📋 Informazioni Progetto</h3>
        <p><strong>Nome:</strong> Project Name</p>
        <p><strong>Descrizione:</strong> Detailed description</p>
        <p><strong>Stato:</strong> Completed ✅</p>
        
        <div class="tech-stack">
            <span class="tech-tag">Technology 1</span>
            <span class="tech-tag">Technology 2</span>
        </div>
    </div>

    <a href="{{ route('projects') }}" class="back-link">
        ← Torna ai Progetti
    </a>
</div>
@endsection
```

## 🎨 Design System

### 🎨 Tema Colori (Solarized Dark)

```css
/* Colori principali */
--solarized-base03: #002b36;  /* Background scuro */
--solarized-base02: #073642;  /* Background secondario */
--solarized-base01: #586e75;  /* Testo secondario */
--solarized-base00: #657b83;  /* Testo normale */
--solarized-base0:  #839496;  /* Testo chiaro */
--solarized-base1:  #93a1a1;  /* Testo più chiaro */
--solarized-base2:  #eee8d5;  /* Testo principale */
--solarized-yellow: #b58900;  /* Accent color */
```

### 📱 Responsive Design

**Breakpoints obbligatori:**
- **Desktop**: `> 768px`
- **Tablet**: `≤ 768px`
- **Mobile**: `≤ 480px`
- **iPhone**: `≤ 430px`

### 🔤 Tipografia

```css
font-family: 'JetBrains Mono', 'Courier New', monospace;
```

## 🔧 Controller Integration

### 📝 Aggiornamento ProjectController

1. **Aggiungi rotta** nel metodo `show()`:

```php
public function show($projectId)
{
    // Handle legacy routes
    if ($projectId === 'test' || $projectId === 'test-project') {
        return view('projects.test.index');
    }
    
    // Handle specific project routes
    if ($projectId === 'my-awesome-project') {
        return view('projects.my-awesome-project.index');
    }
    
    // Database lookup fallback
    $project = Project::findOrFail($projectId);
    
    if ($project->title === 'My Awesome Project') {
        return view('projects.my-awesome-project.index');
    }
    
    abort(404, 'Project view not implemented yet');
}
```

## 📱 Mobile-First Development

### 🎯 Regole Obbligatorie

1. **Touch Targets**: Minimo 48px per pulsanti/interazioni
2. **Viewport Meta**: Includere sempre
3. **Touch Action**: `manipulation` per elementi interattivi
4. **Tap Highlight**: Disabilitare con `-webkit-tap-highlight-color: transparent`

### 📐 Esempio Mobile CSS

```css
.calc-btn {
    min-height: 48px;
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
    -webkit-user-select: none;
    user-select: none;
}

.calc-btn:active {
    transform: scale(0.95);
    transition: transform 0.1s ease;
}
```

## 🧪 Testing

### ✅ Checklist Pre-Deploy

- [ ] **Funzionalità**: Tutte le features funzionano correttamente
- [ ] **Responsive**: Testato su desktop, tablet, mobile
- [ ] **Performance**: Caricamento rapido e fluido
- [ ] **Accessibilità**: Controlli keyboard, contrasti, screen readers
- [ ] **Cross-browser**: Chrome, Firefox, Safari, Edge
- [ ] **SEO**: Meta tags, title, description corretti

### 🔍 Test Manuali

1. **Desktop**: Tutti i browser principali
2. **Mobile**: iOS Safari, Chrome Android
3. **Touch**: Interazioni touch responsive
4. **Keyboard**: Navigazione con tastiera
5. **Performance**: Lighthouse score > 90

## 📚 Best Practices

### 🎯 Sviluppo

1. **Semantic HTML**: Usa tag appropriati
2. **CSS Grid/Flexbox**: Layout moderni e responsive
3. **JavaScript**: ES6+, event delegation, error handling
4. **Performance**: Lazy loading, ottimizzazione immagini
5. **Security**: Validazione input, sanitizzazione output

### 🔧 Codice

1. **Commenti**: Codice autodocumentante + commenti complessi
2. **Naming**: Variabili e funzioni descrittive
3. **DRY**: Don't Repeat Yourself
4. **Separation**: HTML, CSS, JS separati logicamente
5. **Error Handling**: Gestione errori robusta

### 🎨 UX/UI

1. **Loading States**: Feedback visivo per azioni lunghe
2. **Error Messages**: Messaggi chiari e utili
3. **Success Feedback**: Conferme per azioni completate
4. **Progressive Enhancement**: Funziona anche senza JS
5. **Consistent Design**: Segui il design system

## 🚀 Deployment

### 📋 Processo di Pubblicazione

1. **Sviluppo Locale**: Test completo su ambiente locale
2. **Code Review**: Verifica codice e design
3. **Database Update**: Aggiorna seeder se necessario
4. **Controller Update**: Aggiungi route se necessario
5. **Deploy**: Push su repository e deploy
6. **Testing Live**: Verifica funzionamento su produzione

### 🔄 Versioning

- **Major**: Cambiamenti breaking
- **Minor**: Nuove features
- **Patch**: Bug fixes

## 📖 Esempi di Progetti

### 🧮 Calculator (Completato)
- **Cartella**: `/resources/views/projects/calculator/`
- **Features**: Display doppio, touch-friendly, responsive
- **Tecnologie**: HTML5, CSS3, JavaScript, Laravel

### 🧪 Test Project (Template)
- **Cartella**: `/resources/views/projects/test/`
- **Features**: Hello World, template base
- **Tecnologie**: Laravel, PHP, Blade

## 🤝 Contributi

### 📝 Come Contribuire

1. **Fork** del repository
2. **Branch** feature: `git checkout -b feature/amazing-project`
3. **Commit** con messaggi chiari
4. **Push** al branch
5. **Pull Request** con descrizione dettagliata

### 📋 Template Pull Request

```markdown
## 🎯 Descrizione
Breve descrizione del progetto aggiunto

## 🔧 Cambiamenti
- [ ] Nuovo progetto aggiunto
- [ ] Database aggiornato
- [ ] Controller aggiornato
- [ ] Test completati

## 📱 Test
- [ ] Desktop
- [ ] Mobile
- [ ] Tablet

## 📸 Screenshots
(se applicabile)
```

---

**📅 Ultimo aggiornamento**: {{ date('d/m/Y') }}
**👨‍💻 Mantenuto da**: Inkblade.cloud Team
