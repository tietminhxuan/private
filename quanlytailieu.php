<?php
    require("phandau.php");

    // Kiểm tra nếu chưa đăng nhập thì chuyển hướng
    if(!isset($_SESSION['username'])) {
        header("Location: dangnhap.php");
        exit();
    }

    // Xóa tài liệu
    if(isset($_GET['delete_matailieu'])) {
        $id = intval($_GET['delete_matailieu']);
        $sql = "DELETE FROM tailieu WHERE matailieu = $id";
        mysqli_query($conn, $sql);
        header("Location: quanlytailieu.php");
        exit();
    }

    // Tìm kiếm
    $keyword = "";
    if(isset($_GET['keyword'])) {
        $keyword = trim($_GET['keyword']);
        $sql = "SELECT * FROM tailieu WHERE tentailieu LIKE '%$keyword%' OR motatailieu LIKE '%$keyword%' ORDER BY matailieu DESC";
    } else {
        $sql = "SELECT * FROM tailieu ORDER BY matailieu DESC";
    }

    $result = mysqli_query($conn, $sql);
?>


<div class="container" style="margin-top:40px;">
    <h2 class="text-center">📚 Quản lý tài liệu</h2>
    <form class="form-inline text-center" method="GET" style="margin:20px 0;">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm tài liệu..." 
               value="<?php echo htmlspecialchars($keyword); ?>" style="width:300px;">
        <button type="submit" class="btn btn-primary">🔍 Tìm kiếm</button>
        <a href="upload.php" class="btn btn-success">➕ Đăng tài liệu mới</a>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr class="info text-center">
                <th width="5%">ID</th>
                <th width="20%">Tên tài liệu</th>
                <th width="30%">Mô tả</th>
                <th width="15%">File</th>
                <th width="10%">Người đăng</th>
                <th width="10%">Ngày đăng</th>
                <th width="10%">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td class='text-center'>".$row['matailieu']."</td>";
                        echo "<td>".htmlspecialchars($row['tentailieu'])."</td>";
                        echo "<td>".nl2br(htmlspecialchars($row['motatailieu']))."</td>";
                        echo "<td><a href='uploads/".$row['hinh']."' target='_blank'>Tải xuống</a></td>";
                        echo "<td class='text-center'>".$row['nguoidang']."</td>";
                        echo "<td class='text-center'>".$row['ngaydang']."</td>";
                        echo "<td class='text-center'>
                                <a href='sua.php?id=".$row['matailieu']."' class='btn btn-warning btn-sm'>Sửa</a> 
                                <a href='quanlytailieu.php?delete_matailieu=".$row['matailieu']."' 
                                   onclick=\"return confirm('Bạn có chắc muốn xóa tài liệu này không?');\" 
                                   class='btn btn-danger btn-sm'>Xóa</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center text-muted'>Không có tài liệu nào</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    require("phacuoi.php");
?>
