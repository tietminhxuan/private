<?php
require("phandau.php");
?>
<?php
// Kiểm tra quyền (nếu cần, ví dụ chỉ admin mới được sửa)
if (!isset($_SESSION['username'])) {
    header("Location: dangnhap.php");
    exit();
}

// Lấy ID tài liệu từ URL
if (!isset($_GET['id'])) {
    die("Thiếu ID tài liệu!");
}

$id = intval($_GET['id']);

// Xử lý cập nhật khi nhấn nút “Lưu thay đổi”
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tentailieu = mysqli_real_escape_string($conn, $_POST['tentailieu']);
    $tacgia = mysqli_real_escape_string($conn, $_POST['tacgia']);
    $ngaydang = mysqli_real_escape_string($conn, $_POST['ngaydang']);
    $mota = mysqli_real_escape_string($conn, $_POST['motatailieu']);

    // Nếu người dùng có chọn file mới → cập nhật file
    if (!empty($_FILES['hinh']['name'])) {
        $target_dir = "tailieu/";
        $file_name = basename($_FILES["hinh"]["name"]);
        $target_file = $target_dir . $file_name;

        // Upload file mới
        if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
            // Lấy đường dẫn cũ để xóa file cũ
            $old_sql = "SELECT hinh FROM tailieu WHERE matailieu = $id";
            $old_result = mysqli_query($conn, $old_sql);
            if ($old_result && mysqli_num_rows($old_result) > 0) {
                $old_row = mysqli_fetch_assoc($old_result);
                if (file_exists($old_row['hinh'])) {
                    unlink($old_row['hinh']); // Xóa file cũ
                }
            }

            // Cập nhật CSDL với file mới
            $sql = "UPDATE tailieu SET tentailieu='$tentailieu', tacgia='$tacgia', ngaydang='$ngaydang', motatailieu='$mota', hinh='$target_file' WHERE matailieu =$id";
        } else {
            die("Lỗi khi tải lên file mới!");
        }
    } else {
        // Không đổi file
        $sql = "UPDATE tailieu SET tentailieu='$tentailieu', nguoidang='$tacgia', ngaydang='$ngaydang', motatailieu='$mota' WHERE matailieu=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Cập nhật thành công!'); window.location='quanlytailieu.php';</script>";
    } else {
        echo "Lỗi khi cập nhật: " . mysqli_error($conn);
    }
}

// Lấy dữ liệu cũ để hiển thị vào form
$sql = "SELECT * FROM tailieu WHERE matailieu = $id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Không tìm thấy tài liệu!");
}
$row = mysqli_fetch_assoc($result);
?>


<body class="container" style="margin-top:40px;">
    <h3 class="text-center">📝 Sửa thông tin tài liệu</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên tài liệu</label>
            <input type="text" name="tentailieu" class="form-control" value="<?php echo htmlspecialchars($row['tentailieu']); ?>" required>
        </div>

        <div class="form-group">
            <label>Tác giả</label>
            <input type="text" name="tacgia" class="form-control" value="<?php echo htmlspecialchars($row['nguoidang']); ?>" required>
        </div>

        <div class="form-group">
            <label>Ngày đăng</label>
            <input type="date" name="ngaydang" class="form-control" value="<?php echo htmlspecialchars($row['ngaydang']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Mô tả tài liệu</label>
            <textarea name="motatailieu" class="form-control" rows="5" placeholder="Nhập mô tả ngắn gọn về tài liệu..."><?php 
                echo htmlspecialchars($row['motatailieu']); 
            ?></textarea>
        </div>

        <div class="form-group">
            <label>File hiện tại:</label><br>
            <a href="<?php echo $row['hinh']; ?>" target="_blank"><?php echo basename($row['hinh']); ?></a>
        </div>

        <div class="form-group">
            <label>Chọn file mới (nếu muốn thay):</label>
            <input type="file" name="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
        <a href="quanlytailieu.php" class="btn btn-default">🔙 Quay lại</a>
    </form>
</body>
</html>
<?php
require("phacuoi.php");
?>
