<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use Illuminate\View\View;

class ConsoleController extends Controller
{
    public function index(): View
    {
        return view('consoles', [
            'generations' => Generation::with('consoles')->orderBy('id')->get(),
        ]);
    }
}
