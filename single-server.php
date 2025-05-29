
<?php get_header(); ?>
<section data-detail-js class="detail">
    <div class="detail__container container">
        <div class="detail__top">
            <div class="detail__gallery">
                <?php
                $gallery = carbon_get_the_post_meta('server_gallery');
                if ($gallery) {
                    foreach ($gallery as $img_id) {
                        $img_url = wp_get_attachment_image_url($img_id, 'large');
                        echo '<div class="detail__gallery-item"><img data-fancybox src="' . esc_url($img_url) . '" alt=""></div>';
                    }
                }
                ?>
            </div>
            <div class="detail__info">
                <h3 class="detail__title title"><?php the_title(); ?></h3>
                <p class="detail__text"><?php the_content(); ?></p>
                <div class="detail__price">
                    <h5 class="detail__price-title"><?php echo esc_html(carbon_get_the_post_meta('server_price')); ?> ₽</h5>
                    <button class="detail__button">
                        <?php echo esc_html(carbon_get_the_post_meta('server_button')); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="detail__tabs">
            <nav class="detail__nav">
                <button class="active" type="button">Характеристики</button>
                <button type="button">Документация</button>
            </nav>

            <div class="detail__tab active">
                <div class="detail__info-text">
                     <p>
                            <?php echo esc_html(carbon_get_the_post_meta('server_short_desc')); ?>
                        </p>
                    <ul class="detail__info-items">
                        <li><h5>Чипсет</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_chipset')); ?></p></li>
                        <li><h5>Сокет</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_socket')); ?></p></li>
                        <li><h5>Модель процессора</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_cpu_model')); ?> <?php echo esc_html(carbon_get_the_post_meta('server_cpu_generation')); ?></p></li>                        
                        <li><h5>Макс. процессоров</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_max_cpu')); ?></p></li>
                        <li><h5>Тип памяти</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_ram_type')); ?></p></li>
                        <li><h5>Слоты памяти</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_ram_slots')); ?></p></li>
                        <li><h5>Макс. объем памяти</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_max_ram')); ?></p></li>

                        <?php
                        $slots = carbon_get_the_post_meta('server_expansion_slots');
                        if ($slots) {
                            echo '<li><h5>Слоты расширения</h5><ul>';
                            foreach ($slots as $slot) {
                                echo '<li>' . esc_html($slot['slot_type']) . ': ' . esc_html($slot['slot_count']) . '</li>';
                            }
                            echo '</ul></li>';
                        }
                        ?>

                        <li><h5>Передние отсеки</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_drive_bays_front')); ?></p></li>
                        <li><h5>Внутренние отсеки</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_drive_bays_internal')); ?></p></li>
                        <li><h5>M.2 слоты</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_m2_slots')); ?></p></li>
                        <li><h5>microSD для BMC</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_microsd_slot')); ?></p></li>

                        <li><h5>Модуль управления</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_bmc')); ?></p></li>
                        <li><h5>Порт IPMI</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_ipmi_port')); ?></p></li>

                        <?php
                        $front_ports = carbon_get_the_post_meta('server_front_ports');
                        if ($front_ports) {
                            echo '<li><h5>Передняя панель</h5><ul>';
                            foreach ($front_ports as $port) {
                                echo '<li>' . esc_html($port['port_name']) . ': ' . esc_html($port['port_value']) . '</li>';
                            }
                            echo '</ul></li>';
                        }

                        $rear_ports = carbon_get_the_post_meta('server_rear_ports');
                        if ($rear_ports) {
                            echo '<li><h5>Задняя панель</h5><ul>';
                            foreach ($rear_ports as $port) {
                                echo '<li>' . esc_html($port['port_name']) . ': ' . esc_html($port['port_count']) . '</li>';
                            }
                            echo '</ul></li>';
                        }
                        ?>

                        <li><h5>Сетевые интерфейсы</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_network_ports')); ?></p></li>

                        <li><h5>Форм-фактор</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_form_factor')); ?></p></li>
                        <li><h5>Габариты</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_dimensions')); ?></p></li>
                        <li><h5>Вес</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_weight')); ?> кг</p></li>
                        <li><h5>Блоки питания</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_psu')); ?></p></li>
                        <li><h5>Охлаждение</h5><p><?php echo esc_html(carbon_get_the_post_meta('server_cooling')); ?></p></li>

                        <?php if (carbon_get_the_post_meta('server_intrusion_switch') === 'yes'): ?>
                            <li><h5>Дополнительно</h5><p>Датчик вскрытия корпуса</p></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="detail__tab">
                <div class="detail__info-text">
                    <p><?php echo nl2br(esc_html(carbon_get_the_post_meta('server_docs'))); ?></p>
                </div>
            </div>
        </div>

        <?php if ($certs = carbon_get_the_post_meta('server_certificates')): ?>
            <a href="#" class="detail__link"><?php echo esc_html($certs); ?></a>
        <?php endif; ?>
    </div>
</section>


<?php
$videoreviews = carbon_get_the_post_meta('server_videoreviews');
if ($videoreviews && is_array($videoreviews)) :
?>
<section data-videoreviews-js class="videoreviews">
    <div class="videoreviews__container container">
        <h3 class="videoreviews__title">Видеообзоры</h3>
        <div class="videoreviews__swiper swiper">
            <div class="swiper-wrapper">
                <?php foreach ($videoreviews as $video) : ?>
                    <a href="<?php echo esc_url($video['video_url']); ?>" class="swiper-slide videoreviews__item" target="_blank" rel="noopener">
                        <?php if (!empty($video['video_preview'])): ?>
                            <img src="<?php echo esc_url($video['video_preview']); ?>" alt="" class="videoreviews__image">
                        <?php endif; ?>
                        <?php if (!empty($video['video_date'])): ?>
                            <span class="videoreviews__date"><?php echo esc_html($video['video_date']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($video['video_title'])): ?>
                            <h5 class="videoreviews__name"><?php echo esc_html($video['video_title']); ?></h5>
                        <?php endif; ?>
                        <?php if (!empty($video['video_desc'])): ?>
                            <p class="videoreviews__text"><?php echo esc_html($video['video_desc']); ?></p>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>