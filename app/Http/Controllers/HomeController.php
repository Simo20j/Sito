<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'articles' => Article::orderBy('id')->get(),
        ]);
    }
}
