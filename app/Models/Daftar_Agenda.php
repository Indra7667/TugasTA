<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class Daftar_Agenda extends Model
{
    protected $table = 'uns_ikut_agenda';
    protected $primaryKey = false;
    public $incrementing = false;
    protected $guarded = [''];
    public $timestamps = false;
    public $updated_at = false;
}
