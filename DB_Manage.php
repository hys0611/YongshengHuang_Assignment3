<?php
/**
 * DB_Manage.php
 * @author Yongsheng Huang
 * version 27/11/2016
 */

// connect to MySQL
function connectMysql() {
	$con = mysql_connect ( "localhost", "root", "" );
	if ($con) {
// 		echo "Connect mysql sucessfully! ";
		return true;
	} else {
		die ( 'Could not connect mysql:' . mysql_error () );
		return false;
	}
}

// close MySQL
function closeMysql() {
	mysql_close ( mysql_connect ( "localhost", "root", "" ) );
	echo "Close MySQL! ";
	return true;
}

// create a database db_book
function createDB() {
	$con = mysql_connect ( "localhost", "root", "" );
	if (mysql_query ( "CREATE DATABASE db_book", $con )) {
// 		echo "Database created! ";
		return true;
	} else {
// 		echo "Database existed! ";
		return false;
	}
}

// create table in datebase td_book
function createTable() {
	$con = mysql_connect ( "localhost", "root", "" );
	if (mysql_select_db ( "db_book", $con )) {
		$sql_creat_table = "CREATE TABLE tb_book
    (   
        title varchar(60),
        author varchar(30),
		rating int,
		comment  text,
		status enum('buy','read','finished')
    )";
		if (mysql_query ( $sql_creat_table, $con )) {
// 			echo "Table tb_book create successfully! ";
			return true;
		} else {
// 			echo "Table tb_book exists! ";
			return false;
		}
	} else {
// 		echo "Fail to connect the database db_book!";
		return false;
	}
}

// insert some initial data in the table tb_book
function initialInfo() {
	$con = mysql_connect ( "localhost", "root", "" );
	if (mysql_select_db ( "db_book", $con )) {
		$sql1 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('Infomation System', 'Hereen', '4' ,'Interesting','read')";
		$sql2 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('IP', 'Hanesova', '5' ,'Sehr Gut','read')";
		$sql3 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('Compilers', 'Harder', '3' ,'Good','buy')";
		$sql4 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('Computer Network', 'Hanemann', '1' ,'Difficult','finished')";
		$sql5 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('AI', 'Langheld', '4' ,'Interesting','read')";
		$sql6 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('PjMg', 'Landich', '4' ,'Interesting','read')";
		$sql7 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('SoftwareI', 'Hanesova', '4' ,'Great','finished')";
		$sql8 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('Scientific Writing', 'Monica', '3' ,'Good','buy')";
		$sql9 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('Network Security', 'Hanemann', '3' ,'Difficult','read')";
		$sql10 = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('AI II', 'Langheld', '2' ,'Not bad','read')";
		mysql_query ( $sql1 );
		mysql_query ( $sql2 );
		mysql_query ( $sql3 );
		mysql_query ( $sql4 );
		mysql_query ( $sql5 );
		mysql_query ( $sql6 );
		mysql_query ( $sql7 );
		mysql_query ( $sql8 );
		mysql_query ( $sql9 );
		mysql_query ( $sql10 );
	}
}
// add a book in the table db_book
function bookAdd($book) {
	$title = $book->getTitle ();
	$author = $book->getAuthor ();
	$rating = $book->getRating ();
	$comment = $book->getComment ();
	$status = $book->getStatus ();
	mysql_select_db ( "db_book" );
	$sql = "INSERT INTO tb_book (title, author, rating,comment,status) VALUES ('$title', '$author', '$rating' ,'$comment','$status')";
	if (mysql_query ( $sql )) {
// 		echo "Insert succefully!";
		return true;
	} else {
// 		echo "Fail to insert!";
		return false;
	}
}
?>