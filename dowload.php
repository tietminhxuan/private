<?php
require("phandau.php");
?>
<head>
  
  <style>
    .table th {
      background-color: #4CAF50;
      color: white;
    }
    .btn-download {
      background-color: #4CAF50;
      color: white;
      border-radius: 6px;
      padding: 5px 10px;
    }
    .btn-download:hover {
      background-color: #45a049;
      color: white;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>📚 Danh sách tài liệu</h2>

  <?php
  $sql = "SELECT * FROM tailieu ORDER BY ngaydang DESC";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
      echo '<table class="table table-bordered table-hover">';
      echo '<thead><tr>
              <th>Mã tài liệu</th>
              <th>Tên tài liệu</th>
              <th>Tác giả</th>
              <th>Mô tả</th>
              <th>Ngày đăng</th>
              <th>Tải xuống</th>
            </tr></thead><tbody>';
      while($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>'.$row["matailieu"].'</td>';
          echo '<td>'.$row["tentailieu"].'</td>';
          echo '<td>'.$row["nguoidang"].'</td>';
          echo '<td>'.$row["motatailieu"].'</td>';
          echo '<td>'.date("d/m/Y H:i", strtotime($row["ngaydang"])).'</td>';
          echo '<td><a class="btn btn-download" href="'.$row["hinh"].'" download>Tải về</a></td>';
          echo '</tr>';
      }
      echo '</tbody></table>';
  } else {
      echo "<p class='text-center text-muted'>Chưa có tài liệu nào được đăng tải.</p>";
  }

  mysqli_close($conn);
  ?>

  <div class="text-center">
    <a href="index.php" class="btn btn-default">← Quay lại trang chủ</a>
  </div>
</div>

</body>
</html>
<?php
require("phacuoi.php");
?>
