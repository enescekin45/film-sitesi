<?php
include 'header.php';
include 'ft.php';
include 'db.php';
 ?>

<div class="container">
 <div class="head" style="text-align:center;padding: 10px 0px 10px 0px;">
 <h1>Sinema Kategorileri </h1>
 </div>
 <a href="addkategori.php"class="btn btn-warning text-light">Bir kategori ekleyin </a>
 <hr>
 <table class="table table-striped">
 <thead>
 <tr>
 <th scope="col">#</th>
 <th scope="col">kategori_ID<small>Yabancı Anahtar</small></th>
 <th scope=" col">Kategori_name</th>
 <th scope="col">no.of.post</th>
 <th scope="col">CURD</th>
 </thead>
 <?php
 $query = "SELECT * FROM Kategori";
 $run = mysqli_query($con,$query);
 if ($run) {
    while ($row = mysqli_fetch_assoc($run)) {
 
 ?>
   
   <tbody>
     <tr>
       <th scope="row"><?php echo $row['id']; ?></th>
       <td><?php echo $row['Kategori_id']; ?></td>
       <td><?php echo $row['Kategori_name']; ?> 
       <td><?php echo $row['post']; ?> 
       <td>
       <a href="deleteKategori.php?deleteid=<?php echo $row['id']; ?>"class="btn btn-danger">Delete</a>
       <a class ="btn btn-outline-secondary" href="kategoriyidüzenle.php?id=<?php echo $row ['id']; ?>&forkey=<?php echo $row['Kategori_id'];?>&catname=
       <?php echo$row['Kategori_name']?>">Düzenlemek</a></a>
       </td>
     </tr>
   </tbody>
   <?php
}
}
?>
 </table> 
</div>