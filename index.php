<?php
include './connection.php';
if(isset($_POST['sub']))
{
    $un=$_POST['un'];
    $pwd=$_POST['pwd'];
    $chk_log=mysqli_query($dbcon,"select * from user_log where uid='$un' and pwd='$pwd'");
    if(mysqli_num_rows($chk_log)>0)
    {
        $rlog=  mysqli_fetch_row($chk_log);
        session_start();
        if($rlog[3]=="admin")
        {
            $_SESSION['adm']=$un;
            header("location:admin/index.php");
        }       
        if($rlog[3]=="STAF")
        {
            $_SESSION['stf']=$un;
            if($pwd=="christ")
            {
                header("location:changepas.php");
            }
            else
            {
                header("location:staff/index.php");
            }
        }
        if($rlog[3]=="stud")
        {
            $_SESSION['stud']=$un;
            if($pwd=="student")
            {
                header("location:changepas2.php");
            }
            else
            {
            header("location:student/index.php");
            }
        }
        if($rlog[3]=="TSTAF")
        {
            $_SESSION['tchr']=$un;            
            if($pwd=="christ")
            {
                header("location:changepas1.php");
            }
            else
            {
            header("location:teacher/index.php");
            }
        }
        
    }
    else
    {
        header("location:index.php?error=1");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="style.css">
    <title>LOGIN PAGE | UIT</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body{
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container{
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button{
    background-color: #438eb9;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input{
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in{
    transform: translateX(100%);
}

.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
    transition: all 0.5s;
}

.container.active .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}

.social-icons{
    margin: 20px 0;
}

.social-icons a{
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
    transition: all 0.5s;
}

.social-icons a:hover{
    scale: 1.3;
    border: 1px solid #000;
}

.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle{
    background-color: #438eb9;
    height: 100%;
   
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle{
    transform: translateX(50%);
}

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left{
    transform: translateX(-200%);
}

.container.active .toggle-left{
    transform: translateX(0);
}

.toggle-right{
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right{
    transform: translateX(200%);
}
    </style>
</head>

<body>

    <div class="container" id="container">
    
        <div class="form-container sign-up">
            <form method="post">
                <h1>Faculty Login</h1>
                
                <span>Login With user Name And Password</span>
                <input type="text" placeholder="username" name="un">
                <input type="password" placeholder="Password" name="pwd">
                <button name="sub" value="LOGIN HERE">Login</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post">
                <h1> Login</h1>
                <?php
                            if(isset($_GET['ch']))
                            {
                                echo"<font color='green'>Password changed successfully... continue login</font>";
                            }
                          

                             if(isset($_GET['error']))
                            {
                                echo"<font color='red'>Invalid User Credentials</font>";
                            }
                            ?>
                <span>Login With Username And Password</span>
                <input type="text" placeholder="username" name="un">
                <input type="password" placeholder="Password" name="pwd">
                <a href="#">→ Forget Your Password? ←</a>
                <button name="sub" value="LOGIN HERE">Login</button>

            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Students Login</h1>
                    <p>Login as Student</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                  <h2>Exam Manager</h2>
            </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="template/js/jquery-2.1.4.min.js"></script>
	<!-- bootstrap -->
	<script src="template/js/bootstrap.js"></script>
	<!-- stats numscroller-js-file -->
	<script src="template/js/numscroller-1.0.js"></script>

    <script src="template/js/jquery.flexisel.js"></script>
	<!-- //Flexslider-js for-testimonials -->
	<!-- smooth scrolling -->
	<script src="template/js/SmoothScroll.min.js"></script>
	<script src="template/js/move-top.js"></script>
	<script src="template/js/easing.js"></script>
</body>

</html>