<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Data_Usaha extends Model
{
    use HasFactory;
    public $table = 'data_usaha';
    protected $guarded = ['id'];
    public $timestamps = false;
}