<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Kurasireq_berat extends Model
{
    use HasFactory;
    protected $table = 'uns_kurasireq_berat';
    protected $primaryKey = false;
    public $incrementing = false;
    protected $guarded = [''];
    public $timestamps = false;
    public $updated_at = false;
}