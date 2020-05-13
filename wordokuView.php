<?php
	require("WordokuConnection.php");
	require("word_processor.php");
	
	$id = $_GET["id"];
	
	$connection = new WordokuConnection();
	$wordokuSettings = $connection->getPuzzle($id);
	
	$word = $wordokuSettings["word"];
	$size = $wordokuSettings["puzzleSize"];
	$puzzleType = $wordokuSettings["puzzleType"];
	$puzzle =  createGrid($wordokuSettings["puzzle"]);
	$difficulty = $wordokuSettings["puzzleDifficulty"];
	
	$wordProcessor = new wordProcessor($word, "telugu");
	$characters = $wordProcessor->getLogicalChars();
	
	/*
	 * Creates a grid from the string input saved in the database
	 * Rows split by pipes, columns by commas
	 */ 
	function createGrid($encodedArray){
		$array = [];
		
		$rows = explode("|", $encodedArray);
		$columns = null;
		
		$i = -1;
		foreach($rows as $row){
			// First array is a blank array with explode - skip it
			if($i == -1){
				$i++;
				continue;
			}
			
			$columns = explode(",", $row);
			
			$array[$i] = [];
			
			$skipFirst = true;
			foreach($columns as $col){
				// First array is a blank array with explode - skip it
				if($skipFirst){
					$skipFirst = false;
					continue;
				}
				array_push($array[$i], $col);
			}
			
			$i++;
		}
		
		return $array;
	}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN''http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
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
	<form action="wordokuSave.php" method="post">
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
										<h2>Wordoku
											<?php
												echo ucwords($difficulty);
											?>
										</h2>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="form-group" style='width:40%;margin:auto;border:2px solid black;padding-top:10px;padding-bottom:10px;text-align:center'>
									<div class="text-center">
										<h3>Character Key</h3>
									</div>
								</div>
								<div class="form-group" style='width:40%;margin:auto;border:2px solid black;padding-top:10px;padding-bottom:10px;text-align:center'>
									<div class="text-center">
										<h3>
										<?php
											// Displays input word characters seperated out
											foreach ($characters as $key => $letter){
												echo($letter." ");
											}
										?>
										</h3>
									</div>
								</div>
							</div>
							</br></br>
							<!-- NORMAL -->
							<div class="col-sm-12"  id="puzzleNormal">
								<div class="puzzle">
									<table id="grid">
										<?php 
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
										?>
									</table>
								</div>
							</div>
							<!-- NUMBER AND LETTER -->
							<div class="col-sm-12"  id="puzzleNumberAndLetter">
								<div class="puzzle" style="position: relative;right: 24px;">
									<table id="grid">
										<?php 
											// Display a puzzle with a Number row on top and letter column on the side
											// Will appear in a grid like fasion to cells can be specified as A1, B2, etc.
											echo('<tr>');
											echo('<td style="border: none;"> </td>');
											
											for($i = 1; $i <= $size*$size; $i++){
												
												echo('<td style="border: none;"> '.$i.' </td>');
											}
											echo('<tr/>');
											echo('<tr>');
											
											$i = 0;
											$letter = 'A';
											foreach ($puzzle as $key => $value) 
											{
												echo('<tr>');
												echo('<td class="headerCell" style="border: none;">');
												echo($letter);
												echo('</td>');
												
												$letter++;
												
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
										?>
									</table>
								</div>
							</div>
							<!-- NUMBERS -->
							<div class="col-sm-12"  id="puzzleNumbers">
								<div class="puzzle">
									<table id="grid">
										<?php 
											// Displays puzzle with empty values being assigned a number.
											// Empty values could be specified then in message format like 1 = A, 2 = C, etc.
											$i = 0;
											$j = 1;
											foreach ($puzzle as $key => $value) 
											{
												echo'<tr>';
												foreach ($value as $k => $val){
													if($val != " "){
														
														
														echo'<td id="cell'.$size.'-'.$i.'" bgcolor="#EEEEEE"> '.$val.' </td>
														';
													}
													else{
														echo'<td id="cell'.$size.'-'.$i.'" style="font-size: 16px;align: left;vertical-align: top; text-align: left;"> '.$j.' </td>
														';
														
														$j++;
													}
													$i++;
												}
												echo'</tr>';
											}
										?>
									</table>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
<script>
	<?php
		if($puzzleType == 1){
			echo("$('#puzzleNormal').show();$('#puzzleNumberAndLetter').hide();$('#puzzleNumbers').hide();");
		}
		else if($puzzleType == 2){
			echo("$('#puzzleNormal').hide();$('#puzzleNumberAndLetter').show();$('#puzzleNumbers').hide();");
		}
		else{
			echo("$('#puzzleNormal').hide();$('#puzzleNumberAndLetter').hide();$('#puzzleNumbers').show();");
		}
		
	?>
</script>
</html>
