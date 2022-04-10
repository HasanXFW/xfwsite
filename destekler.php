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
              <h3 class="box-title">Destek Talepleri</h3>
            </div>

            <div class="box-body">
			  <table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th><center>Tarih</center></th>
                  <th><center>Başlık</center></th>
                  <th><center>Kategori</center></th>
                  <th><center>Kullanıcı Adı</center></th>
                  <th><center>Durum</center></th>
                  <th>İşlemler</th>
                </tr>
                <?php
                $tickets_cek = $db->query("SELECT * FROM tickets ORDER BY son_guncelleme DESC");
                $tickets_cek->execute();    
                if($tickets_cek->rowCount() != 0){
                  
                  foreach ($tickets_cek as $tickets_oku) {


                              $saat= substr($tickets_oku['son_guncelleme'], 8, 2);
                              $dk= substr($tickets_oku['son_guncelleme'], 10, 2);
                              $gun= substr($tickets_oku['son_guncelleme'], 6, 2);
                              $ay= substr($tickets_oku['son_guncelleme'], 4, 2);
                              $yil= substr($tickets_oku['son_guncelleme'], 0, 4);

                ?>
                </thead>
                <tbody>

                <tr>
                  <td><center><?php echo ''.$gun.'.'.$ay.'.'.$yil.' '.$saat.':'.$dk.'' ?></center></td>
                  <td><center><?php echo $tickets_oku['baslik'] ?></center></td>
                  <td><center><?php echo $tickets_oku['kategori'] ?></center></td>
                  <td><center><?php echo $tickets_oku['nick'] ?></center></td>
                  <td><center><?php 
                  if ($tickets_oku['durum'] == '0'){
                  echo '<strong>Açık</strong>';
                  }
                  if ($tickets_oku['durum'] == '1'){
                  echo '<strong>Yanıtlandı</strong>';
                  }
                  if ($tickets_oku['durum'] == '2'){
                  echo '<strong>Kullanıcı Yanıtı</strong>';
                  }
                  if ($tickets_oku['durum'] == '3'){
                  echo '<strong>Kapatıldı</strong>';
                  }
                  ?></center></td>
                  <td><center><a href="destek-goster.php?id=<?php echo $tickets_oku['id']; ?>"><button class="btn btn-success pull-right">Göster</button></a></center></td>
                </tr>

            	<?php
                }
                }else{
                echo '<center><h1>Hiç destek talebi bulunamadı!</h1><center>';
                }
                ?>

                </tbody>
              </table>
            </div>

          </div>

        </div>

        </section>
      </div>

    </section>
  </div>
  <?php include 'footer.php'; ?>