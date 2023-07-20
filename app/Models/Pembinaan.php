<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pembinaan extends Model
{
    protected $table = 'uns_pembinaan';
    protected $guarded = ['id_pembinaan'];
    protected $primaryKey = false;
    public $incrementing = false;
    public $timestamps = false;
    public $updated_at = false;
}
