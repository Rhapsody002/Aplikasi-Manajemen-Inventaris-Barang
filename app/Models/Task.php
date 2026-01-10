<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'judul',
        'tipe',
        'barang_id',
        'jumlah',
        'user_id',
        'supplier_id',
        'lokasi_id',
        'status',
        'bukti_foto',
        'acc_at',
        'acc_by'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function accBy()
    {
        return $this->belongsTo(User::class, 'acc_by');
    }

    protected $casts = [
        'acc_at' => 'datetime',
    ];
}
