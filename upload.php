<?php
require("phandau.php");
// Kiểm tra nếu chưa đăng nhập thì chuyển hướng
    if(!isset($_SESSION['username'])) {
        header("Location: dangnhap.php");
        exit();
    }
?>

<head>
  <style>
    .upload-box {
      background: #fff;
      max-width: 600px;
      margin: 30px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }
    .btn-upload {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      border: none;
      transition: 0.3s;
    }
    .btn-upload:hover {
      background-color: #43A047;
    }
  </style>
</head>
<body>

<div class="upload-box">
  <h2>📤 Upload Tài Liệu Của Bạn</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label>Tên tài liệu:</label>
      <input type="text" name="ten_tl" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Tác giả:</label>
      <input type="text" name="tacgia" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Mô tả:</label>
      <textarea name="mo_ta" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label>Chọn file tài liệu:</label>
      <input type="file" name="file" class="form-control" required>
    </div>
    <div class="text-center">
      <button type="submit" name="sbsubmit" class="btn-upload">Tải lên</button>
      <a href="index.php" class="btn btn-default">← Quay lại</a>
    </div>
  </form>

<?php
if (isset($_POST['sbsubmit'])) {
    $ten_tl = $_POST['ten_tl'];
    $tacgia = $_POST['tacgia'];
    $mo_ta = $_POST['mo_ta'];

    $file = $_FILES['file']['name'];
    $target_dir = "tailieu/";
    $target_file = $target_dir . basename($file);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra thư mục uploads có tồn tại không
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Giới hạn loại file
    $allow_types = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($file_type, $allow_types)) {
               if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO tailieu (tentailieu, nguoidang, motatailieu, hinh)
                    VALUES ('$ten_tl', '$tacgia', '$mo_ta', '$target_file')";
            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success text-center' style='margin-top:10px;'>✅ Tải tài liệu lên thành công!</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>❌ Lỗi SQL: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>❌ Không thể lưu file vào thư mục uploads/</div>";
        }
    }else{
       echo "<div class='alert alert-danger text-center' style='margin-top:10px;'>❌ Chỉ cho phép upload file tài liệu (.jpg, .png, .jpeg, .gif)</div>";
    
    }
}
?>

</div>

</body>
</html>
<?php
require("phacuoi.php");
?>