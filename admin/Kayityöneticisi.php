<?php 
include 'header.php'; // 'header.php' dosyasını dahil et
include 'ft.php';// 'ft.php' dosyasını dahil et
include 'db.php';// 'db.php' dosyasını dahil et
 ?>
                                                                          
<div class="container">
	<div class="head" style="text-align: center;">
		<h1>Sinema için yönetici kaydı</h1>
	</div>
	<!-- Yönetici kaydı için form -->
	<form action="Kayityöneticisi.php" method="post">
  <div class="form-group">
	<!-- E-posta girişi -->
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" name="uname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address">
    <small id="emailHelp" class="form-text text-muted">E-postanızı asla başka biriyle paylaşmayacağız.</small>
  </div>
  <!-- Şifre girişi -->
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
<!-- Formu gönderme butonu -->
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>

 <?php 
if (isset($_POST['submit'])) {
// Formdan alınan e-posta ve şifre
	$uname = $_POST['uname'];
	$pwd = $_POST['pwd'];
	// Şifreyi hashleme işlemi
	$hash = password_hash("$pwd", PASSWORD_BCRYPT);
	// Şifreyi doğrulama işlemi (hash kullanıldığı için bu satır gereksiz olabilir)
	$de=password_verify($pwd,$hash);
	// Yöneticiyi veritabanına ekleme sorgusu
	$query = "INSERT INTO `admin`(`uname`, `pwd`) VALUES ('$uname','$hash')";
	$run = mysqli_query($con,$query);
	// Ekleme başarılı ise bilgilendirme mesajı
	if ($run) {
		echo "<script>alert('Yönetici Başarıyla Eklendi..:)');window.location.href='yöneticilistesi.php';</script>";

	}// Hata durumunda mesaj
	else{
		echo "yanlış bir şey";
	}
}


  ?>