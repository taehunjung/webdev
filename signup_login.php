<?php 
    //this is to see the details as to where the error occurred. 
    /*
    ini_set("display_errors",1); error_reporting(E_ALL);
    */

    SESSION_START();

    include("signup_function.php");
    include("autologout.php");

    $con = mysqli_connect('localhost', 'root', '', 'rateMyCourses');
    
    if($_SERVER['REQUEST_METHOD']=="POST") 
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $securedpassword = password_hash($password, PASSWORD_BCRYPT);
        
        //check if the provided username by the client is usable in databse. 
        if(!empty($user_name)&&!empty($password)) {
            $query1 = "SELECT * FROM user_info WHERE user_name='$user_name'";
            $result = mysqli_query($con, $query1);
            $rownum = mysqli_num_rows($result);
            if($rownum==0) {
                //$securedpassword = password_hash($password, PASSWORD_BCRYPT);
                $user_id = random_num(5);
                $query = "INSERT INTO user_info (user_id, user_name, password) values ('$user_id', '$user_name', '$securedpassword')";
                mysqli_query($con, $query);
            } else {
                //signupformreload();
                echo "<script>alert('The username is already taken. Choose a different username.');document.location='signup_login.php'</script>";
                exit();
            }
            
        }
        
        
        
        if(!empty($_POST['username']) && !empty($_POST['passw'])){

            $username= mysqli_real_escape_string($con, $_POST['username']);
            $pw=mysqli_real_escape_string($con, $_POST['passw']);
            $securedpw=password_hash($_POST['passw'], PASSWORD_BCRYPT);
           
            $query2 = "SELECT * FROM user_info WHERE user_name='$username'";
            $result2 = mysqli_query($con, $query2);
            $arr = mysqli_fetch_array($result2);
            $row = mysqli_num_rows($result2);
            

            if($row==1 && password_verify($_POST['passw'], $securedpw) ){
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $arr['user_id'];
                $_SESSION["user"] = $arr['user_name'];
                function_alert("Successful Login!");
                header('location:index.php');
            } else{
                function_alert("Wrong login information!");
            }
            //mysqli_close($con);
        }
    }
    
    
    if(isset($_SESSION["id"])){
        header('location:index.php');
    }

    function function_alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    
?>

<!DOCTYPE html>
<html> 
    
    <head>
         <link rel="stylesheet" href="login_page_style.css">
         <script src="https://kit.fontawesome.com/d8a9836ca0.js" crossorigin="anonymous"></script>>
         <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
         <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
          <script type="text/javascript" src="signup_login.js"></script>
    </head>

    <body>
        <header>
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
        </header>
        <div class="login_wrapper">
            <div class="container">
                <form class="form" id="login" method="post">
                    <h1 class="form__title">Login</h1>
                    <div class="form__message form__message--error"></div>
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="username" autofocus placeholder="Username or email" autocomplete="on">
                        <div class="form__input-error-message"></div>
                    </div>
                    <div class="form__input-group">
                        <input type="password" class="form__input" name="passw" autofocus placeholder="Password" autocomplete="on">
                        <div class="form__input-error-message"></div>
                    </div>
                    <button class="form__button" type="submit">Continue</button>

                    <p class="form__text">
                        <a href="#" class="form__link">Forgot your password?</a>
                    </p>
                    <p class="form__text">
                        <a class="form__link" id="linkCreateAccount">Don't have an account? Create account</a>
                    </p>
                </form>
    
                <form class="form form--hidden" id="createAccount" method="post">
                    <h1 class="form__title">Create Account</h1>
                    <div class="form__message form__message--error"></div>
                    <div class="form__input-group">
                        <input type="text" id="signupUsername" class="form__input" name="user_name" autofocus placeholder="Username" autocomplete="on">
                        <div class="form__input-error-message"></div>
                    </div>
                    <div class="form__input-group">
                        <input type="password" class="form__input" name="password" autofocus placeholder="Password" autocomplete="on">
                        <div class="form__input-error-message"></div>
                    </div>
                    <div class="form__input-group">
                        <input type="password" class="form__input" autofocus placeholder="Confirm password" autocomplete="on">
                        <div class="form__input-error-message"></div>
                    </div>
                    <button class="form__button" type="submit">Continue</button>
                    <p class="form__text">
                        <a class="form__link" id="linkLogin">Already have an account? Sign in</a>
                    </p>
                </form>
            </div>

            <script src="signup_login.js"> </script>

        </div>
        

    </body>

</html>
