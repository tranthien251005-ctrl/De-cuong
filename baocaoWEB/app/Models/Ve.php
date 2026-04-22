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

    // Quan hệ với bảng ghế (vitrighe)
    public function ghe()
    {
        return $this->belongsTo(Ghe::class, 'maghe', 'maghe');
    }

    // Quan hệ với bảng tài khoản
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'mataikhoan', 'id');
    }

    // Lấy tên khách hàng
    public function getTenKhachAttribute()
    {
        return $this->taiKhoan ? $this->taiKhoan->hoten : 'Không xác định';
    }

    // Lấy số điện thoại khách hàng
    public function getSoDienThoaiAttribute()
    {
        return $this->taiKhoan ? $this->taiKhoan->phone : 'Không xác định';
    }

    // Format ngày đặt
    public function getNgayDatFormattedAttribute()
    {
        return $this->ngaydat ? date('d/m/Y H:i', strtotime($this->ngaydat)) : '';
    }

    // Format tổng số tiền
    public function getTongSoTienFormattedAttribute()
    {
        return number_format($this->tongsotien, 0, ',', '.') . 'đ';
    }

    // Lấy trạng thái hiển thị
    public function getTrangThaiBadgeAttribute()
    {
        switch ($this->trangthai) {
            case 'cho_thanh_toan':
                return '<span class="badge-warning"><i class="fas fa-clock"></i> Chờ thanh toán</span>';
            case 'da_thanh_toan':
                return '<span class="badge-success"><i class="fas fa-check-circle"></i> Đã thanh toán</span>';
            case 'da_huy':
                return '<span class="badge-danger"><i class="fas fa-times-circle"></i> Đã hủy</span>';
            default:
                return '<span class="badge-info">' . $this->trangthai . '</span>';
        }
    }
}
