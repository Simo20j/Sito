<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        return view('reviews', [
            'reviews' => Review::latest()->latest('id')->get(),
        ]);
    }

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $request->user()->reviews()->create([
            ...$request->validated(),
            'autore' => $request->user()->nome,
        ]);

        return redirect()->route('reviews.index');
    }
}
