<?php 
include("api.php");
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
                    <img src="images/logo1.png" alt="logo" class="logo-img"/>ExaltFilm 
                </a>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="index">Anasayfa</a></li>
                    <li><a href="filmler">Filmler</a></li>
                    <li><a href="diziler">Diziler</a></li>
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
        <div class="hero-slide">
            <div class="owl-carousel carousel-nav-center" id="hero-carousel">
                
				<?php 
				$url="https://api.themoviedb.org/3/trending/movie/day?api_key=$api&language=tr";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$trendFilmler = $json->results;
				$trendFilmSayi=count($trendFilmler);
				for($i=0;$i<$trendFilmSayi; $i++){
					$baslik = $json->results[$i]->title;
					$arkaplan = $json->results[$i]->backdrop_path;
					$aciklama = $json->results[$i]->overview;
					$aciklama = substr($aciklama, 0, 170)."...";
					$idsi = $json->results[$i]->id;
				
					$url2="https://api.themoviedb.org/3/movie/$idsi?api_key=$api&language=tr";
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
				
				<div class="hero-slide-item">
                    <img src="https://www.themoviedb.org/t/p/original/<?php echo $arkaplan; ?>" alt="">
                    <div class="overlay"></div>
                    <div class="hero-slide-item-content">
                        <div class="item-content-wraper">
                            <div class="item-content-title top-down">
                                <?php echo $baslik; ?>
                            </div>
                            <div class="movie-infos top-down delay-2">
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
                            <div class="item-content-description top-down delay-4">
                                <?php echo $aciklama; ?>
                            </div>
                            <div class="item-action top-down delay-6">
                                <a href="detay?id=<?php echo $idsi; ?>&tip=film" class="btn btn-hover">
                                    <i class="bx bxs-right-arrow"></i>
                                    <span>DETAY</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php } ?>
               
            </div>
        </div>
        
        <div class="top-movies-slide">
            <div class="owl-carousel" id="top-movies-slide">
			
				<?php 
				$url="https://api.themoviedb.org/3/trending/movie/day?api_key=$api&language=tr";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$trendFilmler = $json->results;
				$trendFilmSayi=count($trendFilmler);
				for($i=0;$i<$trendFilmSayi; $i++){
					$baslik = $json->results[$i]->title;
					$poster = $json->results[$i]->poster_path;
					$aciklama = $json->results[$i]->overview;
					$idsi = $json->results[$i]->id;
					$url2="https://api.themoviedb.org/3/movie/$idsi?api_key=$api&language=tr";
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
                <a href="detay?id=<?php echo $idsi; ?>&tip=film">
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
				<?php } ?>
               
            </div>
        </div>
        
    </div>

    <div class="section">
        <div class="container">
            <div class="section-header">
                <div> en çok oy alanlar</div>
                <a class="tumu" href="filmler?tip=top">tümü</a>
            </div>
            <div class="movies-slide carousel-nav-center owl-carousel">
			
			
				<?php 
				$url="https://api.themoviedb.org/3/movie/top_rated?api_key=$api&language=tr-TR&page=1";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$trendFilmler = $json->results;
				$trendFilmSayi=count($trendFilmler);
				for($i=0;$i<$trendFilmSayi; $i++){
					$baslik = $json->results[$i]->title;
					$poster = $json->results[$i]->poster_path;
					$aciklama = $json->results[$i]->overview;
					$idsi = $json->results[$i]->id;
					$url2="https://api.themoviedb.org/3/movie/$idsi?api_key=$api&language=tr-TR";
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
				
				<a href="detay?id=<?php echo $idsi; ?>&tip=film">
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
                
            	<?php } ?>

            </div>
        </div>
    </div>
    
    <div class="section">
        <div class="container">
            <div class="section-header">
                <div>son filmler</div>
                <a class="tumu" href="filmler?tip=son">tümü</a>
            </div>
            <div class="movies-slide carousel-nav-center owl-carousel">
			
                <?php 
				$url="https://api.themoviedb.org/3/movie/now_playing?api_key=$api&language=tr-TR&page=1";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$trendFilmler = $json->results;
				$trendFilmSayi=count($trendFilmler);
				for($i=0;$i<$trendFilmSayi; $i++){
					$baslik = $json->results[$i]->title;
					$poster = $json->results[$i]->poster_path;
					$aciklama = $json->results[$i]->overview;
					$idsi = $json->results[$i]->id;
					$url2="https://api.themoviedb.org/3/movie/$idsi?api_key=$api&language=tr-TR";
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
				
				<a href="detay?id=<?php echo $idsi; ?>&tip=film">
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
                
            	<?php } ?>
               
            </div>
        </div>
    </div>
    
    <div class="section">
        <div class="container">
        
            <div class="section-header">
                <div> popüler diziler ve tv programları</div>
                <a class="tumu" href="diziler">tümü</a>
            </div>
            <div class="movies-slide carousel-nav-center owl-carousel">

				<?php 
				$url="https://api.themoviedb.org/3/tv/popular?api_key=$api&language=tr-TR";
				$json = file_get_contents($url);
				$json = json_decode($json);
				$trendFilmler = $json->results;
				$trendFilmSayi=count($trendFilmler);
				for($i=0;$i<$trendFilmSayi; $i++){
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