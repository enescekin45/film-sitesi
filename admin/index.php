<?php 

include 'db.php';// 'db.php' dosyasını dahil et
include 'header.php'; // 'header.php' dosyasını dahil et
include 'ft.php';// 'ft.php' dosyasını dahil et

 ?>
<div class="content">
<div class="row">
<!-- Film Sayısı -->
  <div class="col-sm-6">
    <div class="card bg-info" style="border: 1px solid #ccc;">
      <div class="card-body text-center">
        <h5 class="card-title">Toplam Hayır. Gönderinin</h5>
        <p class="card-text"><?php 

	$query = "SELECT count(*) as total_movie from movie";
	$run = mysqli_query($con,$query);
	if ($run) {
		while ($row = mysqli_fetch_assoc($run)) {
			echo $row['total_movie'];
		}
	}
	 ?></p>
        
      </div>
    </div>
  </div>
   <!-- Kategori Sayısı -->
  <div class="col-sm-6">
    <div class="card bg-success" style="border: 1px solid #ccc;">
      <div class="card-body text-center">
        <h5 class="card-title">Toplam Hayır. Kategori</h5>
        <p class="card-text"><?php 

	$query = "SELECT count(*) as total_Kategori from Kategori";
	$run = mysqli_query($con,$query);
	if ($run) {
		while ($row = mysqli_fetch_assoc($run)) {
			echo $row['total_Kategori'];
		}
	}
	 ?></p>
        
      </div>
    </div>
  </div>

  <!-- Yönetici Sayısı -->
  <div class="col-sm-6">
    <div class="card bg-secondary" style="border: 1px solid #ccc;">
      <div class="card-body text-center">
        <h5 class="card-title">Toplam Hayır. Yöneticinin</h5>
        <p class="card-text"><?php 

	$query = "SELECT count(*) as total_admin from admin";
	$run = mysqli_query($con,$query);
	if ($run) {
		while ($row = mysqli_fetch_assoc($run)) {
			echo $row['total_admin'];
		}
	}
	 ?></p>
        
      </div>
    </div>
  </div>
      
      </div>
    </div>
  </div>
  </div>
  <div>
  </div>
  <br>
  <br>
  <div class="sbtn text-center" id="hbtn">
<button class="btn btn btn-lg" onclick="first()" style="background-color: #8ab593; width: 190px;">Kategori &#8681;&#8681;</button>
  </div> <!-- Kategori Gösterme -->
  <div class="show" id="show" style="display: none;">
  	<hr>
  

  	<center><h1>Kategori</h1></center>
  	<div class="row">
  			<?php 

  	$query1 = "SELECT * FROM Kategori";
  	$run1 = mysqli_query($con,$query1);
  	if ($run1) {
  		while ($row1=mysqli_fetch_assoc($run1)) {
  			?>
  <div class="col-sm-6">
  
    <div class="card text-center">
      <div class="card-body" style="background-color: #8ab593;">
        <h5 class="card-title">Toplam Hayır. Gönderinin <?php echo $row1['Kategori_name']; ?></h5>
         <?php 
      $id = $row1['id'];
      $query2 = "SELECT count(*) as total from movie,Kategori where Kategori.id=movie.cat_id and Kategori.id=$id ";
      $run2 = mysqli_query($con,$query2);
      if ($run2) {
       while ($row2 = mysqli_fetch_assoc($run2)) {
               
                  ?>
        <p class="card-text"><?php echo $row2['total']; ?></p>
                   
                  <?php
                }
      }
       ?>
        <a href="viewpost.php?id=<?php echo$row1['id'] ?>" class="btn btn-outline-info">Gönderileri Görüntüle</a>
      </div>
    </div>
  </div>
  <?php
  		}
  	}

  	 ?>
	
</div>

  </div>
<!-- - daha fazlasını gör -->

	<!-- js sakladı ve gösterdi -->

	<script type="text/javascript">
    // Kategori gösterme fonksiyonu
		function first(show,hide) {
			document.getElementById('show').style.display="block";
			document.getElementById('hbtn').style.display="none";
		}
	</script>
	<script type="text/javascript">
     // Tür gösterme fonksiyonu
		function myfun1(show,hide) {
			document.getElementById('genshow').style.display="block";
			document.getElementById('genbtn1').style.display="none";
		}
	</script>

  			