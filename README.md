# Software Requirement Specification (SRS)
## Chức năng: Hệ thống Xác thực người dùng (User Authentication)
**Mã chức năng:** AUTH-01  
**Trạng thái:** Draft / Review  
**Người soạn thảo:** [thientn]  
**Vai trò:** Student

---

### 1. Mô tả tổng quan (Description): Cung cấp cơ chế xác thực an toàn để người dùng (Nghiên cứu viên/Quản trị viên) truy cập vào hệ thống quản lý dữ liệu và mô hình AI. Đảm bảo tính bảo mật cho các tài sản trí tuệ và kết quả thí nghiệm.
Bài làm
1. Mục tiêu
Đảm bảo chỉ Nghiên cứu viên và Quản trị viên được ủy quyền mới có thể truy cập hệ thống quản lý dữ liệu và mô hình AI, bảo vệ tài sản trí tuệ và kết quả thí nghiệm.

2. Chức năng chính
2.1. Đăng ký và tạo tài khoản
2.2. Đăng nhập
2.3. Quản lý phiên làm việc
2.4. Quản lý mật khẩu

3. Bào mật và phòng chống tấn công
3.1. Lưu mật khẩu: không lưu plain text, sử dụng thuật toán ‘Argon2’ hoặc ‘Bcrypt’
3.2. Chống brute force: sai 5 lần liên tiếp tạm khóa 15 phút
3.3. Chống dò thông tin: thông báo lỗi chung: “Thông tin đăng nhập không hợp lệ”
3.4. Truyền tải: toàn bộ dữ liệu xác thực qua HTTPS/TLS.

4. Phân quyền theo vai trò (RBAC)
Quản trị viên (admin)
- Tạo/sửa/xóa tài khoản người dùng.
- Xem toàn bộ nhật ký hệ thống (audit log).
- Thu hồi phiên làm việc của bất kỳ người dùng nào.
- Bắt buộc MFA.
Nghiên cứu viên (Researcher)
- Chỉ xem và quản lý thông tin cá nhân.
- Xem lịch sử đăng nhập của chính mình.
- Tự đổi mật khẩu.
- Không truy cập dữ liệu của người dùng khác.

5. Giám sát và ghi nhật ký (audit)
Ghi lại tất cả các sự kiện quan trọng
- Đăng nhập thành công / thất bại.
- Thay đổi mật khẩu.
- Khóa / mở khóa tài khoản.
- Thu hồi phiên làm việc.

Thông tin log bao gồm:
- User ID
- Thời gian
- Địa chỉ IP
- Loại sự kiện

6. Cảnh báo và xử lý bất thường
Đăng nhập từ thiết bị/IP lạ: Hệ thống tự động gửi email cảnh báo: "Có đăng nhập mới từ [IP] – [vị trí gần đúng]. Nếu không phải bạn, hãy đổi mật khẩu ngay.".
Khóa tài khoản vĩnh viễn (chờ Admin mở): Xảy ra khi có 10 lần đăng nhập sai liên tiếp trong 1 giờ hoặc phát hiện hành vi tấn công brute force.

7. Hiệu năng và sẵn sàng
Thời gian xác thực (<= 2s)
Số người dùng đồng thời (>= 1000 người)
Thời gian phục hồi sự cố (Tối đa 30 phút)
8. Kết luận
Hệ thống xác thực được thiết kế theo hướng an toàn, kiểm soát chặt chẽ, phân quyền rõ ràng, phù hợp với môi trường quản lý dữ liệu nghiên cứu và mô hình AI – nơi yêu cầu cao về bảo mật và khả năng kiểm toán.

