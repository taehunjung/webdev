<?php
session_start();

if(!isset($_SESSION['id'])){
    //header("location:signup_login.php");
    echo "<script type='text/javascript'> alert('You need to sign in to leave us a rating'); </script>";
    echo "<script>setTimeout(\"location.href = 'signup_login.php';\",500);</script>";
}
?>

<!DOCTYPE html>
<html> 

    <head>
         <title> RatemyCourses </title>
         <link rel="stylesheet" href="styles.css">
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
         <header>
            <nav>
                <ul>
                    <div class="top-bar">
                        <div class="logo">
                            <img src="Images/Original.png"> 
                        </div>
                        <nav class="navbar">
                            <ul class="menu">
                                <li> <a href="index.php"> Home </a> </li>
                            </ul>
                        </nav>
                    </div>
                </ul>
            </nav>
            <div class="wrapper1">

            <div class=ratingform>
                <form action="save_rating.php" method="post" class="forms" id="myform"> 
                <p>
                        <div class=formtitle>
                        <h1> Rate your course for your peers! </h1>
                        </div>
                    </p>

                    <p>
                        <label id="coursecode">1. COURSE CODE: </label>
                        <input type="text" name="coursecode" placeholder="course code" required />
                    </p>
                    
                    <p>
                        <label id="difficultylevel">2. LEVEL OF DIFFICULTY: </label>
                        <input type="range" name="difficultylevel" id="slider" min="0" max="5" value="1"/>
                    </p>

                    <p>
                        <label id="applicability">3. LEVEL OF APPLICABILITY: </label>
                        <input type="range" name="applicabilitylevel" id="slider" min="0" max="5" value="1" />
                    </p>
                    
                    <p>
                        <label id="prof_rec">4. PROF RECOMMENDATION: </label>
                        <input type="text" name="prof_rec" placeholder="professor name" required />
                    </p>

                    <p>
                        <label id="textbook_use">5. TEXTBOOK USAGE: </label>
                        <input type="radio" name="textbookuse" value="yes"/> YES </input>
                        <input type="radio" name="textbookuse" value="no"/> UM, NO </input>
                        
                    </p>

                    <p>
                        <label id="attendace">6. ATTENDANCE: </label>
                        <input type="radio" name="attendance" value="mandatory"/> Expect to show up in class everyday </input>
                        <input type="radio" name="attendance" value="nonmandatory"/> No needa go to class </input>
                    </p>

                    <p>
                        <label id="credityesorno">7. TAKEN FOR CREDIT: </label>
                        <input type="radio" name="credit" value="yes"/> YES </input>
                        <input type="radio" name="credit" value="no"/> NO </input>
                        
                    </p>

                    <p>
                        <label name="specificmessage">8. HERE'S YOUR CHANCE TO BE SPECIFIC! </label>
                        <textarea id='comments' name="comments" maxlength="350" ></textarea>
                    </p>
                
                    <p>
                        <input type="submit" value="SUBMIT" id="submitbtn">
                    </p>
                
            </form>
            </div>

             </div>
        
    
        </header>
        </body>

        
</html>
<!--
<script type="text/javascript">
	function listRatings()
		{
			$.ajax({
				url:'rating_list.php',
				success:function(res){
					$('.wrapper1').html(res);
				}
			})
		}
	$(function(){
		listRatings();
		setInterval(function(){
			listRatings();
		},10000);
		$('.submit').click(function(){
			var coursecode= $('.coursecode').val();
            var difficultylevel = $('.difficultylevel').val();
            var applicabilitylevel = $('.applicabilitylevel').val();
			$.ajax({
				url:'save_rating.php',
				data: 'coursecode='+coursecode+'&difficultylevel'+difficultylevel+'&applicabilitylevel'+applicabilitylevel,
				type:'post',
				success:function()
				{
					alert("Your comment has been posted");
					listRatings();
				}
			})
		})
	})
</script>
-->

