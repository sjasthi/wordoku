<?php
	/*
	 * Data Access class that connects to the database for the Wordoku puzzles
	 */
	class WordokuConnection{
		private $db;
		private $production;
		
		function __construct(){
			$username = "root";
			$password = "";
			$dbname = "puzzles";
			
			$conn = NULL;
			
			try {
				$conn = new PDO("mysql:host=localhost;dbname=".$dbname, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
			
			$this->db = $conn;
		}
		
		/*
		 * Adds a new puzzle to the data base by calling the addNewWordoku stored proc
		 */
		public function addPuzzle($puzzleID, $word, $size, $puzzleType, $puzzleDifficulty, $puzzle, $solution){
			filter_var($puzzleID, FILTER_SANITIZE_STRING);
			filter_var($word, FILTER_SANITIZE_STRING);
			filter_var($size, FILTER_SANITIZE_STRING);
			filter_var($puzzleType, FILTER_SANITIZE_STRING);
			filter_var($puzzleDifficulty, FILTER_SANITIZE_STRING);
			filter_var($puzzle, FILTER_SANITIZE_STRING);
			filter_var($solution, FILTER_SANITIZE_STRING);
			
			$outID = null;
			
			$stmt = $this->db->prepare("CALL addNewWordoku(:p_puzzleID, :p_word, 
				:p_puzzleSize, :p_puzzleType, :p_puzzleDifficulty, :p_puzzle, :p_solution, @out_ID)");
				
			$stmt->bindValue(':p_puzzleID',$puzzleID,PDO::PARAM_INT);
			$stmt->bindValue(':p_word',$word,PDO::PARAM_STR);
			$stmt->bindValue(':p_puzzleSize',$size,PDO::PARAM_STR);
			$stmt->bindValue(':p_puzzleType',$puzzleType,PDO::PARAM_INT);
			$stmt->bindValue(':p_puzzleDifficulty',$puzzleDifficulty,PDO::PARAM_STR);
			$stmt->bindValue(':p_puzzle',$puzzle,PDO::PARAM_STR);
			$stmt->bindValue(':p_solution',$solution,PDO::PARAM_STR);
			$stmt->execute();
			
			$return = $this->db->query('select @out_ID')->fetch(PDO::FETCH_ASSOC);
			return $return['@out_ID'];
		}
		
		/*
		 * Retrieves a new puzzle by calling the getWordokuPuzzle stored proc
		 */
		public function getPuzzle($id){
			filter_var($id, FILTER_SANITIZE_STRING);
			$stmt = $this->db->prepare("CALL getWordokuPuzzle(:p_id)");
			$stmt->bindValue(':p_id',$id,PDO::PARAM_INT);
			$stmt->execute();
			
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
	}
?>