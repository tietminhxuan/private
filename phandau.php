<?php
  ob_start();
  session_start();
  require("config.php");

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

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Website chia se tai lieu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-image: url('tailieu/h12.jpg'); /* 🖼 Thay đường dẫn tại đây */
      background-size: cover;
      background-position: center;
      background-attachment: fixed; /* Nền đứng yên khi cuộn trang */
      background-repeat: no-repeat;
      color: #222222;
    }

    /* --- Thanh menu --- */
    .navbar {
      background-color: rgba(0, 0, 0, 0.6); /* Làm mờ nền menu */
      backdrop-filter: blur(5px);
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
      font-weight: 500;
    }
    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      transition: 0.3s;
    }

    /* --- Chỉnh container nội dung --- */
    .container {
      background-color: rgba(255, 255, 255, 0.85);
      border-radius: 15px;
      padding: 20px;
      margin-top: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    footer {
      background-color: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 15px 0;
      text-align: center;
      margin-top: 40px;
    }
    .header-overlay h1 {

    font-size: 60px;
    font-weight: bold;
    text-shadow: 3px 3px 10px rgba(191, 240, 250, 1);
    }

    .header-overlay p {
    font-size: 20px;
    color: #000000ff;
    text-shadow: 2px 2px 8px rgba(239, 92, 92, 0.94);
    }

  
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Sách và Tài Liệu</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="upload.php">Tải lên</a></li>
        <li><a href="dowload.php">Tải xuống</a></li>
        <li><a href="quanlytailieu.php">Danh mục</a></li>
        <li>
          <style>
.search-form {
  display: flex;
  align-items: center;
}

.search-input {
  width: 300px;        /* chiều ngang (rộng) */
  height: 40px;        /* chiều dọc (cao) */
  font-size: 16px;
  padding: 8px 12px;
}

.search-btn {
  height: 40px;        /* nút cao bằng ô nhập */
  padding: 0 15px;
  margin-left: 5px;
}
</style>
        <a><form class="search-form" action="index.php" method="get" role="search" aria-label="Form tìm kiếm">
    <li><label for="q" class="search-label">Tìm kiếm</label></li>
    <input type="text" name="keyword" class="form-control"   placeholder="Nhập từ khóa..." 
    value="<?php echo htmlspecialchars($keyword); ?>" style="width:300px;">
    <button class="search-btn" type="submit">Tìm</button></li></a>
  </ul>
  </form>
  <style>
    .search-label {
  color: rgba(191, 240, 250, 0.54);     
  font-weight: bold;
  font-size: 16px;
}
    </style>
      <ul class="nav navbar-nav navbar-right">
        <?php 
        if(!isset($_SESSION['username'])){
          
        ?>
        <li><a href="dangky.php"><span class="glyphicon glyphicon-log-in"></span> Đăng ký</a></li>
        <li><a href="dangnhap.php"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
        <?php
        } else{
          if($_SESSION['role']==1){
        ?>
        <li><a href="admin.php"> Quản lý </a></li>
        <?php
          }
        ?>
        <li><a href="dangxuat.php" onclick="return confirm('đăng xuất?')"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
        <?php
        }
        
        ?>
      </ul>
    </div>
  </div>
</nav>

<div class="banner">
  <div class="header-overlay banner text-center">
    <h1>Sách và Tài Liệu</h1>
    <p>Kho chia sẻ tài liệu học tập trực tuyến</p>
  </div>
</div>
<div class="container">
  <div class="row">
  
      <div class="col-sm-12">







