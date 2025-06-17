<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    //Answering Question Function
    public function answeringQuestion(Question $question, AnswerRequest $answerRequest)
    {
        $user = Auth::guard('user')->user();
        Answer::create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer' => $answerRequest->answer,
        ]);

        return redirect()->back()->with('success', 'your answer created successfully');
    }

    //Delete Answer Function
    public function deleteAnswer(Answer $answer)
    {
        $answer->delete();

        return redirect()->back()->with('success', 'answer deleted successfully');
    }

    //Get Question Answers Function
    public function getAnswers(Question $question)
    {
        $answers = $question->answers()->orderBy('created_at', 'desc')->with('user')->get();
        $user = Auth::guard('user')->user();

        return view('questions.answers', compact('answers', 'user', 'question'));
    }
}