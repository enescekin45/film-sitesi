
<?php 
include 'db.php'; // 'db.php' dosyasını dahil et
include 'ft.php';// 'ft.php' dosyasını dahil et

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Yönetici-Sinema</title>
	<!-- En son derlenmiş ve küçültülmüş CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body {
  margin: 0;
   
}

.sidebar {/*Stil tanımı, sayfanın yan bileşenlerinin içerdiği tasarımını belirler.*/
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {/*stil tanımı, yan çubuktaki konnektörlerin tasarlanması*/
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {/*stil tanımı, aktif bağlantının tasarımını belirler.*/
  background-color: #140d14;
  color: white;
}

.sidebar a:hover:not(.active) {/*stil tanımı, ücret üzerine gelindiğinde aktif olmayan düğmelerin tasarımını belirler.*/
  background-color: #140d14;
  color: white;
}

div.content {/*stil tanımı, sayfanın içeriğinin tasarımını beli*/
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {/*sorguları, ekran genişliğine göre tasarıma göre değişiklik yapar. İlk sorgu 7*/
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
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
<nav class=" navbar navbar-expand-1g navbar-light bg-light " >
   
 <a class="navbar-brand" href="#">ExaltFilm </a>
   <!-- Küçük ekranlarda menüyü açma/durma butonu -->
 <button class="navbar-toggler"type ="button" data-toggle = " collapse " data-target = " #navbarNav " aria-controls="navbarNav" aria-expanded="false "
  aria-label ="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Ana menü ve bağlantılar -->
  <div class ="collapse navbar-collapse"id="navbarNav" >
  <ul class = "navbar-nav ml-auto " >
   <li class = "nav-item active " >
     <a class="nav-link" href="#">ev<span class = "sr-only">(current)</span></a>
    </1i>
     <!-- Kayıt Yöneticisi sayfası bağlantısı -->
	<li class = "nav-item">
  <a class="nav-link" href="Kayıtyöneticisi.php">Kayıt Yöneticisi </a>
</li><!-- Yönetici Listesi bağlantısı -->
<li class ="nav-item">
  <a class="nav-link" href="#">Yönetici Listesi</a>
</1i>  <!-- Oturumu Kapatma butonu -->
<li class=" nav-item">
  <a class="btn btn-outline-danger" href="Oturumu Kapat.php">Oturumu Kapat</a>
</li>
</li>
   </li>
  </ul>
  </div>
</nav>
<!-- Yan menü -->
<div class="sidebar"> <!-- Anasayfa bağlantısı -->
  <a class="active" href="index.php">Ev</a>
  <a href="movielist.php">Filmler</a><!-- Filmler sayfası bağlantısı -->
  <a href="İletişim.php">Bağlantı</a> <!-- İletişim sayfası bağlantısı -->

  <a href="adminlist.php">Yöneticiler</a><!-- Yöneticiler sayfası bağlantısı -->
  <a href="kategorilistesi.php">Kategoriler</a><!-- Kategoriler sayfası bağlantısı -->
  <a href="genrelist.php">Tür</a><!-- Tür sayfası bağlantısı --

</div>

