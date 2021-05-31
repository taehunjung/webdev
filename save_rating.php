<?php

$link = mysqli_connect('localhost','root','','rateMyCourses');

if (!$link->connect_error) {
    echo "connection successful";
  } else {
    echo $link->connect_error;
  }

$Coursecode = $_POST['coursecode'];
$Difficultylevel= $_POST['difficultylevel'];
$Applicabilitylevel = $_POST['applicabilitylevel'];
$ProfRec = $_POST['prof_rec'];
$Textbookuse = $_POST['textbookuse'];
$Attendance = $_POST['attendance'];
$Credit = $_POST['credit'];
$Comments = $_POST['comments'];


$sql = "INSERT INTO userratingform (Coursecode, Difficultylevel, Applicabilitylevel, ProfessorRecommendation, Textbookuse, Attendance, Credit, Extracomments, Currtime) VALUES('".$Coursecode."', '".$Difficultylevel."', '".$Applicabilitylevel."', '".$ProfRec."', '".$Textbookuse."','".$Attendance."','".$Credit."','".$Comments."', NOW())";

/*
mysqli_query($link, $q);
*/

if(!mysqli_query($link, $sql))
{
  
  echo '<script>alert("Unexpected Error Occurred!")</script>';
  echo "<script>setTimeout(\"location.href = 'ratingdisplaypage.php?course_name=$Coursecode';\",200);</script>";
}
else{
    echo '<script>alert("Thank you for your review!")</script>';
    echo "<script>setTimeout(\"location.href = 'ratingdisplaypage.php?course_name=$Coursecode';\",200);</script>";
}

/*
header("location:ratingdisplaypage.php?course_name=$Coursecode");
*/

?>
