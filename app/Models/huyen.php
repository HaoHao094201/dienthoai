<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class huyen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idh';
 	protected $table = 'huyens';
    protected $fillable = [
        'idh',
        'ten_h',
        'type',
        'idtinh',
    ];
}
