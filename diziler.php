<?php 
include("api.php");// api.php dosyasını içeri alır, bu dosyada API anahtarınızı içermesi beklenir.

$sayfaid=$_GET["sayfa"];
$kategori=$_GET["kategori"];
// GET isteği ile gelen sayfa ve kategori parametrelerini alır.
// Eğer bu parametreler belirtilmemişse, varsayılan değerleri kullanır.
if(!isset($_GET["sayfa"])) {$sayfaid=1;}
if(!isset($_GET["kategori"])) {$kategori=0;}

if($sayfaid < 1) {$sayfaid=1;}// Sayfa numarası kontrolü
if($sayfaid >= 500) {$sayfaid=500;}
if(!is_numeric($sayfaid)) {$sayfaid=1;}// Kategori ID'si kontrolü
if(!is_numeric($kategori)) {$kategori=0;}

if($kategori==0) {$kategoriAdi="Tümü";}
//TMDB API'sinden televizyon kategorilerini çekme
$url="https://api.themoviedb.org/3/genre/tv/list?api_key=$api&language=tr-TR";
$json = file_get_contents($url);
$json = json_decode($json);
$kategoriler = $json->genres;
$kategoriSayi=count($kategoriler);
for($i=0;$i<$kategoriSayi; $i++){
	$katid = $json->genres[$i]->id;
	$katAdi= $json->genres[$i]->name;
	if($katid==$kategori) {$kategoriAdi=$katAdi;}
}

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
    <div class="nav-wrapper">
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
					<form action="arama" method="POST">
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
    
	
	<div class="section">
        <div class="container">
            <div class="section-header">
                <div> Dizi ve Tv Programı (<?php echo "Bulunduğunuz sayfa: ".$sayfaid; ?>) </div>
            </div>
			<div class="section-header">
                <div> Kategori : <?php echo $kategoriAdi; ?> </div>
            </div>
			<div class="row">
				<?php
				if($kategori==0) {
					$url="https://api.themoviedb.org/3/discover/tv?api_key=$api&language=tr-TR&sort_by=popularity.desc&page=$sayfaid";
				} else {
					$url="https://api.themoviedb.org/3/discover/tv?api_key=$api&language=tr-TR&sort_by=popularity.desc&page=$sayfaid&with_genres=$kategori";
				}
				$json = file_get_contents($url);
				$json = json_decode($json);
				$diziler = $json->results;
				$dizisayi=count($diziler);
				for($i=0;$i<$dizisayi; $i++){
					$baslik = $json->results[$i]->name;
					$poster = $json->results[$i]->poster_path;
					$aciklama = $json->results[$i]->overview;
					$idsi = $json->results[$i]->id;
					$url2="https://api.themoviedb.org/3/tv/$idsi?api_key=$api&language=tr-TR";
					$json2 = file_get_contents($url2);
					$json2 = json_decode($json2);
					$puan = $json2->vote_average;
					$puan = substr($puan, 0, 3);
					$sure = $json2->episode_run_time[0];
					$turler = $json2->genres;
					$tursayi=count($turler);
					$turBirles = "";
					for($x=0;$x<$tursayi; $x++){
						$turum = $json2->genres[$x]->name;
						if(($x + 1) == $tursayi) {$turBirles.=$turum;} else {$turBirles.=$turum.", ";}
						
					}
					
				?>
				<div id="film-listesi" class="col-3">
					<a href="detay?id=<?php echo $idsi; ?>&tip=dizi">
						<div class="movie-item">
							<img src="https://www.themoviedb.org/t/p/original/<?php echo $poster; ?>" alt="">
							<div class="movie-item-content">
								<div class="movie-item-title">
									<?php echo $baslik; ?>
								</div>
								<div class="movie-infos">
									<div class="movie-info">
										<i class="bx bxs-star"></i>
										<span><?php echo $puan; ?></span>
									</div>
									<div class="movie-info">
										<i class="bx bxs-time"></i>
										<span><?php echo $sure; ?> dk.</span>
									</div>
									<div class="movie-info">
										<span><?php echo $turBirles; ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
                </div>
            	<?php } ?>
			</div>
        </div>
    </div>
	<div class="ileri-geri">
		<?php if($kategori==0) { ?>
		<a href="diziler?sayfa=<?php echo $sayfaid - 1;?>" class="geri">‹</a>
		<a href="diziler?sayfa=<?php echo $sayfaid + 1;?>" class="ileri">›</a>
		<?php } else { ?>
		<a href="diziler?sayfa=<?php echo $sayfaid - 1;?>&kategori=<?php echo $kategori;?>" class="geri">‹</a>
		<a href="diziler?sayfa=<?php echo $sayfaid + 1;?>&kategori=<?php echo $kategori;?>" class="ileri">›</a>
		<?php } ?>
	</div>
       
    <footer class="section">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-6 col-sm-12">
                    <div class="content">
                        <a href="#" class="logo">
                            <img class="logo1-img" src="images/logo1.png">  ExaltFilm
                        </a>
                        <p>
                           Lorem ipsum dolor sit amet consectetur adipisicing elit. In incidunt ea quo voluptate et consequuntur, repudiandae dicta eaque vero nisi doloremque nihil hic nobis atque doloribus labore unde ex necessitatibus.
                        </p>
                        <div class="social-list">
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
                </div>
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
                        </div>
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Başlık</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Hakkımızda</a></li>
                                    <li><a href="#">Profilim</a></li>
                                    <li><a href="#">İletişim</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Başlık</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Hakkımızda</a></li>
                                    <li><a href="#">Profilim</a></li>
                                    <li><a href="#">İletişim</a></li>
                                </ul>
                            </div>
                        </div>
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

    <div class="copyright">
        Telif Hakkı 2023 <a href="#">Yazılım</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>

</body>
</html>