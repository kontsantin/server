document.addEventListener('DOMContentLoaded', function() {
    // Сбор фильтров и отправка ajax
    function collectFilters() {
        const filters = {};

        // Форм-фактор
        filters.form_factors = [];
        document.querySelectorAll('.catalog__filter-title').forEach(function(title) {
            if (title.textContent.trim() === 'Форм-фактор') {
                const body = title.parentNode.querySelector('.catalog__filter-body');
                body.querySelectorAll('input[type=checkbox]:checked').forEach(cb => {
                    const val = cb.parentNode.querySelector('span').textContent.trim();
                    if (val !== 'Все') filters.form_factors.push(val);
                });
            }
        });

        // Бюджет
        document.querySelectorAll('.catalog__filter-title').forEach(function(title) {
            if (title.textContent.trim() === 'Бюджет') {
                const body = title.parentNode.querySelector('.catalog__filter-body');
                const inputs = body.querySelectorAll('input[type=text]');
                if (inputs.length === 2) {
                    filters.budget_min = inputs[0].value;
                    filters.budget_max = inputs[1].value;
                }
            }
        });

        // Количество процессоров
        filters.cpu_count = [];
        document.querySelectorAll('.catalog__filter-title').forEach(function(title) {
            if (title.textContent.trim() === 'Количество процессоров') {
                const body = title.parentNode.querySelector('.catalog__filter-body');
                body.querySelectorAll('input[type=checkbox]:checked').forEach(cb => {
                    filters.cpu_count.push(cb.parentNode.querySelector('span').textContent.trim());
                });
            }
        });

        // Можно добавить другие фильтры аналогично

        return filters;
    }

    function filterServers() {
        const filters = collectFilters();
        const data = new FormData();
        data.append('action', 'filter_servers');
        data.append('filters', JSON.stringify(filters));

        fetch(window.ajaxurl, {
            method: 'POST',
            body: data
        })
        .then(r => r.text())
        .then(html => {
            document.querySelector('.catalog__cards').innerHTML = html;
        });
    }

    // Навешиваем обработчики на фильтры
    document.querySelectorAll('.catalog__filters input, .catalog__filters select').forEach(el => {
        el.addEventListener('change', filterServers);
    });
});
