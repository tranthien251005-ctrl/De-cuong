# Website Bán Vé Xe Bus

> Đề tài báo cáo cuối kỳ môn Web nâng cao - Lớp LTWNC-D18CNPM2

## Tổng Quan

Đây là dự án website đặt vé xe bus, phần ứng dụng web được phát triển bằng Laravel và lưu trong thư mục `baocaoWEB`.

Mục tiêu của hệ thống:

- Hỗ trợ người dùng tìm kiếm tuyến xe theo điểm đi, điểm đến và thời gian dự kiến.
- Cho phép đăng ký, đăng nhập, đăng xuất tài khoản người dùng.
- Cho phép chọn ghế, thanh toán/đặt vé và lưu vé vào cơ sở dữ liệu.
- Cho phép người dùng xem lại hóa đơn/vé đã đặt theo tài khoản đăng nhập.
- Cung cấp giao diện quản trị cơ bản cho các màn hình quản lý.

## Thành Viên Nhóm

| STT | Họ và tên       | MSSV        | Vai trò     |
| --- | --------------- | ----------- | ----------- |
| 1   | Phạm Đình Luân  | 23810310282 | Nhóm trưởng |
| 2   | Trần Ngọc Thiện | 23810310271 | Thành viên  |

## Công Nghệ Sử Dụng

| Thành phần | Công nghệ |
| ---------- | --------- |
| Backend | Laravel 12, PHP 8.2 |
| Frontend | Blade, HTML, CSS, JavaScript |
| Cơ sở dữ liệu | PostgreSQL/Supabase |
| Quản lý phụ thuộc | Composer, NPM |

## Tài Liệu Đặc Tả Phần Mềm

### 1. Mục Tiêu Và Phạm Vi

Hệ thống hướng đến bài toán đặt vé xe bus trên web cho 2 nhóm người dùng:

- Khách hàng: đăng ký, đăng nhập, tìm kiếm tuyến xe, chọn ghế, đặt vé và xem hóa đơn.
- Quản trị viên: truy cập khu vực quản trị và các màn hình quản lý dữ liệu.

Phạm vi hiện tại của dự án đã cập nhật:

- Trang chủ hiển thị danh sách tuyến xe từ database.
- Form tìm kiếm tuyến xe theo điểm đi, điểm đến và thời gian dự kiến.
- Trang chọn ghế theo tuyến xe.
- Trang thanh toán/đặt vé và lưu dữ liệu vé vào bảng `ve`.
- Trang hóa đơn hiển thị vé đã đặt theo tài khoản đăng nhập.
- Header, footer, giao diện home, hóa đơn và thanh toán đã được chỉnh lại.

### 2. Tác Nhân Hệ Thống

| Tác nhân | Mô tả |
| -------- | ----- |
| Khách vãng lai | Truy cập trang chủ, xem danh sách tuyến xe, mở trang đăng nhập/đăng ký |
| Người dùng đã đăng ký | Đăng nhập, tìm chuyến, chọn ghế, đặt vé và xem hóa đơn |
| Quản trị viên | Truy cập khu vực quản trị và các màn hình quản lý cơ bản |

### 3. Yêu Cầu Chức Năng

