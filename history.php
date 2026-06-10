<?php
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM search_history
     WHERE user_id='$user_id'
     ORDER BY searched_at DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Search History</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f4f6f9;
}

.container{
    width:85%;
    margin:40px auto;
}

h2{
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th{
    background:#3498db;
    color:white;
}

th,td{
    padding:15px;
    border:1px solid #ddd;
    text-align:center;
}

.back-btn{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    background:#3498db;
    color:white;
    padding:10px 15px;
    border-radius:5px;
}

</style>

</head>
<body>

<div class="container">

<h2>My Search History</h2>

<table>

<tr>
    <th>ID</th>
    <th>City</th>
    <th>Searched Time</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['city']; ?></td>

<td><?php echo $row['searched_at']; ?></td>

</tr>

<?php
}
?>

</table>

<a class="back-btn" href="dashboard.php">
Back Dashboard
</a>

</div>

</body>
</html>