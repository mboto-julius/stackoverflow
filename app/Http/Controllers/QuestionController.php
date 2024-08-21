<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $question = new Question();
        $question->title = $request->title;
        $question->slug = Str::slug($request->title);
        $question->body = $request->body;
        $question->user_id = Auth::user()->id;
        $question->save();
        return redirect()->route('questions.index')->with('success', 'Your question has been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $question = Question::whereSlug($slug)->first();
        if (!$question) {
            return back()->with('error', 'Question not found');
        }
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::find($id);
        if (!$question) {
            return back()->with('error', 'Question not found');
        }
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id)
    {
        $question = Question::find($id);
        if (!$question) {
            return back()->with('error', 'Question not found');
        }
        $question->title = $request->title;
        $question->slug = Str::slug($request->title);
        $question->body = $request->body;
        $question->save();
        return redirect()->route('questions.index')->with('success', 'Your question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::find($id);
        if (!$question) {
            return back()->with('error', 'Question not found');
        }
        try {
            $question->delete();
            return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Unable to delete question');
        }
    }
}
