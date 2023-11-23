<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idsp';
 	protected $table = 'sanphams';
    protected $fillable = [
        'idsp',
        'loai_sp',
        'tensp',
        'img',
        'mota',
        'soluong',
        'soluong_ban',
        'gia',
        'gia_km',
    ];
    public function hangdt()
    {
        return $this->belongsTo('App\Models\hangdt');
    }
}
