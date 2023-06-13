<?php
/**
 * Singular locations slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

//$singularlocations_slider_query = get_query(get_field('query_settings'));

$singularlocations_slider_group = get_field('singularlocations_slider_group');
$category_id = $singularlocations_slider_group['categoria'];
$category = get_category($category_id);
$posts_per_page = $singularlocations_slider_group['posts_per_page'];
$singularlocations_slider_query_settings = ['post_types' => 'rooms', 'cat' => $category_id, 'posts_per_page' => $posts_per_page];
$singularlocations_slider_query = get_query($singularlocations_slider_query_settings);

if ($singularlocations_slider_query->have_posts()): ?>
    <div class="singularlocations_slider">
        <div class="singularlocations_slider_wrapper">
            <div class="singularlocations_slider_wrapper_info">
                <div class="singularlocations_slider_wrapper_info_category_name">
                    <?= $category->name ?>
                </div>
                <div style="display: none;;" class="singularlocations_slider_wrapper_info_category_text">colecciones</div>
                <div class="singularlocations_slider_wrapper_info_category_divider">
                    <hr>
                </div>
                <div class="singularlocations_slider_wrapper_info_category_description">
                    <?= category_description($category_id); ?>
                </div>
            </div>

            <div class="singularlocations_slider_wrapper_slider">
                <?php

                while ($singularlocations_slider_query->have_posts()) {
                    $singularlocations_slider_query->the_post();
                    the_title();
                }
                ; //while
                wp_reset_query(); ?>
            </div>
        </div>
    </div>
    <?php

else:
    echo "No posts were found";
endif;