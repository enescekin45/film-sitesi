<?php
include 'header.php';
include 'db.php';

if (isset($_POST['submit'])){
    $mv_name = $_POST['mv_name'];
    $mv_m_des = $_POST['mv_m_desc'];
    $mv_m_tag = $_POST['mv_m_tag'];
    $mv_link1 = $_POST['mv_link1'];
    $mv_link2 = $_POST['mv_link2'];
    $mv_lang = $_POST['mv_lang'];
    $cat_id = $_POST['cat_id'];
    $genre_id = $_POST['genre_id'];
    $mv_desc = $_POST['mv_desc'];
    $mv_director = $_POST['mv_director'];
    $mv_date = date('Y-m-d', strtotime($_POST['mv_date']));
    $target = "../thumb" . basename($_FILES['img']['name']);
    $img = $_FILES["img"]["name"];

    // SQL enjeksiyonunu önlemek için hazır deyim kullanma
    $query = "INSERT INTO movie (`cat_id`, `genre_id`, `mv_name`, `mv_des`, `mv_tag`, `link1`, `link2`, `img`, `date`, `lang`, `director`, `meta_description`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($con, $query);
    
    // Bağlama parametreleri
    mysqli_stmt_bind_param($stmt, "iissssssssss", $cat_id, $genre_id, $mv_name, $mv_desc, $mv_m_tag, $mv_link1, $mv_link2, $img, $mv_date, $mv_lang, $mv_director, $mv_m_des);
    
    // İfadenin yürütülmesi
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        echo "<script>alert('Film Başarıyla Güncellendi.. :)');window.location.href='movielist.php';</script>";
    } else {
        echo "<script>alert('Bir Hata Oluştu.. :(');window.location.href='addmovie.php';</script>";
    }
// İfadeyi ve bağlantıyı kapatma
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
