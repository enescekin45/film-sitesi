<?php 

include 'db.php';
include 'header.php';
include 'ft.php';
 ?>

<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"> Sinemada Filmler</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  	 <ul class="navbar-nav ml-auto">
  	 	      <li class="nav-item">
        <a class="btn btn-warning text-light" href="addmovie.php">Bir Film Ekleyin</a>
      </li>
  	 </ul>
    <ul class="navbar-nav ml-auto">

 		 <form class="form-inline" method="post" action="searchmovie.php">
    <input class="form-control mr-sm-2" name="search" type="text" placeholder="Arama">
    <button class="btn btn-success" name="submit" type="submit">Arama</button>
  </form>
    </ul>
  </div>
</nav>
</div>

		
	
		
<div class="container">
  

<div class="row">
<?php 

$query = "SELECT * FROM movie";
$run = mysqli_query($con,$query);

if ($run) {
	while ($row = mysqli_fetch_assoc($run)) {
		?>
  <div class="col-md-2">

    <div class="card" style="width:200px;text-align: center;">
    	<p><?php echo $row['id']; ?></p>
     <?php echo "<img height='180px' width='auto' src='../thumb/".$row['img']."'>"; ?>
      <div class="card-body">
        <h5 class="card-title"><?php echo $row['mv_name']; ?></h5>
        <p class="card-text"><?php echo $row['meta_description']; ?></p>
        <a href="viewmovie.php?id=<?php echo$row['id']; ?>" class="btn btn-secondary">Detayları Görüntüle</a>
      <br>
      <br>
      <a href="deletemovie.php?id=<?php echo$row['id'] ?>" class="btn btn-danger">Sil</a>
      <a href="editmovie.php?id=<?php echo$row['id'] ?>" class="btn btn-info ">Düzenle</a>
</div>

    </div>
  </div><?php		
	}}

 ?>
</div>
	</div>