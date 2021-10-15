<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\feedbacks;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class feedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = feedbacks::all();
        return view('review', compact('feedbacks'));
    }
    
   public function destroy($id)
    {
        $feedbacks = feedbacks::find($id);
        $feedbacks->delete();
       
        return redirect(route('review.index'));
    }
}