<?php
    include('connect_db.php');
    date_default_timezone_set('Europe/Kyiv');

    $ID = $_POST['id'];
    $date = new DateTime();
    $sql = "SELECT status_catrige FROM catriges where id = ".$ID;
    $result = mysqli_query($mysql, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row['status_catrige'] == 'Повернуто з заправки')
    {
        $sql = "UPDATE catriges SET status_catrige='Відправлено на заправку', date_time='".$date->format('Y-m-d H:i:s')."' WHERE id = ".$ID;
        mysqli_query($mysql, $sql);
        $sql = "INSERT INTO history_catriges (id_catrige, status_catrige, date_time) VALUES (".$ID.", 'Відправлено на заправку', '".$date->format('Y-m-d H:i:s')."')";
    }
    else if($row['status_catrige'] == 'Відправлено на заправку')
    {
        $sql = "UPDATE catriges SET status_catrige='Повернуто з заправки', date_time='".$date->format('Y-m-d H:i:s')."' WHERE id = ".$ID;
        mysqli_query($mysql, $sql);
        $sql = "INSERT INTO history_catriges (id_catrige, status_catrige, date_time) VALUES (".$ID.", 'Повернуто з заправки', '".$date->format('Y-m-d H:i:s')."')";
    }
    else
    {
        $sql = "UPDATE catriges SET status_catrige='Відправлено на заправку', date_time='".$date->format('Y-m-d H:i:s')."' WHERE id = ".$ID;        
        mysqli_query($mysql, $sql);
        $sql = "INSERT INTO history_catriges (id_catrige, status_catrige, date_time) VALUES (".$ID.", 'Відправлено на заправку', '".$date->format('Y-m-d H:i:s')."')";
    }
    mysqli_query($mysql, $sql);
    header('Location: ../home.php');
?>