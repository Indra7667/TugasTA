<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class Log_Kurasi extends Model
{
    protected $table = 'uns_log_kurasi';
    protected $primaryKey = false;
    public $incrementing = false;
    protected $guarded = [''];
    public $timestamps = false;
    public $updated_at = false;
}
