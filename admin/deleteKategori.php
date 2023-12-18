<?php

include 'header.php';
include 'ft.php';
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $catname=$_GET['catname'];
    $fk = $_GET['forkey'];

    if (isset($_POST['submit'])) {
        $cname = $_POST['kategori name'];
        $frky = $_POST['frky'];
        $pid = $_POST['pid'];

        $query = "UPDATE `kategori` SET `id`=$pid,`kategori_id`=$frky,`kategori_name`='$cname' WHERE id=$id";
       $run = mysqli_query($con,$query);
        if ($run) {
            echo "<script>alert('Category Successfully Updated.. :)');window.location.href='kategorilistesi.php';</script>";
        } else {
            echo "<script>alert('Something Went Wrong');window.location.href='kategoriyidüzenle.php';</script>";
        }

    }

} else {
    header('location:kategorilistesi.php');
}

?>

<div class="container">
    <div class="head" style="text-align: center;padding: 10px 0px 10px 0px;">
        <h1>Kategoriyi Düzenle</h1>
    </div>
    <hr>
    <form action="#" method="post">
        <div class="form-row">
            <div class="col-7">
                <small>Kategori Adı</small>
                <input type="text" class="form-control" name="kategori adı" value="<?php echo $catname; ?>" placeholder="Kategori Adı">
            </div>
            <div class="col">
                <small>Yabancı Anahtar</small>
                <input type="text" class="form-control" name="frky" value="<?php echo $fk; ?>" placeholder="Yabancı Anahtar">
            </div>
            <div class="col">
                <small>Birincil Kimlik</small>
                <input type="text" class="form-control" name="pid" value="<?php echo $id; ?>" placeholder="Birincil Kimlik+">
            </div>
        </div>
        <br>
        <br>
        <input type="submit" class="btn btn-outline-success btn-lg" name="submit">
    </form>
</div>