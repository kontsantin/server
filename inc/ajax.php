<?php
// AJAX: получить уникальные значения для select-фильтров каталога
add_action('wp_ajax_get_server_filter_options', 'get_server_filter_options_callback');
add_action('wp_ajax_nopriv_get_server_filter_options', 'get_server_filter_options_callback');
function get_server_filter_options_callback() {
    $fields = [
        'server_cpu_model' => 'Модель процессора',
        'server_chipset' => 'Чипсет',
        'server_bmc' => 'Модуль управления',
        'server_network_ports' => 'Сетевая карта',
        'server_form_factor' => 'Форм-фактор',
        'server_max_cpu' => 'Количество процессоров',
        'server_ram_type' => 'Тип памяти',
        'server_psu' => 'Блоки питания',
        'server_drive_bays_front' => 'Передние отсеки',
        'server_drive_bays_internal' => 'Внутренние отсеки',
        'server_m2_slots' => 'M.2 слоты',
        'server_cooling' => 'Охлаждение',
        'server_certificates' => 'Сертификаты',
        // Добавьте другие поля по необходимости
    ];

    $result = [];
    foreach ($fields as $field => $label) {
        $result[$field] = get_unique_field_values($field);
    }

    wp_send_json_success($result);
}

add_action('wp_ajax_filter_servers', 'filter_servers_callback');
add_action('wp_ajax_nopriv_filter_servers', 'filter_servers_callback');
function filter_servers_callback() {
    $filters = json_decode(stripslashes($_POST['filters'] ?? '{}'), true);

    $args = [
        'post_type' => 'server',
        'posts_per_page' => -1,
        'meta_query' => []
    ];

    // Фильтр по форм-фактору
    if (!empty($filters['form_factors'])) {
        $args['meta_query'][] = [
            'key' => 'server_form_factor',
            'value' => $filters['form_factors'],
            'compare' => 'IN'
        ];
    }

    // Фильтр по бюджету
    if (!empty($filters['budget_min']) || !empty($filters['budget_max'])) {
        $range = [];
        if (!empty($filters['budget_min'])) {
            $range['value'][] = $filters['budget_min'];
            $range['compare'][] = '>=';
        }
        if (!empty($filters['budget_max'])) {
            $range['value'][] = $filters['budget_max'];
            $range['compare'][] = '<=';
        }
        $args['meta_query'][] = [
            'key' => 'server_price',
            'value' => array_filter([$filters['budget_min'], $filters['budget_max']]),
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN',
        ];
    }

    // Фильтр по количеству процессоров
    if (!empty($filters['cpu_count'])) {
        $args['meta_query'][] = [
            'key' => 'server_max_cpu',
            'value' => $filters['cpu_count'],
            'compare' => 'IN',
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="card-case">
                <div class="card-case__case-pumps">
                    <span style="color: rgba(52,46,46,1); background: rgba(88,208,132,1);">В наличии</span>
                </div>
                <?php if (has_post_thumbnail()): ?>
                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>" class="card-case__case-image">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/server.webp" alt="<?php the_title_attribute(); ?>" class="card-case__case-image">
                <?php endif; ?>
                <div class="card-case__case-info">
                    <h5 class="card-case__case-title"><?php the_title(); ?></h5>
                    <h6 class="card-case__case-subtitle">
                        <?php echo esc_html(carbon_get_the_post_meta('server_short_desc')); ?>
                    </h6>
                    <span class="card-case__case-price">
                        <?php
                        $price = carbon_get_the_post_meta('server_price');
                        echo $price ? esc_html($price) . ' ₽' : 'Цена по запросу';
                        ?>
                    </span>
                </div>
            </a>
            <?php
        endwhile;
    else:
        echo '<p>Серверы не найдены.</p>';
    endif;
    wp_die();
}


function get_unique_field_values($field_name, $post_type = 'server') {
    global $wpdb;
    $meta_key = $field_name;
    $sql = $wpdb->prepare(
        "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} m
        INNER JOIN {$wpdb->posts} p ON p.ID = m.post_id
        WHERE m.meta_key = %s AND p.post_type = %s AND p.post_status = 'publish' AND m.meta_value != ''",
        $meta_key, $post_type
    );
    $results = $wpdb->get_col($sql);
    // Для сериализованных значений (массивы) — раскладываем
    $values = [];
    foreach ($results as $val) {
        $maybe = @unserialize($val);
        if ($maybe !== false && is_array($maybe)) {
            foreach ($maybe as $v) {
                if (is_string($v) && $v !== '') $values[] = $v;
            }
        } elseif (is_string($val) && $val !== '') {
            $values[] = $val;
        }
    }
    return array_unique(array_filter($values));
}