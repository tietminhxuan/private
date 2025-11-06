
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


