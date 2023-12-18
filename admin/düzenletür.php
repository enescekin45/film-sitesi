<?php 
include 'header.php';
include 'ft.php';
include 'db.php';
?>
<?php 
if(isset($_GET['id'])){

     $id=$_GET['id'];
     $gename=$_GET['türname'];
     $catid=$_GET['catid'];  
     $türid=$_GET['türid'];
}
if(isset($_POST['türname'])){
    $cat_id=$_POST['cat_id'];
    $türid1=$_POST['tür_id'];

    $query="UPDATE `tür` SET`tür_name`='$türname1',`Kategori_id`='$cat_id',`türid`=$türid1 WHERE id=$id";
    $run = mysqli_query($con,$query);
   if ($run) {
    echo "<script>alert('tür Başarıyla Güncellendi ..:)');window.location.href='türlistesi.php';</script>";
   }
   else{
    echo "<script>alert('Bir Şeyler Yanlış Gitti ..:)');window.location.href='düzenletür.php';</script>"; 
  }
}
else{
    header('location:türlistesi.php');
}

?>
<div class="container">
    <div class="head">    
        <div class="jumbotron">
            <h1 class="display-4">Tür düzenleyin </h1>
            <p class="lead">Türü düzenleyin ve lütfen kategori kimliğini de belirtin</p>
            <hr class="my-4">
            <form action="düzenletür.php" method="post">
            <div class="form-row">
                <div class="col-7">
                    <input type="text" value="<?php echo $türname;?> "name="türname"class="form-control" placeholder="Kategori name">
                </div>
               
             <div class="col">
                    <input type="text"value="<?php echo $catid;?>" name="catid" class="form-control" placeholder="Kategori ID ">
                </div>
                 <div class="col">
                    <input type="text" value="<?php echo $türid;?>"name="tür_id" class="form-control" placeholder="Tür Kimliği ">
                </div>
            </div>
            <br><br>
            <button class="btn btn-primary btn-lg" name="submit">Kategori ekle</button>
        </form>
    </div>
    </div>
</div>
