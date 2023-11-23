<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'iddh';
 	protected $table = 'donhangs';
    protected $fillable = [
        'iddh',
        'madh',
        'idkhachhang',
        'tongtien',
        'ngay_dat',
        'gia_ship',
        'giamgia',
        'idtinh',
        'idhuyen',
        'diachi',
        'trangthai',
    ];
}
