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
    <form name="g" onsubmit=" return CheckMatch()" action="signup.php" method="post">
        <fieldset>
            <legend>Create Acount</legend>
            <label for="Username">Email</label><br>
            <input type="email" id="Username" name="Username"><br>
            <label for="Password">Password</label><br>
            <input minlength="8" type="password" id="Password" name="Password"><br>
            <label for="Password2">Re-Enter Password</label><br>
            <input minlength="8" type="password" id="Password2"><br><br>
            <button type="submit" name="submit">Sign Up</button>
        </fieldset>
    </form>
    <p id="Error"></p>
    <script>
        function CheckMatch() {
            pass1 = document.forms['g']['Password'].value;
            pass2 = document.forms['g']['Password2'].value;
            if (pass1 != pass2) {

                alert("Password Doesn't match");

                return false;
            }

        }
    </script>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "genomedb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (isset($_POST['Username']) && isset($_POST['Password'])) {
        $UserName = $_REQUEST['Username'];
        $Password = $_REQUEST['Password'];
        $sql = "INSERT INTO user VALUES ('$UserName','$Password')";
        if (mysqli_query($conn, $sql)) {
            echo "<p>User Created Successfully</p>";
        } else {
            echo '<p>Username Already Exist</p>';
        }
    }





    // Check connection
    
    $conn->close();
    ?>
</body>

</html>