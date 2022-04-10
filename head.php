<?php
include('../baglanti.php');
require_once('../WebsenderAPI.php');
session_start();
ob_start();

$menuurl=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$id = explode('/', $menuurl);
$id_Son = explode('-', $id[2]);
$menuaktif= $id_Son[0];

$kullanicisor=$db->prepare("SELECT * FROM authme where username=:username and yetki=1");
$kullanicisor->execute(array('username' => $_SESSION['user_nick']));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id = ?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch();

if ($say==0) {
  echo "<script>alert('Buraya Girebilmek Icin Giris Yapmalisin')</script>";
  echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
  exit;
}

if(!isset($_SESSION['user_nick'])){
  echo "<script>alert('Buraya Girebilme Icin Giris Yapmalisin')</script>";
  echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
  exit;
}

$host=$ayarcek['websend_sayisalip'];
$pass=$ayarcek['websend_sifre'];
$port=$ayarcek['websend_port'];

if(isset($_POST["komut-gonder"])){
  $komut=$_POST["komut"];

  $wsr = new WebsenderAPI($host, $pass, $port);

  if($wsr->connect()){
    $wsr->sendCommand($komut);
    echo "<script>alert('Komut başarıyla gönderildi')</script>";
  }else{
    echo "<script>alert('Komut gönderilemedi')</script>";
  }
  $wsr->disconnect();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script type="text/javascript">

    function ShowConfirm() {
        var confirmation = confirm("Silmek istediğinize emin misiniz?");
        if (confirmation) {
          alert("Kayıt Silinmiştir.");
        }
        return confirmation;
    };

  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CR</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CraftRosi</b> v1.1</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user user-menu">
            <a href="cikis.php">
              <span class="hidden-xs">Çıkış yap</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>