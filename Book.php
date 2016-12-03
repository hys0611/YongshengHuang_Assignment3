<?php
/**
 * Book.php
 * @author Yongsheng Huang
 * version 27/11/2016
 */
class book {
	// attributes of books
	var $title;
	var $author;
	var $rating;
	var $comment;
	var $status;
	
	// getters
	function getTitle() {
		return $this->title;
	}
	function getAuthor() {
		return $this->author;
	}
	function getRating() {
		return $this->rating;
	}
	function getComment() {
		return $this->comment;
	}
	function getStatus() {
		return $this->status;
	}
	
	// setters
	function setTitle($title) {
		$this->title = $title;
	}
	function setAuthor($author) {
		$this->author = $author;
	}
	function setRating($rating) {
		$this->rating = $rating;
	}
	function setComment($comment) {
		$this->comment = $comment;
	}
	function setStatus($status) {
		$this->status = $status;
	}
	
	// print the book info according to the rating
	function toString() {
		echo "<div style='margin-left:20px;margin-top:20px;width:170px;height:200px;float:left;border:#1F7AD9 dashed;'>";
		echo "<span style='font-size:20px;color:#5C00B6'>"."Title:"."</span>"."<label>".$this->title."</label>"."<br>";
		echo "<span style='font-size:20px;color:#5C00B6'>"."Author:"."</span>"."<label>".$this->author."</label>"."<br>";
		echo "<span style='font-size:20px;color:#5C00B6'>"."Rating:"."</span>"."<label>".$this->rating."</label>"."<br>";
		echo "<span style='font-size:20px;color:#5C00B6'>"."Comment:"."</span>"."<br>";
		echo "<label style='margin-left:20px;display:block;width:130px;height:80px;border:solid #C2C2C2 thin;background-color:#F3F3F3;'>".$this->comment."</label>";
		echo "<span style='font-size:20px;color:#5C00B6'>"."status:"."</span>"."<label>".$this->status."</label>"."<br>";
		echo "</div>";
	}
}
?>