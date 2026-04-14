# 🚌 Website Ban Ve Xe Bus

> 🎓 De tai thuc tap tot nghiep - Lop LTWNC-D18CNPM2

## 📌 Tong quan

Day la du an xay dung website dat ve xe bus, trong do phan ung dung web duoc phat trien bang Laravel va luu trong thu muc `baocaoWEB`. Thu muc goc cua repo dong vai tro tap hop tai lieu de cuong, bao cao tien do va file huong dan.

Muc tieu cua he thong:

- 🔎 Ho tro nguoi dung tim kiem chuyen xe, xem lich trinh va thuc hien dat ve online.
- 🔐 Cung cap giao dien dang nhap cho khach hang va tai khoan quan tri demo.
- 🚀 Lam nen tang de phat trien tiep cac chuc nang quan ly chuyen xe, ghe ngoi, ve va nguoi dung.

## 👥 Thanh vien nhom

| STT | Ho va ten         | MSSV        | Vai tro      |
| --- | ----------------- | ----------- | ------------ |
| 1   | Pham Dinh Luan    | 23810310282 | Nhom truong  |
| 2   | Tran Ngoc Thien   | 23810310271 | Thanh vien   |

## 🛠️ Cong nghe su dung

| Thanh phan | Cong nghe |
| ---------- | --------- |
| Backend    | Laravel 12, PHP 8.2 |
| Frontend   | Blade, HTML, CSS, JavaScript |
| Build tool | Vite, NPM |
| Du lieu    | Supabase REST API cho dang nhap; cac migration mac dinh cua Laravel van duoc giu trong project |
| Du lieu    | PHPMYADMIN|

## 📘 Tai lieu dac ta phan mem

### 1. 🎯 Muc tieu va pham vi

He thong huong den bai toan dat ve xe bus tren web cho 2 nhom nguoi dung:

- Khach hang: xem thong tin tuyen xe, dang nhap va thao tac dat ve.
- Quan tri vien: duoc dinh huong de quan ly nguoi dung, chuyen xe, ve va bao cao.

Pham vi hien tai cua repo tap trung vao giao dien va luong co ban:

- Trang chu hien thi danh sach tuyen xe mau.
- Trang dang nhap co xac thuc bang so dien thoai va mat khau.
- Trang dat ve co tim chuyen, chon ngay, chon ghe va tinh tong tien o muc demo giao dien.

### 2. 👤 Tac nhan he thong

| Tac nhan | Mo ta |
| -------- | ----- |
| Khach vang lai | Truy cap trang chu, xem giao dien, mo trang dang nhap/dat ve |
| Nguoi dung da dang ky | Dang nhap bang thong tin tai khoan luu tren Supabase |
| Admin demo | Dang nhap bang tai khoan `admin / 12345678`, duoc dieu huong sang khu vuc quan tri du kien |

### 3. ✅ Yeu cau chuc nang

| Ma | Chuc nang | Mo ta | Trang thai |
| --- | --------- | ----- | ---------- |
| AUTH-01 | Dang nhap | Nguoi dung dang nhap bang so dien thoai va mat khau; du lieu hien dang doc tu bang `taiKhoan` qua Supabase REST API | Da co ban |
| AUTH-02 | Dang xuat | Xoa session dang nhap va dieu huong ve trang dang nhap | Da co ban |
| HOME-01 | Trang chu | Hien thi header, footer, khu vuc hero, danh sach cac tuyen xe mau va nut dat ve | Da co ban |
| SEARCH-01 | Tim chuyen xe | Chon diem di, diem den, ngay di o trang chu va trang dat ve | Demo giao dien |
| BOOK-01 | Dat ve | Chon ghe, xem thong tin chuyen, tinh tong tien va xac nhan dat ve bang thong bao client-side | Demo giao dien |
| AUTH-03 | Dang ky | Da co file view mau `resources/views/auth/register.blade.php` nhung chua co controller va route hoat dong | Dang phat trien |
| AUTH-04 | Quen mat khau | Route da duoc khai bao nhung chua co view xu ly | Chua hoan tat |
| ADMIN-01 | Quan tri he thong | Luong admin moi dung o muc dang nhap demo; route/man hinh `/admin` chua duoc dinh nghia trong repo hien tai | Chua trien khai |
| DATA-01 | Dong bo du lieu chuyen xe/ve/ghe | Chua co API va model nghiep vu rieng cho dat ve, chuyen xe, ghe ngoi | Chua trien khai |

### 4. 🔒 Yeu cau phi chuc nang

