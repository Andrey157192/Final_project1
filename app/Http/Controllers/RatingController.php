<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        Rating::create([
            'user_id' => Auth::id(),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'approved' => false
        ]);

        return back()->with('success', 'Your rating has been submitted and is awaiting approval.');
    }

    public function adminIndex()
    {
        $pendingRatings = Rating::where('approved', false)
            ->with('user')
            ->latest()
            ->get();
        
        $approvedRatings = Rating::where('approved', true)
            ->with('user')
            ->latest()
            ->get();

        return view('admin.ratings.index', compact('pendingRatings', 'approvedRatings'));
    }

    public function approve($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->approved = true;
        $rating->save();

        return redirect()->route('admin.ratings')->with('success', 'Rating approved successfully.');
    }    public function index()
    {
        $ratings = Rating::where('approved', true)
            ->with('user')
            ->latest()
            ->paginate(12);

        return view('user.pages.ratings.index', compact('ratings'));
    }
}
