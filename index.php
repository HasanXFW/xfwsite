<?php include 'head.php'; 
	  include 'sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gösterge Paneli
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                    <?php
                    $kayit = $db->prepare("SELECT count(*) FROM alinanurun");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?>
              </h3>

              <p>Alınan Ürün</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                    <?php
                    $kayit = $db->prepare("SELECT sum(miktar) FROM krediler");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?>
              </h3>

              <p>Alınan Kredi</p>
            </div>
            <div class="icon">
              <i class="ion ion-card"></i>
            </div>
            <a class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                    <?php
                    $kayit = $db->prepare("SELECT count(*) FROM authme");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?>
              </h3>

              <p>Kayıtlı Üye</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                    <?php
                    $kayit = $db->prepare("SELECT count(*) FROM urunler");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?>
              </h3>

              <p>Eklenen Ürün</p>
            </div>
            <div class="icon">
              <i class="ion ion-pricetags"></i>
            </div>
            <a class="small-box-footer"></a>
          </div>
        </div>

      </div>

      <div class="row">

        <section class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Komut gönder</h3>
            </div>
            <div class="box-body" style="background-color: #4DC3E3; color: white">
              <div>
                <br>
                <span style="font-size: 22px; margin-left: 135px">Sunucu</span>
                <center>
                <div class="form-group col-md-5">
                  <select class="form-control" style="margin-left: 120px">
                    <option selected=""><?php echo $ayarcek['sunucu_isim']; ?></option>
                  </select>
                </div>
                </center>
                <br><br><br>
                  <div class="input-group">
                      <span class="input-group-addon">/</span>
                      <form method="post">
                      <input type="text" name="komut" class="form-control"style="height: 30px; font-weight: 20px; width: 185px"/>
                      <button type="submit" name="komut-gonder" class="btn btn-block btn-success btn-sm pull-right" style="width: 60px">Gönder</button>
                    </form>
                  </div>
              </div>
            </div>
          </div>
        </section>

        <section class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Son alınan 3 kredi</h3>
            </div>
            <div class="box-body">

			<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>Kredi</center></th>
                  <th><center>Method</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $kredisor=$db->prepare("SELECT * FROM krediler order by id desc limit 0, 3");
				$kredisor->execute();
				while($kredicek=$kredisor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $kredicek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $kredicek['username']; ?></center></td>
                  <td><center><?php echo $kredicek['miktar']; ?></center></td>
                  <td><center><?php echo $kredicek['metod']; ?></center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>

            </div>
          </div>

          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Son alınan 3 ürün</h3>
            </div>
            <div class="box-body">

			<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>İsim</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $urunsor=$db->prepare("SELECT * FROM alinanurun order by urun_id desc limit 0, 3");
				$urunsor->execute();
				while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $uruncek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $uruncek['username']; ?></center></td>
                  <td><center><?php echo $uruncek['urun_isim']; ?> (<?php echo $uruncek['urun_fiyat']; ?>₺)</center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>

            </div>
          </div>
        </section>

       </div>
    </section>
  </div>
  <?php include 'footer.php'; ?>