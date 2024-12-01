<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoRM extends Model
{
    use HasFactory;

    protected $table = 'no_r_m_s'; // Nama tabel di database

    protected $fillable = ['no_rm', 'keterangan']; // Kolom yang dapat diisi
}
