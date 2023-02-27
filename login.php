<?php

$conn=mysqli_connect("localhost", "root", "") or die("Cannot connect to server");
mysqli_select_db($conn, "examdb") or die("Cannot find db");

session_start();
if(isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "select * from client where username='" . $username . "' and password='" .md5($password). "'";
    $result=mysqli_query($conn, $query);

    $num=mysqli_num_rows($result);

    if ($num==1)
    {
        $row=mysqli_fetch_array($result);
        $id=$row[0];
        $_SESSION["username"]=$username;
        header("Location: dashboard.php");
    }
    else 
        echo "Not correct";

}


?>



<html>
    <head>

    </head>
    <body>
        <h1> Enter your account to login </h1>
        <form method="post">
            <table>
                <tr>
                    <td> Username: </td>
                    <td> <input type="text" size="40" name="username"> </td>
                </tr>
                <tr>
                    <td> Password: </td>
                    <td> <input type="text" size="40" name="password"> </td>
                </tr>
            </table>
            <input type="submit" value="Login" name="login">
            <br>
            <a href="register.php"> Click to Register </a>
        </form>
    </body>
</html>