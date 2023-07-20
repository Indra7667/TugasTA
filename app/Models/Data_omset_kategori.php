<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Data_omset_kategori extends Model
{
    use HasFactory;
    protected $table = 'uns_aset_omset_kategori';
    protected $guarded = [''];
    public $timestamps = false;
}