
<?php 
include 'db.php';// 'db.php' dosyasını dahil et
include 'ft.php';// 'ft.php' dosyasını dahil et
session_start();
if (isset($_SESSION['loginsuccesfull'])) {}
	else{
		echo "<script>alert('You Are not Logged in');window.location.href='giriş.php';</script>";
		
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>yönetici listesi</title><!-- En son derlenmiş ve küçültülmüş CSS -->
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body {
  margin: 0;
}

.sidebar {
  margin: 0;
  padding: 0;
  width:100px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a.active {
  background-color: #140d14;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #140d14;
  color: white;
}

div.content {
  margin-left:200px;
  padding: 16px; /* Değişiklik: Yukarıda 1px olarak ayarlıydı, artırıldı */
  min-height: 100vh; /* Değişiklik: Ekran yüksekliği kadar minimum yükseklik */
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {
    float: left;
    width: 100%; /* Değişiklik: Mobilde linklerin genişliği 100% */
  }
  div.content {
    margin-left: 0;
  }
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }

}

</style>
</head>
<body>

<!-- nav -->
<div class="container">
  <img src="img/logo1.png" style="height: 100px; width: auto; max-width: 100%">
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Merhaba,<?php echo $_SESSION['user']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">EV <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Kayityöneticisi.php">Kayityöneticisi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="yöneticilistesi.php">yöneticilistesi</a>
      </li>
  <li class="nav-item">
        <a class="nav-link" href="movielist.php">Film</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="İletişim.php">İletişim</a>
      </li>
            <li class="nav-item">
        <a class="nav-link" href="kategorilistesi.php">kategori</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-outline-danger" href="OturumuKapat.php">oturum kapatma</a>
      </li>
    </ul>
  </div>
</nav>
