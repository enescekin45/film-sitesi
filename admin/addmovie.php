<?php 

include 'db.php';
include 'header.php';
include 'ft.php';
 ?>

<div class="container">
	<div class="jumbotron">
  <form action="valinewpost.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" name="mv_name" class="form-control" placeholder="Film Adını Girin" >
  </div>
  <div class="form-group">
   
    <input type="text" name="mv_m_desc" class="form-control" placeholder="Meta açıklamayı girin" >
  </div>
    <div class="form-group">
   
    <input type="text" name="mv_m_tag" class="form-control" placeholder="Meta Etiketleri Girin" >
  </div>
  <div class="form-group">
   
    <input type="text" name="mv_link1" class="form-control" placeholder="Bağlantı 1'i girin" >
  </div>
  <div class="form-group">
   
    <input type="text" name="mv_link2" class="form-control" placeholder="Bağlantı 2'yi girin" >
  </div>
  <div class="form-group">
   
    <input type="date" name="mv_date" class="form-control" placeholder="Tarih Girin">
  </div>
  <div class="form-group">
   
    <input type="text" name="mv_lang" class="form-control" placeholder="Film Dilini Girin" >
  </div>
  <div class="form-group">
   
    <input type="text" name="mv_director" class="form-control" placeholder="Film Yönetmenine Girin" >
  </div>
  <div class="form-group">
   
    <input type="text" name="cat_id" class="form-control" placeholder="Kategori Kimliğini Girin" >
  </div>
  <div class="form-group">
   
    <input type="text" name="genre_id" class="form-control" placeholder="Tür Kimliğini Girin" >
  </div>
   <div class="custom-file">
    <input type="file" name="img" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Dosya seçin</label>
  </div>
  <br>
  <br>
  <br>
  <div class="form-group">
   <textarea type="text" name="mv_desc" class="form-control" placeholder="Enter Movie description" rows="4"></textarea>
    
  </div>


  <button type="submit" name="submit" class="btn btn-info btn-lg">Gönder</button>
</form>
	</div>
</div>