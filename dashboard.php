<?php
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weather Dashboard</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial,sans-serif;
    }

    body{
        background:#f4f6f9;
    }

    .navbar{
        background:#3498db;
        color:white;
        padding:15px 30px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .navbar h2{
        font-size:24px;
    }

    .navbar a{
        color:white;
        text-decoration:none;
        background:#e74c3c;
        padding:8px 15px;
        border-radius:5px;
    }

    .container{
        width:90%;
        max-width:1200px;
        margin:30px auto;
    }

    .welcome{
        margin-bottom:20px;
    }

    .search-box{
        background:white;
        padding:20px;
        border-radius:10px;
        box-shadow:0 0 10px rgba(0,0,0,0.1);
    }

    .search-box form{
        display:flex;
        gap:10px;
    }

    .search-box input{
        flex:1;
        padding:12px;
        border:1px solid #ccc;
        border-radius:5px;
    }

    .search-box button{
        padding:12px 20px;
        border:none;
        background:#3498db;
        color:white;
        border-radius:5px;
        cursor:pointer;
    }

    .cards{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
        gap:20px;
        margin-top:30px;
    }

    .card{
        background:white;
        padding:25px;
        border-radius:12px;
        text-align:center;
        box-shadow:0 0 10px rgba(0,0,0,0.1);
    }

    .card h3{
        color:#555;
        margin-bottom:10px;
    }

    .card p{
        font-size:24px;
        font-weight:bold;
        color:#3498db;
    }

    </style>
</head>

<body>

<div class="navbar">

    <h2>Weather Dashboard</h2>

    <div>
        Welcome,
        <?php echo $_SESSION['name']; ?>

        |
        <a href="logout.php">Logout</a>
    </div>

</div>

<div class="container">

    <div class="welcome">
        <h1>Live Weather System</h1>
        <p>Search any city and view weather details.</p>
    </div>

    <div class="search-box">

        <form action="weather.php" method="GET">

            <input
                type="text"
                name="city"
                placeholder="Enter City Name..."
                required>

            <button type="submit">
                Search Weather
            </button>

        </form>

    </div>

    <div class="cards">

        <div class="card">
            <h3>Temperature</h3>
            <p>-- °C</p>
        </div>

        <div class="card">
            <h3>Humidity</h3>
            <p>-- %</p>
        </div>

        <div class="card">
            <h3>Wind Speed</h3>
            <p>-- km/h</p>
        </div>

        <div class="card">
            <h3>Condition</h3>
            <p>--</p>
        </div>

    </div>

    <div style="margin-top:10px;">
    <a href="history.php">
        View Search History
    </a>
    </div>

</div>

</body>
</html>