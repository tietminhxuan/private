<?php
    require("phandau.php");
    require_once "config.php";  
?>

<?php
    if(isset($_REQUEST['sbdangnhap'])){
        $us = $_REQUEST['txtusername'];
        $pass = md5($_REQUEST['txtmatkhau']);
        $sql ="select * from nguoidung where username='$us' and matkhau='$pass'";
        $rs = $conn->query($sql);
        if($rs->num_rows>0){
            $row = $rs->fetch_assoc();
            echo "<script language='javascript'>alert('EN thanh cũng');</script>";
            $_SESSION['username'] = $us;
            $_SESSION['role'] = $row['role'];
            if($row['role'] == 1){
                header("Location: admin.php");
            } else {
                header("Location: index.php");
        }
        exit();
    }   else{
            echo "<script language='javascript'>alert('User/ pass không đúng');</script>";
        }
    }
?>
<form action="" method="POST" role="form" name="f1">
    <legend><h3>Đăng nhập</h3></legend>

    <div class="form-group">
        <lable for="us"> Username </lable>
        <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="Nhập tên đăng nhập">
    </div>
  
    <div class="form-group">
        <lable for="pss"> password </lable>
        <input type="Password" class="form-control" id="txtmatkhau" name="txtmatkhau" placeholder="Nhập mật khẩu">
    </div>

    <button type="submit" class="btn btn-primary" name="sbdangnhap"> Đăng nhập </button>

</form>
<?php
    require("phacuoi.php");
?>