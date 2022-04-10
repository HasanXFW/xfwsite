<?php include 'head.php'; 
	  include 'sidebar.php';?>
<center>
  <div class="content-wrapper">

    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 500</h2>

        <div class="error-content">
          <h3 style="margin-top: 200px"><i class="fa fa-warning text-yellow"></i> Oops! Birseyler ters gitti</h3>

          <p>
            Bunu hemen duzeltmeye calisacagiz.
          </p>
            <?php header("refresh: 5; url=index.php") ?>

        </div>
      </div>
    </section>
  </div>
</center>
  <?php include 'footer.php'; ?>