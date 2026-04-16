<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css'])
</head>
<body class="font-['Inter']">
    <div class="admin-container">
        @include('admin.partials.sidebar')
        
        <main class="admin-main">
            <div class="main-content">
                <div class="header-actions">
                    <div class="page-header" style="margin-bottom: 0;">
                        <h1>Quản lý người dùng</h1>
                        <p>Danh sách tất cả tài khoản trong hệ thống</p>
                    </div>
                    <a href="{{ route('admin.users.create') }}" class="btn-primary">
                        <i class="fas fa-plus"></i> Thêm người dùng
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- Filter -->
                <div class="filter-section">
                    <div class="filter-group">
                        <input type="text" placeholder="Tìm kiếm người dùng..." class="filter-search">
                        <select class="filter-select">
                            <option>Tất cả vai trò</option>
                            <option>Admin</option>
                            <option>Người dùng</option>
                        </select>
                        <button class="filter-btn">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
                
                <!-- Bảng danh sách người dùng -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày tạo</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="font-medium">Quản trị viên</td>
                            <td>admin</td>
                            <td>admin@mybus.com</td>
                            <td><span class="badge-info">Admin</span></td>
                            <td>01/01/2026</td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editUser(1)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteUser(1)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="font-medium">Nguyễn Văn A</td>
                            <td>0987654321</td>
                            <td>nguyenvana@email.com</td>
                            <td><span class="badge-success">Người dùng</span></td>
                            <td>15/03/2026</td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editUser(2)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteUser(2)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="pagination">
                    <p class="pagination-info">Hiển thị 1-2 của 10 người dùng</p>
                    <div class="pagination-buttons">
                        <button class="pagination-btn">Trước</button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">Sau</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        function editUser(id) { alert('Sửa người dùng ID: ' + id); }
        function deleteUser(id) { if(confirm('Xóa người dùng?')) alert('Đã xóa'); }
    </script>
</body>
</html>