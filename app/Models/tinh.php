<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tinh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idt';
 	protected $table = 'tinhs';
    protected $fillable = [
        'idt',
        'ten_t',
        'type',
    ];
}
