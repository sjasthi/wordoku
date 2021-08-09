<?php
		/*  Created by Stephen Schneider
		 *	Index page for the Wordoku puzzle.
		 *	Allows user to set information for puzzle generation.
		 *  On first submission page is done as a POST request to validate user input.
		 *  After validation of input, the page is redirected to the Wordoku Puzzle page as a GET request with passed in parameters.
		 */
		 
	session_start();
	ob_start();
	
	$startid ="";
	$endid ="";
	
	
	//require("Wordoku.php");
	include_once "db_credentials.php";
	

	$ini = parse_ini_file('config.ini');
	$db->set_charset("utf8");
	$sql = "SELECT * FROM words_list";
	$result = $db->query($sql);
	if (!$result = $db->query($sql)) {
      die('There was an error running query[' . $connection->error . ']');
    } 
	 else{
		 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$startid = $_POST['startid'];
        $endid = $_POST['endid'];


  


        $_session["startid"]= $_POST['startid'];
		$_session["endid"]= $_POST['endid'];
    }




}





	  
	
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN''http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<title> Wordoku</title>
</head>
<body>
<form action="batchhml.php"   method="post">
<div class="container-fluid">
            <div class="jumbotron" id="jumbos">
            </div>
            <div class="panel">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-12">
									<div align="center">
										<h2>Select the range of words:</h2>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Puzzle Starting Id</label>
  <select name="startid" id="startid">
   <?php
                            if (!is_null($result)) {
                               
    foreach ($result as $postResult) {
            echo '<option value="'.$postResult["id"].'">'.$postResult["id"].'</option>';
        }
							}

    ?>
</select>
</div>
</div>
</div>
<br>
<div class="col-sm-3">
<label>Puzzle Ending Id</label>

										
 <select name="endid" id="endid">
   <?php
 if (!is_null($result)) {
                               
 foreach ($result as $postResult) {
   echo '<option value="'.$postResult["id"].'">'.$postResult["id"].'</option>';
        }
							}

    ?>
</select>
           </div>                     
   
		</div>
		</div>
		
<div class="row">
<br>
                    <div class="col-sm-6"><input type="submit" name="submit" class="btn btn-primary btn-lg" value="HTML"></div>
					<div class="col-sm-6"><input type="button" name="button" onclick="window.location.href='PPTX.php'" class="btn btn-primary btn-lg" value="PowerPont"></div>
               
				 <div class="col-sm-6"><input type="button" name="test"  onclick="window.location.href='batchfinaltest.php'" class="btn btn-primary btn-lg" value="finaltest"></div>
				 
				 
				 
                </div>
				 </div>
				
		</div>
		</div>
		</div>
</form>
</body>
</html>