<?php

namespace App\Http\Controllers;

use App\Models\Era;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        return view('games', [
            'eras' => Era::with('games')->orderBy('id')->get(),
        ]);
    }
}
