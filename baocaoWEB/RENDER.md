# Deploy lên Render

## File đã chuẩn bị sẵn

- `Dockerfile.render`: image riêng cho Render
- `docker/scripts/start-render.sh`: script khởi động app trên cổng Render cấp
- `render.yaml`: blueprint mẫu để tạo web service

## Cách deploy

1. Đẩy repo này lên GitHub.
2. Vào Render, chọn `New +` -> `Blueprint`.
3. Chọn repo chứa dự án `baocaoWEB`.
4. Render sẽ đọc file `render.yaml`.
5. Khi được hỏi biến môi trường, nhập:

```text
APP_KEY=base64:...
APP_URL=https://ten-app-cua-ban.onrender.com
DB_URL=postgresql://postgres.lihtjssuurywbduijupu:MAT_KHAU@aws-1-ap-northeast-1.pooler.supabase.com:5432/postgres
```

## APP_KEY

Tạo `APP_KEY` bằng lệnh local:

```powershell
php artisan key:generate --show
```

## Ghi chú

- Dự án này đang dùng Supabase, nên không cần tạo Postgres trên Render nếu bạn tiếp tục dùng Supabase.
- Nếu schema Supabase đã có sẵn dữ liệu thì không cần thêm lệnh migrate.
- Nếu sau này bạn có migration riêng muốn chạy mỗi lần deploy, có thể thêm `preDeployCommand`.
