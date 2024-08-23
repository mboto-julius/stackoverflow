<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required'
        ]);
        if (!$question->id) {
            return back()->with('error', 'Question not found');
        }
        $question->answers()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);
        return back()->with('success', 'Your answer has been submitted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $request->validate([
            'body' => 'required'
        ]);
        $answer->update([
            'body' => $request->body,
        ]);
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Answer $answer)
    {
        if (!$question) {
            return back()->with('error', 'Answer not found');
        }
        $this->authorize('delete', $answer);
        try {
            $answer->delete();
            return back()->with('success', 'Answer deleted successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Unable to delete answer');
        }
    }
}
