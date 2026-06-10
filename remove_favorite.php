<?php

include("config.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM favorites WHERE id='$id'"
    );
}

header("Location: favorites.php");
exit();

?>