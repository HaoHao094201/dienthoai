<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idsld';
 	protected $table = 'sliders';
    protected $fillable = [
        'idsld',
        'img',
    ];
}
