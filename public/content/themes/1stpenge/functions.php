<?php

function bs_1stpenge_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . PHP_EOL;
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . PHP_EOL;
}

add_action('wp_head', 'bs_1stpenge_preconnect', 2);

function bs_1stpenge_block_assets() {
    wp_enqueue_style(
        'Nunito+Sans',
        'https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap'
    );
    wp_enqueue_style(
        'bs-1stpenge-theme',
        get_stylesheet_directory_uri() . '/assets/css/app.css',
        ['Nunito+Sans', 'theme'],
        wp_get_theme()->get('Version')
    );
}

add_action('enqueue_block_assets', 'bs_1stpenge_block_assets', 20);
