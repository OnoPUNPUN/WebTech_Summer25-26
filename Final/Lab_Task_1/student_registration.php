<?php
$studentName = "";
$studentID = "";
$username = "";
$email = "";
$phone = "";
$age = "";
$website = "";
$dob = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentName = trim($_POST["studentName"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirmPassword"] ?? "";
    $studentID = trim($_POST["studentID"] ?? "");
    $website = trim($_POST["website"] ?? "");
    $dob = trim($_POST["dob"] ?? "");

    if ($studentName === "") {
        $errors["studentName"] = "Full Name is required.";
    } elseif (!preg_match("/^[A-Za-z ]+$/", $studentName)) {
        $errors["studentName"] = "Full Name may contain only alphabetic characters and spaces.";
    } elseif (strlen($studentName) < 3) {
        $errors["studentName"] = "Full Name must contain at least 3 characters.";
    } elseif (strlen($studentName) > 50) {
        $errors["studentName"] = "Full Name must not contain more than 50 characters.";
    }

    if ($username === "") {
        $errors["username"] = "Username is required.";
    } elseif (!preg_match("/^[A-Za-z0-9_]+$/", $username)) {
        $errors["username"] = "Username may contain only letters, numbers, and underscore.";
    } elseif (strlen($username) < 5 || strlen($username) > 15) {
        $errors["username"] = "Username length must be between 5 and 15 characters.";
    } elseif (!preg_match("/^[A-Za-z]/", $username)) {
        $errors["username"] = "The first character of Username must be an alphabetic character.";
    }

    if ($email === "") {
        $errors["email"] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email Address must be a valid email address.";
    } elseif (!preg_match("/\.(com|org|edu)$/i", $email)) {
        $errors["email"] = "Email Address must end with .com, .org, or .edu.";
    }

    if ($phone === "") {
        $errors["phone"] = "Phone Number is required.";
    } elseif (!preg_match("/^[0-9]+$/", $phone)) {
        $errors["phone"] = "Phone Number must contain digits only.";
    } elseif (strlen($phone) !== 11) {
        $errors["phone"] = "Phone Number must contain exactly 11 digits.";
    } elseif (substr($phone, 0, 2) !== "01") {
        $errors["phone"] = "Phone Number must start with 01.";
    }

    if ($age === "") {
        $errors["age"] = "Age is required.";
    } elseif (!is_numeric($age)) {
        $errors["age"] = "Age must contain a numeric value.";
    } elseif ($age < 18 || $age > 30) {
        $errors["age"] = "Age must be between 18 and 30.";
    }

    if ($password === "") {
        $errors["password"] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password must contain at least 8 characters.";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $errors["password"] = "Password must contain at least one uppercase English letter.";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors["password"] = "Password must contain at least one numeric digit.";
    } elseif (!preg_match("/[@#$%]/", $password)) {
        $errors["password"] = "Password must contain at least one special character: @, #, $, %.";
    }

    if ($confirmPassword === "") {
        $errors["confirmPassword"] = "Confirm Password is required.";
    } elseif ($confirmPassword !== $password) {
        $errors["confirmPassword"] = "Confirm Password must exactly match Password.";
    }

    if ($studentID === "") {
        $errors["studentID"] = "Student ID is required.";
    } elseif (!preg_match("/^[0-9]{2}-[0-9]{5}-[0-9]$/", $studentID)) {
        $errors["studentID"] = "Student ID must follow the format XX-XXXXX-X.";
    }

    if ($website === "") {
        $errors["website"] = "Personal Website is required.";
    } elseif (!preg_match("/^https?:\/\//", $website)) {
        $errors["website"] = "Personal Website must begin with http:// or https://.";
    } elseif (!filter_var($website, FILTER_VALIDATE_URL)) {
        $errors["website"] = "Personal Website must contain a valid URL.";
    }

    if ($dob === "") {
        $errors["dob"] = "Date of Birth is required.";
    }

    if (empty($errors)) {
        $success = true;
    }
}

function showValue($value)
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
</head>
<body>
    <?php
    if ($success) {
        echo "<h3>Registration Successful!</h3>";
        echo "Full Name: " . showValue($studentName) . "<br>";
        echo "Username: " . showValue($username) . "<br>";
        echo "Student ID: " . showValue($studentID) . "<br>";
        echo "Email Address: " . showValue($email) . "<br>";
    } else {
    ?>
        <section>
            <h3>Student Registration</h3>
            <form action="student_registration.php" method="post">
                <input type="text" name="studentName" placeholder="Enter your fullname" value="<?php echo showValue($studentName); ?>">
                <br>
                <?php echo $errors["studentName"] ?? ""; ?>
                <br><br>

                <input type="text" name="username" placeholder="Enter your username" value="<?php echo showValue($username); ?>">
                <br>
                <?php echo $errors["username"] ?? ""; ?>
                <br><br>

                <input type="text" name="email" placeholder="Enter your email" value="<?php echo showValue($email); ?>">
                <br>
                <?php echo $errors["email"] ?? ""; ?>
                <br><br>

                <input type="text" name="phone" placeholder="Enter your phone number" value="<?php echo showValue($phone); ?>">
                <br>
                <?php echo $errors["phone"] ?? ""; ?>
                <br><br>

                <input type="text" name="age" placeholder="Enter your age" value="<?php echo showValue($age); ?>">
                <br>
                <?php echo $errors["age"] ?? ""; ?>
                <br><br>

                <input type="password" name="password" placeholder="Enter your password" value="">
                <br>
                <?php echo $errors["password"] ?? ""; ?>
                <br><br>

                <input type="password" name="confirmPassword" placeholder="Confirm your password" value="">
                <br>
                <?php echo $errors["confirmPassword"] ?? ""; ?>
                <br><br>

                <input type="text" name="studentID" placeholder="Enter your student ID" value="<?php echo showValue($studentID); ?>">
                <br>
                <?php echo $errors["studentID"] ?? ""; ?>
                <br><br>

                <input type="text" name="website" placeholder="Enter your personal website" value="<?php echo showValue($website); ?>">
                <br>
                <?php echo $errors["website"] ?? ""; ?>
                <br><br>

                <input type="date" name="dob" value="<?php echo showValue($dob); ?>">
                <br>
                <?php echo $errors["dob"] ?? ""; ?>
                <br><br>

                <button type="submit">Register</button>
            </form>
        </section>
    <?php
    }
    ?>
</body>
</html>
<?php
/*
server-side validation help me to show submitted things again to stop user write html code from instpected mode. like as I've password if I used 
requied only the html just lock the page user seeing but he can go to instpect mode and remove the required that's why we need the server-side validation.

htmlspecialchars() we can use it like if user type <h1>hello</h1> in any input filed the html will think it's a html code and make it big but htmlspecialchars() stope this

if someone type any string in the age filed instead of number it will work that's why we must must always check what it is before checking how much it is.
*/
?>
