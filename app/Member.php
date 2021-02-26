<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $table = 'member';
    protected $fillable = ['username','email', 'password','salt','oauth_provider','oauth_uid','status','full_name','alias','cover','phone','address','gender','locale','avatar','facebook','google_plus','youtube','about','link'];
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }
}
