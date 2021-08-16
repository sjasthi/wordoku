

<?php
session_start();
//require('wordoku.php');
//require ('batch.php');
$startid = $_POST['startid'];
$endid = $_POST['endid'];
 
$showSolution= "true";
echo $startid;
echo $endid;
require("Wordoku.php");
include_once "db_credentials.php";
require("word_processor.php");
function formatMoney($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0.00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney
$difficulty = "beginner";
	function getSizeNum($size){
		switch($size){
			case "2x2":
				return 2;
				break;
				case "2x4":
				return 8;
				break;
				case "2x3":
				return 6;
				break;
			case "3x3":
				return 3;
				break;
			case "4x4":
				return 4;
				break;
			default:
				return 2;
				break;
		}
	}
?>

<!DOCTYPE HTML>
<html>
  <head>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="wordokustyle.css">
	
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	
    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1">
    <title>Wordoku Puzzle Generator</title>
	
</head>
  
  <body>
    <div class="Worddoku">
	<?php
	$count = 0;
     		for ($s=$startid; $s<=$endid; $s++){
				//$i=$startid;
   $sql1 = "SELECT * FROM words_list WHERE id = $s";
   $result1 = $db->query($sql1);
   if ($result1->num_rows > 0){
   while ($row = $result1->fetch_assoc()) {

       $word =$row['word'];
	   
    $wordsize = strlen($word);
	   if($wordsize == 4) {$size = "2x2";}
	   if($wordsize == 6) {$size = "2x3";}
	   if($wordsize == 8) {$size = "2x4";}
	   if($wordsize == 9) {$size = "3x3";}
	   if($wordsize == 16) {$size = "4x4";}
	   if($wordsize == 81) {$size = "9x9";}
	   
	   $hiddenCount = ($wordsize*$wordsize)/2;
	   
	  
        $hiddenCount= formatMoney($hiddenCount, 0);
	   
	//   $showSolution ="false";
	//   $url = "wordokuPuzzle.php?size=".$size."&hidecount=".$hiddenCount."&difficulty=".$difficulty."&word=".$word."&showsolution=".$showSolution;
				//print_r("</br>");
				//print_r($url);
	//			 $showSolution ="true";
	//			  $url = "wordokuPuzzle.php?size=".$size."&hidecount=".$hiddenCount."&difficulty=".$difficulty."&word=".$word."&showsolution=".$showSolution;
				//print_r("</br>");
				//print_r($url);
				//header("Location:".$url);
				//die();
				if(isset($_GET["showsolution"])){
			$showSolution = $_GET["showsolution"];
			
			if(!($showSolution == "true")){
				$showSolution == "false";
			}
		}
		else{
			$showSolution = "false";
		}
				$sizeNum = getSizeNum($size);
				
				$wordoku = new Wordoku($sizeNum, $word, $hiddenCount);
				$count = $count + 1;
				echo '<font size=12 face="Arial">';
				echo "$count.  $word";
				echo '<font>';
				echo '<br>';
				
				$puzzle = $wordoku->getPuzzle();
				
			
				
	echo'<div class="col-sm-12"; id="puzzleNormal"">';
	
	echo'<h3>The Puzzle</h3>';	
									echo	'<div class="puzzle">';
									echo '<table id="grid" >';
		
										
											// Display a normal/default puzzle
											$i = 0;
											foreach ($puzzle as $key => $value) 
											{
												echo'<tr>';
												foreach ($value as $k => $val){
													if($val != " "){
														echo'<td id="cell'.$size.'-'.$i.'" bgcolor="#EEEEEE"> '.$val.' </td>
														';
													}
													else{
														echo'<td id="cell'.$size.'-'.$i.'"> '.$val.' </td>
														';
													}
													$i++;
												}
												echo'</tr>';
											}
								
									
									echo '</table>';
									echo '</div>';
			
			echo '</div>';
				
			//echo '<br>';
		//	echo " solution";
   }
   }
			}
			
			?>
			<div>
						<div class="row">
							<div class="form-group">
								<div class="col-sm-4">
									<input type="checkbox" class="showSolution" name="showSolutionTextBox" onchange="valueChanged()" 
									<?php
										// Sets the checkbox as checked or unchecked based on input parameters
										if($showSolution == "true"){
											echo('checked');
										}
									?>> Show solution?
								</div>
							</div>
						</div>
					</div>
					<div class="solutionSection"> 
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-sm-12">
										<div align="center"><h2>Solution</h2></div>
									</div>
								</div>
							</div>
							<div class="panel-body">
								
									
									
								
							<?php
$startid = $_POST['startid'];
$endid = $_POST['endid'];
   
   $count1 = 0;
     		for ($j=$startid; $j<=$endid; $j++){
				//$i=$startid;
   $sql2 = "SELECT * FROM words_list WHERE id = $j";
   $result2 = $db->query($sql2);
   if ($result2->num_rows > 0){
   while ($row1 = $result2->fetch_assoc()) {

       $word =$row1['word'];
	   
    $wordsize = strlen($word);
	   if($wordsize == 4) {$size = "2x2";}
	   if($wordsize == 6) {$size = "2x3";}
	   if($wordsize == 8) {$size = "2x4";}
	   if($wordsize == 9) {$size = "3x3";}
	   if($wordsize == 16) {$size = "4x4";}
	   if($wordsize == 81) {$size = "9x9";}
	   
	   $hiddenCount = ($wordsize*$wordsize)/2;
	   
	  
        $hiddenCount= formatMoney($hiddenCount, 0);
	   
	//   $showSolution ="false";
	//   $url = "wordokuPuzzle.php?size=".$size."&hidecount=".$hiddenCount."&difficulty=".$difficulty."&word=".$word."&showsolution=".$showSolution;
				//print_r("</br>");
				//print_r($url);
	//			 $showSolution ="true";
	//			  $url = "wordokuPuzzle.php?size=".$size."&hidecount=".$hiddenCount."&difficulty=".$difficulty."&word=".$word."&showsolution=".$showSolution;
				//print_r("</br>");
				//print_r($url);
				//header("Location:".$url);
				//die();
				$sizeNum = getSizeNum($size);
				
				$wordoku = new Wordoku($sizeNum, $word, $hiddenCount);
				$count1 = $count1 + 1;
				echo '<font size=12 face="Arial">';
				echo "$count1.  $word";
				echo '<font>';
				echo '<br>';
				
			
		$solution = $wordoku->getSolution();
	$puzzle = $wordoku->getPuzzle();
	
	echo	'<div class="col-sm-12";  id="solutionNormal"">';
	echo '<div class="col-sm-12">';
	
							echo	'<div class="puzzle">';
									echo '<table id="grid">';
		echo '<h3>The Solution</h3>';
										
											// Display a normal/default puzzle
										$i = 0;
													foreach ($solution as $key => $value) 
													{
														echo'<tr>';
														foreach ($value as $k => $val){
															if($puzzle[$key][$k] != " "){
																echo'<td id="cell'.$size.'-'.$i.'" bgcolor="#EEEEEE"> '.$val.' </td>
																';
															}
															else{
																echo'<td id="cell'.$size.'-'.$i.'" bgcolor="#EEEEEE" style="color: red;"> '.$val.' </td>
																';
															}
															$i++;
														}
														echo'</tr>';
													}	
									
								echo	'</table>';
									echo '</div>';
								echo	'</div>';
								echo	'</div>';
			}
		
       //end while
   } 
   
}


?>

								</br></br>
</div>
</div>
    </div>
  </body>
  <script>
	// Shows the solution on initialization based on whether the box is checked
	if($('.showSolution').is(":checked")){
		$(".solutionSection").show();
	}
	else{
		$(".solutionSection").hide();
	}
	
	// Set default hidden/shown puzzles
	$('#puzzleNormal').show();
	$('#solutionNormal').show();


	// Updates the solution section to hidden/visable on check box update
	function valueChanged(){
		if($('.showSolution').is(":checked")){  
			$(".solutionSection").show();
		}
		else{
			$(".solutionSection").hide();
		}
	}
	
	
</script>
</html>