### 2. Luồng nghiệp vụ (User Workflow)
| Bước | Hành động người dùng | Phản hồi hệ thống |
| :--- | :--- | :--- |
| 1 | Truy cập URL `/login` | Hiển thị Form đăng nhập (Email, Password, Remember Me). |
| 2 | Nhập thông tin và nhấn "Login" | Validate định dạng dữ liệu đầu vào (Client-side & Server-side). |
| 3 | Hệ thống kiểm tra thông tin | So khớp Email và mã hóa Password (Bcrypt) trong Database. |
| 4 | Xác thực thành công | Khởi tạo Session/Token, chuyển hướng về Dashboard. |
| 5 | Xác thực thất bại | Giữ nguyên trang, hiển thị thông báo lỗi và xóa trường Password. |
Bài làm
Bước	Hành động người dùng	Phản hồi hệ thống	Ghi chú
1	Truy cập URL /login	Kiểm tra trạng thái session hiện tại.
Nếu đã đăng nhập → tự động chuyển hướng về Dashboard.
Nếu chưa đăng nhập → hiển thị Form đăng nhập (Email/Username, Password, Remember Me).	
2	Nhập thông tin và nhấn "Login"	Client-side validation: Kiểm tra định dạng email, mật khẩu không để trống.
Rate limiting check: Kiểm tra số lần đăng nhập sai từ IP này trong 15 phút qua.	Nếu vi phạm rate limit → thông báo "Tạm khóa 15 phút"
3	Hệ thống kiểm tra thông tin	Server-side validation: Kiểm tra tài khoản tồn tại.
So khớp mật khẩu: Sử dụng bcrypt để kiểm tra mật khẩu nhập vào với hash lưu trong DB.	
4	Xác thực thành công	Kiểm tra MFA: Nếu tài khoản yêu cầu MFA → chuyển hướng sang trang xác thực MFA.
Tạo session/token: JWT token (access + refresh) hoặc session ID.
Ghi log: Lưu sự kiện đăng nhập thành công (IP, thời gian, User-Agent).
Ghi nhớ: Nếu chọn "Remember Me" → kéo dài thời gian sống của refresh token (ví dụ 30 ngày).
Chuyển hướng: Về Dashboard theo vai trò (Admin/Researcher).	
5	Xác thực thất bại	Tăng biến đếm: Tăng số lần đăng nhập sai cho tài khoản/IP.
Ghi log: Lưu sự kiện đăng nhập thất bại.
Kiểm tra khóa tài khoản: Nếu đạt ngưỡng (5 lần sai) → khóa tạm 15 phút.
Hiển thị thông báo: "Thông tin đăng nhập không hợp lệ" (chung chung).
Xóa trường Password: Giữ lại Email/Username để người dùng nhập lại mật khẩu.	Không tiết lộ nguyên nhân cụ thể

### 3. Yêu cầu dữ liệu (Data Requirements)
#### 3.1. Dữ liệu đầu vào (Input Fields)
* **Email:** `string`, định dạng email hợp lệ, bắt buộc.
* **Password:** `string`, tối thiểu 8 ký tự, ẩn ký tự khi nhập, bắt buộc.
* **Remember Me:** `boolean`, tùy chọn (mặc định false).

#### 3.2. Dữ liệu lưu trữ (Database - Bảng `users`)
* `email`: unique, index.
* `password`: hashed string.
* `last_login_at`: timestamp (để theo dõi truy cập).
* `login_ip`: string (phục vụ Audit Log).
Bài làm
####3.1. Dữ liệu đầu vào (Input Fields)
Trường (Field)	Kiểu dữ liệu	Ràng buộc & Validation	Mô tả
Email	string	Bắt buộc (required)
Định dạng email hợp lệ (regex: ^[\w\.-]+@[\w\.-]+\.\w+$)
Độ dài tối đa: 255 ký tự
Không phân biệt chữ hoa/thường khi xử lý	Có thể nhập email hoặc username tùy theo cấu hình hệ thống
Password	string	Bắt buộc (required)
Tối thiểu: 12 ký tự (theo yêu cầu bảo mật từ mục 2.4)
Tối đa: 128 ký tự
Ẩn ký tự khi nhập (type="password")
Hỗ trợ Unicode (cho phép ký tự đặc biệt, khoảng trắng)	Đáp ứng chính sách độ mạnh mật khẩu đã nêu
Remember Me	boolean	Tùy chọn (optional)
Mặc định: false
Khi true: kéo dài thời gian sống của refresh token lên 30 ngày	Ảnh hưởng đến thời hạn của session/token

