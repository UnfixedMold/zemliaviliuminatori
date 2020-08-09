<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Invitation extends Model
{
    protected $fillable = [
        'email', 'token', 'registered_at',
    ];

    public function generateToken() {
        $this->token = Uuid::generate()->string;
    }
}
