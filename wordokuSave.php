<?php
	/*
	 * Wordoku Save page that saves all the settings from the edit page and saves them into the database.
	 */
	require("WordokuConnection.php");
	
	session_start();
	
	$puzzleID = "1";
	$word = $_SESSION["word"];
	$size = $_SESSION["size"];
	$puzzleType = getPuzzleType($_POST["displayMode"]);
	$puzzleDifficulty = $_SESSION["difficulty"];
	$puzzle = serializeArray($_SESSION["puzzle"]);
	$solution = serializeArray($_SESSION["solution"]);
	
	$connection = new WordokuConnection();
	$newID = $connection->addPuzzle($puzzleID, $word, $size, $puzzleType, $puzzleDifficulty, $puzzle, $solution);

	$url = "WordokuView.php?id=".$newID;
	
	header("Location: ".$url);
	die();
	
	/*
	 * Saves array into a string format
	 * Columns separated by commas, rows by pipes
	 */
	function serializeArray($array){
		$encodedArray = "";
		
		foreach($array as $row){
			$encodedArray .= "|";
			
			foreach($row as $col){
				$encodedArray .= ",".$col;
			}
		}

		return $encodedArray;
	}
	
	/*
	 * Saves the puzzle type in number format based off form input
	 */
	function getPuzzleType($displayMode){
		switch($displayMode){
			case "NoNumbers":
				return 1;
				break;
			case "NumbersAndLetter":
				return 2;
				break;
			case "JustNumbers":
				return 3;
				break;
		}
	}
?>