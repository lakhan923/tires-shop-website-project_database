<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit button */
        .registerbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Form for user registration -->
    <form action="#" method="POST">

        <!-- Container for the form -->
        <div class="container">

            <!-- Heading for the registration form -->
            <h1>Register</h1>

            <!-- Instruction for the user -->
            <p>Please fill in this form to create an account.</p>
            <hr>

            <!-- Syötä kentät sähköpostille, salasanalle ja toista salasanalle -->
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw_repeat" id="psw-repeat" required>
            <hr>
            <!-- Submission button -->
            <button type="submit" name="submit" class="registerbtn">Register</button>
        </div>
    </form>

</body>

</html>
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Yhdistä tietokantaan
$db = mysqli_connect('localhost', 'root', 'database_password') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'registration_db') or die(mysqli_error($db));

// Check if the registration form is submitted
if (isset($_POST['submit'])) {

    // Hae käyttäjän syöte
    $email = $_POST['email'];
    $psw = $_POST['psw'];
    $psw_repeat = $_POST['psw_repeat'];

    // Hash the passwords using password_hash for security
    $hashed_password = password_hash($psw, PASSWORD_DEFAULT);

    // SQL-kysely/query käyttäjätietojen lisäämiseksi tietokantaan
    $query = "INSERT INTO `account` (email, password, retypepassword) VALUES ('$email', '$hashed_password', '$psw_repeat')";
    echo $query; // Print the query for debugging purposes

    // Suorita kysely ja käsittele virheet
    if (mysqli_query($db, $query)) {
        echo "Account Successfully Registered!";
    } else {
        echo "Error in updating Database: " . mysqli_error($db);
    }
?>
    <!-- javaScript-hälytys, joka ilmoittaa käyttäjälle onnistuneesta rekisteröinnistä -->
    <script type="text/javascript">
        alert("Account Successfully Registered!");
        window.location = "encrypted_password.php";
    </script>
<?php
}
?>