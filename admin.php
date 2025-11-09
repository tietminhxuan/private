
<?php
  require ("phandau.php");
  require("config.php");
  if(!isset($_SESSION['username']) || $_SESSION['role'] !=1){
    header("location:dangnhap.php");
    exit();
  }
?>
<div class="container">
  <div class="admin-header">
    <h2><i class="fa-solid fa-gear"></i> TRANG QUẢN TRỊ</h2>
    <!-- Tab Thống kê -->
  <h3 class="text-center mb-4">📊 Thống kê số liệu</h3>

  <?php
  // Kết nối database
  include("config.php");

  // 1️⃣ Tổng số người dùng
  $sql_users = "SELECT COUNT(*) AS total_users FROM nguoidung";
  $res_users = $conn->query($sql_users);
  $row_users = $res_users->fetch_assoc();
  $total_users = $row_users['total_users'];

  // 2️⃣ Tổng số tài liệu đã tải lên
  $sql_docs = "SELECT COUNT(*) AS total_docs FROM tailieu";
  $res_docs = $conn->query($sql_docs);
  $row_docs = $res_docs->fetch_assoc();
  $total_docs = $row_docs['total_docs'];

  // 3️⃣ Giả sử có bảng `luotxem` hoặc cột `view_count` trong `tailieu`
  // Nếu có cột view_count thì ta dùng như sau:
  $sql_views = "SELECT SUM(view) AS total_views FROM tailieu";
  $res_views = $conn->query($sql_views);
  $row_views = $res_views->fetch_assoc();
  $total_views = $row_views['total_views'] ?? 0;

  // Tính tỷ lệ % click = (tổng lượt xem / tổng tài liệu)
  $click_rate = ($total_docs > 0) ? round(($total_views / $total_docs), 2) : 0;
  ?>

  <div class="row text-center">
    <div class="col-md-4">
      <div class="card shadow-sm p-3">
        <h5>👤 Người dùng đã đăng ký</h5>
        <h2 class="text-primary"><?php echo $total_users; ?></h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm p-3">
        <h5>📚 Tổng số tài liệu đã tải lên</h5>
        <h2 class="text-success"><?php echo $total_docs; ?></h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm p-3">
        <h5>📈 Tỷ lệ % click vào bài đăng</h5>
        <h2 class="text-warning"><?php echo $click_rate; ?>%</h2>
      </div>
    </div>
  </div>
  </div>

  <!-- Tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#users"><i class="fa-solid fa-users"></i> Quản lý người dùng</a></li>
    <li><a data-toggle="tab" href="#documents"><i class="fa-solid fa-file-lines"></i> Quản lý tài liệu</a></li>
  </ul>

  <div class="tab-content" style="margin-top:20px;">
    
    <!-- Tab Quản lý người dùng -->
    <div id="users" class="tab-pane fade in active">
      <h3><i class="fa-solid fa-user-gear"></i> Danh sách người dùng</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
$sql = "SELECT * FROM nguoidung"; // hoặc users tùy tên bảng của bạn
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
  echo "<tr>";
  echo "<td>" . htmlspecialchars($row['Manguoidung']) . "</td>";              // id
  echo "<td>" . htmlspecialchars($row['username'] ?? $row['ten']) . "</td>"; // username hoặc ten
  echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
  echo "<td>" . htmlspecialchars($row['role'] ?? '') . "</td>";
  // nút Xóa: nối biến PHP vào chuỗi
  echo '<td>
          <a href="xoa.php?type=nguoidung&id=' . intval($row['Manguoidung']) . '" 
             onclick="return confirm(\'Bạn có chắc muốn xóa người dùng này?\');" 
             class="btn btn-danger btn-sm">Xóa</a>
        </td>';
  echo "</tr>";
}
?>

        </tbody>
      </table>
    </div>

    <!-- Tab Quản lý tài liệu -->
    <div id="documents" class="tab-pane fade">
      <h3><i class="fa-solid fa-book-open"></i> Danh sách tài liệu</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên tài liệu</th>
            <th>Tác giả</th>
            <th>Ngày đăng</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
$sql = "SELECT * FROM tailieu"; // hoặc users tùy tên bảng của bạn
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
  echo "<tr>";
  echo "<td>" . htmlspecialchars($row['matailieu']) . "</td>";              // id
  echo "<td>" . htmlspecialchars($row['tentailieu'] ?? $row['ten']) . "</td>"; // username hoặc ten
  echo "<td>" . htmlspecialchars($row['nguoidang'] ?? '') . "</td>";
  echo "<td>" . htmlspecialchars($row['ngaydang'] ?? '') . "</td>";
  // nút Xóa: nối biến PHP vào chuỗi
  echo '<td>
          <a href="xoa.php?type=hinh&id=' . intval($row['matailieu']) . '" 
             onclick="return confirm(\'Bạn có chắc muốn xóa tailieu này?\');" 
             class="btn btn-danger btn-sm">Xóa</a>
        </td>';
  echo "</tr>";
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>


</body>
</html>

<?php
require("phacuoi.php");
?>


