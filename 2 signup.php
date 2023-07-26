<?php
session_start();
if(isset($_SESSION['uname']))
session_destroy();
?>
<html>
    <head>
        <title> Online Shopping - Sign up </title>
        <style>
            .header{
                overflow: hidden;
                padding: 20px 10px;
            }
            .header a{
                font-family: Georgia, 'Times New Roman', Times, serif;
                float: left;
                color: black;
                text-align: center;
                padding: 12px 12px;
                text-decoration: none;
                font-size: 18px;
                line-height: 25px;
                border-radius: 4px;
            } 
            .header a:hover{
                background-color: #ddd;
                color: black;
            }
            .header a.active{
                background-color: dodgerblue;
                color: white;
            }             
            td{
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }  
            table{
                margin-top: 10%;
                margin-left: auto;
                margin-right: auto;          
                /* background-color */
                border:2px solid #ccc;
                width: 50%;
                padding: 20px;
            }  
            #submit{
                width: 30%;
            }
            input{width: 100%; padding: 6px;}            
            input[type = submit] {cursor: pointer;}
        </style>
    </head>
    <body background="Images/signup-page.jpg" style="background-repeat: no-repeat; background-size: cover;">
        <div class="header">
            <a href="index.php" class="logo"><img src="Images/logo.jpeg" width="60"></a>
            <div>
                <a href="index.php"> Home </a>
                <a class="active" href="2 signup.php"> Sign up </a>
                <a href="6 contact.php"> Contact </a>
                <a href="7 about.php"> About </a>
            </div>
        </div>
        <table>
            <form method="post" action="signup_page.php">
                <tr><td> Enter your name  </td></tr>
                <tr><td><input type="text" name="name" ></td></tr>
                <tr><td> Enter a username  </td></tr>
                <tr><td><input type="text" name="username"
                    pattern="/^[a-zA-Z0-9!@_#=+-]{8, 16}$/g" ></td></tr>
                <tr><td> Enter your Mobile number </td></tr>
                <tr><td><input type="text" name="mobile"></td></tr>
                <tr><td> Enter a password </td></tr>
                <tr><td><input type="password" name="password"></td></tr>
                <tr><td> Confirm your password </td></tr>
                <tr><td><input type="password" name="password1"></td></tr>
                
                <tr><td colspan="2"><center><input type="submit" id="submit" value="Next"></center></td></tr>
                <tr><td><center>Already have an account?</center></td></tr>
                <tr><td><center><a href="3 signin.php"> Sign in </a></center></td></tr>
            </form>
        </table>
    </body>
</html>
