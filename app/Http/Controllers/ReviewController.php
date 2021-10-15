<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Review::all();
        return view('review', compact('review'));
    }
    
   public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
       
        return redirect(route('review.index'));
    }
}