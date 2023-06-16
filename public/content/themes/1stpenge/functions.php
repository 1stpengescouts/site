<?php

function bs_1stpenge_block_assets() {
    wp_enqueue_style('bs-1stpenge-theme',
        get_stylesheet_directory_uri() . '/assets/css/app.css',
        ['theme'],
        wp_get_theme()->get('Version')
    );
}

add_action('enqueue_block_assets', 'bs_1stpenge_block_assets', 20);
