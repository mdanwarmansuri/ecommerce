<?php
session_start();
if(isset($_SESSION['uname']))
session_destroy();
?>
<html>
    <head>
        <title> Online Shopping - Sign in </title>        
        <style>
            .header 
            {
                overflow: hidden;
                padding: 20px 10px;
            }
            .header a 
            {
                font-family: Georgia, 'Times New Roman', Times, serif;
                float: left;
                color: white;
                text-align: center;
                padding: 12px;
                text-decoration: none;
                font-size: 18px;
                line-height: 25px;
                border-radius: 4px;
            }    
            .header a.logo 
            {
                font-size: 25px;
                font-weight: bold;
            }
            .header a:hover 
            {
                background-color: #ddd;
                color: rgb(0, 0, 0);
                color: p
            }
            .header a.active 
            {
                background-color: dodgerblue;
                color: white;
            }
            
            td
            {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-size: 18px;
            }
            input{width: 100%; padding: 6px;}
            input[type = submit] {cursor: pointer;}
            table{
                margin-left: auto;
                margin-right: auto;
                margin-top: 12%;                
                width: 40%;
                padding: 40px;
                color: white;
                border:2px solid #ccc;
                border-radius: 3px;
                /* background-color:; */
                /* color: navy;                 */
            }
            #submit{
                width: 25%;
                color:green;
                padding:2%;
                border-radius:4px;
                margin-top:2%;
            }
        </style>
    </head>
    <body background="Images/signin-page.avif" style="background-repeat: no-repeat; background-size: cover;">
        <div class="header">
            <a href="index.php" class="logo"><img src="Images/logo.jpeg" width="60"></a>
            <div>
                <a href="index.php"> Home </a>
                <a href="2 signup.php"> Sign up </a>
                <a class="active" href="3 signin.php"> Sign in </a>
                <a href="6 contact.php"> Contact </a>
                <a href="7 about.php"> About </a>
            </div>
        </div>
        <form method="post" action="signin_page.php">
            <div id="signup">
                <table>
                    <tr><td><p> Enter username</p></td></tr>
                    <tr><td><input type="text" name="username" pattern="/^[a-zA-Z0-9!@_#=+-]{8, 16}$/g" ></td></tr>
                    <tr><td><p> Enter password</p></td></tr>
                    <tr><td><input type="password" name="password"></td></tr>
                    <tr><td colspan="2"><center> <input type="submit" id="submit" value="Sign In"> </center></td></tr>
                </table>
                
            </div>
        </form>
    </body>
</html>