| Mã | Chức năng | Mô tả | Trạng thái |
| --- | --------- | ----- | ---------- |
| AUTH-01 | Đăng nhập | Người dùng đăng nhập bằng số điện thoại và mật khẩu, lưu thông tin vào session | Đã hoàn thành |
| AUTH-02 | Đăng xuất | Xóa session đăng nhập và điều hướng người dùng khỏi phiên hiện tại | Đã hoàn thành |
| AUTH-03 | Đăng ký | Người dùng đăng ký tài khoản bằng số điện thoại, mật khẩu và thông tin cá nhân | Đã hoàn thành |
| HOME-01 | Trang chủ | Hiển thị hero, bộ lọc tìm chuyến, danh sách tuyến xe, header và footer | Đã hoàn thành |
| SEARCH-01 | Tìm tuyến xe | Lọc tuyến xe theo điểm đi, điểm đến và thời gian dự kiến từ cột `thoigiandukien` | Đã hoàn thành |
| ROUTE-01 | Hiển thị tuyến xe | Hiển thị tên tuyến, điểm đi, điểm đến, thời gian dự kiến, khoảng cách và giá vé từ database | Đã hoàn thành |
| BOOK-01 | Chọn ghế | Người dùng chọn ghế theo tuyến xe, hệ thống kiểm tra ghế đã đặt và ghế còn trống | Đã hoàn thành |
| PAYMENT-01 | Thanh toán/đặt vé | Xác nhận đặt vé, lưu dữ liệu vào bảng `ve`, cập nhật trạng thái ghế đã đặt | Đã hoàn thành |
| PAYMENT-02 | Thông báo đặt vé | Sau khi đặt vé thành công, trang home hiển thị thông báo “Đặt vé thành công” | Đã hoàn thành |
| BILL-01 | Hóa đơn | Hiển thị danh sách hóa đơn/vé của tài khoản đang đăng nhập, không dùng dữ liệu mẫu | Đã hoàn thành |
| BILL-02 | Lọc hóa đơn | Lọc hóa đơn theo trạng thái chờ đón/đã đi trên giao diện | Đã hoàn thành |
| UI-01 | Header dùng chung | Cập nhật header mới, có logo, điều hướng, trạng thái active và nút đăng nhập/đăng xuất | Đã hoàn thành |
| ADMIN-01 | Giao diện quản trị | Có các view quản trị cơ bản cho người dùng, xe, tuyến, chuyến, vé, thanh toán, báo cáo | Đã hoàn thành |

### 4. Yêu Cầu Phi Chức Năng

- Giao diện hiển thị được trên trình duyệt desktop và mobile.
- Form đăng nhập, đăng ký và thanh toán có kiểm tra dữ liệu đầu vào.
- Session được dùng để lưu trạng thái đăng nhập.
- Thông tin cấu hình nhạy cảm được tách trong file `.env`.
- Mã nguồn giữ theo cấu trúc Laravel để dễ mở rộng và bảo trì.

### 5. Cấu Trúc Database Chính

Dự án đang sử dụng các bảng nghiệp vụ chính:

- `taikhoan`: lưu tài khoản, số điện thoại, mật khẩu, vai trò, email, họ tên.
- `tuyenxe`: lưu tuyến xe, điểm đi, điểm đến, thời gian dự kiến, khoảng cách, giá tiền, xe.
- `xe`: lưu thông tin xe.
- `vitrighe`: lưu vị trí ghế, trạng thái ghế và xe tương ứng.
- `ve`: lưu vé đã đặt gồm ghế, tài khoản, ngày đặt, hình thức thanh toán, tổng số tiền và trạng thái.
- `nguoidung`, `taixe`, `chuyenxe`: các bảng mở rộng cho nghiệp vụ người dùng, tài xế và chuyến xe.

## Cấu Trúc Thư Mục Dự Án

```text
du an/
|-- README.MD
|-- DECUONG.MD
|-- reports/
`-- baocaoWEB/
    |-- app/
    |   |-- Http/Controllers/
    |   `-- Models/
    |-- public/
    |   `-- css/
    |-- resources/
    |   `-- views/
    |       |-- auth/
    |       |-- layouts/
    |       |-- pages/
    |       `-- admin/
    |-- routes/
    |   `-- web.php
    |-- database/
    |-- artisan
    |-- composer.json
    `-- package.json
```

## Hướng Dẫn Cài Đặt

### 1. Yêu Cầu Môi Trường

- PHP 8.2 trở lên
- Composer
- Node.js và NPM
- Database PostgreSQL/Supabase

### 2. Cài Đặt Dự Án

```bash
cd baocaoWEB
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Nếu dùng PowerShell trên Windows:

```powershell
Copy-Item .env.example .env
```

### 3. Cấu Hình `.env`

Cập nhật thông tin kết nối database và các cấu hình cần thiết trong file:

```env
APP_NAME="Website Ban Ve Xe Bus"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=pgsql
DB_HOST=your-host
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-password
```

### 4. Chạy Ứng Dụng

```bash
npm run dev
php artisan serve
```

Truy cập:

```text
http://127.0.0.1:8000
```

## Tài Liệu Liên Quan

- [Đề cương môn học](./DECUONG.MD)
- [Báo cáo ngày 03/04/2026](./reports/REPORT_20260403.md)

## Ghi Chú

- README đã được cập nhật theo trạng thái chức năng hiện tại của dự án.
- Các chức năng trong bảng yêu cầu chức năng đã được đánh dấu `Đã hoàn thành` cho những phần đã triển khai trong source code.
