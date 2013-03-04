<?php

class CommentHandler{
	
	private $dbc = null;
	
	//Hämta bildens kommentarer
	public function GetComments($pictureName){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";		
		
		$this->dbc->Connect();

		if ($stmt = $this->dbc->Prepare("SELECT username, comment, dateTime FROM comments WHERE pictureName = ? ORDER BY commentID")){
			$stmt->bind_param("s", $pictureName);
			$stmt->bind_result($username, $comments, $dateTime);		
			$stmt->execute();
			
			//Hämtar kommentarer till array
			while($stmt->fetch()){
				$CommentContent = array();
				$CommentContent[] = $username;
				$CommentContent[] = $comments;
				$CommentContent[] = $dateTime;
				$result[] = $CommentContent;	
			}
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_GET_COMMENTS);
		}
		
		$this->dbc->Close();
		
		return $result;
	}
	
	//Hämtar antal kommentarer per bild
	public function GetNumberOfCommentsByPicture($pictureName){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";	
		
		$this->dbc->Connect();
		
		if ($stmt = $this->dbc->Prepare("SELECT comment FROM comments WHERE pictureName = ?")){
			$stmt->bind_param("s", $pictureName);
			$stmt->bind_result($comments);		
			$stmt->execute();
			$stmt->store_result();
			
			//Plockar ut antal kommentarer
			$result = $stmt->num_rows;
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_GET_COMMENTS);
		}
		
		$this->dbc->Close();
		
		return $result;
	}
	
	//Lägga till nya kommentarer för vald bild
	public function InsertComment($comment, $username, $dateTime, $pictureName){
		$this->dbc = new DBConnection();
		$log = new Log();
		$result = "";
		
		$this->dbc->Connect();
		
		if ($stmt = $this->dbc->Prepare("INSERT INTO comments (comment,username, dateTime, pictureName) VALUES(?, ?, ?, ?)")){
	        $stmt->bind_param("ssss", $comment,$username, $dateTime, $pictureName);		
			$stmt->execute();
			
			//Om kommentaren lagts till returneras true
			if($stmt->affected_rows == true){
				$result = true;
			}
			
			$stmt->close();
		}
		else{
			$log->LogMessage(LOG::COULD_NOT_INSERT_COMMENTS);			
		}
		
		$this->dbc->Close();
		
		return $result;
	}
	
	//Testfunktion
	public function Test(){
		if($this->InsertComment("Solglasögon på en byracka!", "LASSE", "kulhund.jpg") == false){
			echo "Detta bör vara en giltig insert!";
			return false;
		}
		
		if($this->GetComments("kulhund.jpg") == false){
			echo "Inga kommentarer hämtades!";
			return false;
		}
		
		if($this->GetNumberofCommentsByPicture("kaloribomb.jpg") == false){
			echo "Något gick fel när kommentarer skulle hämtas";
			return false;
		}
	}
}