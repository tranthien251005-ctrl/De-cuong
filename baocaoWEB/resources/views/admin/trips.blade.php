<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý chuyến - Admin</title>
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
                        <h1>Quản lý chuyến</h1>
                        <p>Danh sách tất cả chuyến xe</p>
                    </div>
                    <button onclick="openCreateModal()" class="btn-primary">
                        <i class="fas fa-plus"></i> Thêm chuyến mới
                    </button>
                </div>
                
                <!-- Filter -->
                <div class="filter-section">
                    <div class="filter-group">
                        <input type="date" class="filter-input">
                        <select class="filter-select">
                            <option>Tất cả tuyến</option>
                            <option>Hà Nội - Nam Định</option>
                            <option>Hà Nội - Ninh Bình</option>
                            <option>Nam Định - Thanh Hóa</option>
                        </select>
                        <input type="text" placeholder="Tìm kiếm chuyến..." class="filter-search">
                        <button class="filter-btn">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
                
                <!-- Bảng danh sách chuyến -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tuyến đường</th>
                            <th>Ngày đi</th>
                            <th>Giờ đi</th>
                            <th>Xe</th>
                            <th>Ghế trống</th>
                            <th>Giá vé</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="font-medium">Hà Nội - Nam Định</td>
                            <td>15/04/2026</td>
                            <td>08:00</td>
                            <td>29A-12345</td>
                            <td class="text-green-600 font-semibold">25/40</td>
                            <td class="font-semibold">150,000đ</td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editTrip(1)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteTrip(1)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button onclick="viewTickets(1)" class="action-view">
                                        <i class="fas fa-ticket-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="font-medium">Hà Nội - Ninh Bình</td>
                            <td>15/04/2026</td>
                            <td>09:30</td>
                            <td>29B-67890</td>
                            <td class="text-green-600 font-semibold">18/22</td>
                            <td class="font-semibold">120,000đ</td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button onclick="editTrip(2)" class="action-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteTrip(2)" class="action-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button onclick="viewTickets(2)" class="action-view">
                                        <i class="fas fa-ticket-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="pagination">
                    <p class="pagination-info">Hiển thị 1-2 của 15 chuyến</p>
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
    
    <!-- Modal thêm/sửa chuyến -->
    <div id="tripModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-header" id="modalTitle">Thêm chuyến mới</h2>
            <form id="tripForm">
                <div class="form-group">
                    <label class="form-label">Tuyến đường</label>
                    <select class="form-select">
                        <option>Hà Nội - Nam Định</option>
                        <option>Hà Nội - Ninh Bình</option>
                        <option>Nam Định - Thanh Hóa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Ngày đi</label>
                    <input type="date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Giờ đi</label>
                    <input type="time" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Xe</label>
                    <select class="form-select">
                        <option>29A-12345 (40 ghế)</option>
                        <option>29B-67890 (22 ghế)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Giá vé</label>
                    <input type="number" class="form-input" placeholder="Nhập giá vé">
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
            document.getElementById('modalTitle').innerText = 'Thêm chuyến mới';
            document.getElementById('tripModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('tripModal').classList.remove('show');
        }
        
        function editTrip(id) { alert('Sửa chuyến ID: ' + id); }
        function deleteTrip(id) { if(confirm('Xóa chuyến?')) alert('Đã xóa'); }
        function viewTickets(id) { alert('Xem vé chuyến ID: ' + id); }
    </script>
</body>
</html>