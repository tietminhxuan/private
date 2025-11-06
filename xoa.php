<?php
ob_start();
session_start();
require("config.php");

// ✅ Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 1) {
    echo "<script>alert('Bạn không có quyền thực hiện hành động này!'); window.location='index.php';</script>";
    exit();
}

// ✅ Kiểm tra tham số URL
if (!isset($_GET['type']) || !isset($_GET['id'])) {
    echo "<script>alert('Thiếu dữ liệu!'); window.location='admin.php';</script>";
    exit();
}

$type = $_GET['type'];
$id = intval($_GET['id']);

// 🧩 Xóa người dùng
if ($type === "nguoidung") {
    $sql = "DELETE FROM nguoidung WHERE Manguoidung = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Đã xóa người dùng thành công!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa người dùng!'); window.location='admin.php';</script>";
    }
}

// 🧾 Xóa tài liệu
elseif ($type === "hinh") {
    $sql = "SELECT hinh FROM tailieu WHERE matailieu = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hinh_path = "tailieu/" . $row['hinh']; // nối với thư mục lưu file

        if (file_exists($hinh_path)) {
            unlink($hinh_path);
        }

        // Xóa bản ghi trong DB
        mysqli_query($conn, "DELETE FROM tailieu WHERE matailieu = $id");
        echo "<script>alert('Đã xóa tài liệu thành công!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Không tìm thấy tài liệu!'); window.location='admin.php';</script>";
    }
}

// ❌ Type không hợp lệ
else {
    echo "<script>alert('Dữ liệu không hợp lệ!'); window.location='admin.php';</script>";
}
?>
