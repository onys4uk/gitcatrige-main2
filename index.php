<?php
    ob_start();
    include('include/connect_db.php');
    session_start();
    $_SESSION['STATUS']='0';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Admin">
    <title>Грона&trade; - Система закупівель</title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link rel="shortcut icon" href="./img/favicon.ico">
</head>
<body>
  <!--Авторизация-->
  <header>
    <div class="container">
      <form method="post" autocomplete="off">
        <div class="container-logo">
          <div class="logo">
            <img src="./img/logo.png" alt="Грона">
          </div>
        </div>
        <div class="container-text">
          <p class="help-text">Введіть ваш логін та пароль</p>
        </div>
        <div class="container-input">
          <div class="login-input">
            <label for="MyLogin">ЛОГІН</label>
            <!-- <input type="text"  class="indexlogin" name="login" id="MyLogin" placeholder="Введіть логін.." autocomplete="off"> -->
            <select class='indexLogin' name="login" id='MyLogin'>
              <?php
                $sql = "select login from users order by id";
                $result = mysqli_query($mysql, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                  echo "<option value='".$row['login']."'>".$row['login']."</option>";
                }
              ?>
            </select>
          </div>
          <div class="password-input">
            <label for="MyPassword">ПАРОЛЬ</label>
            <input type="password" name="password" id="MyPassword" placeholder="Введіть пароль.." autocomplete="off">
          </div>
        </div>
        <button type="submit" class="index-signin" name='submit_enter'>Увійти</button>
        <p class="copy-text"><?php echo date('Y');?> &copy; Грона</p>


    <?php
            if(isset($_POST['submit_enter'])){
                $name = filter_input(INPUT_POST, 'login');
                $password = filter_input(INPUT_POST, 'password');
                $query = "SELECT id, first_name, last_name, status, password FROM users WHERE login='$name'";
                $result = mysqli_query($mysql, $query);
                if($result->num_rows>0){
                    $row = mysqli_fetch_assoc($result);
                    if($row['password'] == $password){
                        $_SESSION['FNAME'] = $row['first_name'];
                        $_SESSION['LNAME'] = $row['last_name'];
                        $_SESSION['ID_USER'] = $row['id'];
                        $_SESSION['STATUS'] = $row['status'];
                        if($row['status']=='user')
                        {
                          header('Location: home.php');
                        }
                        else if($row['status']=='admin')
                        {
                          header('Location:admin/index.php');
                        }
                    }
                    else{
                        echo "<p class='danger-text'>Неправильно введений пароль!</p>";
                    }
                }
                else{
                    echo "<p class='danger-text'>Неправильно введений логін!</p>";
                }
            }
        ?>
      </form>
    </div>
  </header>
</body>
</html>
