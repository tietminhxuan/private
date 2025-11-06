<?php
    require("phandau.php");
?>

<?php
    if(isset($_REQUEST['sbdangky'])){
        $us = $_REQUEST['txtusername'];
        $ful = $_REQUEST['txtfullname'];
        $email = $_REQUEST['txtemail'];
        $matkhau = $_REQUEST['txtmatkhau'];
        $sql ="insert into nguoidung(username, fullname, email, matkhau) values('".$us."','".$ful."','".$email."','".$matkhau."')";
        echo $sql;
        if($conn->query($sql)){
            echo "Đăng ký thành công";
            header("Location:dangnhap.php");
        }else
            echo "Lỗi";
    }

?>



<form action="" method="POST" role="form" name="f1">
    <legend><h3>Đăng ký</h3></legend>

    <div class="form-group">
        <lable for="us"> Tên đăng nhập</lable>
        <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="Nhập tên đăng nhập">
    </div>
    <div class="form-group">
        <lable for="us"> Họ tên đăng nhập </lable>
        <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="Nhập tên đăng nhập">
    </div>
    <div class="form-group">
        <lable for="pss"> Password </lable>
        <input type="Password" class="form-control" id="txtmatkhau" name="txtmatkhau" placeholder="Nhập mật khẩu">
    </div>
    <div class="form-group">
        <lable for="pss"> Nhập lại password </lable>
        <input type="password" class="form-control" id="txtmatkhau" name="txtmatkhau" placeholder="Nhập lại mật khẩu">
    </div>
    <div class="form-group">
        <lable for="email"> Email </lable>
        <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Nhập email">
    </div>
    <button type="submit" class="btn btn-primary" name="sbdangky"> Đăng ký </button>

</form>
<?php
    require("phacuoi.php");
?>