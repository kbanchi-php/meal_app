<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nette\Utils\DateTime;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function getElapsedTimeAttribute()
    {
        // get current time
        $now = new DateTime();
        // get meal post created at time
        $post_time = new DateTime($this->created_at);
        // check elaped time
        if ($post_time->diff(new DateTime("now -1 mins"))->invert) {
            // if meal post time is within 1 minute
            $elaped_time = $post_time->diff($now)->s . '秒';
        } elseif ($post_time->diff(new DateTime("now -1 hours"))->invert) {
            // if meal post time is within 1 hour
            $elaped_time = $post_time->diff($now)->m . '分';
        } elseif ($post_time->diff(new DateTime("now -1 days"))->invert) {
            // if meal post time is within 1 day
            $elaped_time = $post_time->diff($now)->h . '時間';
        } elseif ($post_time->diff(new DateTime("now -1 months"))->invert) {
            // if meal post time is within 1 month
            $elaped_time = $post_time->diff($now)->d . '日';
        } elseif ($post_time->diff(new DateTime("now -1 years"))->invert) {
            // if meal post time is within 1 year
            $elaped_time = $post_time->diff($now)->m . 'ヶ月';
        } else {
            // if meal post time is over 1 year
            $elaped_time = '1年以上';
        }
        return $elaped_time;
    }
}
