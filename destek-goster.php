<?php 
include 'head.php'; 
include 'sidebar.php';
include 'baglanti.php';
if (isset($_POST['dsil'])) {

	$sil=$db->prepare("DELETE from destekler where id=:id");
	$kontrol=$sil->execute(array('id' => $_POST['uid']));
	if ($kontrol) {
		header("refresh: 0; url=destekler.php");
	} else {
		echo "<script>alert('Destek silinemedi')</script>";
		header("refresh: 0; url=destekler.php");
	}
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">
    	<br>
      <div class="row">

        <section class="col-md-12">
        <div class="col-lg-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Destek Talepleri > Göster</h3>
            </div>

            <div class="box-body">

              <?php
      
      $id = @$_GET["id"];
      $cevap = $_POST["cevap"]; 
      $durum = "1";
      $guncelleme = date('YmdHis');

      $ticket_cevapla = $db->prepare("SELECT * FROM tickets WHERE id = ?");
      $ticket_cevapla->execute(array($_GET['id']));
      $ticket_oku = $ticket_cevapla->fetch();
      
      if(isset($_POST['cevapla'])){

        if(($ticket_oku["durum"] == "1") or ($ticket_oku["durum"] == "2")){


        $ticket_son_id = $db->prepare("SELECT * FROM tickets_sc WHERE ticket_id = ? ORDER BY id DESC LIMIT 1");
        $ticket_son_id->execute(array($_GET["id"]));
        $ticket_son_id_oku = $ticket_son_id->fetch();

        $ticket_query = $db->prepare("UPDATE tickets_sc SET cevap = ? WHERE ticket_id = ? and id = ?");
        $update = $ticket_query->execute(array($cevap,$_GET['id'],$ticket_son_id_oku["id"]));

        $ticket_query = $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE id = ?");
        $update = $ticket_query->execute(array($durum,$guncelleme,$_GET['id']));

        echo 'Destek talebi başarıyla cevaplandı!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';

        }if($ticket_oku["durum"] == 0){

        $ticket_query = $db->prepare("UPDATE tickets SET cevap = ?, durum = ?, son_guncelleme = ? WHERE id = ?");
        $update = $ticket_query->execute(array($cevap,$durum,$guncelleme,$_GET['id']));
        echo 'Destek talebi başarıyla cevaplandı!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';
      }
    }
      
      if(isset($_POST['sil'])){
        $query = $db->prepare("DELETE FROM tickets WHERE id = :id");
        $delete = $query->execute(array(
           "id" => $_GET['id']
        ));
        echo 'Destek talebi başarıyla silindi!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';
      }
      if(isset($_POST['ticket-kapat'])){
        $durum = "3";
        $ticket_query = $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE id = ?");
        $update = $ticket_query->execute(array($durum,$guncelleme,$_GET['id']));

        echo 'Destek talebi başarıyla kapatıldı!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';
      }
        
      ?>
      <?php
    
            $ticket_kontrol = $db->prepare("SELECT * FROM tickets WHERE id = ? and nick = ?");
            $ticket_kontrol->execute(array($_GET["id"],$_SESSION['user_nick']));  
            $ticket_oku = $ticket_kontrol->fetch(); 
              if($ticket_kontrol->rowCount() != 0){
          ?>
                <h2>Kullanıcı:</h2>
                <p><?php echo $ticket_oku["mesaj"]; ?></p>
                <br>
                <?php
              if($ticket_oku["cevap"] != NULL){
            ?>
            <h2>Siz:</h2>
          <p><?php echo $ticket_oku["cevap"]; ?></p>
              <?php } ?>
              <?php
              $tickets_sc = $db->prepare("SELECT * FROM tickets_sc WHERE nick = ? and ticket_id = ?");
              $tickets_sc->execute(array($_SESSION['user_nick'],$_GET["id"]));

              if($tickets_sc->rowCount() != 0){

                foreach ($tickets_sc as $tickets_sc_oku) {

                  if($tickets_sc_oku["soru"] != NULL){
            ?>
          <h2>Kullanıcı:</h2>
                <p><?php echo $tickets_sc_oku["soru"]; ?></p>
                <br>
                <?php 
                
                }
              if($tickets_sc_oku["cevap"] != NULL){
            ?>
            <h2>Siz:</h2>
            <p><?php echo $tickets_sc_oku["cevap"]; ?></p>
          <?php } ?>

          <?php
                }
              }
            }

            ?>
            <?php

if($ticket_oku["durum"] != 3){

if(isset($_POST['soru_gonder'])){
$soru     = strip_tags($_POST['soru']);
$durum    = "2";
$guncelleme = date('YmdHis');

if($_POST["soru"] == ""){
  echo '
             <h2 style="color:red">Boş alan bırakmayın!</h2>
  ';
}
else{
    $cevap_gonder = $db->prepare("INSERT INTO tickets_sc (nick,ticket_id,soru) VALUES(?,?,?)");
    $cevap_gonder->execute(array($_SESSION['user_nick'],$_GET["id"],$soru));

    $durum_guncelle =  $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE nick = ? and id = ?");
    $durum_guncelle->execute(array($durum,$guncelleme,$_SESSION['user_nick'],$_GET["id"]));

    echo '<meta http-equiv="refresh" content="0;URL=dst-goster.php">';
}
}
}
?>
<form action="" method="post">
<textarea class="form-control" required name="cevap" placeholder="Destek ekibimize bırakmak istediğiniz mesajı yazınız." rows="5"></textarea>
<br>
<button name="cevapla" type="submit" class="btn btn-success">Cevapla</button>
<button name="ticket-kapat" type="submit" class="btn btn-warning">Talebi Kapat</button>
<button name="sil" type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button>
</form>

            </div>

          </div>

        </div>

        </section>
      </div>

    </section>
  </div>
  <?php include 'footer.php'; ?>