<?php
require("phandau.php");
?>

    <h2 class="mb-3">Danh sách tài liệu</h2>

    <div class="product-list">
        <?php
        $sql = "SELECT * FROM tailieu";
        $rs = $conn->query($sql);
        $tm = "tailieu/";
?>
        <?php
if ($rs->num_rows > 0) {
    echo '<div class="row">';

    while ($product = $rs->fetch_assoc()) {
        echo '
        <div class="col-md-3 col-sm-6 text-center" style="margin-bottom: 30px;">
            <div style="border:1px solid #ddd; border-radius:10px; padding:15px; box-shadow:0 2px 5px rgba(0,0,0,0.1); background-color:#fff;">
                <img src="'.htmlspecialchars($product['hinh']).'" alt="'.htmlspecialchars($product['tentailieu']).'" 
                     style="height:200px; width:100%; object-fit:cover; border-radius:8px;">
                <h4 style="margin-top:15px;">'.htmlspecialchars($product['tentailieu']).'</h4>
                <a href="dangtailieu.php?matl='.$product['matailieu'].'" class="btn btn-info btn-sm" style="margin-top:10px;">Xem chi tiết</a>
            </div>
        </div>
        ';
    }

    echo '</div>';
} else {
    echo "<p>Không có tài liệu nào!</p>";
}
?>
    </div>


<!-- JS lọc sản phẩm -->
<script>
document.getElementById('productSearch').addEventListener('keyup', function() {
    let keyword = this.value.toLowerCase();
    let items = document.querySelectorAll('.product-item');
    items.forEach(item => {
        let name = item.getAttribute('data-name');
        item.style.display = name.includes(keyword) ? '' : 'none';
    });
});
</script>


<?php
  require("phacuoi.php");
?>