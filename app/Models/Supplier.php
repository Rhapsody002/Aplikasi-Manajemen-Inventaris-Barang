<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
        'nama_supplier',
        'telepon',
        'alamat',
        'logo_supplier'
    ];

    /* RELASI */
    public function barangMasuk()
    {
        return $this->hasMany(\App\Models\BarangMasuk::class);
    }

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class);
    }
}
