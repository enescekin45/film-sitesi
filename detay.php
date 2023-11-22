<?php 
include("api.php");
$idsi=$_GET["id"];
$tip=$_GET["tip"];

if($tip=="film"){

$url2="https://api.themoviedb.org/3/movie/$idsi?api_key=$api&language=tr-TR";
$json2 = file_get_contents($url2);
$json2 = json_decode($json2);
$puan = $json2->vote_average;
$puan = substr($puan, 0, 3);
$yuzdePuan = $puan * 10;
$sure = $json2->runtime;
$baslik = $json2->title;
$imdb = $json2->imdb_id;
$poster = $json2->poster_path;
$arkaplan = $json2->backdrop_path;
$aciklama = $json2->overview;

if($aciklama=="") {
	$url3="https://api.themoviedb.org/3/movie/$idsi?api_key=$api&language=en-US";
	$json3 = file_get_contents($url3);
	$json3 = json_decode($json3);
	$aciklama = $json3->overview;
}

$url3="https://api.themoviedb.org/3/movie/$idsi/release_dates?api_key=$api";
$json3 = file_get_contents($url3);
$json3 = json_decode($json3);
$contenti = $json3->results;
$contentSayi=count($contenti);
$yas="";
for($x=0;$x<$contentSayi; $x++){
$ulke = $json3->results[$x]->iso_3166_1;
if($ulke=="TR") {$yas = $json3->results[$x]->release_dates[0]->certification;}
}

 

$cikis_tarih=$json2->release_date;
$cikis_tarihi = substr($cikis_tarih, 0, 4);
$turler = $json2->genres;
$tursayi=count($turler);
$turBirles = "";
for($x=0;$x<$tursayi; $x++){
	$turum = $json2->genres[$x]->name;
	if(($x + 1) == $tursayi) {$turBirles.=$turum;} else {$turBirles.=$turum.", ";}
	
}

$url="https://api.themoviedb.org/3/movie/$idsi/videos?api_key=$api&language=tr-TR";
$json = file_get_contents($url);
$json = json_decode($json);
$youtube_link = $json->results[0]->key;

$youtube_linki = "https://www.youtube.com/watch?v=".$youtube_link;

}

