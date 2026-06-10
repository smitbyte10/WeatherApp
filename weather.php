<?php
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

if(!isset($_GET['city']))
{
    header("Location: dashboard.php");
    exit();
}

$city = trim($_GET['city']);

$apiKey = "163f5050afd1d75b0db8c67482e66fea";

$url = "https://api.openweathermap.org/data/2.5/weather?q=".$city.",IN&appid=".$apiKey."&units=metric";
$response = file_get_contents($url);

$data = json_decode($response,true);

if(isset($data['cod']) && $data['cod']==200)
{
    $temperature = $data['main']['temp'];
    $humidity = $data['main']['humidity'];
    $wind = $data['wind']['speed'];
    $condition = $data['weather'][0]['main'];
    $description = $data['weather'][0]['description'];
    $icon = $data['weather'][0]['icon'];
    $cityName = $data['name'];
    $country = $data['sys']['country'];

    $user_id = $_SESSION['user_id'];

    mysqli_query(
        $conn,
        "INSERT INTO search_history(user_id,city)
         VALUES('$user_id','$cityName')"
    );
}
else
{
    die("City Not Found!");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Weather Result</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#eef2f7;
    margin:0;
}

.navbar{
    background:#3498db;
    color:white;
    padding:15px;
}

.container{
    width:90%;
    max-width:900px;
    margin:40px auto;
}

.weather-card{
    background:white;
    padding:30px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}

.weather-card img{
    width:100px;
}

.weather-card h1{
    margin-bottom:10px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
    margin-top:25px;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.card h3{
    color:#666;
}

.card p{
    font-size:24px;
    color:#3498db;
    font-weight:bold;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:#3498db;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

</style>

</head>
<body>

<div class="navbar">
    Weather Information
</div>

<div class="container">

<div class="weather-card">

<h1><?php echo $cityName.", ".$country; ?></h1>

<img src="https://openweathermap.org/img/wn/<?php echo $icon; ?>@2x.png">

<h2><?php echo ucfirst($description); ?></h2>

</div>

<div class="cards">

<div class="card">
<h3>Temperature</h3>
<p><?php echo $temperature; ?> °C</p>
</div>

<div class="card">
<h3>Humidity</h3>
<p><?php echo $humidity; ?> %</p>
</div>

<div class="card">
<h3>Wind Speed</h3>
<p><?php echo $wind; ?> m/s</p>
</div>

<div class="card">
<h3>Condition</h3>
<p><?php echo $condition; ?></p>
</div>

</div>

<center>
<a class="btn" href="dashboard.php">
Back to Dashboard
</a>
</center>

</div>

</body>
</html>