<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuyenXe extends Model
{
    protected $table = 'tuyenxe';
     protected $primaryKey = 'matuyen';
     public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'tentuyen',
        'diemdi',
        'diemden',
        'thoigiandukien',
        'khoangcach',
        'giodi',
        'gioden',
        'giatien',
    ];
}