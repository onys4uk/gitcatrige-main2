<?php
    include('connect_db.php');

    if(!empty($_GET['q'])){
        $IdCatrige = $_GET['q'];
        
        $sql = "SELECT * FROM catriges WHERE barcode LIKE '%".$IdCatrige."%'";
        $result = mysqli_query($mysql, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row['barcode']."</td>
            <td>".$row['name_catrige']."</td>
            <td>".$row['mark']."</td>
            <td>".$row['user']."</td>
            <td>".$row['printer']."</td>
            <td>".$row['status_catrige']."</td>
            <td>".$row['date_time']."</td>";
            if($row['status_catrige'] == 'Повернуто з заправки')
            {
                echo "<td><form action='include/SendCatrige.php' method='POST'><button name='id' value=".$row['id']." onclick=\"return confirm('Відправити картридж на заправку?')\">Відправити на заправку</button></form></td>";
            }
            else if($row['status_catrige'] == 'Відправлено на заправку')
            {
                echo "<td><form action='include/SendCatrige.php' method='POST'><button name='id' value=".$row['id']." onclick=\"return confirm('Позначити картридж як повернуто з заправки?')\">Повернуто з заправки</button></form></td>";
            }
            else
            {
                echo "<td><form action='include/SendCatrige.php' method='POST'><button name='id' value=".$row['id']." onclick=\"return confirm('Відправити картридж на заправку?')\">Відправити на заправку</button></form></td>";
            }
            echo "<td><form action='include/WriteOff.php' method='POST'><button name='id' id='WriteOff' value=".$row['id']." onclick=\"return confirm('Списати картридж? Цю дію не можна скасувати!')\">Списати</button></form></td></tr>";
        }
    }
    else if(!empty($_GET['a']))
    {
        $IdCatrige = $_GET['a'];

        $sql = "SELECT barcode, name_catrige, mark, user, printer, history_catriges.status_catrige as status_catrige, history_catriges.date_time as date_time 
        FROM catriges
        join history_catriges on catriges.id = history_catriges.id_catrige
        WHERE barcode LIKE '%".$IdCatrige."%' order by history_catriges.date_time desc";
        $result = mysqli_query($mysql, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>".$row['barcode']."</td>
            <td>".$row['name_catrige']."</td>
            <td>".$row['mark']."</td>
            <td>".$row['user']."</td>
            <td>".$row['printer']."</td>
            <td>".$row['status_catrige']."</td>
            <td>".$row['date_time']."</td></tr>";
        }
    }
    else if(!empty($_GET['start_date']))
    {
        $StartDate = $_GET['start_date'];
        $StartDate = new DateTime($StartDate);
        $EndDate = $_GET['end_date'];
        $EndDate = new DateTime($EndDate);
        if(!empty($_GET['status']))
        {
            $status = 'history_catriges.status_catrige = "' . $_GET['status'] . '" AND ';
        }
        else
        {
            $status = '';
        }
        $sql = "SELECT barcode, name_catrige, mark, user, printer, history_catriges.status_catrige as status_catrige, history_catriges.date_time as date_time 
        FROM catriges
        join history_catriges on catriges.id = history_catriges.id_catrige
        WHERE ".$status." history_catriges.date_time BETWEEN '".$StartDate->format('Y-m-d 00:00:00')."' AND '".$EndDate->format('Y-m-d 23:59:59')."' order by history_catriges.date_time desc";
        $result = mysqli_query($mysql, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>".$row['barcode']."</td>
            <td>".$row['name_catrige']."</td>
            <td>".$row['mark']."</td>
            <td>".$row['user']."</td>
            <td>".$row['printer']."</td>
            <td>".$row['status_catrige']."</td>
            <td>".$row['date_time']."</td></tr>";
        }
    }
?>