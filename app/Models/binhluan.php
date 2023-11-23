<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class binhluan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idbl';
 	protected $table = 'binhluans';
    protected $fillable = [
        'idbl',
        'binhluan',
        'ngay',
        'idsanpham',
        'idkhachhang',
    ];
}
