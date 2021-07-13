<?php $page_title = 'Delete your quote'; ?>
<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
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
    $sql = "SELECT * FROM words_list
            WHERE id = '-1'";

    $db->set_charset("utf8");

    $touched = isset($_POST['ident']);
    if (!$touched) {
        echo 'You need to select an entry. Go back and try again. <br>';

    ?>
        <button><a class="btn btn-sm" href="list.php">Go back</a></button>
    <?php
    } else {
        $id = $_POST['ident'];
        $sql = "SELECT * FROM words_list
            WHERE id = '$id'";
    }

    if (!$result = $db->query($sql)) {
        die('There was an error running query[' . $connection->error . ']');
    } //end if


    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <form action="deleteTheQuote.php" method="POST" >
                <br>
                <h3 id="title">Delete Word</h3><br>
            
                <table>
                    <tr>
                        <td style="width:100px"> <label for="categoryx">ID</label> </td>
                        <td><input type="text" class="form-control" name="id" value="<?php echo $row["id"]; ?>"  maxlength="5" readonly> </td>
                    </tr>
                    <tr>
                        <td style="width:100px"> <label for="category">Word</label> </td>
                        <td><input type="text" class="form-control" name="word" value="<?php echo $row["word"]; ?>"  maxlength="50" size="50" readonly></td>
                    </tr>
                        
                    <tr>
                        <td style="width:100px">  <label for="name">Length</label></td>
                        <td>  <input type="text" class="form-control" name="length" value="<?php echo $row["length"]; ?>"  maxlength="50" size="50" readonly></td>
                    </tr>
                    
                        
                   
                </table>    
            
                <br>
                <div align="center" class="text-left">
                    <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center"> Delete Word</button>
                </div>
                <br><br>
            </form>
            <?php
        } //end while
    } //end if
    else {
        echo "0 results";
    } //end else

    ?>

</div>