####3.2. Dữ liệu lưu trữ (Database – Bảng `users`)
Trường (Column)	Kiểu dữ liệu	Ràng buộc	Mô tả
email	VARCHAR(255)	UNIQUE, NOT NULL, INDEX	Địa chỉ email liên lạc, dùng cho khôi phục mật khẩu và thông báo
password	VARCHAR(255)	NOT NULL	Mật khẩu đã được băm bằng bcrypt (cost factor = 12) hoặc Argon2id
last_login_at	TIMESTAMP	NULL	Thời gian đăng nhập thành công gần nhất (để theo dõi truy cập)
login_ip	VARCHAR(45)	NULL	Địa chỉ IP của lần đăng nhập thành công gần nhất (IPv4 hoặc IPv6)

### 4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
* **Giao thức:** Bắt buộc sử dụng **HTTPS** để mã hóa dữ liệu trên đường truyền.
* **Bảo mật Form:** Tích hợp mã **CSRF Token** trong mọi request POST.
* **Mã hóa:** Mật khẩu không bao giờ được lưu dưới dạng văn bản thuần (Plaintext). Sử dụng thuật toán `Argon2` hoặc `Bcrypt`.
* **Throttling (Chống Brute-force):** Khóa tạm thời IP/Tài khoản nếu đăng nhập sai quá 5 lần trong 1 phút.
Bài làm
Hạng mục	Yêu cầu	Tóm tắt
Giao thức	HTTPS	Bắt buộc TLS 1.2/1.3
HTTP bị từ chối
HSTS, X-Frame-Options: DENY, CSP
Bảo mật form	CSRF Protection	Mọi POST/PUT/DELETE đều có CSRF token
Cookie có SameSite=Lax, HttpOnly, Secure
Mã hóa mật khẩu	Argon2id hoặc bcrypt	Không lưu plaintext
bcrypt cost ≥ 12
Mỗi user có salt riêng
Chống Brute-force	Throttling	IP: tối đa 10 lần sai/5 phút → khóa 15 phút
Tài khoản: 5 lần sai liên tiếp → khóa 15 phút
10 lần sai/24h → khóa vĩnh viễn (chờ Admin)

### 5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
* **Trường hợp:** Người dùng nhập sai định dạng email.  
  * **Xử lý:** Hiển thị lỗi ngay tại field: "Email không đúng định dạng".
* **Trường hợp:** Tài khoản đã bị quản trị viên khóa (Inactive).  
  * **Xử lý:** Thông báo: "Tài khoản của bạn tạm thời bị đình chỉ. Vui lòng liên hệ Admin".
* **Trường hợp:** Token CSRF hết hạn (do để trang quá lâu).  
  * **Xử lý:** Redirect về trang login với thông báo "Phiên làm việc hết hạn, vui lòng thử lại".
Bài làm
STT	Trường hợp	Xử lý & Thông báo
1	Email sai định dạng	Hiển thị ngay tại field: "Email không đúng định dạng"
2	Tài khoản bị Admin khóa (inactive)	"Tài khoản của bạn tạm thời bị đình chỉ. Vui lòng liên hệ Admin"
3	Token CSRF hết hạn	Redirect về /login kèm thông báo: "Phiên làm việc hết hạn, vui lòng thử lại"

### 6. Giao diện (UI/UX)
* Thiết kế Responsive (hoạt động tốt trên cả Desktop và Mobile).
* Nút "Login" hiển thị trạng thái `processing` (spinner) khi đang gửi request.
* Hỗ trợ phím tắt: Nhấn `Enter` để gửi form.
Bài làm
Hạng mục	Yêu cầu
Responsive	Hoạt động tốt trên Desktop, Tablet, Mobile
Nút Login	Hiển thị spinner + vô hiệu hóa khi đang xử lý
Phím tắt	Nhấn Enter để gửi form
Hiển thị lỗi	Inline validation, hiển thị ngay dưới field
Password	Có nút hiện/ẩn mật khẩu (eye icon)
Remember Me	Checkbox, mặc định không chọn
Link hỗ trợ	"Quên mật khẩu?" và "Liên hệ Admin"
