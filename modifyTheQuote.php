<?php

include_once 'db_credentials.php';

if (isset($_POST['id'])) {

  $id = mysqli_real_escape_string($db, $_POST['id']);
  $word = mysqli_real_escape_string($db, $_POST['word']);
  $length = mysqli_real_escape_string($db, $_POST['length']);
  

  $sql = "UPDATE words_list  
				  SET  word = '$word',
				      length = '$length'
              
          WHERE id = '$id'";

  mysqli_query($db, $sql);

  header('location: list.php?updated=Success');
}//end if
