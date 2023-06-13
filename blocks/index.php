<?php

add_action('init', 'register_acf_blocks');
function register_acf_blocks()
{
    register_block_type(__DIR__ . '/testimonial');
    register_block_type(__DIR__ . '/singularlocations-slider');
}