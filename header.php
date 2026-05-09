<?php
    include('include/connect_db.php');
    session_start();
    if(empty($_SESSION['FNAME']))
    {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime('css/style.css'); ?>">
    <title>Грона &trade; — Картриджі</title>
</head>
<body>
    <header>
        <div class="header-logo">
            <a href="home.php"><img src='./img/logo.png' alt='ТОВ фірма Грона'></a>
        </div>
        <nav class="header-nav">
            <a class='btn nav-link' href="home.php">🔍 Головна</a>
            <a class='btn nav-link' href="catrige.php">🖨 Картриджі</a>
            <a class='btn nav-link' href="history.php">📋 Історія</a>
        </nav>
        <div class="header-user">
            <span class="user-badge">
                <?php echo htmlspecialchars($_SESSION['FNAME'] . ' ' . $_SESSION['LNAME']); ?>
            </span>
            <a href="index.php" class="logout-btn">Вихід</a>
        </div>
    </header>
    <script src='js/TopMenuActive.js'></script>