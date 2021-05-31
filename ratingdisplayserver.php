<?php

$conn = mysqli_connect('localhost', 'root', '','rateMyCourses');

if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error($conn));
    exit();
}

session_start();

/*
if(empty($_SESSION['id'])){
    if(isset($_POST['action'])) {
        //echo "You need to be logged-in to perform this action";
        //die();
        die(header("location:signup_login.php"));
    }
}*/
if(isset($_SESSION['id']) && $_SESSION['loggedin']==true){
    $curseshid = $_SESSION['id'];

    $sql = "SELECT * FROM user_info WHERE user_id=$curseshid";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_array($result);

    $user_id= $arr['user_id'] ;

    if(isset($_POST['action'])) {
        //if(isset($_SESSION['id']) && $_SESSION['loggedin']=true){
            $post_id = $_POST['post_id'];
            $action = $_POST['action'];

            /*
            $curseshid = $_SESSION['id'];

            $sql = "SELECT * FROM user_info WHERE user_id=$curseshid";
            $result = mysqli_query($conn, $sql);
            $arr = mysqli_fetch_array($result);

            $user_id= $arr['user_id'] ;
            */
            
            switch ($action) {
                case 'like':
                    $sql = "INSERT INTO rating_info (user_id, post_id, rating_action) VALUES ($user_id, $post_id, 'like')
                            ON DUPLICATE KEY UPDATE rating_action='like'";
                
                    $coursecode = mysqli_real_escape_string($conn, $_SESSION['coursename']);

                    $sql2 = "INSERT INTO post_liking (post_id, course_code) VALUES ('$post_id', '$coursecode')";
                    mysqli_query($conn, $sql2);

                break;
                
                case 'dislike':
                    $sql="INSERT INTO rating_info (user_id, post_id, rating_action) VALUES ($user_id, $post_id, 'dislike') 
                    ON DUPLICATE KEY UPDATE rating_action='dislike'";
                break;

                case 'unlike':
                    $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
                break;

                case 'undislike':
                    $sql="DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
                break;
                
                default:
                break;
            }

            mysqli_query($conn, $sql);
            echo getRating($post_id);
            exit(0);
        //}
    }   
} 
/*
else if(!isset($_SESSION['id'])){
    if(isset($_POST['action'])) {
        echo "You need to be logged-in to perform this action";
    }
}
*/


function getLikes($id) {
    global $conn;
    $sql = "SELECT COUNT(*) FROM rating_info 
            WHERE post_id = $id AND rating_action='like'";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE post_id = $id AND rating_action='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
		  			WHERE post_id = $id AND rating_action='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id)
{
  global $conn;
  //global $user_id;

  if(isset($_SESSION['id'])){
    $curseshid = $_SESSION['id'];
    $sql = "SELECT * FROM user_info WHERE user_id=$curseshid";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_array($result);
    $user_id= $arr['user_id'] ;

        $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
            AND post_id=$post_id AND rating_action='like'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return true;
        }else{
            return false;
        }
  }else{
    return false;
  }
  
  
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $conn;
  //global $user_id;
  if(isset($_SESSION['id'])){
    $curseshid = $_SESSION['id'];
    $sql = "SELECT * FROM user_info WHERE user_id=$curseshid";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_array($result);
    $user_id= $arr['user_id'] ;
    $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
  		  AND post_id=$post_id AND rating_action='dislike'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }else{
        return false;
    }
  }else{
    return false;
  }

  
}




