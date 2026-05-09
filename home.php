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
.AddCatrigeBtn {
    width: 100%;
    margin: 0 auto;
    padding: 0;
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
    <div class="AddCatrigeBtn">
        <a href="add_catrige.php" style="display:block;width:100%;text-decoration:none;">
            <h2 onclick="hide('SearchBarcode')" style="font-weight:bold;text-decoration:none;margin:0;">Додати картридж</h2>
        </a>
        <a href="print.php" style="display:block;width:100%;text-decoration:none;margin-top:10px;">
            <h2 style="font-weight:bold;text-decoration:none;margin:0;">Акт дифектації</h2>
        </a>
    </div>
    <div class="SearchCatrige">
        <input type="text" name="idCatrige" id="idCatrige" namespace='ID картриджа' onkeyup="showHint(this.value)">
    </div>
    <div class="FindCatrige">
        <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Назва картриджа</td>
                    <td>Марка</td>
                    <td>Користувач</td>
                    <td>Принтер</td>
                    <td>Статус</td>
                    <td>Дата</td>
                    <td width='150px' class="no-sort"></td>
                    <td width='150px' class="no-sort"></td>
                </tr>
            </thead>
            <tbody id='Catrige'>
                <!-- JS will fill rows -->
            </tbody>
        </table>
        </div>
    </div>
</main>
<script>
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("Catrige").innerHTML = "";
    return;
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Catrige").innerHTML = this.responseText;
      // Додаємо data-label для адаптивності
      let rows = document.querySelectorAll("#Catrige tr");
      rows.forEach(function(row) {
          let cells = row.children;
          if (cells.length >= 9) {
              cells[0].setAttribute('data-label', 'ID');
              cells[1].setAttribute('data-label', 'Назва картриджа');
              cells[2].setAttribute('data-label', 'Марка');
              cells[3].setAttribute('data-label', 'Користувач');
              cells[4].setAttribute('data-label', 'Принтер');
              cells[5].setAttribute('data-label', 'Статус');
              cells[6].setAttribute('data-label', 'Дата');
              cells[7].setAttribute('data-label', '');
              cells[8].setAttribute('data-label', '');
          }
      });
      // Оновлюємо сортування після завантаження рядків
      var table = document.querySelector('.FindCatrige table');
      if (table) makeSortable(table);
    }
  };
  xmlhttp.open("GET", "include/SearchCatrige.php?q=" + str, true);
  xmlhttp.send();
}
const inputField = document.getElementById('idCatrige');
    
// Функція для встановлення фокусу
function keepFocus() {
    inputField.focus();
}
// Фокус на завантаженні сторінки
inputField.focus();
// Фокус при втраті фокусу
inputField.addEventListener('blur', function() {
    setTimeout(keepFocus, 0); // Фокус повертається після завершення поточної події
});
</script>
<script src="js/table-sort.js"></script>
<script>
// Ініціалізуємо сортування після завантаження сторінки
document.addEventListener('DOMContentLoaded', function() {
    var table = document.querySelector('.FindCatrige table');
    if (table) makeSortable(table);
});
</script>
<?php
    include('footer.php');
?>