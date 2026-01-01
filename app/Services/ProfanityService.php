<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProfanityService
{
     protected $baseUrl = 'https://vector.profanity.dev';

     public function checkProfanity(string $text)
     {
          $response = Http::post($this->baseUrl, [
               'message' => $text,
          ]);

          if ($response->successful()) {
               return $response->json();
          }

          return ['error' => 'Failed to check profanity', 'status' => $response->status()];
     }
}
