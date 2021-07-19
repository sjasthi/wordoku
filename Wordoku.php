<?php

/*  Created by Stephen Schneider
 *	Wordoku creates a Sudoku puzzle of sizes 2x2, 3x3, or 4x4 and converts the input word 
 *	into the puzzle instead of the traditional numbers.
 *	The puzzle is created by a backtracking algorithm that fills in spaces with randomized options.
 *	A solution is first created and then numbers are converted to characters.
 *	After that a puzzle is generated by hiding cells based off the passed in parameter for hidden cells.
 */

class Wordoku{
	private $word = "";
	private $charArray = [];
	
	// Puzzle and Solution are stored as an array with arrays that represent each row of the Wordoku
	// Methods getColumn and getBox can obtain the values of a particular cell's column and box values
	private $solution = [];
	private $puzzle = [];
	
	private $cellSize = 3;
	private $cellSize1 = 3;
	private $gridSize = 9;
	private $hiddenCount = 0;
	
	// Takes in the size of the puzzle, the Wordoku word, and the number of tiles to be hidden.
	public function __construct($size = 3, $word, $hiddenCount) {
		
		// Conduct various input validation to verify correct input.
		// If something is wrong it may go to a default value or return false and produce a blank puzzle.
		
		// Validate size
		if(!($size == 2 || $size == 3 || $size == 4 || $size == 6 || $size == 8)){
			return false;
		}
		
		
			 else{ if (($size == 6 || $size == 8) ){
			 $this->cellSize1 = 2;
			 $this->cellSize = $size/2;
		    $this->gridSize = $this->cellSize * $this->cellSize1;
			 }
			 else{
			$this->cellSize = $size;
			$this->cellSize1 = $size;
		    $this->gridSize = $this->cellSize * $this->cellSize1;
		}
		
			 }
		
		
		// Validate input word length
		// Create a word processor that handles Telugu words
		$wordProcessor = new wordProcessor($word, "telugu");
		$wordLength = $wordProcessor->getLength();
			
		if($wordLength != $this->gridSize){
			return false;
		}
		else{
			$this->word = $word;
			$this->charArray = $wordProcessor->getLogicalChars();
		}
		
		// Validate hidden count doesn't exceed the number of spaces
		if($hiddenCount > $this->gridSize * $this->gridSize){
			return false;
		}
		else{
			$this->hiddenCount = $hiddenCount;
		}
        
		// Create the solution and puzzle
		$this->setStartingArrays();
		$this->generateSolution(0, 0);
		$this->convertToLetters();
		$this->generatePuzzle();
    }
	
	// Fills initial solution array as the size of the grid and fills with 0s
	public function setStartingArrays(){
		$this->solution = array_fill(0, $this->gridSize, array_fill(0, $this->gridSize, 0));
    }
	
	 // Recursive Backtracking algorithm for creating a randomized puzzle.
	 // It will backtrack if it finds no potential options for the current cell and try the next option for the previous cell.
	public function generateSolution($row, $col){
		// Wrap around columns if it passes the grid size
		if($col > ($this->gridSize - 1)){
			$col = 0;
			$row = $row + 1;
			
			// End puzzle creation if the last row is reached - a final solution has been made.
			if($row > ($this->gridSize - 1)){
				return true;
			}
		}
		
		// Create a list of valid options for the current cell.
		// Options are randomized to create new potential puzzles each time.
		$validOptions = $this->getValidOptions($row, $col);
		
		// If no valid options, then backtrack to previous cell
		if(count($validOptions) == 0){
			return false;
		}
		// If there's options, attempt to try each valid option.
		// If no options work, then back track to previous cell.
		else{
			foreach($validOptions as $optionIndex => $option){
				$this->solution[$row][$col] = $option;
				$result = $this->generateSolution($row, $col + 1);
				
				// If true is returned then that means a solution has been found.
				if($result == true){
					return true;
				}
			}
			
			$this->solution[$row][$col] = 0;
			return false;
		}
    }
	
	// Obtains all valid options for current cell
	private function getValidOptions($row, $col){
		// Get the current filled in spaces for each column, row, and box for the cell
		$colOptions = $this->getCol($col);
		$rowOptions = $this->getRow($row);
		$boxOptions = $this->getBox($row, $col);
		
		// Combine them together and remove 0 values to get a full list of invalid options
		$invalidNumbers = array_merge($colOptions, $rowOptions, $boxOptions);
		$invalidNumbers = array_diff($invalidNumbers, array(0));
		
		// Invert the invalid options to valid ones, then shuffle
		$validNumbers = array_diff(range(1, $this->gridSize), $invalidNumbers);
		shuffle($validNumbers);
		
		return $validNumbers;
	}

	// Converts Sudoku solution numbers into letters making it into a Wordoku
	private function convertToLetters(){
		for($r = 0; $r < $this->gridSize; $r++){
			for($c = 0; $c < $this->gridSize; $c++){
				$currentNum = $this->solution[$r][$c] - 1;
				$newLetter = $this->charArray[$currentNum];
				
				$this->solution[$r][$c] = $newLetter;
			}
		}
	}
	
	// Generates a puzzle from the Wordoku puzzle by converting random cells into blank cells
	private function generatePuzzle(){
		$hiddenCount = $this->hiddenCount;
		$this->puzzle = $this->solution;
		
		// Create a numbered list of all cells
		$spotList = range(0, ($this->gridSize * $this->gridSize) - 1);
		$deleteList = [];
		
		// For each loop randomly select a cell from spotList, add it to the delete list, and remove it from spotList
		for($i = 0; $i < $hiddenCount; $i++){
			$randVal = array_rand($spotList);
			array_push($deleteList, $spotList[$randVal]);
			unset($spotList[$randVal]);
			$spotList = array_values($spotList);
		}
		
		// For each removed cell in deleteList change the value in the puzzle to a blank value
		foreach($deleteList as $key => $hideValue){
			$row = floor($hideValue / $this->gridSize);
			$col = $hideValue - ($this->gridSize * $row);

			$this->puzzle[$row][$col] = " ";
		}
	}
	
	// Returns the character array for the input word
	public function getCharacters(){
		return $this->charArray;
	}
	
	// Returns the word used for the puzzle
	public function getWord(){
		return $this->word;
	}
	
	// Returns the Wordoku solution
	public function getSolution(){
		return $this->solution;
	}
	
	// Returns the Wordoku puzzle with hidden characters
	public function getPuzzle(){
		return $this->puzzle;
	}
	
	// Returns all elements in cells row
	private function getRow($row){
		return $this->solution[$row];
	}
	
	// Returns all elements in the cells column
	private function getCol($col){
		$colNumbers = [];
		
		for($i = 0; $i < $this->gridSize; $i++){
			array_push($colNumbers, $this->solution[$i][$col]);
		}
		
		return $colNumbers;
	}
	
	// Returns all elements in the cells "box" which is defined by a size * size boxes throughout the board
	private function getBox($row, $col){
		$boxNumbers = [];
		
		$boxRow = floor($row / $this->cellSize);
		$boxCol = floor($col / $this->cellSize1);
		
		for($r = $boxRow * $this->cellSize; $r < $boxRow * $this->cellSize + $this->cellSize; $r++){
			for($c = $boxCol * $this->cellSize1; $c < $boxCol * $this->cellSize1 + $this->cellSize1; $c++){
				array_push($boxNumbers, $this->solution[$r][$c]);
			}
		}
		
		return $boxNumbers;
	}
}