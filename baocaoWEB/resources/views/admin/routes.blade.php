<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tuyến - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="font-['Inter']">
    <div class="admin-container">
        @include('admin.partials.sidebar')
        
        <main class="admin-main">
            <div class="main-content">
                <div class="header-actions">
                    <div class="page-header" style="margin-bottom: 0;">
                        <h1>Quản lý tuyến</h1>
                        <p>Danh sách tất cả tuyến xe</p>
                    </div>
                    <button onclick="openCreateModal()" class="btn-primary">
                        <i class="fas fa-plus"></i> Thêm tuyến mới
                    </button>
                </div>
                
                <!-- Filter -->
                <div class="filter-section">
                    <div class="filter-group">
                        <input type="text" placeholder="Tìm kiếm tuyến..." class="filter-search">
                        <button class="filter-btn">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
                
                <!-- Bảng danh sách tuyến -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Điểm đi</th>
                            <th>Điểm đến</th>
                            <th>Khoảng cách</th>
                            <th>Thời gian</th>
                            <th>Giá vé mặc định</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td>1</td>
                            <td class="font-medium">Hà Nội</td>
                            <td class="font-medium">Nam Định</td>
                            <td>110 km</td>
                            <td>2.5 giờ</td>
                            <td class="font-semibold">150,000đ</td>
                            <td><span class="badge-success">Đang hoạt động</span></td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editRoute(1)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteRoute(1)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td>2</td>
                            <td class="font-medium">Hà Nội</td>
                            <td class="font-medium">Ninh Bình</td>
                            <td>90 km</td>
                            <td>2 giờ</td>
                            <td class="font-semibold">120,000đ</td>
                            <td><span class="badge-success">Đang hoạt động</span></td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editRoute(2)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteRoute(2)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td>3</td>
                            <td class="font-medium">Nam Định</td>
                            <td class="font-medium">Thanh Hóa</td>
                            <td>85 km</td>
                            <td>1.8 giờ</td>
                            <td class="font-semibold">90,000đ</td>
                            <td><span class="badge-success">Đang hoạt động</span></td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editRoute(3)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteRoute(3)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="pagination">
                    <p class="pagination-info">Hiển thị 1-3 của 6 tuyến</p>
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
    
    <!-- Modal thêm/sửa tuyến -->
    <div id="routeModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-header" id="modalTitle">Thêm tuyến mới</h2>
            <form id="routeForm">
                <div class="form-group">
                    <label class="form-label">Điểm đi</label>
                    <input type="text" class="form-input" placeholder="VD: Hà Nội">
                </div>
                <div class="form-group">
                    <label class="form-label">Điểm đến</label>
                    <input type="text" class="form-input" placeholder="VD: Nam Định">
                </div>
                <div class="form-group">
                    <label class="form-label">Khoảng cách (km)</label>
                    <input type="number" class="form-input" placeholder="VD: 110">
                </div>
                <div class="form-group">
                    <label class="form-label">Thời gian (giờ)</label>
                    <input type="text" class="form-input" placeholder="VD: 2.5">
                </div>
                <div class="form-group">
                    <label class="form-label">Giá vé mặc định</label>
                    <input type="number" class="form-input" placeholder="VD: 150000">
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal()" class="btn-outline flex-1">Hủy</button>
                    <button type="submit" class="btn-primary flex-1">Lưu</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function openCreateModal() {
            document.getElementById('modalTitle').innerText = 'Thêm tuyến mới';
            document.getElementById('routeModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('routeModal').classList.remove('show');
        }
        
        function editRoute(id) {
            document.getElementById('modalTitle').innerText = 'Sửa thông tin tuyến';
            document.getElementById('routeModal').classList.add('show');
        }
        
        function deleteRoute(id) {
            if(confirm('Bạn có chắc chắn muốn xóa tuyến này?')) {
                alert('Đã xóa tuyến!');
            }
        }
    </script>
</body>
</html>
