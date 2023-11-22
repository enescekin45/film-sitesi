<?php 
include("api.php");// URL'den alınan id parametresi
$idsi=$_GET["id"];// api.php dosyasını dahil etme
// API kullanarak kişi bilgilerini çekme
$url2="https://api.themoviedb.org/3/person/$idsi?api_key=$api&language=tr-TR";
$json2 = file_get_contents($url2);
$json2 = json_decode($json2);
$dogumTarihi = $json2->birthday;
$cinsiyet = $json2->gender;
if($cinsiyet==1) {$cinsiyeti="Kadın";} else {$cinsiyeti="Erkek";}
$adi = $json2->name;
$imdb = $json2->imdb_id;
$profilFoto = $json2->profile_path;
$dogumYeri = $json2->place_of_birth;
$biyografi = $json2->biography;

if($biyografi=='') { 
    // Biyografi boşsa, İngilizce dilinde tekrar çekme
    $url="https://api.themoviedb.org/3/person/$idsi?api_key=$api&language=en-US";
    $json = file_get_contents($url);
    $json = json_decode($json);
    $biyografi = $json->biography;
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
    <div class="section"><!-- Filmleri gösteren bölüm -->
        <div class="container">
            <div class="section-header">
                <div> filmleri</div>
            </div> <!-- Owl Carousel kullanarak filmleri slayt halinde gösterme -->
            <div class="movies-slide carousel-nav-center owl-carousel">
                <?php // API ile kişinin oynadığı filmleri çekme
                $url="https://api.themoviedb.org/3/person/$idsi/movie_credits?api_key=$api&language=tr-TR";
                $json = file_get_contents($url);
                $json = json_decode($json);
                $filmler = $json->cast;
                $filmsayi=count($filmler);
                for($i=0;$i<$filmsayi; $i++){// ... Film bilgilerini çekme ...
                    $filmid = $json->cast[$i]->id; // Define $filmid here
                    $baslik = $json->cast[$i]->title;
                    $poster = $json->cast[$i]->poster_path;
                    $aciklama = $json->cast[$i]->overview;
                    if($aciklama=="") {
                        $url3="https://api.themoviedb.org/3/movie/$filmid?api_key=$api&language=en-US";
                        $json3 = file_get_contents($url3);
                        $json3 = json_decode($json3);
                        $aciklama = $json3->cast[$i]->overview;
                    }
                    $url2="https://api.themoviedb.org/3/movie/$filmid?api_key=$api&language=tr-TR";
                    $json2 = file_get_contents($url2);
                    $json2 = json_decode($json2);
                    $puan = $json2->vote_average;
                    $puan = substr($puan, 0, 3);
                    $sure = $json2->runtime;
                    $imdb = $json2->imdb_id;
                    $turler = $json2->genres;
                    $tursayi=count($turler);
                    $turBirles = "";
                    for($x=0;$x<$tursayi; $x++){
                        $turum = $json2->genres[$x]->name;
                        if(($x + 1) == $tursayi) {$turBirles.=$turum;} else {$turBirles.=$turum.", ";}
                    }
                ?>
				 <!-- Her film için detay sayfasına yönlendiren bağlantı -->
				<a href="detay?id=<?php echo $filmid; ?>&tip=film"> <!-- Her filmi temsil eden bir öğe -->
					<div class="movie-item"> <!-- Film afişi -->
						<img src="https://www.themoviedb.org/t/p/original/<?php echo $poster; ?>" alt="">
						<div class="movie-item-content"><!-- Film içeriği -->
							<div class="movie-item-title"> <!-- Film başlığı -->
								<?php echo $baslik; ?>
							</div>
							<div class="movie-infos"> <!-- Film bilgileri -->
								<div class="movie-info"> <!-- Film puanı -->
									<i class="bx bxs-star"></i>
									<span><?php echo $puan; ?></span>
								</div> <!-- Film süresi -->
								<div class="movie-info">
									<i class="bx bxs-time"></i>
									<span><?php echo $sure; ?> dk.</span>
								</div> <!-- Film türleri -->
								<div class="movie-info">
                                    <span><?php echo $turBirles; ?></span>
                                </div>
							</div>
						</div>
					</div>
				</a>
                
            	<?php } ?>

        
				</div>
        </div>
    </div>
	
	<div class="section">
        <div class="container">
            <div class="section-header">
                <div> dizileri ve tv programları</div>
            </div>
            <div class="movies-slide carousel-nav-center owl-carousel">
			
			
				<?php 
				$url="https://api.themoviedb.org/3/person/$idsi/tv_credits?api_key=$api&language=tr-TR";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$diziler = $json->cast;
				$dizisayi=count($diziler);
				for($i=0;$i<$dizisayi; $i++){
					$baslik = $json->cast[$i]->name;
					$poster = $json->cast[$i]->poster_path;
					$aciklama = $json->cast[$i]->overview;
					$diziid = $json->cast[$i]->id;
					$karakterAdi = $json->cast[$i]->character;
					$url2="https://api.themoviedb.org/3/tv/$diziid?api_key=$api&language=tr-TR";
					$json2 = file_get_contents($url2);
					$json2 = json_decode($json2);
					$puan = $json2->vote_average;
					$puan = substr($puan, 0, 3);
					$sure = $json2->runtime;
					$imdb = $json2->imdb_id;
					
					
				?>
				
				<a href="detay?id=<?php echo $diziid; ?>&tip=dizi">
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
									<i class="bx bxs-user"></i>
									<span><?php echo $karakterAdi; ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
                
            	<?php } ?>

            </div>
        </div>
    </div>
       
    <footer class="section">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-6 col-sm-12">
                    <div class="content">
                        <a href="#" class="logo">
                            <img class="logo-img" src="images/logo1.png">ExaltFilm 
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