- Giao dien phai hien thi duoc tren trinh duyet desktop va mobile co ban.
- Form dang nhap co kiem tra du lieu dau vao truoc khi xu ly.
- Session duoc dung de luu trang thai dang nhap.
- Cau hinh nhay cam duoc tach trong file `.env`, dac biet la `SUPABASE_URL` va `SUPABASE_ANON_KEY`.
- Cau truc project giu dung convention cua Laravel de de mo rong ve sau.

### 5. 🧩 Rang buoc va hien trang ky thuat

- Chuc nang dat ve hien tai chu yeu la demo giao dien, chua ghi du lieu dat ve xuong co so du lieu.
- Du an chua co `routes/api.php` va chua xay dung lop service nghiep vu rieng.
- Chuc nang dang ky va quen mat khau moi o muc khung giao dien/route, chua du de van hanh thuc te.
- Tai lieu trong `reports/` la minh chung tien do va anh chup man hinh cho qua trinh phat trien.

## 📂 Cau truc thu muc du an

### 1. 🗂️ Thu muc goc

```text
du an/
|-- README.MD
|-- DECUONG.MD
|-- reports/
|   |-- REPORT_20260403.md
|   `-- images/
`-- baocaoWEB/
```

Y nghia:

- 📄 `README.MD`: tai lieu tong quan du an, dac ta rut gon va huong dan cai dat.
- 📝 `DECUONG.MD`: de cuong mon hoc va danh sach chuc nang nghiep vu mong muon.
- 🖼️ `reports/`: bao cao tien do theo ngay va anh chup giao dien.
- 💻 `baocaoWEB/`: ma nguon ung dung Laravel.

### 2. 🏗️ Cau truc chinh trong `baocaoWEB`

```text
baocaoWEB/
|-- app/
|   |-- Http/Controllers/
|   |   `-- LoginController.php
|   |-- Models/
|   `-- Providers/
|-- bootstrap/
|-- config/
|-- database/
|   |-- factories/
|   |-- migrations/
|   `-- seeders/
|-- public/
|   |-- css/
|   `-- index.php
|-- resources/
|   |-- css/
|   |-- js/
|   `-- views/
|       |-- auth/
|       |-- layouts/
|       `-- pages/
|-- routes/
|   |-- console.php
|   `-- web.php
|-- storage/
|-- tests/
|-- artisan
|-- composer.json
|-- package.json
`-- vite.config.js
```

Mo ta nhanh:

- ⚙️ `app/Http/Controllers/`: xu ly request; hien tai tap trung vao dang nhap.
- 🔐 `resources/views/auth/`: giao dien dang nhap va khung dang ky.
- 🏠 `resources/views/layouts/`: giao dien trang chu va trang dat ve.
- 🧱 `resources/views/pages/`: header va footer dung chung.
- 🎨 `public/css/`: file CSS thu cong cho trang chu, dang nhap va dat ve.
- 🛣️ `routes/web.php`: dinh nghia cac route giao dien web.
- 🗃️ `database/migrations/`: migration mac dinh cua Laravel, san sang cho viec mo rong CSDL.
- 🧪 `tests/`: bo test mac dinh cua Laravel, chua co test nghiep vu rieng.

## ⚙️ Huong dan cai dat

### 1. 🧰 Yeu cau moi truong

- PHP 8.2 tro len
- Composer
- Node.js va NPM
- Tai khoan Supabase neu muon kiem thu luong dang nhap nguoi dung thuc

### 2. 📥 Cai dat du an

```bash
cd baocaoWEB
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Neu dung PowerShell tren Windows, co the thay lenh sao chep `.env` bang:

```powershell
Copy-Item .env.example .env
```

### 3. 🔑 Cau hinh bien moi truong

Cap nhat it nhat cac bien sau trong file `.env`:

```env
APP_NAME="Website Ban Ve Xe Bus"
APP_URL=http://127.0.0.1:8000

SUPABASE_URL=https://your-project.supabase.co
SUPABASE_ANON_KEY=your-anon-key
```

Neu can su dung cac bang mac dinh cua Laravel:

```bash
php artisan migrate
```

### 4. ▶️ Chay ung dung

```bash
npm run dev
php artisan serve
```

Truy cap: `http://127.0.0.1:8000`

## 🔗 Tai lieu lien quan

- [De cuong mon hoc](./DECUONG.MD)
- [Bao cao ngay 03/04/2026](./reports/REPORT_20260403.md)

## 📌 Ghi chu

- README nay duoc viet theo trang thai code hien co trong repo, khong mo ta vuot qua nhung gi dang ton tai.
- Neu bo sung cac module nhu dang ky, admin, quan ly chuyen xe hoac thanh toan, can cap nhat lai bang yeu cau chuc nang va cau truc thu muc.
