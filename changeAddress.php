<?php
include("user_secure.php");
?>
<html>
    <head>
        <title> Medicine Shopping - Address </title>
        <style>
            .header 
            {
                overflow: hidden;
                background-color: #f1f1f1;
                padding: 20px 10px;
            }
            .header a 
            {
                font-family: Georgia, 'Times New Roman', Times, serif;
                float: left;
                color: black;
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
                color: black;
            }
            .header a.active 
            {
                background-color: dodgerblue;
                color: white;
            }
            .column 
            {
                float:none;
            }            
            .middle 
            {
                width: 100%;
            }
            .row:after 
            {
                content: "";
                display: table;
                clear: both;
            }
            
            td
            {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }
            select
            {
                width: 100%;
            }
            f2
            {
                font-weight: bold;
                font-size: 16;
            }
            f3
            {
                font-size: 12;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <a href="1 home.php" class="logo"><img src="Images/logo.jpeg" width="60"></a>
        </div> 
        <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["sub"]=="update"){
            include('Conn.php');
            // session_start();
            $uname=$_SESSION['uname'];
            $address="Pin:".$_POST['pin']." House no:".$_POST['house']." Area:".$_POST['area']." Landmark:".$_POST['landmark']." City:".$_POST['city']." State:".$_POST['state']." Addtype:".$_POST['addtype'];

            $sql = "UPDATE orders SET location='".$address."'where uname='".$uname."' and date='".date('Y-m-d')."'";

            $result=mysqli_query($con,$sql);
            if($result){
                header('location:billing.php');
            }
            else{
                die(mysqli_error($con));
            }

            }
        ?>
        <div class="row">
            <div class="column middle">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <center><table>
                    <tr><td> <f2> PIN Code </f2></td></tr>
                    <tr><td><input type="text" name="pin" size="55"></td></tr>
                    <tr><td> <f2> House no, Building, Company, Apartment </f2></td></tr>
                    <tr><td><input type="text" name="house" size="55"></td></tr>
                    <tr><td> <f2> Area, Colony, Street, Sector, Village </f2></td></tr>
                    <tr><td><input type="text" name="area" size="55"></td></tr>
                    <tr><td> <f2> Landmark </f2></td></tr>
                    <tr><td><input type="text" name="landmark" size="55" placeholder="E.g near PVR Cinemas, near High Court"></td></tr>
                    <tr><td> <f2> Town/City </f2></td></tr>
                    <tr><td><input type="text" name="city" size="55"></td></tr>
                    <tr><td> <f2>State</f2> </td></tr>
                    <tr><td><select name="state">
                        <option> --Select state--
                        <option> Andhra Pradesh
                        <option> Arunachal Pradesh
                        <option> Assam
                        <option> Bihar
                        <option> Chhatisgarh
                        <option> Goa
                        <option> Gujarat
                        <option> Haryana
                        <option> Himachal Pradesh
                        <option> Jharkhand
                        <option> Karnataka
                        <option> Kerala
                        <option> Madhya Pradesh
                        <option> Maharashtra
                        <option> Manipur
                        <option> Meghalaya
                        <option> Mizoram
                        <option> Nagaland
                        <option> Odisha
                        <option> Punjab
                        <option> Rajasthan
                        <option> Sikkim
                        <option> Tamil Nadu
                        <option> Telangana
                        <option> Tripura
                        <option> Uttar Pradesh
                        <option> Uttarkhand
                        <option> West Bengal
                    </select></td></tr>
                    <tr><td> <f2> Add delivery instructions </f2></td></tr>
                    <tr><td> <f3> Preferences are used to plan your delivery. However, shipments can sometimes<br>
                        arrive early or later than planned. </f3></td></tr>
                    <tr><td><select name="addtype">
                        <option> --Select an address type --
                        <option> Home (7am - 9pm delivery)
                        <option> Office/Commercial (10am - 6pm delivery)
                    </select></td></tr>
                    <tr><td><center><button type="submit" name="sub" value="update"> Update </button></center></td></tr>
                </table></center></form>
            </div>
        </div>
    </body>
</html>
