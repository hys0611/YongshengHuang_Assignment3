<?php
/**
 * HomePage.php
 * @author Yongsheng Huang
 * version 27/11/2016
 */

// start the session
session_start ();

// include php files
include ("Book.php");
include ("DB_Manage.php");
include ("HomePageMethod.php");

// connect the Mysql
connectMysql ();
// create the database db_book if not existed
createDB ();
// create and initializ the table tb_book if not existed
if(createTable ()) {
	initialInfo();
}

// set the initial values of variables
if (isset ( $_SESSION ["title"] )) {
	$title = $_SESSION ["title"];
	$author = $_SESSION ["author"];
	$rating = $_SESSION ["rating"];
	$comment = $_SESSION ["comment"];
	$status = $_SESSION ["status"];
	$title_error = $_SESSION ["title_error"];
	$author_error = $_SESSION ["author_error"];
	$rating_error = $_SESSION ["rating_error"];
	$status_error = $_SESSION ["status_error"];
} else {
	$title = $author = $comment = "";
	$rating = $status = "0";
	$title_error = $author_error = $rating_error = $status_error = "";
}

// set the initial state
if (isset ( $_SESSION ["state"] )) {
	$state = $_SESSION ["state"];
	$reSubmit = $_SESSION ["reSubmit"];
	$state_error = $_SESSION ["state_error"];
} else {
	$reSubmit = "0";
	$state = "0";
	$state_error = "";
}
?>

