<?php
    include('connect_db.php');
    date_default_timezone_set('Europe/Kyiv');

    $ID = $_POST['id'];
    $date = new DateTime();
    $sql = "UPDATE catriges SET status_catrige = 'Списано' WHERE id = ".$ID;
    mysqli_query($mysql, $sql);
    $sql = "INSERT INTO history_catriges (id_catrige, status_catrige, date_time) VALUES (".$ID.", 'Списано', '".$date->format('Y-m-d H:i:s')."')";
    mysqli_query($mysql, $sql);
    header('Location: ../home.php');
?>