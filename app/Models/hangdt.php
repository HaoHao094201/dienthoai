<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hangdt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idhdt';
 	protected $table = 'hangdts';
    protected $fillable = [
        'idhdt',
        'tenloai',
    ];
    public function sanpham() {
        return $this->hasMany('App\Models\sanpham');
    }
}
