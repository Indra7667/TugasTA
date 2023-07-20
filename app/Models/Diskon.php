<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Diskon extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'uns_diskon';
    protected $guarded = ['id_diskon'];
    protected $primaryKey = 'id_diskon';
    public $timestamps = false;
    public $updated_at = false;

}
