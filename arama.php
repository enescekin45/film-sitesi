<?php // api.php dosyasını dahil et
include("api.php");

// Eğer "aranan" POST değişkeni set edilmemişse, index sayfasına yönlendir
if(!isset($_POST["aranan"])){header('Location: index');}
$aranan=$_POST["aranan"];// "aranan" değişkenini POST verilerinden al
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
    <div class="nav-wrapper"><!-- Navigation kısmı -->
        <div class="container">
            <div class="nav">
                <a href="#" class="logo"><!-- Logo ve menü bağlantıları -->
                    <img src="images/logo1.png" alt="logo" width="32px"/>ExaltFilm 
                </a>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="index">Anasayfa</a></li>
                    <li><a href="filmler">Filmler</a></li>
                    <li><a href="diziler">Diziler</a></li>
					<li><a href="kategoriler">Kategoriler</a></li>
					<li>
					<form action="arama" method="POST"> <!-- Film/Dizi arama formu -->
						<input type="search" id="aranan" name="aranan" placeholder="Film/Dizi adı..."/>
						<button class="search_button" type="submit"><i class="fa fa-search"></i></button>
					</form>
					</li>				
                </ul>
                <!-- Mobil için hamburger menüsü -->
                <div class="hamburger-menu" id="hamburger-menu">
                    <div class="hamburger"></div>
                </div>
            </div>
        </div>
    </div>
    
	
	<div class="section">  <!-- Film arama sonuçları -->
        <div class="container">
            <div class="section-header">
                <div> film arama sonucu: <?php echo "(".$aranan.")"; ?></div>
            </div>
            <div class="movies-slide carousel-nav-center owl-carousel">
			
			
				<?php 
                 // "themoviedb.org" API'sinden film arama sonuçlarını çek
				$url="https://api.themoviedb.org/3/search/movie?api_key=$api&language=tr-TR&query=$aranan";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$trendFilmler = $json->results;
				$trendFilmSayi=count($trendFilmler);
				for($i=0;$i<$trendFilmSayi; $i++){
					$baslik = $json->results[$i]->title;
					$poster = $json->results[$i]->poster_path;
					$aciklama = $json->results[$i]->overview;
					$idsi = $json->results[$i]->id;// Tekil film bilgilerini çek
					$url2="https://api.themoviedb.org/3/movie/$idsi?api_key=$api&language=tr-TR";
					$json2 = file_get_contents($url2);
					$json2 = json_decode($json2);
					$puan = $json2->vote_average;
					$puan = substr($puan, 0, 3);
					$sure = $json2->runtime;
					$imdb = $json2->imdb_id;
					$turler = $json2->genres;
					$tursayi=count($turler);
					$turBirles = "";// Film türlerini birleştir
					for($x=0;$x<$tursayi; $x++){
						$turum = $json2->genres[$x]->name;
						if(($x + 1) == $tursayi) {$turBirles.=$turum;} else {$turBirles.=$turum.", ";}
						
					}
					
				?>
				 <!-- Her film için detay sayfasına link içeren bir kart oluştur -->
				<a href="detay?id=<?php echo $idsi; ?>&tip=film">
					<div class="movie-item">
						<img src="https://www.themoviedb.org/t/p/original/<?php echo $poster; ?>" alt="">
						<div class="movie-item-content">
							<div class="movie-item-title">
								<?php echo $baslik; ?>
							</div>
							<div class="movie-infos"><!-- Puan, süre ve tür bilgileri -->
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
                
            	<?php } ?>

            </div>
        </div>
    </div>
	 <!-- Dizi arama sonuçları -->
	<div class="section">
        <div class="container">
            <div class="section-header">
                <div> dizi/Tv programı arama sonucu:  <?php echo "(".$aranan.")"; ?></div>
            </div>
            <div class="movies-slide carousel-nav-center owl-carousel">
			
			
				<?php // "themoviedb.org" API'sinden dizi/Tv programı arama sonuçlarını çek
				$url="https://api.themoviedb.org/3/search/tv?api_key=$api&language=tr-TR&query=$aranan";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$trendFilmler = $json->results;
				$trendFilmSayi=count($trendFilmler);// Her bir dizi için gerekli bilgileri çekerek ekrana bas
				for($i=0;$i<$trendFilmSayi; $i++){
					$baslik = $json->results[$i]->name;
					$poster = $json->results[$i]->poster_path;
					$aciklama = $json->results[$i]->overview;
					$idsi = $json->results[$i]->id; // Tekil dizi bilgilerini çek
					$url2="https://api.themoviedb.org/3/tv/$idsi?api_key=$api&language=tr-TR";
					$json2 = file_get_contents($url2);
					$json2 = json_decode($json2);
					$puan = $json2->vote_average;
					$puan = substr($puan, 0, 3);
					$sure = $json2->episode_run_time[0];
					$turler = $json2->genres;
					$tursayi=count($turler);
					$turBirles = "";
                     // Dizi türlerini birleştir
					for($x=0;$x<$tursayi; $x++){
						$turum = $json2->genres[$x]->name;
						if(($x + 1) == $tursayi) {$turBirles.=$turum;} else {$turBirles.=$turum.", ";}
						
					}
					
				?> <!-- Her dizi için detay sayfasına link içeren bir kart oluştur -->
				
                <a href="detay?id=<?php echo $idsi; ?>&tip=dizi">
					<div class="movie-item">
						<img src="https://www.themoviedb.org/t/p/original/<?php echo $poster; ?>" alt="">
						<div class="movie-item-content">
							<div class="movie-item-title">
								<?php echo $baslik; ?>
							</div>
							<div class="movie-infos">
                                   <!-- Puan, süre ve tür bilgileri -->
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
				
				<?php } ?>

            </div>
        </div>
    </div>
       <!-- Sayfa alt kısmı (footer) -->
    <footer class="section">
        <div class="container">
            <div class="row">
                <!-- Logo ve şirket bilgileri -->
                <div class="col-4 col-md-6 col-sm-12">
                    <div class="content">
                        <a href="#" class="logo">
                            <img class="logo-img" src="images/logo1.png">ExaltFilm 
                        </a>
                        <p>
                           Lorem ipsum dolor sit amet consectetur adipisicing elit. In incidunt ea quo voluptate et consequuntur, repudiandae dicta eaque vero nisi doloremque nihil hic nobis atque doloribus labore unde ex necessitatibus.
                        </p><!-- Sosyal medya bağlantıları -->
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
                 <!-- Hızlı bağlantılar ve uygulama indirme bağlantıları -->
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
                        </div><!-- Hızlı bağlantılar ve uygulama indirme bağlantıları -->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="crossorigin="anonymous"></script>
    <script src="js/app.js"></script>

</body>
</html>