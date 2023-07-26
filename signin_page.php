<?php
include("Conn.php");
$uname = $_POST["username"];
$password = $_POST["password"];

$uname = htmlspecialchars($uname);
$password = htmlspecialchars($password);
$uname = mysqli_real_escape_string($con, $uname);
$password = mysqli_real_escape_string($con, $password);
$sql = "select * from admin where uname='$uname'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["pass"])) {
        session_start();
        $_SESSION['uname'] = $uname;
        $_SESSION['role'] = "admin";
        header('location: admin_panel.php');
    }
} else {
    $stmt = "select * from user_data where username='$uname'";
    $query = mysqli_query($con, $stmt);

    if ($query) {
        echo "Hello";
        $num = mysqli_num_rows($query);
        if ($num > 0) {
            $row = $query->fetch_assoc();
            $uname_c = $row["username"];
            $password_c = $row["password"];
            if ($uname_c == $uname && password_verify($password, $password_c)) {
                session_start();
                $_SESSION['uname'] = $uname;
                $_SESSION['user'] = $row['name'];
                $_SESSION['mobile'] = $row['mobile'];
                $_SESSION['role'] = "user";
                header('location:4 order.php');
            } else {
                include("3 signin.php");
                echo "<center><h1 style = 'color:red;'> Incorrect credentials! </h1></center>";
            }
        } else {
            include("3 signin.php");
            echo "<center><h1 style = 'color:red;'> Incorrect credentials! </h1></center>";
        }
    } else {
        include("3 signin.php");
        echo "<center><h1 style = 'color:red;'> Incorrect credentials! </h1></center>";
    }
}