if($tip=="dizi"){

$url2="https://api.themoviedb.org/3/tv/$idsi?api_key=$api&language=tr-TR";
$json2 = file_get_contents($url2);
$json2 = json_decode($json2);
$puan = $json2->vote_average;
$puan = substr($puan, 0, 3);
$yuzdePuan = $puan * 10;
$sure = $json2->episode_run_time[0];
$baslik = $json2->name;
$poster = $json2->poster_path;
$arkaplan = $json2->backdrop_path;
$aciklama = $json2->overview;

$websitesi=$json2->homepage;

if($aciklama=="") {
	$url3="https://api.themoviedb.org/3/tv/$idsi?api_key=$api&language=en-US";
	$json3 = file_get_contents($url3);
	$json3 = json_decode($json3);
	$aciklama = $json3->overview;
}

$url3="https://api.themoviedb.org/3/tv/$idsi/content_ratings?api_key=$api";
$json3 = file_get_contents($url3);
$json3 = json_decode($json3);
$contenti = $json3->results;
$contentSayi=count($contenti);
$yas="";
for($x=0;$x<$contentSayi; $x++){
$ulke = $json3->results[$x]->iso_3166_1;
if($ulke=="TR") {$yas = $json3->results[$x]->rating;}
}

$cikis_tarih=$json2->first_air_date;
$cikis_tarihi = substr($cikis_tarih, 0, 4);
$turler = $json2->genres;
$tursayi=count($turler);
$turBirles = "";
for($x=0;$x<$tursayi; $x++){
	$turum = $json2->genres[$x]->name;
	if(($x + 1) == $tursayi) {$turBirles.=$turum;} else {$turBirles.=$turum.", ";}
	
}

$url="https://api.themoviedb.org/3/tv/$idsi/videos?api_key=$api&language=tr-TR";
$json = file_get_contents($url);
$json = json_decode($json);
$youtube_link = $json->results[0]->key;

$youtube_linki = "https://www.youtube.com/watch?v=".$youtube_link;

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
                    <img src="images/logo1.png" alt="logo" width="32px"/>  ExaltFilm
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
    <div class="hero-section">
		<div class="film-detay" style='background-image: url("https://www.themoviedb.org/t/p/w1920_and_h800_multi_faces/<?php echo $arkaplan; ?>");'>
			<div id="poster" class="tasarim poster">
				<img src="https://www.themoviedb.org/t/p/w300_and_h450_bestv2<?php echo $poster; ?>">								
			</div>
			<div id="icerik" class="tasarim icerik">
				<h1><?php echo $baslik."(".$cikis_tarihi.")"; ?></h1>
				
				<div class="movie-info-detay">
					<span id="pegi"><?php echo $yas." "; ?></span>
					<div id="puan">
						<i class="bx bxs-star"></i>
						<span><?php echo $puan; ?></span>
					</div>
					<div id="sure">
						<i class="bx bxs-time"></i>
						<span><?php echo $sure; ?> dk.</span>
					</div>
					<span id="turler"><?php echo $turBirles; ?></span>
				</div>
				<br>
				<div class="site-link">
					<div class="ratingi"><?php echo $yuzdePuan; ?></div>
					
					<?php if($tip=="dizi") { ?>
					<a href="<?php echo $websitesi; ?>" target="_blank">
						<img class="imdb-logo" src="https://www.freepnglogos.com/uploads/logo-website-png/logo-website-website-icon-with-png-and-vector-format-for-unlimited-22.png"/>
					</a>
					<?php } else { ?>
					<a href="https://www.imdb.com/title/<?php echo $imdb; ?>" target="_blank">
						<img class="imdb-logo" src="https://ia.media-imdb.com/images/M/MV5BODc4MTA3NjkzNl5BMl5BcG5nXkFtZTgwMDg0MzQ2OTE@._V1_.png"/>
					</a>
					<?php } ?>
					<?php if($youtube_link!="") { ?>
						<a href="<?php echo $youtube_linki; ?>" target="_blank"><img class="youtube-logo" src="https://www.freepnglogos.com/uploads/youtube-logo-png/youtube-transparent-youtube-play-button-png-download-clip-art-11.png"/></a>
					<?php } ?>
				</div>
				<br>
				<h3>Özet</h3>
				<p class="aciklama"><?php echo $aciklama; ?></p>
			</div>
		</div>
	</div>
	
	<div class="section">
        <div class="container">
            <div class="section-header">
                <div> oyuncular</div>
            </div>
            <div class="movies-slide carousel-nav-center owl-carousel">
			
			
				<?php 
				if($tip=="film"){
					$url="https://api.themoviedb.org/3/movie/$idsi/credits?api_key=$api&language=tr-TR";
				} else {
					$url="https://api.themoviedb.org/3/tv/$idsi/credits?api_key=$api&language=tr-TR";
				}
				$json = file_get_contents($url);
				$json = json_decode($json);
				$oyuncular = $json->cast;
				$oyuncuSayi=count($oyuncular);
				$ekip= $json->crew;
				$ekipSayi=count($ekip);
				for($y=0;$y<$oyuncuSayi; $y++){
					$oyuncuId = $json->cast[$y]->id;
					$oyuncuAdi = $json->cast[$y]->name;
					$karakterAdi = $json->cast[$y]->character;
					$profilFoto = $json->cast[$y]->profile_path;
					
				?>
				
				<a href="oyuncu?id=<?php echo $oyuncuId; ?>">
					<div class="movie-item">
						<?php if($profilFoto!="") { ?>
						<img src="https://www.themoviedb.org/t/p/w300_and_h450_bestv2<?php echo $profilFoto; ?>" alt="">
						<?php } else { ?>
						<img src="images/cast.jpg" alt="">
						<?php } ?>
						<div class="movie-item-content">
							<div class="movie-item-title">
								<?php echo $oyuncuAdi; ?>
							</div>
							<div class="movie-infos">
								<div class="movie-info">
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
                            <img class="logo-img" src="images/logo1.png"> ExaltFilm
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