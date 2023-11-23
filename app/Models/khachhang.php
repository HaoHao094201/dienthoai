<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khachhang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idkh';
 	protected $table = 'khachhangs';
    protected $fillable = [
        'idkh',
        'tenkh',
        'matkhau',
        'sdt',
        'email',
    ];
}
