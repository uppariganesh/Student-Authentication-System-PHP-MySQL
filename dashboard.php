
<?php
session_start();
echo $_SESSION['role'];
include "db.php";

$sql = "SELECT COUNT(*) AS total FROM students";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>

        body{
            margin:0;
            padding:0;
            font-family:Arial, sans-serif;
            background:linear-gradient(135deg,#667eea,#764ba2,#f093fb);
background-size:300% 300%;
animation:gradientMove 8s ease infinite;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            width:500px;
max-width:90%;
            padding:40px;
            background:rgba(255,255,255,0.1);
            backdrop-filter:blur(10px);
            border-radius:20px;
            text-align:center;
            box-shadow:0 8px 32px rgba(0,0,0,0.3);
        }

        h1{
            color:white;
        }

        p{
            color:#ddd;
            margin-bottom:30px;
        }

        a{
            display:block;
            margin:15px 0;
            padding:15px;
            border-radius:10px;
            text-decoration:none;
            color:white;
            font-size:18px;
            transition:0.3s;
        }

        .add{
            background:#2563eb;
        }

        .view{
            background:#16a34a;
        }

        .logout{
            background:#dc2626;
        }

       a:hover{
    transform:scale(1.08);
    transition:0.3s;
    box-shadow:0 0 15px rgba(255,255,255,0.4);
    @keyframes gradientMove
{
    0%
    {
        background-position:0% 50%;
    }

    50%
    {
        background-position:100% 50%;
    }

    100%
    {
        background-position:0% 50%;
    }
    .admin
{
    background:#16a34a;
    color:white;
    display:inline-block;
    padding:10px 25px;
    border-radius:30px;
    font-weight:bold;
    margin:15px;
}

.student
{
    background:#2563eb;
    color:white;
    display:inline-block;
    padding:10px 25px;
    border-radius:30px;
    font-weight:bold;
    margin:15px;
    .card
{
    background:white;
    color:#333;
    width:180px;
    margin:20px auto;
    padding:20px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.2);
}

.card h1
{
    margin:0;
    color:#764ba2;
}

.card p
{
    color:#555;
}
}
}
}
    </style>

</head>

<body>

<div class="container">

   <h1>Student Management System</h1>
<h2>👋 Welcome Back!</h2>

<h3><?php echo $_SESSION['email']; ?></h3>

<?php
if($_SESSION['role']=="admin")
{
    echo "<div class='admin'>🛡 Administrator</div>";
}
else
{
    echo "<div class='student'>🎓 Student</div>";
}
?>
   <div class="card">

<h1><?php echo $row['total']; ?></h1>

<p>Total Students</p>

</div>
    <p>Date: <?php echo date("d-m-Y"); ?></p>


      

   <?php if($_SESSION['role']=="admin") { ?>

<a class="add" href="add_student.php">
    📚 Add Student
</a>

<?php } ?>

<a class="view" href="view_students.php">
    👨‍🎓 View Students
</a>

<a href="logout.php"
   class="logout"
   onclick="return confirm('Are you sure you want to logout?')">
   Logout
</a>
</div>


</body>
</html>