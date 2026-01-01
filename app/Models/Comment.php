<?php

namespace App\Models;

use App\Services\ProfanityService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            $service = new ProfanityService();
            $check = $service->checkProfanity($comment->comment);

            if (is_array($check) && isset($check['isProfanity']) && $check['isProfanity'] === true) {
                return false;
            }
        });
    }
}