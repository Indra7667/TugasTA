<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Kurasireq_judul extends Model
{
    use HasFactory;
    protected $table = 'uns_kurasireq_judul';
    protected $primaryKey = false;
    protected $guarded = [''];
    public $timestamps = false;
}