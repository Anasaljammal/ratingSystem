<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //Create Question Function
    public function createQuestion(QuestionRequest $questionRequest)
    {
        $user = Auth::guard('user')->user();

        Question::create([
            'user_id' => $user->id,
            'question' => $questionRequest->question
        ]);

        return redirect()->back()->with('success', 'your question created successfully');
    }

    //Edit Question Function
    public function editQuestion(Question $question, QuestionRequest $questionRequest)
    {
        $question->update([
            'question' => $questionRequest->question
        ]);

        return redirect()->back()->with('success', 'your question updated successfully');
    }

    //Delete Question Function
    public function deleteQuestion(Question $question)
    {
        $question->delete();

        return redirect('/questions')->with('success', 'your question deleted successfully');
    }

    //Get Questions Function
    public function getQuestions()
    {
        $questions = Question::orderBy('created_at', 'desc')->with('user')->get();
        $user = Auth::guard('user')->user();

        return view('questions.questions', compact('questions', 'user'));
    }
}