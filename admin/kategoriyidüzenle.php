<?php 

include 'header.php';
include 'ft.php';
include 'db.php';

if (isset($_GET['id'])) {
 $id=$_GET['id'];
 $catname=$_GET['catname'];
 $fk=$_GET['forkey'];
 if(isset($_POST['submit'])){
  $catname=$_POST['kategoriname'];
  $frky=$_POST['frky'];
  $pid=$_POST['pid'];

  $query="UPDATE `kategori` SET `id`='$pid',`Kategori_id`=$frky,`Kategori_name`='$catname' WHERE id=$id";
  $run=mysqli_query($con,$query);
  if($run){
    echo "<script>alert('Kategori Başarıyla Güncellendi ..:)');window.location.href='kategorilistesi.php';</script>";
  }
  else{
    echo "<script>alert('Bir Şeyler Yanlış Gitti ..:)');window.location.href='kategoriyidüzenle.php';</script>"; 
  }
 }
}
else{
 header('location:kategorilistesi.php');
}

?>

<div class="container">
    <div class="head" style="text-align:center;padding: 10px 10px 10px 0px;">
        <h1>Kategori Düzenle</h1>
    </div>
    <hr>
    <form method="post">
 <div class="form-row">
    <div class="col-7">
        <small>Kategori name</small>
      <input type="text" class="form-control" name="kategoriname" value="<?php echo$catname;?>"placeholder="Kategori Name">
    </div>
    <div class="col">
        <small>Yabancı Anahtar</small>
      <input type="text"  class="form-control" name="frky"value="<?php echo$fk;?>" placeholder="Yabancı Anahtar">
    </div>
    <div class="col">
        <small>Birincil kimlik</small>
      <input type="text" class="form-control"name="pid" value="<?php echo$id;?>" placeholder="Birincil kimlik">
    </div>
 </div>
 <br>
 <input type="submit" class="btn btn-outline-success btn-lg" name="submit">
</form>