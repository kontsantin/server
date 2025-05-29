<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', 'Настройки темы')
        ->add_tab('Header', [
            Field::make('file', 'header_logo', 'SVG логотип (header)')
                ->set_help_text('Загрузите SVG логотип')
                ->set_width(50)
                ->set_value_type('url'),
            Field::make('text', 'header_phone_1', 'Телефон 1 (header)')
                ->set_width(24),
            Field::make('text', 'header_phone_2', 'Телефон 2 (header)')
                ->set_width(24),
        ])
        ->add_tab('Footer', [
            Field::make('text', 'footer_copyright', 'Копирайт')
                ->set_help_text('Текст копирайта в подвале сайта'),
            Field::make('text', 'footer_phone', 'Телефон (footer)'),
            Field::make('text', 'footer_email', 'Email (footer)'),
        ])
        ->add_tab('Partners', [
            Field::make('text', 'partners_title', 'Заголовок секции')
                ->set_default_value('Партнеры'),
            Field::make('image', 'partners_bg', 'Фоновое изображение')
                ->set_value_type('url')
                ->set_help_text('Фоновое изображение для секции "Партнеры"'),
            Field::make('media_gallery', 'partners_images', 'Изображения партнеров')
                ->set_type(array('image'))
                ->set_help_text('Загрузите изображения логотипов партнеров для секции "Партнеры"'),


        ])
        ->add_tab('Секция: О компании', [
            Field::make('text', 'about_title', 'Заголовок секции'),

            Field::make('complex', 'about_cards', 'Карточки')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'title', 'Заголовок карточки'),
                    Field::make('file', 'image', 'Изображение')
                        ->set_value_type('url')
                        ->set_help_text('Загрузите изображение для карточки'),
                ]),
            Field::make('complex', 'about_paragraphs', 'Абзацы')
                ->add_fields([
                    Field::make('textarea', 'paragraph', 'Текст абзаца'),
                ])->set_layout('tabbed-horizontal')
                ->set_help_text('Добавьте абзацы текста для секции "О компании"'),
        ])
        ->add_tab('Секция: Форма обратной связи', [
            Field::make('text', 'form_title', 'Заголовок формы')->set_default_value('Готовы стать частью команды?'),
            Field::make('image', 'form_logo', 'Логотип формы')->set_value_type('url'),
            Field::make('text', 'form_subtitle', 'Подзаголовок')->set_default_value('Оставьте заявку прямо сейчас, и мы свяжемся с вами в ближайшее время!'),
            Field::make('text', 'form_button', 'Текст кнопки')->set_default_value('Начать проект'),
        ]);
});

add_action('carbon_fields_register_fields', 'register_home_template_fields');
function register_home_template_fields()
{
    Container::make('post_meta', 'Настройки главной страницы')
        ->where('post_template', '=', 'templates/home.php')
        ->add_tab('Секция: Решения', [
            Field::make('checkbox', 'show_solutions_section', 'Показывать секцию "Решения"')->set_option_value('yes'),
            Field::make('text', 'solutions_title', 'Заголовок секции'),

            Field::make('complex', 'solutions_items', 'Элементы решений')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'title', 'Заголовок'),
                    Field::make('file', 'icon', 'Иконка')
                        ->set_value_type('url'),
                    Field::make('text', 'link', 'Ссылка'),
                ]),

            Field::make('file', 'solutions_server_image', 'Изображение сервера')
                ->set_value_type('url'),

            Field::make('text', 'solutions_server_link_text', 'Текст ссылки сервера'),
            Field::make('text', 'solutions_server_link_url', 'URL ссылки сервера'),
        ])
        ->add_tab('Глобальные секции', [
            Field::make('checkbox', 'show_about_section', 'Показывать секцию "О нас"')->set_option_value('yes'),
            Field::make('checkbox', 'show_partners_section', 'Показывать секцию "Партнеры"')->set_option_value('yes'),
        ]);
}


