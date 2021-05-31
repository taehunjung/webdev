<?php
    include('ratingdisplayserver.php'); 
    include('autologout.php');
?>

<html> 
    <head>
         <title> RatemyCourses </title>
         <link rel="stylesheet" href="styles.css">
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Vollkorn">
    </head>

    <body>
         <header id="ratingdisplaypageheader">
            <nav>
                <ul>
                    <div class="top-bar">
                        <div class="logo">
                            <img src="Images/Original.png"> 
                        </div>
                        <nav class="navbar">
                            <ul class="menu">
                                        <?php
                                $started = session_start();
                                if ($started && !empty($_SESSION['id'])){
                                ?>
                                    <li> <a href="index.php"> Home </a> </li> 
                                    <li > <a class="signout" href="signout.php" id="signoutbtn"> Signout </a> </li>
                                <?php
                                } else{
                                ?>
                                    <li> <a href="index.php"> Home </a> </li> 
                                    <li> <a class="login" href="signup_login.php" id="loginbtn"> Login / Signup </a> </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </ul>
            </nav>


        
        
            <div class=ratinglist>
                <div class=ratingdetails>

                        <div class="toppartdetails"> 
                        
                        <h1 id="toph1"> Course: </h1>
                        <h2 id="courseName">
                        <!--Coursename: <span id="course_code"> </span> -->
                        <p> <?php echo strtoupper($_GET['course_name']); ?> </p>
                        </h2>

                        <!-- this line of code is to redirect user to leave comment if there is no review
                        
                       
                         $connection = mysqli_connect('localhost', 'root', '', 'rateMyCourses');
                            $val = $_GET['course_name'];
                            $query = $mysqli_query($connection, "SELECT * FROM `userratingform` WHERE `Coursecode`='$val'");
                            if(mysqli_num_rows($query)==0){
                                echo "<script type='text/javascript'> alert('There is no available rating for $val. Be the first one to leave us a rating :)'); </script>";
                                echo "<script>setTimeout(\"location.href = 'ratingforms.php';\",500);</script>";
                            }
                        
                        -->

                        <h1> Level of Difficulty: </h1>
                        <h2 id="difficulty">
                        <?php 
                            $connection = mysqli_connect('localhost', 'root', '', 'rateMyCourses');
                            $val = $_GET['course_name'];
                            $query1=mysqli_query($connection, "SELECT ROUND(AVG(`Difficultylevel`),2) AS 'avg_difficulty' FROM `userratingform` WHERE `Coursecode`='$val'");
                            $result1=mysqli_fetch_assoc($query1);
                            echo $result1['avg_difficulty']; echo "/5";
                            $_SESSION["coursename"] = $val;
                            ?>  
                        </h2>

                        <h1> Level of Practicality: </h1>
                        <h2 id="practicality">
                        <?php
                            $query3=mysqli_query($connection, "SELECT ROUND(AVG(`Applicabilitylevel`),2) AS 'avg_applicability' FROM `userratingform` WHERE `Coursecode`='$val'");
                            $result3=mysqli_fetch_assoc($query3);
                            echo $result3['avg_applicability']; echo "/5"?>
                        </h2>

                        <h1> Professor Recommendation: </h1>
                        <h2 id="profrec">
                            <?php 
                                $query4=mysqli_query($connection, "SELECT  `ProfessorRecommendation`,
                                    COUNT(`ProfessorRecommendation`) AS `value_occurrence` 
                                    FROM     `userratingform`
                                    WHERE `Coursecode`='$val'
                                    GROUP BY `ProfessorRecommendation`
                                    ORDER BY `value_occurrence` DESC
                                    LIMIT    1");
                                if(mysqli_num_rows($query4)>0){
                                    $result4=mysqli_fetch_assoc($query4);
                                    echo $result4['ProfessorRecommendation']; 
                                }
                            ?>
                        </h2>

                        <p>
                            <form action="ratingforms.php">
                            <input type="submit" class="ratemycoursebutton" value="Rate this course"> </input>
                            </form>
                        </p>


                        </div>
                        
                        <div class="topcomment"> 

    
                            <div class="topcommentsubsect"> 

                            <p>

                            <div class="topcommentstyle"> 
                                <h4 id='topcommenttitle'>
                                    <i class="fa fa-thumbs-o-up" style="font-size:25px"></i>
                                    Most Helpful Rating: <?php echo strtoupper($_GET['course_name']);?>
                                </h>
                            </div>
                            
                            <?php
                                $connection = mysqli_connect('localhost', 'root', '', 'rateMyCourses');
                                $query7=mysqli_query($connection, "SELECT  `post_id`,
                                    COUNT(`post_id`) AS `value_occurrence` 
                                    FROM     `post_liking`
                                    WHERE `course_code`='$val'
                                    GROUP BY `post_id`
                                    ORDER BY `value_occurrence` DESC
                                    LIMIT    1");
                                if(mysqli_num_rows($query7)>0){
                                    $result1=mysqli_fetch_assoc($query7);
                                    $mostliked_postid = $result1['post_id'];
                                    $query6=mysqli_query($connection, "SELECT * FROM `userratingform` WHERE `Coursecode`='$val' AND `id`='$mostliked_postid'");
                                    $result=mysqli_fetch_assoc($query6);
                                    ?>
                                    <h4 id="timestamp"> <?php echo $result['Currtime']; ?> </h4>
                                    <p> For Credit: <?php echo "<b>".$result['Credit']."</b>" ?> &nbsp &nbsp Attendance: <?php  echo  "<b>" .$result['Attendance']. "</b>";?> &nbsp &nbsp Textbook use: <?php echo "<b> ".$result['Textbookuse']."</b>"?> </p>
                                    <p> <?php echo $result['Extracomments'];?> </p>
                                    <?php

                                } 
                            ?>
                            </p>    

                            </div>

                        </div>
                        
                
                    </div>
                    

                    <div class="extracomment">
                        <div class="ratingtitle">
                        <p>
                        <h1 id="rating_title"> 
                        <?php 
                            $connection = mysqli_connect('localhost', 'root', '', 'rateMyCourses');
                            $query6=mysqli_query($connection, "SELECT * FROM `userratingform` WHERE `Coursecode`='$val'");
                            $result=mysqli_num_rows($query6);
                            echo $result;
                        ?>
                        Student Ratings: 
                        </h1>
                        </p>   
                        </div>

                        <?php 
                            $connection = mysqli_connect('localhost', 'root', '', 'rateMyCourses');
                            $query5 = mysqli_query($connection, "SELECT * FROM `userratingform` WHERE `Coursecode`='$val' AND `Extracomments`!=''");

                            if(mysqli_num_rows($query5)>0) {
                                while($row=mysqli_fetch_assoc($query5)){
                                ?>
                                    
                                    <div class="post" id="singleitem"> 
                                    
                                        <h4 id="timestamp"> <?php echo $row['Currtime']; ?> </h4>
                                        <p> For Credit: <?php echo "<b>".$row['Credit']."</b>" ?> &nbsp &nbsp Attendance: <?php  echo  "<b>" .$row['Attendance']. "</b>";?> &nbsp &nbsp Textbook use: <?php echo "<b> ".$row['Textbookuse']."</b>" ?> </p>
                                        <p> <?php echo $row['Extracomments'];?> </p>

                                        <div class="thumbs rating"> 
                                            
                                            <i <?php if (userLiked($row['id'])): ?>
                                                class="fa fa-thumbs-up like-btn" style="font-size:24px"
                                               <?php else: ?>
                                                class="fa fa-thumbs-o-up like-btn" style="font-size:24px"
                                                <?php endif ?>
      	                                        data-id="<?php echo $row['id'] ?>"></i>
                                            
                                            <span class="likes"> <?php echo getLikes($row['id']); ?> </span>
                                                
                                            &nbsp; &nbsp; &nbsp; &nbsp;
                                            
                                            <i 
                                                <?php if (userDisliked($row['id'])): ?>
                                                    class="fa fa-thumbs-down dislike-btn" style="font-size:24px"
                                                <?php else: ?>
                                                    class="fa fa-thumbs-o-down dislike-btn" style="font-size:24px"
                                                <?php endif ?>
      	                                            data-id="<?php echo $row['id'] ?>"></i>
                                                <span class="dislikes"><?php echo getDislikes($row['id']); ?></span>
                                        
                                            
                                        </div>
                                        
                                    </div>
                                <?php
                                }
                            
                            }
                        ?> 
                      
                    </div>
                    <script src="thumbsupdown.js"> </script>
                </div>
                
            </div>

            <?php
             mysqli_close($connection);
            ?>

        
        </header>   
    </body>
    

</html>

