<?php

/**
 * Шаблон архива серверов
 */
get_header(); ?>



<section data-catalog-js class="catalog">
    <div class="catalog__container container">
        <h1 class="catalog__title title">Сервера под любые задачи</h1>
        <div class="catalog__nav">
            <div class="catalog__nav-scroll">
                <button class="catalog__nav-button catalog__open">
                    <svg>
                        <use xlink:href="#menu"></use>
                    </svg>
                    <svg>
                        <use xlink:href="#close"></use>
                    </svg>
                    Фильтр
                </button>
                <?php
                $terms = get_terms([
                    'taxonomy' => 'server_category',
                    'hide_empty' => true,
                ]);
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $i => $term) {
                        $selected = $i === 0 ? ' selected' : '';
                        echo '<button class="catalog__nav-button' . $selected . '">'
                            . esc_html($term->name) . '</button>';
                    }
                } else {
                    echo '<button class="catalog__nav-button" disabled>Категории не найдены</button>';
                }
                ?>
            </div>

            <div class="catalog__filters-mobile">
                <button class="catalog__filters-close">
                    <svg>
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="catalog__body">
            <div class="catalog__filters">
                <div class="catalog__filter catalog__filter_range">
                    <h5 class="catalog__filter-title">Бюджет</h5>
                    <div class="catalog__filter-body">
                        <div class="catalog__filter-input">
                            <span>от</span><input placeholder="0" maxlength="8" type="text">
                        </div>
                        <div class="catalog__filter-input">
                            <span>до</span><input placeholder="59 987 888" maxlength="8" type="text">
                        </div>
                    </div>
                </div>
                <!-- Форм-фактор (жестко зашит, ок) -->
                <div class="catalog__filter catalog__filter_checkboxes">
                    <h5 class="catalog__filter-title">Форм-фактор</h5>
                    <div class="catalog__filter-body">
                        <?php
                        $form_factors = get_server_form_factor_options();
                        ?>
                        <label class="catalog__filter-checkbox">
                            <span>Все</span>
                            <input type="checkbox" value="" checked>
                        </label>
                        <?php foreach ($form_factors as $value => $label): ?>
                            <label class="catalog__filter-checkbox">
                                <span><?php echo esc_html($label); ?></span>
                                <input type="checkbox" name="server_form_factor[]" value="<?php echo esc_attr($value); ?>">
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Модель процессора -->
                <div class="catalog__filter">
                    <h5 class="catalog__filter-title">Модель процессора</h5>
                    <div class="catalog__filter-body">
                        <?php $cpu_models = get_server_cpu_model_options(); ?>
                        <select class="catalog__select" name="server_cpu_model">
                            <option value="">Выбрать</option>
                            <?php foreach ($cpu_models as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Поколение -->
                <div class="catalog__filter">
                    <h5 class="catalog__filter-title">Поколение</h5>
                    <div class="catalog__filter-body">
                        <?php $generations = get_server_cpu_generation_options(); ?>
                        <select class="catalog__select" name="server_cpu_generation">
                            <option value="">Выбрать</option>
                            <?php foreach ($generations as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Кол-во процессоров -->
                <div class="catalog__filter catalog__filter_checkboxes catalog__filter_checkboxes-3">
                    <h5 class="catalog__filter-title">Количество процессоров</h5>
                    <div class="catalog__filter-body">
                        <?php $cpu_counts = get_server_max_cpu_options(); ?>
                        <?php foreach ($cpu_counts as $value => $label): ?>
                            <label class="catalog__filter-checkbox">
                                <span><?php echo esc_html($label); ?></span>
                                <input type="checkbox" name="server_max_cpu[]" value="<?php echo esc_attr($value); ?>">
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Частота процессора (заглушка — заменишь позже) -->
                <div class="catalog__filter">
                    <h5 class="catalog__filter-title">Частота процессора</h5>
                    <div class="catalog__filter-body">
                        <?php $frequency = get_server_cpu_frequency_options(); ?>
                        <select class="catalog__select" name="server_cpu_frequency">
                            <option value="">Выбрать</option>
                            <?php foreach ($frequency as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="catalog__filter catalog__filter_checkboxes catalog__filter_checkboxes-3">
                    <h5 class="catalog__filter-title">Тип дисков</h5>
                    <div class="catalog__filter-body">
                        <?php $drive_types = get_server_drive_type_options(); ?>
                        <?php foreach ($drive_types as $value => $label): ?>
                            <label class="catalog__filter-checkbox">
                                <span><?php echo esc_html($label); ?></span>
                                <input type="checkbox" name="server_drive_type[]" value="<?php echo esc_attr($value); ?>">
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="catalog__filter catalog__filter_range">
                    <h5 class="catalog__filter-title">Максимальное количество дисков</h5>
                    <div class="catalog__filter-body">
                        <div class="catalog__filter-input">
                            <span>от</span><input placeholder="2" maxlength="2" type="text">
                        </div>
                        <div class="catalog__filter-input">
                            <span>до</span><input placeholder="49" maxlength="2" type="text">
                        </div>
                    </div>
                </div>
                <div class="catalog__filter">
                    <h5 class="catalog__filter-title">Модуль удаленного управления</h5>
                    <div class="catalog__filter-body">
                        <?php $remote_modules = get_server_remote_management_module_options(); ?>
                        <select class="catalog__select" name="server_remote_management_module">
                            <option value="">Выбрать</option>
                            <?php foreach ($remote_modules as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="catalog__filter">
                    <h5 class="catalog__filter-title">Сетевая карта</h5>
                    <div class="catalog__filter-body">
                        <?php $network_cards = get_server_network_card_options(); ?>
                        <select class="catalog__select" name="server_network_card">
                            <option value="">Выбрать</option>
                            <?php foreach ($network_cards as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="catalog__filter">
                    <h5 class="catalog__filter-title">RAID контроллер</h5>
                    <div class="catalog__filter-body">
                        <?php $raid_controllers = get_server_raid_controller_options(); ?>
                        <select class="catalog__select" name="server_raid_controller">
                            <option value="">Выбрать</option>
                            <?php foreach ($raid_controllers as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="catalog__filter catalog__filter_range">
                    <h5 class="catalog__filter-title">Оперативная память</h5>
                    <div class="catalog__filter-body">
                        <div class="catalog__filter-input">
                            <span>от</span><input placeholder="0" maxlength="8" type="text">
                        </div>
                        <div class="catalog__filter-input">
                            <span>до</span><input placeholder="2048" maxlength="8" type="text">
                        </div>
                    </div>
                </div>
                <div class="catalog__filter catalog__filter_checkboxes catalog__filter_checkboxes-3">
                    <h5 class="catalog__filter-title">Количество блоков питания</h5>
                    <div class="catalog__filter-body">
                        <label class="catalog__filter-checkbox">
                            <span>1</span><input type="checkbox">
                        </label>
                        <label class="catalog__filter-checkbox">
                            <span>2</span><input type="checkbox">
                        </label>
                        <label class="catalog__filter-checkbox">
                            <span>4</span><input type="checkbox">
                        </label>
                    </div>
                </div>
                <div class="catalog__filter catalog__filter_range">
                    <h5 class="catalog__filter-title">Объем кеша контролера, мб</h5>
                    <div class="catalog__filter-body">
                        <div class="catalog__filter-input">
                            <span>от</span><input placeholder="0" maxlength="8" type="text">
                        </div>
                        <div class="catalog__filter-input">
                            <span>до</span><input placeholder="8000" maxlength="8" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="catalog__cards">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="card-case">
                            <div class="card-case__case-pumps">
                                <?php
                                $available = carbon_get_the_post_meta('server_available');
                                if ($available) {
                                    // В наличии — зелёный фон
                                    echo '<span style="color: rgba(52, 46, 46, 1); background: rgba(88, 208, 132, 1);">В наличии</span>';
                                } else {
                                    // Нет в наличии — красный фон
                                    echo '<span style="color: #fff; background: #e74c3c;">Нет в наличии</span>';
                                }
                                ?>
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
                    <?php endwhile;
                else: ?>
                    <p>Серверы не найдены.</p>
                <?php endif; ?>
            </div>
        </div>
        <button class="catalog__more">Показать еще</button>
    </div>
</section>

<?php get_footer(); ?>