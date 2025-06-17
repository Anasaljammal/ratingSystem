<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportRequest;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    //Asking Support Function
    public function askingSupport(SupportRequest $supportRequest)
    {
        $user = Auth::guard('user')->user();

        Support::create([
            'user_id' => $user->id,
            'support' => $supportRequest->support,
        ]);

        return redirect()->back()->with('success', 'sent successfully');
    }

    //Get Supports Function
    public function getSupports()
    {
        $supports = Support::orderBy('created_at', 'desc')->with('user')->get();
        $user = Auth::guard('user')->user();

        return view('supports.supports', compact('supports', 'user'));
    }

    //Get Create Support Page Function
    public function createSupportPage()
    {
        $user = Auth::guard('user')->user();
        return view('supports.create_support', compact('user'));
    }
}