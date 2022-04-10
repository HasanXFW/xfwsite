<?php include 'head.php'; 
	  include 'sidebar.php';

if (isset($_POST['akaydet'])) {

		$kaydet=$db->prepare("UPDATE ayar SET
	    site_title=:site_title,
	    sunucu_ip=:sunucu_ip,
	    slogan=:slogan,
	    sunucu_isim=:sunucu_isim,
      websend_sayisalip=:websend_sayisalip,
	    websend_sifre=:websend_sifre,
	    websend_port=:websend_port,
	    discord_davetkodu=:discord_davetkodu,
	    batihost_id=:batihost_id,
	    batihost_email=:batihost_email,
	    batihost_token=:batihost_token,
		descri=:descri,
		keyword=:keyword
	    WHERE ayar_id=0");
	    

	  $update=$kaydet->execute(array(
	    'site_title' => $_POST['site_title'],
	    'sunucu_ip' => $_POST['sunucu_ip'],
	    'slogan' => $_POST['slogan'],
	    'sunucu_isim' => $_POST['sunucu_isim'],
      'websend_sayisalip' => $_POST['websend_sayisalip'],
	    'websend_sifre' => $_POST['websend_sifre'],
	    'websend_port' => $_POST['websend_port'],
	    'discord_davetkodu' => $_POST['discord_davetkodu'],
	    'batihost_id' => $_POST['batihost_id'],
	    'batihost_email' => $_POST['batihost_email'],
	    'batihost_token' => $_POST['batihost_token'],
		'descri' => $_POST['descri'],
		'keyword' => $_POST['keyword']
		));


	  if ($update) {
	  	echo "<script>alert('Ayarlar değiştirildi')</script>";
	    header("refresh: 0; url=ayarlar.php");

	  } else {
	  	echo "<script>alert('Ayarlar değiştirilemedi')</script>";
	    header("refresh: 0; url=ayarlar.php");
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
              <h3 class="box-title">Ayarlar</h3>
            </div>

            <div class="box-body">
              <center>
              <form method="POST">

                <div class="form-group">
                  <label>Site Title</label>
                  <input type="text" style="width: 200px" name="site_title" class="form-control" value="<?php echo $ayarcek['site_title']; ?>" required="required">
                </div>

				<div class="form-group">
                  <label>Sunucu Sloganı:</label>
                  <input type="text" style="width: 200px" name="slogan" class="form-control" value="<?php echo $ayarcek['slogan']; ?>" required="required">
                </div>


                <div class="form-group">
                  <label>Sunucu IP (IP adresiniz sayısal ve varsayılan 25565 portunu kullanmıyorsa "sayisalip:port" formatında yazınız.</label>
                  <input type="text" style="width: 200px" name="sunucu_ip" class="form-control" value="<?php echo $ayarcek['sunucu_ip']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Sunucu İsmi</label>
                  <input type="text" style="width: 200px" name="sunucu_isim" class="form-control" value="<?php echo $ayarcek['sunucu_isim']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Websender Sayısal İp</label>
                  <input type="text" style="width: 200px" name="websend_sayisalip" class="form-control" value="<?php echo $ayarcek['websend_sayisalip']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Websender Şifre</label>
                  <input type="text" style="width: 200px" name="websend_sifre" class="form-control" value="<?php echo $ayarcek['websend_sifre']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Websender Port</label>
                  <input type="number" style="width: 200px" min="0" max="99999" name="websend_port" class="form-control" value="<?php echo $ayarcek['websend_port']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Discord davet kodu</label>
                  <input type="text" style="width: 200px" name="discord_davetkodu" class="form-control" value="<?php echo $ayarcek['discord_davetkodu']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Meta Keywords (Google da çıkmanız için anahtar kelimelerdir. "," ile ayırın.</label>
                  <input type="text" style="width: 200px" name="keyword" class="form-control" value="<?php echo $ayarcek['keyword']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Meta Description (Google da çıktığınızda gösterilecek site açıklamasıdır.</label>
                  <input type="text" style="width: 200px" name="descri" class="form-control" value="<?php echo $ayarcek['descri']; ?>" required="required">
                </div>
                      
                <div class="form-group">
                  <label>Batihost Müşteri Id</label>
                  <input type="text" style="width: 200px" name="batihost_id" class="form-control" value="<?php echo $ayarcek['batihost_id']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Batihost Mail</label>
                  <input type="text" style="width: 200px" name="batihost_email" class="form-control" value="<?php echo $ayarcek['batihost_email']; ?>" required="required">
                </div>

                <div class="form-group">
                  <input type="hidden" style="width: 200px" name="batihost_token" class="form-control" value="<?php echo $ayarcek['batihost_token']; ?>" required="required">
                </div>

                <button type="submit" name="akaydet" class="btn btn-primary">Kaydet</button>
              </form>
              </center>
            </div>

          </div>

        </div>

        </section>
      </div>

    </section>
  </div>
  <?php include 'footer.php'; ?>