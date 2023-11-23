<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giamgia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idgg';
 	protected $table = 'giamgias';
    protected $fillable = [
        'idgg',
        'magg',
        'sotien',
        'gioihan_luot',
        'sl_nhap',
        'ngay_hethan',
        'toithieu',
        'mota',
    ];
}
