<?php
/**
 * jc-catalogue Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

$block_id = $block['id'];

$query_settings = get_field('query_settings');
$wp_jc_catalogue_query = get_query($query_settings);

$general_settings = get_field('general_settings');
$spacing = $general_settings['spacing'];
$background_colour = $general_settings['background_colour'];

$avatar = default_placeholder_image();

?>

<style>
    <?php
    $classes = <<<ITEM
	#$block_id{
		background-color: $background_colour;
	}
	ITEM;
    echo $classes; ?>
</style>

<?php if ($wp_jc_catalogue_query): ?>
    <div class="jc-catalogue <?= $spacing ?>" id="<?= $block_id ?>">
        <div class="jc-catalogue_wrapper">
            <?php
            while ($wp_jc_catalogue_query->have_posts()):
                $wp_jc_catalogue_query->the_post();
                $locations_group = get_field('locations_group', get_the_ID());
                $name = get_the_title();
                $address = $locations_group['address'] ?? null;
                $permalink = get_the_permalink();
                $image_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $avatar; ?>

                <a href="<?= $permalink ?>" class="jc-catalogue_wrapper_item">
                    <img class="jc-catalogue_wrapper_item_image" src="<?= $image_url ?>" alt="">
                    <div class="jc-catalogue_wrapper_item_overlay"></div>
                    <div class="jc-catalogue_wrapper_item_information">
                        <div class="jc-catalogue_wrapper_item_information_name">
                            <h2>
                                <?= $name ?>
                            </h2>
                        </div>
                        <?php if ($address): ?>
                            <div class="jc-catalogue_wrapper_item_information_icon">
                                <i class="fas fa-map-marker-alt">
                                    <?= $address ?>
                                </i>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
                <?php
            endwhile;
            ?>

        </div>
    </div>
<?php else:
    echo "No posts were found";
endif; ?>