<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div id='nav'>
        <a href="/index.php" style='font-weight: bold; font-size: 24px;'>Home</a>
        <a href="/insert.html">Insert</a>
        <a href="/delete.html">Delete</a>
        <a href="/update.html">Update</a>
        <div id='profile'>
            <a href="/signup.php">Sign Up</a>
            <a href="/signin.php">Sign In</a>
        </div>
    </div>
    <form method="post">
        <fieldset>
            <legend>Sign In</legend>
            <label for="Username">Email</label><br>
            <input type="email" id="Username" name="Username"><br>
            <label for="Password">Password</label><br>
            <input minlength="8" type="password" id="Password" name="Password"><br><br>

            <button type="submit" name="submit">Sign in</button>
        </fieldset>
    </form>
    <p id="Error"></p>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "genomedb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if (isset($_POST['Username'])) {
        $Username = $_POST['Username'];
        $sql = "SELECT email FROM user";

        $res = $conn->query($sql);
        $array = [];

        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {

                array_push($array, $row['email']);
            }
        }

        if (!in_array($Username, $array)) {
            echo "<p>Username doesn't exsist</p>";
        } else {
            $Password = $_POST['Password'];
            $ref = "SELECT password_ FROM user WHERE email = '$Username'";
            $res = $conn->query($ref);
            $row = $res->fetch_assoc();
            $text = $row['password_'];

            if ($Password != $text) {
                echo "<p>Password isn't correct</p>";

            } else {
                header('Location:/index.php');
            }
        }
    }

    $conn->close();
    ?>
</body>

</html>