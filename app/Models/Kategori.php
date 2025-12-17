<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    
    protected $fillable = [
        'name_kategori',
        'image'
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}
