<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Display the games index page
     */
    public function index()
    {
        return view('games.index');
    }

    /**
     * Display the Tetris game
     */
    public function tetris()
    {
        return view('games.tetris.index');
    }

    /**
     * Display the Tic-Tac-Toe game
     */
    public function tictactoe()
    {
        return view('games.tic-tac-toe.index');
    }

    /**
     * Display the Pibble Belly Washing game
     */
    public function pibbleBelly()
    {
        return view('games.pibble-belly.index');
    }
}
