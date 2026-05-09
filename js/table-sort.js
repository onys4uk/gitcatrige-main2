/**
 * Утиліта сортування таблиць.
 * Виклик: makeSortable(table) — де table це HTMLTableElement.
 * Або: makeSortableAll() — для всіх таблиць на сторінці.
 */
function makeSortable(table) {
    var headers = table.querySelectorAll('thead tr td, thead tr th');
    headers.forEach(function(th, colIndex) {
        // Пропускаємо порожні заголовки (кнопки дій тощо)
        if (!th.textContent.trim()) return;

        // Якщо заголовок вже ініціалізовано — не дублюємо іконки та обробники
        if (th.getAttribute('data-sort-init') === '1') return;
        th.setAttribute('data-sort-init', '1');

        th.classList.add('sortable-th');
        th.setAttribute('data-sort-dir', '');
        th.style.cursor = 'pointer';
        th.style.userSelect = 'none';
        th.style.whiteSpace = 'nowrap';

        // Додаємо іконку сортування (лише один раз)
        var icon = document.createElement('span');
        icon.classList.add('sort-icon');
        icon.innerHTML = ' ⇅';
        th.appendChild(icon);


        th.addEventListener('click', function() {
            var dir = th.getAttribute('data-sort-dir');
            var newDir = (dir === 'asc') ? 'desc' : 'asc';

            // Скидаємо всі інші заголовки цієї таблиці
            headers.forEach(function(other) {
                other.setAttribute('data-sort-dir', '');
                var otherIcon = other.querySelector('.sort-icon');
                if (otherIcon) otherIcon.innerHTML = ' ⇅';
            });

            th.setAttribute('data-sort-dir', newDir);
            icon.innerHTML = newDir === 'asc' ? ' ↑' : ' ↓';

            sortTableByColumn(table, colIndex, newDir);
        });
    });
}

function sortTableByColumn(table, colIndex, dir) {
    var tbody = table.querySelector('tbody');
    if (!tbody) return;

    var rows = Array.from(tbody.querySelectorAll('tr'));

    rows.sort(function(a, b) {
        var aCell = a.querySelectorAll('td')[colIndex];
        var bCell = b.querySelectorAll('td')[colIndex];
        if (!aCell || !bCell) return 0;

        var aVal = aCell.textContent.trim();
        var bVal = bCell.textContent.trim();

        // Спроба порівняти як числа
        var aNum = parseFloat(aVal.replace(/\s/g, '').replace(',', '.'));
        var bNum = parseFloat(bVal.replace(/\s/g, '').replace(',', '.'));

        if (!isNaN(aNum) && !isNaN(bNum)) {
            return dir === 'asc' ? aNum - bNum : bNum - aNum;
        }

        // Спроба порівняти як дати (формат YYYY-MM-DD або DD.MM.YYYY)
        var aDate = parseDate(aVal);
        var bDate = parseDate(bVal);
        if (aDate && bDate) {
            return dir === 'asc' ? aDate - bDate : bDate - aDate;
        }

        // Текстове порівняння (з підтримкою кирилиці)
        return dir === 'asc'
            ? aVal.localeCompare(bVal, 'uk')
            : bVal.localeCompare(aVal, 'uk');
    });

    rows.forEach(function(row) {
        tbody.appendChild(row);
    });
}

function parseDate(str) {
    // YYYY-MM-DD HH:MM:SS або YYYY-MM-DD
    var m = str.match(/^(\d{4})-(\d{2})-(\d{2})/);
    if (m) return new Date(m[1], m[2] - 1, m[3]);

    // DD.MM.YYYY
    m = str.match(/^(\d{2})\.(\d{2})\.(\d{4})/);
    if (m) return new Date(m[3], m[2] - 1, m[1]);

    return null;
}

function makeSortableAll() {
    var tables = document.querySelectorAll('table');
    tables.forEach(function(t) {
        makeSortable(t);
    });
}
