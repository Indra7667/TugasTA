<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Model_Bisnis extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'uns_model_bisnis';
    protected $primaryKey = 'id_model';
    protected $guarded = ['id_model'];
    public $timestamps = false;
    public $updated_at = false;

}
