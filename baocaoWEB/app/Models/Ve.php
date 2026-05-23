<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    protected $table = 've';
    protected $primaryKey = 'mave';
    public $timestamps = false;

    protected $fillable = [
        'mave',
        'maghe',
        'mataikhoan',
        'ngaydat',
        'hinhthucthanhtoan',
        'tongsotien',
        'trangthai',
    ];

    public function ghe()
    {
        return $this->belongsTo(Ghe::class, 'maghe', 'maghe');
    }

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'mataikhoan', 'id');
    }

    public function getTenKhachAttribute()
    {
        return $this->taiKhoan ? $this->taiKhoan->hoten : 'Không xác định';
    }

    public function getSoDienThoaiAttribute()
    {
        return $this->taiKhoan ? $this->taiKhoan->phone : 'Không xác định';
    }

    public function getNgayDatFormattedAttribute()
    {
        return $this->ngaydat ? date('d/m/Y', strtotime($this->ngaydat)) : '';
    }

    public function getTongSoTienFormattedAttribute()
    {
        return number_format((int) $this->tongsotien, 0, ',', '.') . 'đ';
    }

    public function getTrangThaiBadgeAttribute()
    {
        return match ($this->trangthai) {
            'chua_thanh_toan' => '<span class="badge-danger"><i class="fas fa-ban"></i> Đã hủy</span>',
            'cho_xac_nhan' => '<span class="badge-info"><i class="fas fa-hourglass-half"></i> Chờ xác nhận thanh toán</span>',
            'cho_don' => '<span class="badge-warning"><i class="fas fa-circle-check"></i> Đã thanh toán</span>',
            'da_di' => '<span class="badge-success"><i class="fas fa-check-circle"></i> Đã đi</span>',
            default => '<span class="badge-info">' . e((string) $this->trangthai) . '</span>',
        };
    }
}
