<?php
    include('header.php');
?>
<style>
.table-responsive {
    max-width: 100%;
    overflow-x: auto;
    margin: 0 auto;
}
table {
    width: 95%;
    margin: 0 auto 20px auto;
    font-size: 14px;
    border-collapse: collapse;
}
td, th {
    padding: 6px 8px;
    border: 1px solid #ddd;
}
@media (max-width: 600px) {
    table {
        width: 100% !important;
        font-size: 12px;
    }
    .table-responsive {
        padding: 0 2px;
    }
    thead, tbody, tr, td, th {
        display: block;
    }
    thead {
        display: none;
    }
    tr {
        margin-bottom: 15px;
        border-bottom: 1px solid #ccc;
    }
    td {
        position: relative;
        padding-left: 50%;
        min-height: 30px;
        border: none;
        border-bottom: 1px solid #eee;
    }
    td:before {
        position: absolute;
        left: 10px;
        top: 0;
        width: 45%;
        white-space: normal;
        font-weight: bold;
        content: attr(data-label);
    }
}
/* Сортування таблиць */
thead td.sortable-th, thead th.sortable-th {
    background-color: #f0f0f0;
    position: relative;
    transition: background 0.2s;
}
thead td.sortable-th:hover, thead th.sortable-th:hover {
    background-color: #dce6f0;
}
thead td.sortable-th .sort-icon {
    font-size: 12px;
    color: #666;
}
</style>
<main class="home">
    <?php
        function status_catrige($status, $mysql)
        {
            // include('include/connect_db.php');
            echo "
                <h2>".$status."</h2>
                <div class='table-responsive'>
                <table>
                <thead>
                    <tr>
                        <td width='100px'>ID</td>
                        <td width='250px'>Назва картриджа</td>
                        <td width='150px'>Марка</td>
                        <td width='250px'>Користувач</td>
                        <td width='150px'>Принтер</td>
                        <td width='150px'>Статус</td>
                        <td width='150px'>Дата</td>
                    </tr>
                </thead>
                <tbody>
            ";
            $sql = "SELECT * FROM catriges where status_catrige = '".$status."'";
            $result = mysqli_query($mysql, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                echo "
                <tr>
                    <td data-label='ID'>".$row['barcode']."</td>
                    <td data-label='Назва картриджа'>".$row['name_catrige']."</td>
                    <td data-label='Марка'>".$row['mark']."</td>
                    <td data-label='Користувач'>".$row['user']."</td>
                    <td data-label='Принтер'>".$row['printer']."</td>
                    <td data-label='Статус'>".$row['status_catrige']."</td>
                    <td data-label='Дата'>".$row['date_time']."</td>
                </tr>
                ";
            }
            echo "
                </tbody>
                </table>
                </div>
            ";
        }
        status_catrige('Відправлено на заправку', $mysql);
        status_catrige('Повернуто з заправки', $mysql);
        status_catrige('Списано', $mysql);
        echo "
            <h2>Без статусу</h2>
            <div class='table-responsive'>
            <table>
            <thead>
                <tr>
                    <td width='100px'>ID</td>
                    <td width='250px'>Назва картриджа</td>
                    <td width='150px'>Марка</td>
                    <td width='250px'>Користувач</td>
                    <td width='150px'>Принтер</td>
                    <td width='150px'>Статус</td>
                    <td width='150px'>Дата</td>
                </tr>
            </thead>
            <tbody>
        ";
        $sql = "SELECT * FROM catriges where status_catrige != 'Списано' and status_catrige != 'Повернуто з заправки' and status_catrige != 'Відправлено на заправку'";
        $result = mysqli_query($mysql, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            echo "
            <tr>
                <td data-label='ID'>".$row['barcode']."</td>
                <td data-label='Назва картриджа'>".$row['name_catrige']."</td>
                <td data-label='Марка'>".$row['mark']."</td>
                <td data-label='Користувач'>".$row['user']."</td>
                <td data-label='Принтер'>".$row['printer']."</td>
                <td data-label='Статус'>".$row['status_catrige']."</td>
                <td data-label='Дата'>".$row['date_time']."</td>
            </tr>
            ";
        }
        echo "
            </tbody>
            </table>
            </div>
        ";
    ?>
</main>
<script src="js/table-sort.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    makeSortableAll();
});
</script>
<?php
    include('footer.php');
?>