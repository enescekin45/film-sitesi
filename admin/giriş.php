<?php 
session_start();
include 'ft.php';// 'ft.php' dosyasını dahil et
include 'db.php';// 'db.php' dosyasını dahil et

 ?>
 <head>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<div class="container">
	<div class="head" style="text-align: center;">
		<h1>sinemasına giriş yapın</h1>
	</div>
	<form action="giriş.php" method="post">
		<!-- Kullanıcıdan e-posta ve şifre bilgisi girişi için form -->
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" name="uname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address">
    <small id="emailHelp" class="form-text text-muted">E-postanızı asla başka biriyle paylaşmayacağız.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
<!-- Giriş butonu -->
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<?php 
// Formdan gönderilen kullanıcı adı ve şifre
if (isset($_POST['submit'])) {
	$user = $_POST['uname'];
	$pwd = $_POST['pwd'];
// Veritabanında kullanıcı adına göre sorgu
	$query = "Select * From admin where uname = '$user'";
	$run = mysqli_query($con,$query);
	// Eğer kullanıcı bulunduysa
	if (mysqli_num_rows($run)>0) {
		while ($row = mysqli_fetch_assoc($run)) {
			// Şifre doğrulaması
			if (password_verify($pwd, $row['pwd'])) {
				// Oturum başlatma ve yönlendirme
				$_SESSION['loginsuccesfull']=1;
				$_SESSION['user'] = $user;
				echo "<script>alert('Başarıyla Giriş Yapıldı'); window.location.href='index.php';</script>";
		
			}
				
		}	
	// Kullanıcı bulunamazsa hata mesajı
	}
	else{
				echo "<script>alert('Kimlik kartınızı kontrol edin - Kullanıcılarımıza Müdahale Etmediler'); </script>";
			}
	
}

 ?>
