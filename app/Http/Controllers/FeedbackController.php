<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('review', compact('feedbacks'));
    }
    
   public function destroy($id)
    {
        $feedbacks = Feedback::find($id);
        $feedbacks->delete();
       
        return redirect(route('review.index'));
    }
}