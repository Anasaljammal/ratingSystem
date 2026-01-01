<?php

namespace App\Http\Controllers;

use App\Models\UserRate;
use Google\Cloud\Dialogflow\V2\Client\SessionsClient;
use Google\Cloud\Dialogflow\V2\DetectIntentRequest;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AIController extends Controller
{
    //Summorize Comment Using AI API
    public function summorizeComment(UserRate $rate)
    {
        $client = new Client();
        $response = $client->post('https://api.apyhub.com/ai/summarize-text', [
            'headers' => [
                'apy-token' => "APY0R3my69JwvCIWZ0PZrCGZzNwQ2YRHpVz63pvlPGHqFAiuxC4CO9KjfY91hw2KM1tx8p3UcLTv",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => $rate->comment,
                'summary_length' => 'short'
            ]
        ]);

        $summary = json_decode($response->getBody(), true);
        return response()->json(['text' => $summary]);
    }

    //Get Chatbot Page
    public function chatbotPage()
    {
        $user = Auth::guard('user')->user();
        return view('ai.chatbot', compact('user'));
    }

    //Chatbot API
    public function chatbot(Request $request)
    {
        $text = $request->input('message');

        $projectId = 'test-vacx';
        $sessionId = uniqid();
        $languageCode = 'en';

        $credentialsPath = storage_path('app/google-key.json');
        $sessionsClient = new SessionsClient([
            'credentials' => $credentialsPath
        ]);
        $session = $sessionsClient->sessionName($projectId, $sessionId);

        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);

        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        $requestDialogflow = new DetectIntentRequest();
        $requestDialogflow->setSession($session);
        $requestDialogflow->setQueryInput($queryInput);

        $response = $sessionsClient->detectIntent($requestDialogflow);
        $reply = $response->getQueryResult()->getFulfillmentText();

        $sessionsClient->close();

        return response()->json(['reply' => $reply]);
    }
}
