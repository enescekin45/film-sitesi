<?php 
include 'header.php';
include 'ft.php';
include 'db.php';
?>

<div class="container">
    <div class="head">    
        <div class="jumbotron">
            <h1 class="display-4">Kategori Ekleme</h1>
            <p class="lead">Kategori ekleyin ve lütfen Kategori Kimliklerini de belirtin</p>
            <hr class="my-4">
            <form action="addkategori.php" method="post">
            <div class="form-row">
                <div class="col-7">
                    <input type="text" name="catname" class="form-control" placeholder="Kategori name">
                </div>
               
             <div class="col">
                    <input type="text" name="catid" class="form-control" placeholder="Kategori ID ">
                </div>
                 <div class="col">
                    <input type="text" name="genid" class="form-control" placeholder="Tür Kimliği ">
                </div>
            </div>
            <br><br>
            <button class="btn btn-primary btn-lg" name="submit">Kategori ekle</button>
        </form>
    </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $catname = $_POST['catname'];
    $catid = $_POST['catid'];
    $query ="INSERT INTO `Kategori`(`Kategori_id`, `Kategori_name`) VALUES ($catid,'$catname')";
    $run=mysqli_query($con,$query);
    if ($run) {
        echo "<script>alert('Kategori Başarıyla Eklendi..:)');window.location.href='kategorilistesi.php';</script>";
    }
    else{
             echo "<script>alert('Kategori Eklerken Bir Sorun Yaşandı'); window.location.href='addKategori.php';</script>";

    }
}

?>