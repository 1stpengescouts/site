<?php

function bs_1stpenge_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . PHP_EOL;
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . PHP_EOL;
}

add_action('wp_head', 'bs_1stpenge_preconnect', 2);

function bs_1stpenge_block_assets() {
    wp_dequeue_script('theme-script');

    wp_enqueue_style(
        'Nunito+Sans',
        'https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600;1,700;1,900&display=swap'
    );
    wp_enqueue_style(
        'bs-1stpenge-theme',
        get_stylesheet_directory_uri() . '/assets/css/app.css',
        ['Nunito+Sans', 'theme'],
        wp_get_theme()->get('Version')
    );
}

add_action('enqueue_block_assets', 'bs_1stpenge_block_assets', 21);

function bs_1stpenge_global_styles() {
    $wp_styles = wp_styles();
    $inline = $wp_styles->get_data('global-styles', 'after');
    $pattern = '/(--wp--preset--color--(black|white|primary|secondary|scout-[a-zA-Z0-9-]+):(\s+)([^;]+);)/m';

    $inline = preg_replace_callback($pattern, function ($matches) {
        [, $rule, $color, $ws, $hex] = $matches;
        $hex = $color === 'black' ? tint($hex, .15) : shade($hex, .15);

        return sprintf('%s--wp--preset--color--%s-hover:%s%s;', $rule, $color, $ws, $hex);
    }, $inline);

    $wp_styles->add_data('global-styles', 'after', $inline);
}

add_action('wp_enqueue_scripts', 'bs_1stpenge_global_styles');
