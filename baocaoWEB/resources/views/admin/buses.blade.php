<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý xe - Admin</title>
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
                        <h1>Quản lý xe</h1>
                        <p>Danh sách tất cả xe trong hệ thống</p>
                    </div>
                    <button onclick="openCreateModal()" class="btn-primary">
                        <i class="fas fa-plus"></i> Thêm xe mới
                    </button>
                </div>
                
                <!-- Filter -->
                <div class="filter-section">
                    <div class="filter-group">
                        <select class="filter-select">
                            <option>Tất cả trạng thái</option>
                            <option>Đang hoạt động</option>
                            <option>Bảo trì</option>
                            <option>Ngừng hoạt động</option>
                        </select>
                        <input type="text" placeholder="Tìm kiếm xe..." class="filter-search">
                        <button class="filter-btn">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
                
                <!-- Bảng danh sách xe -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Biển số xe</th>
                            <th>Loại xe</th>
                            <th>Số ghế</th>
                            <th>Nhà xe</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td>1</td>
                            <td class="font-medium">29A-12345</td>
                            <td>Giường nằm</td>
                            <td>40</td>
                            <td>MY BUS</td>
                            <td><span class="badge-success">Đang hoạt động</span></td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editBus(1)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteBus(1)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td>2</td>
                            <td class="font-medium">29B-67890</td>
                            <td>Limousine</td>
                            <td>22</td>
                            <td>MY BUS</td>
                            <td><span class="badge-warning">Bảo trì</span></td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editBus(2)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteBus(2)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td>3</td>
                            <td class="font-medium">29C-11223</td>
                            <td>Ghế ngồi</td>
                            <td>35</td>
                            <td>MY BUS</td>
                            <td><span class="badge-success">Đang hoạt động</span></td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editBus(3)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteBus(3)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="pagination">
                    <p class="pagination-info">Hiển thị 1-3 của 10 xe</p>
                    <div class="pagination-buttons">
                        <button class="pagination-btn">Trước</button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">Sau</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Modal thêm/sửa xe -->
    <div id="busModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-header" id="modalTitle">Thêm xe mới</h2>
            <form id="busForm">
                <div class="form-group">
                    <label class="form-label">Biển số xe</label>
                    <input type="text" class="form-input" placeholder="VD: 29A-12345">
                </div>
                <div class="form-group">
                    <label class="form-label">Loại xe</label>
                    <select class="form-select">
                        <option>Giường nằm</option>
                        <option>Limousine</option>
                        <option>Ghế ngồi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Số ghế</label>
                    <input type="number" class="form-input" placeholder="Số lượng ghế">
                </div>
                <div class="form-group">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select">
                        <option>Đang hoạt động</option>
                        <option>Bảo trì</option>
                        <option>Ngừng hoạt động</option>
                    </select>
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
            document.getElementById('modalTitle').innerText = 'Thêm xe mới';
            document.getElementById('busModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('busModal').classList.remove('show');
        }
        
        function editBus(id) {
            document.getElementById('modalTitle').innerText = 'Sửa thông tin xe';
            document.getElementById('busModal').classList.add('show');
        }
        
        function deleteBus(id) {
            if(confirm('Bạn có chắc chắn muốn xóa xe này?')) {
                alert('Đã xóa xe!');
            }
        }
    </script>
</body>
</html>
