<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Data_omset extends Model
{
    use HasFactory;
    protected $table = 'uns_aset_omset';
    protected $primaryKey = false;
    protected $guarded = [''];
    public $timestamps = false;
}