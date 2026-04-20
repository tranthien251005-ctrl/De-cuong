<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý vé - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-container">
        @include('admin.partials.sidebar')
        
        <main class="admin-main">
            <div class="main-content">
                <div class="header-actions">
                    <div class="page-header">
                        <h1>Quản lý vé</h1>
                        <p>Danh sách tất cả vé đã bán</p>
                    </div>
                    <div class="action-group" style="gap: 0.75rem;">
                        <button onclick="exportTickets()" class="btn-primary">
                            <i class="fas fa-file-excel"></i> Xuất Excel
                        </button>
                        <button onclick="printReport()" class="btn-outline">
                            <i class="fas fa-print"></i> In báo cáo
                        </button>
                    </div>
                </div>
                
                <!-- Thống kê nhanh -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-content">
                            <div>
                                <p class="stat-label">Tổng vé đã bán</p>
                                <p class="stat-value">1,234</p>
                            </div>
                            <div class="stat-icon bg-blue-100">
                                <i class="fas fa-ticket-alt text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-content">
                            <div>
                                <p class="stat-label">Doanh thu</p>
                                <p class="stat-value">185.5M</p>
                            </div>
                            <div class="stat-icon bg-green-100">
                                <i class="fas fa-money-bill-wave text-green-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-content">
                            <div>
                                <p class="stat-label">Vé hôm nay</p>
                                <p class="stat-value">45</p>
                            </div>
                            <div class="stat-icon bg-orange-100">
                                <i class="fas fa-calendar-day text-orange-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-content">
                            <div>
                                <p class="stat-label">Tỷ lệ lấp đầy</p>
                                <p class="stat-value">78%</p>
                            </div>
                            <div class="stat-icon bg-purple-100">
                                <i class="fas fa-chart-line text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Filter -->
                <div class="filter-section">
                    <div class="filter-group">
                        <input type="date" class="filter-input">
                        <input type="date" class="filter-input">
                        <select class="filter-select">
                            <option>Tất cả trạng thái</option>
                            <option>Đã thanh toán</option>
                            <option>Chờ thanh toán</option>
                            <option>Đã hủy</option>
                        </select>
                        <input type="text" placeholder="Mã vé / SĐT khách..." class="filter-search">
                        <button class="filter-btn">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
                
                <!-- Bảng danh sách vé -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Mã vé</th>
                            <th>Hành khách</th>
                            <th>Tuyến đường</th>
                            <th>Ngày đi</th>
                            <th>Giờ đi</th>
                            <th>Ghế</th>
                            <th>Giá vé</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-medium" style="color: #2563eb;">#V-001234</td>
                            <td>Nguyễn Văn A</td>
                            <td>Hà Nội - Nam Định</td>
                            <td>15/04/2026</td>
                            <td>08:00</td>
                            <td>A12</td>
                            <td class="font-semibold">150,000đ</td>
                            <td><span class="badge-success">Đã thanh toán</span></td>
                            <td>
                                <div class="action-group">
                                    <button onclick="viewTicket('#V-001234')" class="action-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="cancelTicket('#V-001234')" class="action-delete">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                    <button onclick="printTicket('#V-001234')" class="action-edit">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-medium" style="color: #2563eb;">#V-001235</td>
                            <td>Trần Thị B</td>
                            <td>Hà Nội - Ninh Bình</td>
                            <td>15/04/2026</td>
                            <td>09:30</td>
                            <td>B05</td>
                            <td class="font-semibold">120,000đ</td>
                            <td><span class="badge-warning">Chờ thanh toán</span></td>
                            <td>
                                <div class="action-group">
                                    <button onclick="viewTicket('#V-001235')" class="action-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="cancelTicket('#V-001235')" class="action-delete">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                    <button onclick="printTicket('#V-001235')" class="action-edit">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-medium" style="color: #2563eb;">#V-001236</td>
                            <td>Lê Văn C</td>
                            <td>Nam Định - Thanh Hóa</td>
                            <td>16/04/2026</td>
                            <td>14:00</td>
                            <td>C08</td>
                            <td class="font-semibold">90,000đ</td>
                            <td><span class="badge-danger">Đã hủy</span></td>
                            <td>
                                <div class="action-group">
                                    <button onclick="viewTicket('#V-001236')" class="action-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="cancelTicket('#V-001236')" class="action-delete">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                    <button onclick="printTicket('#V-001236')" class="action-edit">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="pagination">
                    <p class="pagination-info">Hiển thị 1-3 của 234 vé</p>
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
    
    <!-- Modal chi tiết vé -->
    <div id="ticketModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-header">Chi tiết vé</h2>
            <div class="form-group">
                <label class="form-label">Mã vé:</label>
                <p class="form-label" id="ticketCode" style="font-weight: normal;">#V-001234</p>
            </div>
            <div class="form-group">
                <label class="form-label">Hành khách:</label>
                <p class="form-label" id="passengerName" style="font-weight: normal;">Nguyễn Văn A</p>
            </div>
            <div class="form-group">
                <label class="form-label">Số điện thoại:</label>
                <p class="form-label" id="phone" style="font-weight: normal;">0987654321</p>
            </div>
            <div class="form-group">
                <label class="form-label">Tuyến đường:</label>
                <p class="form-label" id="route" style="font-weight: normal;">Hà Nội - Nam Định</p>
            </div>
            <div class="form-group">
                <label class="form-label">Ngày giờ đi:</label>
                <p class="form-label" id="departure" style="font-weight: normal;">15/04/2026 - 08:00</p>
            </div>
            <div class="form-group">
                <label class="form-label">Số ghế:</label>
                <p class="form-label" id="seat" style="font-weight: normal;">A12</p>
            </div>
            <div class="form-group">
                <label class="form-label">Giá vé:</label>
                <p class="form-label" id="price" style="font-weight: bold; color: #16a34a;">150,000đ</p>
            </div>
            <div class="modal-footer">
                <button onclick="closeModal()" class="btn-outline">Đóng</button>
                <button onclick="printCurrentTicket()" class="btn-primary">In vé</button>
            </div>
        </div>
    </div>
    
    <script>
        function viewTicket(code) {
            document.getElementById('ticketModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('ticketModal').classList.remove('show');
        }
        
        function cancelTicket(code) {
            if(confirm('Hủy vé ' + code + '?')) {
                alert('Đã hủy vé!');
            }
        }
        
        function printTicket(code) {
            alert('Đang in vé ' + code);
        }
        
        function printCurrentTicket() {
            alert('Đang in vé hiện tại');
        }
        
        function exportTickets() {
            alert('Xuất danh sách vé ra Excel');
        }
        
        function printReport() {
            alert('In báo cáo vé');
        }
    </script>
</body>
</html>
