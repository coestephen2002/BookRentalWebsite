<?php

$conn=mysqli_connect("localhost", "root", "") or die("Cannot connect to server");
mysqli_select_db($conn, "examdb") or die("Cannot find db");

session_start();
if (!(isset($_SESSION["username"])))
{

    header("Location:login.php");    
}

$username = $_SESSION["username"];

if(isset($_POST["submit"])) {

    if(isset($_POST["books"])) {

        $books = $_POST["books"];
        foreach($books as $book) {
            $bookName = explode(' - ', $book)[0];
            $query = "update book set status=1 where title='" .$bookName. "'";

            $result=mysqli_query($conn,$query );

            $query = "select id from book where title='" .$bookName. "'";

            $result=mysqli_query($conn,$query );
            $row=mysqli_fetch_array($result);
            $bookID = $row[0];

            $query = "select id from client where username='" .$username. "'";
            $result=mysqli_query($conn,$query );
            $row=mysqli_fetch_array($result);
            $clientID = $row[0];

            $query = "insert into bookrental (client_id, book_id)";
            $query .= " values ('" .$clientID. "', '" .$bookID. "')";
            
            $result=mysqli_query($conn, $query);

            //echo $bookName . "<br>";

        }

        if ($result)
        {
            echo "<script> alert(\"Books have been sucessfully rented\")</script>";
        }
    }

    else {
        echo "<script> alert(\"You have to select books\")</script>";
    }
}

?>


<html>
    <head>

    </head>
    <body>
        <h1> Dashboard </h1>
        Hey, <?php echo($username . "!") ?>
        <br> <br>
        You are now on the dashboard page.
        <br> <br>
        <a href="logout.php"> Logout </a>

        <br>
        <h2> Select the books you wish </h2>
        <form method="post">
        <select name="books[]" multiple>
            <?php
                $query = "select * from book where status=0";
                $result=mysqli_query($conn, $query);

                while($row=mysqli_fetch_array($result))
                {
                    echo "<option>" .$row[1]. " - " .$row[2]. " - " . $row[3]. "</option>";
                }
            ?>
        </select>
        <br> <br>
        <input type="submit" name="submit" value="Submit">
        </form>

        <?php
            if(isset($_POST["submit"])) {
                foreach($books as $book) {
                    $bookName = explode(' - ', $book)[0];
                    echo "You selected: " .$bookName . "<br>"; 
                }
            }
        ?>
    </body>
</html>