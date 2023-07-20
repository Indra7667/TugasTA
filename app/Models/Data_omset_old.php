<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Data_omset extends Model
{
    use HasFactory;
    protected $table = 'data_asetomset';
    protected $guarded = ['id'];
    public $timestamps = false;
}