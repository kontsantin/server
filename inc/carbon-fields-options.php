<?php
// functions/carbon-fields-options.php

if (!function_exists('get_server_cpu_model_options')) {
    function get_server_cpu_model_options(): array {
        return [
            'intel_xeon_scalable' => 'Intel Xeon Scalable',
            'intel_xeon_gold'     => 'Intel Xeon Gold',
            'intel_xeon_silver'   => 'Intel Xeon Silver',
            'intel_xeon_bronze'   => 'Intel Xeon Bronze',
            'amd_epyc'            => 'AMD EPYC',            
        ];
    }
}

if (!function_exists('get_server_chipset_options')) {
    function get_server_chipset_options(): array {
        return [
            'intel_c741'    => 'Intel C741',
            'intel_c621a'   => 'Intel C621A',
            'intel_c622'    => 'Intel C622',
            'amd_sp5100'    => 'AMD SP5100',
            'amd_swrx8'     => 'AMD WRX80',           
        ];
    }
}

if (!function_exists('get_server_socket_options')) {
    function get_server_socket_options(): array {
        return [
            '2_x_lga_4677' => '2 x LGA 4677',
            '1_x_lga_4189' => '1 x LGA 4189',
            '2_x_lga_4189' => '2 x LGA 4189',
            '1_x_sp3'      => '1 x SP3',
            '2_x_sp3'      => '2 x SP3',            
        ];
    }
}

if (!function_exists('get_server_cpu_generation_options')) {
    function get_server_cpu_generation_options(): array {
        return [
            '1' => '1-го поколения',
            '2' => '2-го поколения',
            '3' => '3-го поколения',
            '4' => '4-го поколения',
            '5' => '5-го поколения',
        ];
    }
}

if (!function_exists('get_server_max_cpu_options')) {
    function get_server_max_cpu_options(): array {
        return [
            '1' => '1',
            '2' => '2',
            '8' => '8',
        ];
    }
}

if (!function_exists('get_server_ram_type_options')) {
    function get_server_ram_type_options(): array {
        return [
            'DDR4'    => 'DDR4',
            'DDR5'    => 'DDR5',
            'DDR3'    => 'DDR3',
            'LPDDR4'  => 'LPDDR4',
            'LPDDR5'  => 'LPDDR5',
        ];
    }
}
if (!function_exists('get_server_psu_options')) {
    function get_server_psu_options(): array {
        return [
            '1' => '1 блок питания',
            '2' => '2 блока питания',
            '3' => '3 блока питания',
            '4' => '4 блока питания',            
        ];
    }
}
if (!function_exists('get_server_form_factor_options')) {
    function get_server_form_factor_options(): array {
        return [
            '1u' => '1U',
            '2u' => '2U',
            '4u' => '4U',
            'tower'        => 'Tower',
            'blade'        => 'Blade',
            'mini_tower'   => 'Mini Tower',           
        ];
    }
}

if (!function_exists('get_server_cpu_frequency_options')) {
    function get_server_cpu_frequency_options(): array {
        return [
            '2_0_ghz' => '2.0 ГГц',
            '2_2_ghz' => '2.2 ГГц',
            '2_4_ghz' => '2.4 ГГц',
            '2_6_ghz' => '2.6 ГГц',
            '2_8_ghz' => '2.8 ГГц',
            '3_0_ghz' => '3.0 ГГц',
            '3_2_ghz' => '3.2 ГГц',
            '3_4_ghz' => '3.4 ГГц',
            '3_6_ghz' => '3.6 ГГц',            
        ];
    }
}
if (!function_exists('get_server_drive_type_options')) {
    function get_server_drive_type_options(): array {
        return [
            '2_5_sff' => '2,5 SFF',
            '3_5_lff' => '3,5 LFF',
            'nvme'    => 'NVMe',            
        ];
    }
}
if (!function_exists('get_server_remote_management_module_options')) {
    function get_server_remote_management_module_options(): array {
        return [
            'bmc_aspect_ast2600' => 'BMC Aspect AST2600',
            'idrac9'             => 'Dell iDRAC9',
            'hp_ilo5'            => 'HPE iLO 5',
            'supermicro_x11'     => 'Supermicro X11 BMC',
            'asrock_rack_ast2500'=> 'ASRock Rack AST2500',
            // Добавьте другие модули удаленного управления здесь при необходимости
        ];
    }
}
if (!function_exists('get_server_network_card_options')) {
    function get_server_network_card_options(): array {
        return [
            '1g_rj45'    => '1 Гбит/с RJ-45',
            '10g_rj45'   => '10 Гбит/с RJ-45',
            '10g_sfp+'   => '10 Гбит/с SFP+',
            '25g_sfp28'  => '25 Гбит/с SFP28',
            '40g_qsfp+'  => '40 Гбит/с QSFP+',
            '100g_qsfp28'=> '100 Гбит/с QSFP28',
            'fc_8g'      => '8 Гбит/с Fibre Channel',
            'fc_16g'     => '16 Гбит/с Fibre Channel',
            'fc_32g'     => '32 Гбит/с Fibre Channel',
        ];
    }
}

if (!function_exists('get_server_raid_controller_options')) {
    function get_server_raid_controller_options(): array {
        return [
            'lsi_megaraid'    => 'LSI MegaRAID',
            'hp_smart_array'  => 'HP Smart Array',
            'dell_perc'       => 'Dell PERC',
            'adaptec_raid'    => 'Adaptec RAID',
            'intel_raid'      => 'Intel RAID',
            'software_raid'   => 'Программный RAID',
            'no_raid'         => 'Без RAID контроллера',
        ];
    }
}

