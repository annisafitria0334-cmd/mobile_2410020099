<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisAkta extends Model
{
    protected $table = 'jenis_akta';
    protected $primaryKey = 'id_akta';

    protected $fillable = ['nama_jenis', 'keterangan'];

    public function pemohon(): HasMany
    {
        return $this->hasMany(Pemohon::class, 'id_akta', 'id_akta');
    }
}
