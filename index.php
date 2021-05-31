

<!DOCTYPE html>
<html> 
    
    <head>
         <link rel="stylesheet" href="styles.css">
         <script src="https://kit.fontawesome.com/d8a9836ca0.js" crossorigin="anonymous"></script>>
         <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
         <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
        
         <script src="passingsearchdata.js"> </script>
    </head>

    <body>
        <header>
        <meta http-equiv="refresh" content="900;url=signout.php" />
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
        
            <div class="wrapper">
                <div class="deco-text">
                    <h1> Find a <strong>course</strong> at <strong> McGill University </strong> </h1>
                </div>
                
            <form action="ratingdisplaypage.php" method="GET" id="searchform">
                <div class="search-input">

                    <input class="searchinput" name="course_name" id="Course_name" type="text" placeholder="Course code"/>
        
                    <div class="icon"> <i class="fa fa-search fa-lg" onclick="handleSearch()"></i> </div>
                </div>
            </form>

                <div class="deco-text2">
                    <h1> Tired of going through <strong>reddit page</strong> for <strong>course information?</strong>  </h1>
                </div>
            </div>

            <!--
                <script src="autocomplete.js"> </script>
                $(function() {
                var courseCode=["COMP202", "COMP206", "COMP250", "COMP251", "COMP303"];
                $( "#Course_name").autocomplete({  
                    source: courseCode
                });
            });
            
            -->
    
            <script type="text/javascript">
            /*
            $(function() {
                //var courseCode=["COMP202", "COMP206", "COMP250", "COMP251", "COMP273", "COMP303"];
                $( "#Course_name").autocomplete({  
                    source: 'courselist.txt',
                    minLength: 3
                });
            });
            */
                    $( function(){
                        $.get('courselist.txt', function(data) {
                            var allCourses = data.split(', ');
                            $( "#Course_name" ).autocomplete({
                                source: allCourses,
                                minLength: 4
                        });
                    });
            });
 
            /*
            $(document).ready(function(){
                const signoutbutton = document.querySelector("#signoutbtn");
                    $(".login").on("click", function(){
                        signoutbutton.classList.remove("form--hidden");
                    });
            });
            */
                
           
             </script>
          
            
         <!--<script src="main.js"> </script>-->
         </header>

         <section class="features"> 
             <div class="features">
             <figure name="editing">
                <!--<img src="Images/editing.jpg" alt="Editing reviews">-->
                <figcaption> Manage and edit your <strong>ratings </strong></figcaption>
             </figure>

             <figure name="anonymous">
                <!--<img src="Images/anonymous.jpg" alt="Anonymous reviews">-->
                <figcaption> All ratings stay <strong>anonymous</strong> </figcaption>
             </figure>
             
             <figure name="thumbsup">
               <!--<img src="Images/thumbsup.jpg" alt="Thumbsup">-->
                <figcaption> <strong> Thumbs up or down </strong> ratings  </figcaption>
             </figure>
            </div>
         </section>

         
         <footer> 
             <h1> 845 Sherbrooke st. Ouest, Montreal, QC </h1> 
         </footer>

         
        </body>
</html>