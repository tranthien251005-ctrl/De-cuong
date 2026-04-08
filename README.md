# 🚌 Website Bán Vé Xe Bus

> **Đề tài thực tập tốt nghiệp** — Lớp LTWNC-D18CNPM2

Hệ thống cho phép:

Người dùng tìm kiếm tuyến xe bus
Xem lịch trình, chọn ghế, đặt vé online
Quản lý chuyến xe, tài xế, vé
Admin quản lý toàn hệ thống

---

## 👥 Thành viên nhóm

| STT | Họ và tên | MSSV | Vai trò |
|---|---|---|---|
| 1 | Phạm Đình Luân | 23810310282| Nhóm trưởng |
| 2 | Trần Ngọc Thiện | 23810310271 | Thành viên |

---

## 🚀 Công nghệ sử dụng

| Thành phần | Công nghệ |
|---|---|
| Frontend | HTML, CSS, JavaScript, Bootstrap 5 |
| Backend | Laravel |
| Database | phpMyAdmin |

---

## 📋 Tài liệu Đặc tả Yêu cầu Phần mềm (SRS)

| Mã | Chức năng | Trạng thái |
|---|---|---|
| AUTH-01 | 🔐 Xác thực người dùng (Đăng nhập / Đăng ký / Quên mật khẩu) | chưa hoàn thiện |
| SEARCH-01 | 🔍 Tìm kiếm tuyến xe bus | chưa hoàn thiện |
| BOOK-01 | 🎫 Đặt vé xe bus | chưa hoàn thiện |

| ROUTE-01 | 🚌 Quản lý tuyến xe | chưa hoàn thiện |
| REVIEW-01 | ⭐ Đánh giá | chưa hoàn thiện |
| ADMIN-01 | 🛡️ Quản trị hệ thống | chưa hoàn thiện |

---

## 🗂️ Cấu trúc thư mục dự án

```
bus-ticket/
├── docs/srs/
├── public/
├── app/
├── database/
├── .env
└── README.md
```

---

## 🗓️ Kế hoạch thực hiện

| Ngày | Công việc |
|---|---|
| Ngày 1 | Thiết kế Database, dựng cấu trúc project, phân chia task |
| Ngày 2 | Giao diện User: trang chủ, tìm kiếm, chi tiết salon |
| Ngày 3 | Chức năng đặt lịch, chọn nhân viên, chọn giờ |
| Ngày 4 | Giao diện Chủ Salon: quản lý lịch, dịch vụ, nhân viên |
| Ngày 5 | Giao diện Admin + tích hợp thanh toán VNPay/Momo |
| Ngày 6 | Chức năng review, thống kê, báo cáo |
| Ngày 7 | Test toàn bộ, fix bug, hoàn thiện giao diện |

---

## ⚙️ Hướng dẫn cài đặt

```bash
# Clone repository
git clone https://github.com/<username>/barber-spa.git
cd barber-spa

# Cài đặt dependencies (Laravel)
composer install
npm install

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Chạy migration và seed dữ liệu mẫu
php artisan migrate --seed

# Khởi động server
php artisan serve
```

Truy cập tại: `http://localhost:8000`

---

## 📝 Ghi chú

- Tài liệu SRS được soạn thảo theo chuẩn IEEE 830
- Mọi thay đổi yêu cầu phải cập nhật file SRS tương ứng và ghi chú vào commit message
- Liên hệ nhóm trưởng Nguyễn Công Sơn (MSSV: 23810310102) để được hỗ trợ

---

*Hà Nội, tháng 03 năm 2026*