add_action('carbon_fields_register_fields', 'register_about_template_fields');
function register_about_template_fields()
{
    Container::make('post_meta', 'Настройки главной страницы')
        ->where('post_template', '=', 'templates/about.php')
        ->add_tab('Секция: Наша команда', [
            Field::make('checkbox', 'show_team_section', 'Показывать секцию "О нас"')->set_option_value('yes'),
            Field::make('text', 'team_title', 'Заголовок секции')
                ->set_default_value('Наша команда'),
            Field::make('textarea', 'team_description', 'Описание секции'),
            Field::make('complex', 'team_members', 'Карточки команды')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'name', 'Имя'),
                    Field::make('text', 'position', 'Должность'),
                    Field::make('image', 'photo', 'Фото')
                        ->set_value_type('url')
                        ->set_help_text('Загрузите изображение участника команды'),
                ])
                ->set_help_text('Добавьте участников команды'),
        ])
        ->add_tab('Сертификаты', [
            Field::make('checkbox', 'show_certificates_section', 'Показывать секцию "Сертификаты и награды"')->set_option_value('yes'),
            Field::make('text', 'certificates_title', 'Заголовок секции')
                ->set_default_value('Сертификаты и награды'),
            Field::make('media_gallery', 'certificates_images', 'Изображения сертификатов и наград')
                ->set_type(['image'])
                ->set_help_text('Загрузите изображения сертификатов и наград для слайдера'),
        ])
        ->add_tab('Отзывы', [
            Field::make('checkbox', 'show_reviews_section', 'Показывать секцию "Отзывы"')->set_option_value('yes'),
            Field::make('complex', 'reviews_items', 'Отзывы')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'author', 'Имя автора'),
                    Field::make('text', 'job', 'Должность/Компания'),
                    Field::make('image', 'photo', 'Фото автора')->set_value_type('url'),
                    Field::make('textarea', 'text', 'Текст отзыва'),
                    Field::make('image', 'company_logo', 'Логотип компании')->set_value_type('url'),
                    Field::make('select', 'stars', 'Количество звёзд')
                        ->add_options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ])
                        ->set_default_value('5'),
                ]),
        ])
        ->add_tab('Глобальные секции', [
            Field::make('checkbox', 'show_about_section', 'Показывать секцию "О нас"')->set_option_value('yes'),
            Field::make('checkbox', 'show_partners_section', 'Показывать секцию "Партнеры"')->set_option_value('yes'),
            Field::make('checkbox', 'show_form_section', 'Показывать секцию "Формы обратной связи"')->set_option_value('yes'),
        ]);
}

