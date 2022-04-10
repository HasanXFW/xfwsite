<?php include 'head.php'; 
	  include 'sidebar.php';?>
<center>
  <div class="content-wrapper">

    <section class="content">
      <div class="error-page">
        <h1 class="headline text-yellow"> 404</h1>

        <div class="error-content">
          <h3 style="margin-top: 200px"><i class="fa fa-warning text-yellow"></i> Oops! Aradigin sayfa bulunamadi</h3>

          <p>
            <?php header("refresh: 5; url=index.php") ?>
          </p>

        </div>
      </div>
    </section>
  </div>
 </center>
  <?php include 'footer.php'; ?>