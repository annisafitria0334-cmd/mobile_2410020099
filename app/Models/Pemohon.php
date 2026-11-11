<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemohon extends Model
{
    protected $table = 'pemohon';
    protected $primaryKey = 'id_pemohon';

    protected $fillable = [
        'id_akta', 'nik_pemohon', 'nama_pemohon', 'tgl_lahir',
        'tempat_lahir', 'jenis_kelamin', 'alamat', 'no_hp',
        'username', 'password',
    ];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'tgl_lahir' => 'date:Y-m-d',
        ];
    }

    public function jenisAkta(): BelongsTo
    {
        return $this->belongsTo(JenisAkta::class, 'id_akta', 'id_akta');
    }
}
