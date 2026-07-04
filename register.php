<?php
include "db.php";

if(isset($_POST['register']))
{
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $role = "student";

    // Server-side Validation
    if(empty($username))
    {
        die("Username is required.");
    }

    if(empty($email))
    {
        die("Email is required.");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        die("Please enter a valid email address.");
    }

    if(strlen($password) < 6)
    {
        die("Password must be at least 6 characters.");
    }

    // Prepared Statement
    $stmt = $conn->prepare("INSERT INTO users(username,email,password,role) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if($stmt->execute())
    {
        echo "<script>
                alert('Registration Successful');
                window.location='login.php';
              </script>";
        exit();
    }
    else
    {
        echo "<script>alert('Registration Failed');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>User Registration</h2>

   <form method="POST" onsubmit="return validateForm()">

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="email"
               name="email"
               placeholder="Email"
               required>

        <input
    type="password"
    name="password"
    placeholder="Password"
    minlength="6"
    required>

        <button name="register">
            Register
        </button>

        <p>
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </form>
</div>
<script>

function validateForm()
{
    let username = document.getElementsByName("username")[0].value.trim();
    let email = document.getElementsByName("email")[0].value.trim();
    let password = document.getElementsByName("password")[0].value;

    if(username=="")
    {
        alert("Please enter Username");
        return false;
    }

    if(email=="")
    {
        alert("Please enter Email");
        return false;
    }

    if(password.length < 6)
    {
        alert("Password must be at least 6 characters.");
        return false;
    }

    return true;
}

</script>
</body>
</html>