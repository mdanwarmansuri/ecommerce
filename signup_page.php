    <?php
    include('Conn.php');
    $name = $_REQUEST["name"];
    $uname = $_REQUEST["username"];
    $mobile = $_REQUEST["mobile"];
    $password = $_REQUEST["password"];
    $cp = $_REQUEST["password1"];
    $name=htmlspecialchars($name);
    $uname=htmlspecialchars($uname);
    $mobile=htmlspecialchars($mobile);
    $password=htmlspecialchars($password);
    $cp=htmlspecialchars($cp);
    $name = mysqli_real_escape_string($con, $name);
    $uname = mysqli_real_escape_string($con, $uname);
    $mobile = mysqli_real_escape_string($con, $mobile);
    $password= mysqli_real_escape_string($con, $password);
    $cp= mysqli_real_escape_string($con, $cp);

    $enter = 0;

    $sql = "select * from user_data where username='$uname'";
    $result = $con -> query($sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num > 0){
            echo "<center><h1 style = 'color:red;'> User already exist, you can sign in </h1></center>";
            include("3 signin.php");
        }
        else{
            if(strlen($mobile) < 10){
                echo "<center><h3 style = 'color:red;'> Enter a valid mobile number </h3></center>";
                include("2 signup.php");
                return false;
            }
            if($password === $cp){
                if(strlen($password) >= 8){
                    $hashedpass=password_hash($password, PASSWORD_DEFAULT);
                    $stmt = "insert into user_data (name, username, mobile, password) values ('$name', '$uname', '$mobile', '$hashedpass')";
                    $res = $con -> query($stmt);
                    if($res){
                        session_start();
                        $_SESSION['uname']=$uname;
                        $_SESSION['role']='user';
                        header('location:5 address.php');
                        error_reporting(E_ERROR | E_PARSE);
                    }
                    else{
                        die(mysqli_error($con));
                    }
                }
                else{
                    echo "<center><h3 style = 'color:red;'> Length of the password must be greater than 8 </h3></center>";
                    include("2 signup.php");
                }
            } 
            else{
                echo "<center><h3 style = 'color:red;'> Passowrds doesn't match </h3></center>";
                include("2 signup.php");
            }           
        }
    }
?>