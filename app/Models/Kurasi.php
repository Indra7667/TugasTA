<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Kurasi extends Model
{
    use HasFactory;
    protected $table = 'uns_kurasi_main';
    protected $primaryKey = 'id_kurasi';
    protected $guarded = ['id_kurasi'];
    public $timestamps = false;
}