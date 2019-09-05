<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = ['user_id', 'subject', 'content'];

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
