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
<main class="home history">
  <h2 onclick="hide('SearchBarcode')">Пошук по штрих коду</h2>
  <div class="SearchBarcode" id='SearchBarcode'>
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
                </tr>
            </thead>
            <tbody id='Catrige'>
            </tbody>
        </table>
        </div>
    </div>
  </div>
  <h2 onclick="hide('SearchDate')">Пошук по даті</h2>
  <div class="SearchDate" id='SearchDate'>
    <div class="SearchCatrige">
      <label for="">Початок:</label>
      <input type="date" name="" id="start_date">
      <label for="">Кінець:</label>
      <input type="date" name="" id="end_date">
      <label for="">Статус:</label>
      <select name="status" id="StatusCatrige">
        <option value="">Всі статуси</option>
        <option value="Відправлено на заправку">Відправлено на заправку</option>
        <option value="Повернуто з заправки">Повернуто з заправки</option>
      </select>
      <button id='SearchButton' onclick="Search()">Пошук</button>
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
                </tr>
            </thead>
            <tbody id='Catrige1'>
            </tbody>
        </table>
        </div>
    </div>
  </div>
</main>
<script>
  function Search(){
    let start_date = document.getElementById('start_date').value;
    let end_date = document.getElementById('end_date').value;
    let status = document.getElementById('StatusCatrige').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("Catrige1").innerHTML = this.responseText;
        // Додаємо data-label для адаптивності
        let rows = document.querySelectorAll("#Catrige1 tr");
        rows.forEach(function(row) {
            let cells = row.children;
            if (cells.length >= 7) {
                cells[0].setAttribute('data-label', 'ID');
                cells[1].setAttribute('data-label', 'Назва картриджа');
                cells[2].setAttribute('data-label', 'Марка');
                cells[3].setAttribute('data-label', 'Користувач');
                cells[4].setAttribute('data-label', 'Принтер');
                cells[5].setAttribute('data-label', 'Статус');
                cells[6].setAttribute('data-label', 'Дата');
            }
        });
        // Оновлюємо сортування
        var t = document.querySelector('#SearchDate table');
        if (t) makeSortable(t);
      }
    };
    xmlhttp.open("GET", "include/SearchCatrige.php?start_date=" + start_date +'&end_date=' + end_date + '&status=' +status, true);
    xmlhttp.send();
  }
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
          if (cells.length >= 7) {
              cells[0].setAttribute('data-label', 'ID');
              cells[1].setAttribute('data-label', 'Назва картриджа');
              cells[2].setAttribute('data-label', 'Марка');
              cells[3].setAttribute('data-label', 'Користувач');
              cells[4].setAttribute('data-label', 'Принтер');
              cells[5].setAttribute('data-label', 'Статус');
              cells[6].setAttribute('data-label', 'Дата');
          }
      });
      // Оновлюємо сортування
      var t = document.querySelector('#SearchBarcode table');
      if (t) makeSortable(t);
    }
  };
  xmlhttp.open("GET", "include/SearchCatrige.php?a=" + str, true);
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

// Додаємо ініціалізацію видимості блоків при завантаженні сторінки
document.addEventListener('DOMContentLoaded', function() {
    // За замовчуванням показуємо пошук по штрих коду, ховаємо по даті
    document.getElementById('SearchBarcode').style.display = 'block';
    document.getElementById('SearchDate').style.display = 'none';
});

function hide(name)
{
  if(name == 'SearchBarcode')
  {
    document.getElementById('SearchBarcode').style.display = 'block';
    document.getElementById('SearchDate').style.display = 'none';
    inputField.focus();
    // blur-обробник вже додано один раз при завантаженні сторінки
  }
  else if(name == 'SearchDate')
  {
    document.getElementById('SearchBarcode').style.display = 'none';
    document.getElementById('SearchDate').style.display = 'block';
  }
}
</script>
<script src="js/table-sort.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ініціалізуємо сортування для обох таблиць
    document.querySelectorAll('table').forEach(function(t) { makeSortable(t); });
});
</script>
<?php
    include('footer.php');
?>