<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietdonhang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'ID';
 	protected $table = 'chitietdonhangs';
    protected $fillable = [
        'ID',
        'iddonhang',
        'idsanpham',
        'soluong_m',
    ];
}
