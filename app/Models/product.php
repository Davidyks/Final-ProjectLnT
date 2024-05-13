<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'CategoryId',
        'Nama',
        'Harga',
        'Jumlah',
        'Photo'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryId');
    }
}