<!doctype html>
<!-- HTML of literature manager -->
<html>
<head>
<meta charset="utf-8">
<title>Literature Manager</title>
<link rel="stylesheet" type="text/css" href="HomePage.css" />
<script>
//reset the form when click the cancle button
function formReset() {
    document.forms["form1"]["title"].value="";
    document.forms["form1"]["author"].value="";
    document.forms["form1"]["rating"].value="0";
    document.forms["form1"]["comment"].value="";
    document.forms["form1"]["status"].value="0";
}
</script>
</head>
<body>
 <?php
	// store the post values into session and validate the form and then add a book infomation into database
	if (isset ( $_POST ["add"] )) {
		$_SESSION ["title"] = $_POST ["title"];
		$_SESSION ["author"] = $_POST ["author"];
		$_SESSION ["rating"] = $_POST ["rating"];
		$_SESSION ["comment"] = $_POST ["comment"];
		$_SESSION ["status"] = $_POST ["status"];
		$book = new book ();
		$book->setTitle ( $_POST ["title"] );
		$book->setAuthor ( $_POST ["author"] );
		$book->setRating ( $_POST ["rating"] );
		$book->setComment ( $_POST ["comment"] );
		$book->setStatus ( $_POST ["status"] );
		if (validateForm1 ( $book )) {
			bookAdd ( $book );
			$_SESSION ["title"] = $_SESSION ["author"] = $_SESSION ["comment"] = "";
			$_SESSION ["rating"] = $_SESSION ["status"] = "0";
			echo '<script language="javascript">window.alert("You have successfully add a new!");</script>';
		}
		pageRefresh ();
	}
	?>
    <div id="div-title">
		<h1>Literature Manager</h1>
	</div>
	<div id="div-form1">
		<!-- Form to add new books -->
		<form action="" name="form1" method="post" id="form1">
			<h2>Book Infomation</h2>
			<br> <span class="span-head">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<input type="text" class="input-text" name="title"
				placeholder="Please add the title here"
				value="<?php echo $GLOBALS["title"];?>"> <span class="span-error"><?php echo $GLOBALS["title_error"]; ?></span><br>
			<br> <span class="span-head">&nbsp;&nbsp;&nbsp;&nbsp;Author:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<input class="input-text" type="text" name="author"
				placeholder="Please add author here"
				value="<?php echo $GLOBALS["author"];?>"> <span class="span-error"><?php echo $GLOBALS["author_error"]; ?></span><br>
			<br> <span class="span-head">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rating:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<select name="rating">
				<option value="0"
					<?php if($GLOBALS["rating"]=="0") { echo "selected";}?>>0</option>
				<option value="1"
					<?php if($GLOBALS["rating"]=="1") { echo "selected";}?>>1</option>
				<option value="2"
					<?php if($GLOBALS["rating"]=="2") { echo "selected";}?>>2</option>
				<option value="3"
					<?php if($GLOBALS["rating"]=="3") { echo "selected";}?>>3</option>
				<option value="4"
					<?php if($GLOBALS["rating"]=="4") { echo "selected";}?>>4</option>
				<option value="5"
					<?php if($GLOBALS["rating"]=="5") { echo "selected";}?>>5</option>
			</select> <span class="span-error"><?php echo $GLOBALS["rating_error"]; ?></span><br>
			<br> <span class="span-head">Comment:</span><br> <br>
			<textarea name="comment" id="textarea-comment"
				placeholder="Please add comment here"><?php echo $GLOBALS["comment"];?></textarea>
			<br> <br> <span class="span-head">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<select name="status">
				<option value="0"
					<?php if($GLOBALS["status"]=="0") { echo "selected";}?>>Please
					select status</option>
				<option value="1"
					<?php if($GLOBALS["status"]=="1") { echo "selected";}?>>buy</option>
				<option value="2"
					<?php if($GLOBALS["status"]=="2") { echo "selected";}?>>read</option>
				<option value="3"
					<?php if($GLOBALS["status"]=="3") { echo "selected";}?>>finished</option>
			</select> <span class="span-error"><?php echo $GLOBALS["status_error"]; ?></span><br>
			<br> <br> <br> <input type="button" value="Cancle" name="cancle"
				onClick="formReset();" id="button-cancle"> <input type="submit"
				value="Add" name="add" id="button-add">
		</form>
	</div>
	<br>
	<div id="div-form2">
		<!-- Form to show overview -->
		<form action="" name="form2" method="post">
			<span style="color: #000; font-size: 26px;">Overview:&nbsp;&nbsp;</span>
			<select name="state"
				style="height: 25px; width: 350px; border: #0CCAD3; background-color: #ECDFDF;">
				<option value="0"
					<?php if($GLOBALS["state"] =="0") { echo "selected";}?>>Please
					select a criteria of overview</option>
				<option value="1"
					<?php if($GLOBALS["state"] =="1") { echo "selected";}?>>Rating(DESC)</option>
				<option value="2"
					<?php if($GLOBALS["state"] =="2") { echo "selected";}?>>Title(ASC)</option>
				<option value="3"
					<?php if($GLOBALS["state"] =="3") { echo "selected";}?>>Author(ASC)</option>
				<option value="4"
					<?php if($GLOBALS["state"] =="4") { echo "selected";}?>>Buy(status)</option>
				<option value="5"
					<?php if($GLOBALS["state"] =="5") { echo "selected";}?>>Read(status)</option>
				<option value="6"
					<?php if($GLOBALS["state"] =="6") { echo "selected";}?>>Finished(status)</option>
			</select> <input name="display" type="submit" id="button-display"
				value="Display"><label style="color:#ccc">Hint: If the browser pop-up prompt window,please click the retry button to show results</label>
				 <span class="span-error"><?php echo $GLOBALS["state_error"]; ?></span>
		</form>
	</div>
	<div style="margin-left: 25%; width: 600px;">
		<?php
		if (isset ( $_POST ["display"] )) {
			$_SESSION ["state"] = $_POST ["state"];
			$GLOBALS ["state"] = $_POST ["state"];
			if (validateForm2 ( $GLOBALS ["state"] )) {
				display ();
			}
			if ($GLOBALS ["reSubmit"] == "0") {
				$_SESSION ["reSubmit"] = "1";
			} else {
				$_SESSION ["reSubmit"] = "0";
				echo "<script type='text/javascript'> document.location.reload();</script>";
			}
		}
		?>
	</div>
	<div
		style="margin-left: 25%; margin-top: 100px; width: 600px; height: 30px; clear: both;">
		<span style="padding-left: 150px;">Copyright &copy;2016, Yongsheng
			Huang</span>
	</div>
</body>
</html>