//Single-page server

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', 'Данные сервера')
        ->where('post_type', '=', 'server')
        ->add_tab('Основная информация', [
            Field::make('text', 'server_short_desc', 'Краткое описание')
                ->set_default_value('Однопроцессорный сервер корпоративного класса...')
                ->set_width(100),
            Field::make('media_gallery', 'server_gallery', 'Галерея изображений')
                ->set_type(['image'])
                ->set_width(100),
            Field::make('text', 'server_price', 'Цена')
                ->set_attribute('type', 'number')
                ->set_width(33),
            Field::make('checkbox', 'server_russian_production', 'Российское производство')
                ->set_option_value('yes')
                ->set_width(33),
            Field::make('checkbox', 'server_available', 'В наличии')
                ->set_option_value('yes')
                ->set_width(33),
            Field::make('text', 'server_button', 'Текст кнопки')
                ->set_default_value('Запросить КП')
                ->set_width(33),
        ])
        ->add_tab('Основные характеристики', [
            Field::make('select', 'server_chipset', 'Чипсет')
                ->add_options(get_server_chipset_options())
                ->set_default_value('intel_c741')
                ->set_width(15),
            Field::make('select', 'server_socket', 'Сокет')
                ->add_options(get_server_socket_options())
                ->set_default_value('2_x_lga_4677')
                ->set_width(15),
            Field::make('select', 'server_cpu_model', 'Модель процессора')
                ->add_options(get_server_cpu_model_options())
                ->set_default_value('intel_xeon_scalable')
                ->set_width(15),
            Field::make('select', 'server_cpu_generation', 'Поколение процессора')
                ->add_options(get_server_cpu_generation_options())
                ->set_default_value('4')
                ->set_width(15),
            Field::make('select', 'server_max_cpu', 'Макс. количество процессоров')
                ->add_options(get_server_max_cpu_options())
                ->set_default_value('2')
                ->set_width(15),
             Field::make('select', 'server_cpu_frequency', 'Частота процессора')
                ->add_options(get_server_cpu_frequency_options())
                ->set_default_value('3.0')
                ->set_width(15),
            Field::make('select', 'server_ram_type', 'Тип памяти')
                ->add_options(get_server_ram_type_options())
                ->set_default_value('DDR5')
                ->set_width(33),           
            Field::make('text', 'server_ram_slots', 'Количество слотов памяти')
                ->set_default_value('32 x 288-pin DIMM')
                ->set_width(33),
            Field::make('text', 'server_max_ram', 'Макс. объем памяти')
                ->set_default_value('3TB')
                ->set_width(33),
            Field::make('multiselect', 'server_raid_controllers', 'RAID контроллеры')
                ->add_options(get_server_raid_controller_options())
                ->set_help_text('Выберите поддерживаемые RAID контроллеры')
                ->set_width(50),
            Field::make('text', 'server_raid_cache_size', 'Объем кеша RAID-контроллера')
                ->set_help_text('Укажите объем кеша RAID-контроллера, например: 4 ГБ')
                ->set_width(50),
            Field::make('complex', 'server_expansion_slots', 'Слоты расширения')
                ->add_fields([
                    Field::make('text', 'slot_type', 'Тип слота')->set_width(50),
                    Field::make('text', 'slot_count', 'Количество')->set_width(50),
                ])
                ->set_default_value([
                    [
                        'slot_type' => 'PCI-E 5.0 x16',
                        'slot_count' => '2 полнопрофильных'
                    ],
                    [
                        'slot_type' => 'PCI-E 5.0 x8',
                        'slot_count' => '4 полнопрофильных'
                    ]
                ])
                ->set_width(100),
        ])
        ->add_tab('Дисковая подсистема', [
            Field::make('multiselect', 'server_drive_types', 'Типы поддерживаемых накопителей')
                ->add_options(get_server_drive_type_options()),


            Field::make('text', 'server_drive_bays_front_max', 'Передние отсеки — макс. количество')
                ->set_help_text('Выберите максимальное количество поддерживаемых накопителей')
                ->set_default_value('3'),

            Field::make('text', 'server_drive_bays_front_types', 'Передние отсеки — типы накопителей')
                ->set_help_text('Выберите все поддерживаемые типы накопителей'),

            Field::make('text', 'server_drive_bays_front_description', 'Передние отсеки — описание')
                ->set_default_value('25 x 2.5" SATA/SAS hot-swap')
                ->set_width(50),

            Field::make('text', 'server_drive_bays_internal', 'Внутренние отсеки')
                ->set_default_value('2 x 2.5" SATA/SAS')
                ->set_width(50),

            Field::make('text', 'server_m2_slots', 'M.2 слоты')
                ->set_default_value('2 x M.2 (тип 2280/22110 PCI-e 4.0 x4)')
                ->set_width(50),

            Field::make('text', 'server_microsd_slot', 'microSD для BMC')
                ->set_default_value('1')
                ->set_width(50),
        ])

        ->add_tab('Интерфейсы и управление', [
            Field::make('select', 'server_bmc', 'Модуль управления')
                ->add_options(get_server_remote_management_module_options())
                ->set_default_value('BMC Aspect AST2600')
                ->set_width(33),

            Field::make('text', 'server_ipmi_port', 'Порт IPMI')
                ->set_default_value('RJ45')
                ->set_width(33),
            Field::make('multiselect', 'server_network_cards', 'Сетевые интерфейсы')
                ->add_options(get_server_network_card_options())
                ->set_help_text('Выберите поддерживаемые сетевые интерфейсы')
                ->set_width(34),
            Field::make('complex', 'server_front_ports', 'Передняя панель')
                ->add_fields([
                    Field::make('text', 'port_name', 'Элемент')->set_width(50),
                    Field::make('text', 'port_value', 'Описание')->set_width(50),
                ])
                ->set_default_value([
                    ['port_name' => 'USB', 'port_value' => '2 x USB 3.0'],
                    ['port_name' => 'Индикаторы', 'port_value' => 'Питания, сети, UID, состояния системы'],
                ])
                ->set_width(50),
            Field::make('complex', 'server_rear_ports', 'Задняя панель')
                ->add_fields([
                    Field::make('text', 'port_name', 'Интерфейс')->set_width(50),
                    Field::make('text', 'port_count', 'Количество')->set_width(50),
                ])
                ->set_default_value([
                    ['port_name' => 'VGA', 'port_count' => '1'],
                    ['port_name' => 'USB 3.0', 'port_count' => '2'],
                    ['port_name' => 'COM', 'port_count' => '1'],
                ])
                ->set_width(50),
        ])
        ->add_tab('Физические параметры', [
            Field::make('select', 'server_form_factor', 'Форм-фактор')
                ->add_options(get_server_form_factor_options())
                ->set_default_value('2u')
                ->set_width(33),
            Field::make('text', 'server_dimensions', 'Габариты (Ш x Г x В)')
                ->set_default_value('763 x 447 x 87 мм')
                ->set_width(33),
            Field::make('text', 'server_weight', 'Вес, кг')
                ->set_attribute('type', 'number')
                ->set_default_value('30')
                ->set_width(34),
            Field::make('select', 'server_psu_count', 'Количество блоков питания')
                ->add_options([
                    '1' => '1',
                    '2' => '2',
                    '4' => '4',
                ])
                ->set_help_text('Выберите количество блоков питания')
                ->set_width(50),
            Field::make('text', 'server_psu', 'Блоки питания')
                ->set_default_value('2000W 80+ Platinum')
                ->set_width(50),
            Field::make('text', 'server_cooling', 'Охлаждение')
                ->set_default_value('4 x 80 мм вентиляторов')
                ->set_width(50),
            Field::make('checkbox', 'server_intrusion_switch', 'Датчик вскрытия корпуса')
                ->set_option_value('yes')
                ->set_width(100),
        ])
        ->add_tab('Дополнительно', [
            Field::make('textarea', 'server_docs', 'Документация')
                ->set_width(100),
            Field::make('text', 'server_certificates', 'Сертификаты')
                ->set_width(100),
            Field::make('complex', 'server_videoreviews', 'Видеообзоры')
                ->add_fields([
                    Field::make('text', 'video_url', 'Ссылка на видео')->set_width(50),
                    Field::make('image', 'video_preview', 'Превью видео')->set_width(50),
                    Field::make('date', 'video_date', 'Дата обзора')->set_width(33),
                    Field::make('text', 'video_title', 'Заголовок обзора')->set_width(33),
                    Field::make('textarea', 'video_desc', 'Описание обзора')->set_width(34),
                ])
                ->set_width(100),
        ]);
});




require_once get_template_directory() . '/inc/vendor/autoload.php';

add_action('after_setup_theme', function () {
    \Carbon_Fields\Carbon_Fields::boot();
});
