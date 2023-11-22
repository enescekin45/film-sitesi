<?php 
include("api.php");
$sayfaid=$_GET["sayfa"];
if(!isset($_GET["sayfa"])) {$sayfaid=1;}

if($sayfaid < 1) {$sayfaid=1;}
if($sayfaid >= 500) {$sayfaid=500;}
if(!is_numeric($sayfaid)) {$sayfaid=1;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Rehberi - 2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="nav-wrapper"><!-- Navigasyon Çubuğu -->
        <div class="container">
            <div class="nav">
                <a href="#" class="logo">
                    <img src="images/logo1.png" alt="logo" width="32px"/>ExaltFilm 
                </a>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="index">Anasayfa</a></li>
                    <li><a href="filmler?sayfa=1&kategori=0">Filmler</a></li>
                    <li><a href="diziler?sayfa=1&kategori=0">Diziler</a></li>
					<li><a href="kategoriler">Kategoriler</a></li>
					<li>
					<form action="arama" method="POST"><!-- Arama Formu -->
						<input type="search" id="aranan" name="aranan" placeholder="Film/Dizi adı..."/>
						<button class="search_button" type="submit"><i class="fa fa-search"></i></button>
					</form>
					</li>				
                </ul>
                <div class="hamburger-menu" id="hamburger-menu">
                    <div class="hamburger"></div>
                </div>
            </div>
        </div>
    </div>
    
	<!-- Film Kategorileri Bölümü -->
	<div class="section">
        <div class="container">
            <div class="section-header">
                <div> Film Kategorileri</div>
            </div>
			<div class="row">
				<?php  // TMDb API kullanarak film kategorilerini çek ve listele
				$url="https://api.themoviedb.org/3/genre/movie/list?api_key=$api&language=tr-TR";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$kategoriler = $json->genres;
				$kategoriSayi=count($kategoriler);
				for($i=0;$i<$kategoriSayi; $i++){
					$katid = $json->genres[$i]->id;
					$katadi = $json->genres[$i]->name;					
				?>
				<div id="film-listesi" class="col-2"><!-- Her kategoriye bir bağlantı oluştur -->
					<a href="filmler?sayfa=1&kategori=<?php echo $katid; ?>" class="kategori-button">
						<?php echo $katadi; ?>
					</a>
                </div>
            	<?php } ?>
			</div>
        </div>
    </div>
	<!-- Dizi Kategorileri Bölümü -->
	<div class="section">
        <div class="container">
            <div class="section-header">
                <div> Dizi Kategorileri</div>
            </div>
			<div class="row">
				<?php // TMDb API kullanarak dizi kategorilerini çek ve listele
				$url="https://api.themoviedb.org/3/genre/tv/list?api_key=$api&language=tr-TR";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$kategoriler = $json->genres;
				$kategoriSayi=count($kategoriler);
				for($i=0;$i<$kategoriSayi; $i++){
					$katid = $json->genres[$i]->id;
					$katadi = $json->genres[$i]->name;					
				?>
				<div id="film-listesi" class="col-2"> <!-- Her kategoriye bir bağlantı oluştur -->
					<a href="diziler?sayfa=1&kategori=<?php echo $katid; ?>" class="kategori-button">
						<?php echo $katadi; ?>
					</a>
                </div>
            	<?php } ?>
			</div>
        </div>
    </div>
	 <!-- Altbilgi -->
	 <footer class="section">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-6 col-sm-12">
                    <div class="content">
                        <a href="#" class="logo">
                            <img class="logo1-img" src="images/logo1.png">ExaltFilm 
                        </a>
                        <p>
                           Lorem ipsum dolor sit amet consectetur adipisicing elit. In incidunt ea quo voluptate et consequuntur, repudiandae dicta eaque vero nisi doloremque nihil hic nobis atque doloribus labore unde ex necessitatibus.
                        </p>
                        <div class="social-list"><!-- Sosyal medya bağlantıları -->
                            <a href="#" class="social-item">
                                <i class="bx bxl-facebook"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bx bxl-twitter"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bx bxl-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div> <!-- Hızlı bağlantılar ve uygulama indirme bağlantıları -->
                <div class="col-8 col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Başlık</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Hakkımızda</a></li>
                                    <li><a href="#">Profilim</a></li>
                                    <li><a href="#">İletişim</a></li>
                                </ul>
                            </div>
                        </div> <!-- Hızlı bağlantılar ve uygulama indirme bağlantıları -->
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Başlık</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Hakkımızda</a></li>
                                    <li><a href="#">Profilim</a></li>
                                    <li><a href="#">İletişim</a></li>
                                </ul>
                            </div>
                        </div> <!-- Hızlı bağlantılar ve uygulama indirme bağlantıları -->
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Başlık</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Hakkımızda</a></li>
                                    <li><a href="#">Profilim</a></li>
                                    <li><a href="#">İletişim</a></li>
                                </ul>
                            </div>
                        </div><!-- Uygulama indirme bağlantıları -->
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Uygulamalarımız</b></p>
                                <ul class="footer-menu">
                                    <li>
                                        <a href="#">
                                            <img src="images/app-store.png" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="images/google-play.png" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="copyright"><!-- Telif hakkı bilgisi -->
        Telif Hakkı 2023 <a href="#">Yazılım</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="  crossorigin="anonymous"></script>
    <script src="js/app.js"></script>

</body>
</html>