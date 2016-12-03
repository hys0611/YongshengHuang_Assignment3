<?php

/**
 * HomePageMthod.php
 * @author Yongsheng Huang
 * version 27/11/2016
 */

// display the overview according to the selected criterea
function display() {
	global $state;
	global $title;
	global $author;
	global $ratingr;
	global $status;
	if ($state == "1") {
		$con = mysql_connect ( "localhost", "root", "" );
		mysql_select_db ( "db_book", $con );
		$sql = "select * from tb_book order by rating desc";
		$result = mysql_query ( $sql, $con );
		while ( $bookInfo = mysql_fetch_array ( $result ) ) {
			$title = $bookInfo ["title"];
			$author = $bookInfo ["author"];
			$rating = $bookInfo ["rating"];
			$comment = $bookInfo ["comment"];
			$status = $bookInfo ["status"];
			$book = new book ();
			$book->setTitle ( $title );
			$book->setAuthor ( $author );
			$book->setRating ( $rating );
			$book->setComment ( $comment );
			$book->setStatus ( $status );
			$book->toString ();
		}
		mysql_free_result ( $result );
		mysql_close ( $con );
	}
	if ($state == "2") {
		$con = mysql_connect ( "localhost", "root", "" );
		mysql_select_db ( "db_book", $con );
		$sql = "select * from tb_book order by title asc";
		$result = mysql_query ( $sql, $con );
		while ( $bookInfo = mysql_fetch_array ( $result ) ) {
			$title = $bookInfo ["title"];
			$author = $bookInfo ["author"];
			$rating = $bookInfo ["rating"];
			$comment = $bookInfo ["comment"];
			$status = $bookInfo ["status"];
			$book = new book ();
			$book->setTitle ( $title );
			$book->setAuthor ( $author );
			$book->setRating ( $rating );
			$book->setComment ( $comment );
			$book->setStatus ( $status );
			$book->toString ();
		}
		mysql_free_result ( $result );
		mysql_close ( $con );
	}
	if ($state == "3") {
		$con = mysql_connect ( "localhost", "root", "" );
		mysql_select_db ( "db_book", $con );
		$sql = "select * from tb_book order by author asc";
		$result = mysql_query ( $sql, $con );
		while ( $bookInfo = mysql_fetch_array ( $result ) ) {
			$title = $bookInfo ["title"];
			$author = $bookInfo ["author"];
			$rating = $bookInfo ["rating"];
			$comment = $bookInfo ["comment"];
			$status = $bookInfo ["status"];
			$book = new book ();
			$book->setTitle ( $title );
			$book->setAuthor ( $author );
			$book->setRating ( $rating );
			$book->setComment ( $comment );
			$book->setStatus ( $status );
			$book->toString ();
		}
		mysql_free_result ( $result );
		mysql_close ( $con );
	}
	if ($state == "4") {
		$con = mysql_connect ( "localhost", "root", "" );
		mysql_select_db ( "db_book", $con );
		$sql = "select * from tb_book where status ='buy'";
		$result = mysql_query ( $sql, $con );
		while ( $bookInfo = mysql_fetch_array ( $result ) ) {
			$title = $bookInfo ["title"];
			$author = $bookInfo ["author"];
			$rating = $bookInfo ["rating"];
			$comment = $bookInfo ["comment"];
			$status = $bookInfo ["status"];
			$book = new book ();
			$book->setTitle ( $title );
			$book->setAuthor ( $author );
			$book->setRating ( $rating );
			$book->setComment ( $comment );
			$book->setStatus ( $status );
			$book->toString ();
		}
		mysql_free_result ( $result );
		mysql_close ( $con );
	}
	if ($state == "5") {
		$con = mysql_connect ( "localhost", "root", "" );
		mysql_select_db ( "db_book", $con );
		$sql = "select * from tb_book where status ='read'";
		$result = mysql_query ( $sql, $con );
		while ( $bookInfo = mysql_fetch_array ( $result ) ) {
			$title = $bookInfo ["title"];
			$author = $bookInfo ["author"];
			$rating = $bookInfo ["rating"];
			$comment = $bookInfo ["comment"];
			$status = $bookInfo ["status"];
			$book = new book ();
			$book->setTitle ( $title );
			$book->setAuthor ( $author );
			$book->setRating ( $rating );
			$book->setComment ( $comment );
			$book->setStatus ( $status );
			$book->toString ();
		}
		mysql_free_result ( $result );
		mysql_close ( $con );
	}
	if ($state == "6") {
		$con = mysql_connect ( "localhost", "root", "" );
		mysql_select_db ( "db_book", $con );
		$sql = "select * from tb_book where status ='finished'";
		$result = mysql_query ( $sql, $con );
		while ( $bookInfo = mysql_fetch_array ( $result ) ) {
			$title = $bookInfo ["title"];
			$author = $bookInfo ["author"];
			$rating = $bookInfo ["rating"];
			$comment = $bookInfo ["comment"];
			$status = $bookInfo ["status"];
			$book = new book ();
			$book->setTitle ( $title );
			$book->setAuthor ( $author );
			$book->setRating ( $rating );
			$book->setComment ( $comment );
			$book->setStatus ( $status );
			$book->toString ();
		}
		mysql_free_result ( $result );
		mysql_close ( $con );
	}
}

// validate the first form when the form submit
function validateForm1($book) {
	$title_error = $author_error = $rating_error = $status_error = "";
	if (empty ( $book->getTitle () )) {
		$title_error = "Title could not be empty!";
	} else {
		if (! preg_match ( "/^[A-Za-z0-9\s]{1,60}$/", $book->getTitle () )) {
			$title_error = "Please check the form of title!(Special character is invalid and 60 characters at most)";
		}
	}
	
	if (empty ( $book->getAuthor () )) {
		$author_error = "Author could not be empty!";
	} else {
		if (! preg_match ( "/^[A-Za-z0-9\s]{1,30}$/", $book->getAuthor () )) {
			$author_error = "Please check the form of author!(Special character is invalid and 30 characters at most)";
		}
	}
	
	if ($book->getRating () == "0") {
		$rating_error = "Please choose the rating of the book!";
	}
	
	if ($book->getStatus () == "0") {
		$status_error = "Please choose the status of the book!";
	}
	
	if ($title_error == "" && $author_error == "" && $rating_error == "" && $status_error == "") {
		$_SESSION ["title_error"] = "";
		$_SESSION ["author_error"] = "";
		$_SESSION ["rating_error"] = "";
		$_SESSION ["status_error"] = "";
		return true;
	} else {
		$_SESSION ["title_error"] = $title_error;
		$_SESSION ["author_error"] = $author_error;
		$_SESSION ["rating_error"] = $rating_error;
		$_SESSION ["status_error"] = $status_error;
		return false;
	}
}

// validate the second form when the form submit
function validateForm2($state) {
	global $state_error;
	if ($state == "0") {
		$state_error = "Please choose the critera of overview!";
		$_SESSION ["state_error"] = $state_error;
		return false;
	} else {
		$state_error = "";
		$_SESSION ["state_error"] = $state_error;
		return true;
	}
}

// refresh page
function pageRefresh() {
	echo "<script type='text/javascript'> document.location.href='HomePage.php'</script>";
}
?>