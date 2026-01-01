<?php

namespace App\Models;

use App\Services\SentimentService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRate extends Model
{
    use HasFactory;
    protected $table = 'users_rates';
    protected $fillable = [
        'user_id',
        'service_id',
        'stars',
        'comment',
    ];
    protected $appends = ['analyze'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function getAnalyzeAttribute()
    {
        if ($this->comment) {
            $service = new SentimentService();
            $check = $service->analyze($this->comment);
            return $check;
        }
    }
}
