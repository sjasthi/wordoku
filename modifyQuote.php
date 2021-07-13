<?php $page_title = ' Modify Word'; ?>
<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");
?>


<div class="container">
  <style>
    #title {
      text-align: center;
      color: darkgoldenrod;
    }
  </style>

  <?php
  include_once 'db_credentials.php';
  $db->set_charset("utf8");
  $sql = "SELECT * FROM words_list
            WHERE id = -1";
  $sleep = true;
  $touched = isset($_POST['ident']);
  if (!$touched) {
    echo "You need to select an entry.";
  ?>
    <button><a class="btn btn-sm" href="list.php">Go back</a></button>
  <?php


  } else {
    $id = $_POST['ident'];
    $sql = "SELECT * FROM words_list
            WHERE id = '$id'";
  }
  if ($touched) {
    if (!$result = $db->query($sql)) {
      die('There was an error running query[' . $connection->error . ']');
    } //end if
    //end if

    if ($result->num_rows > 0) {
      // output data of each row


      while ($row = $result->fetch_assoc()) {

        echo '<form action="modifyTheQuote.php" method="POST" enctype="multipart/form-data">
      <br>
     <h2 id="title">Modify Word</h2><br>
      
           <table>
		   <tr>
       <td style="width:100px>   <label for="id">Id</label> </td>
       <td> <input type="text" class="form-control" name="id" value="' . $row["id"] . '"  maxlength="255" readonly></td>
      </tr>
      
    <tr>
        <td style="width:100px>  <label for="word">Word</label></td>
     <td>    <input type="text" class="form-control" name="word" value="' . $row["word"] . '"  maxlength="255"  required></td>
  </tr>
      
      <tr>
        <td style="width:100px>  <label for="length">Length</label></td>
    <td>     <input type="text" class="form-control" name="length" value="' . $row["length"] . '"  maxlength="255" required></td>
     </tr>
          
   
          
    </table>

      <br>
      <div class="text-left">
          <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Word</button>
      </div>
      <br> <br>
      
      </form>';
      } //end while
    } //end if
  } else {
    echo "0 results";
  } //end else

  ?>

</div>