<?php 
include 'header.php';
include 'ft.php';
include 'db.php';
 ?>
 <!-- table -->
<div class="container">
	<div class="head" style="padding-top: 10px; padding-bottom: 10px;text-align: center;">
		<h1>Sinema Yöneticileri</h1>
		<hr>
	</div>
	<table class="table table-striped">
  <thead>

    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">CURD</th>
    </tr>
  </thead>
    	<?php 

  	$query = "SELECT * from admin";
  	$run = mysqli_query($con,$query);
  	if ($run) {
  		while ($row = mysqli_fetch_assoc($run)) {
  			
  	?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['uname']; ?></td>
      <td><pre>Şifreli Parola</pre></td>
      <td><a class="btn btn-danger" href="deleteadmin.php?unameid=<?php echo $row['id']; ?>">sil</a> <a class="btn btn-success" href="registeradmin.php">Yeni Yönetici</a></td>
    </tr>
    <?php
	}
  	}

  	 ?>

  </tbody>
</table>
</div>
