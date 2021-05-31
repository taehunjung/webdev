<?php
$link = mysqli_connect("localhost","root","","php_specials");

$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];
$comment_date = date('Y-m-d H:i:s');

$q = "INSERT INTO comments (name,email,comment,comment_date) VALUES('".$name."','".$email."','".$comment."','".$comment_date."')";
mysqli_query($link,$q);

?>