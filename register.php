<?php



$conn=mysqli_connect("localhost", "root", "") or die("Cannot connect to server");
mysqli_select_db($conn, "examdb") or die("Cannot find db");

session_start();

if(isset($_POST['username'])) {
    echo("Thanks for registering!");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    if($username && $password) {

        $query = "insert into client (username, password, email, phone, address)";
        $query .= " values ('".$username."', '".md5($password)."', '".$email."', ".$phone.", '" .$address. "')";

        $result=mysqli_query($conn, $query);

        if ($result){
            $_SESSION["username"]=$username;
            header("Location:dashboard.php");
        }
    }
}


?>


<html>
    <head>

    </head>
    <body>
        <h1> Registration Form </h1>
        <form method="post"> 
            <table width="40%">
                <tr>
                    <td> Username: </td>
                    <td> <input type="text" size ="40" name="username"> </td>
                </tr>
                <tr>
                    <td> Password: </td>
                    <td> <input type="password" size="40" name="password"> </td>
                </tr>
                <tr>
                    <td> Phone Number: </td>
                    <td> <input type="number" size="40" name="phone" width="40"> </td>
                </tr>
                <tr>
                    <td> Email: </td>
                    <td> <input type="text" size="40" name="email"> </td>
                </tr>
                <tr>
                    <td> Address: </td>
                    <td> <textarea cols="40" rows="5" name="address"> </textarea> </td>
                </tr>
                <tr>
                    <td> <input type="submit" value="Register" name="register"> </td>
                </tr>
            </table>

            Already have an account? <a href="login.php"> Login </a>
        </form>
    </body>
</html>