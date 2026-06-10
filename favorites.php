<?php
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['save_favorite']))
{
    $city = mysqli_real_escape_string($conn,$_POST['city']);

    $check = mysqli_query(
        $conn,
        "SELECT * FROM favorites
         WHERE user_id='$user_id'
         AND city='$city'"
    );

    if(mysqli_num_rows($check)==0)
    {
        mysqli_query(
            $conn,
            "INSERT INTO favorites(user_id,city)
             VALUES('$user_id','$city')"
        );
    }

    header("Location: favorites.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Favorite Cities</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f4f6f9;
}

.container{
    width:80%;
    margin:40px auto;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th,td{
    padding:15px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#3498db;
    color:white;
}

.btn{
    padding:8px 12px;
    background:red;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

</style>

</head>
<body>

<div class="container">

<h2>My Favorite Cities</h2>

<table>

<tr>
    <th>ID</th>
    <th>City</th>
    <th>Action</th>
</tr>

<?php

$result = mysqli_query(
    $conn,
    "SELECT * FROM favorites
     WHERE user_id='$user_id'"
);

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['city']; ?></td>

<td>
<a class="btn"
href="remove_favorite.php?id=<?php echo $row['id']; ?>">
Delete
</a>
</td>

</tr>

<?php
}
?>

</table>

<br>

<a href="dashboard.php">← Back Dashboard</a>

</div>

</body>
</html>