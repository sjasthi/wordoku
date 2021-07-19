<?php
$page_title = 'Create a Word';
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
if (isset($_POST["word"])) {
    require_once "./initialize.php";
    $success = create_quote($_POST["word"], $_POST["length"]);
    
    if ($success) {
        redirect_to('./list.php?create=Success');
    } else {
        redirect_to('./list.php?create=Failure');
    }
}

include("./nav.php");
?>

<form action="createQuote.php" method="POST" enctype="multipart/form-data">
    <br>
    <h3 id="title">Create A Word</h3> <br>

    <table>

        <tr>
            <td style="width:100px">Word:</td>
            <td><input type="text" name="word" class="form-control" maxlength="50" size="50" required title="Please enter an author."></td>
        </tr>
        <tr>
            <td style="width:100px">Length:</td>
            <td><input type="text" name="length" class="form-control" maxlength="50" size="50" required title="Please enter a topic."></td>
        </tr>



    </table>

    <br><br>
    <div align="center" class="text-left">
        <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Word</button>
    </div>
    <br> <br>

</form>
</div>