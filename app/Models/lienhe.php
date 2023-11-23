<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lienhe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idlh';
 	protected $table = 'lienhes';
    protected $fillable = [
        'idlh',
        'ten',
        'tieude',
        'sdt',
        'email',
        'noidung',
        'ngay',
    ];
}
