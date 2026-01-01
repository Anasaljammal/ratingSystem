<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use PHPInsight\Sentiment;

class SentimentService
{
     public function analyze(string $text)
     {
          $sentiment = new Sentiment();
          $scores = $sentiment->score($text);
          $class = $sentiment->categorise($text);

          return [
               'scores' => $scores,
               'class' => $class
          ];
     }
}