<?php

/**
 * slick-slider-block Block Template.
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
$slick_slider_query = get_query($query_settings);

$general_settings = get_field('general_settings');
$spacing = $general_settings['spacing'];
$background_colour = $general_settings['background_colour'];

$avatar = default_placeholder_image();

//Importing Slick slicer
wp_enqueue_style("slick-css");
wp_enqueue_script("slick-js");
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

<?php if ($slick_slider_query->have_posts()): ?>
    <div class="slick-slider-block <?= $spacing ?>" id="<?= $block_id ?>">
        <div class="slick-slider-block-wrapper">
            <div class="slick-slider slick-slider-block-wrapper-slider">
                <?php
                while ($slick_slider_query->have_posts()):
                    $slick_slider_query->the_post();
                    $title = get_the_title();
                    $image_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $avatar;
                    $locations_group = get_field('locations_group', get_the_ID());
                    $address = $locations_group['address'] ?? null; ?>
                    <div class="slick-slider-block-wrapper-slider-slide">
                        <img src="<?= $image_url ?>" alt="" class="slick-slider-block-wrapper-slider-slide-image">
                        <div class="slick-slider-block-wrapper-slider-slide-overlay"></div>
                        <div class="slick-slider-block-wrapper-slider-slide-information">
                            <div class="slick-slider-block-wrapper-slider-slide-information-title">
                                <?= $title ?>
                            </div>
                            <?php if ($address): ?>
                                <div class="slick-slider-block-wrapper-slider-slide-information-address">
                                    <span class="dashicons dashicons-location"></span>
                                    <span>
                                        <?= $address ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
            <div class="slick-slider-pagination">
                <a class="slick-slider-pagination-prev-btn">
                    <span class="uagb-svg-wrapper"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M512 256C512 273.7 497.7 288 480 288H160.1l0 72c0 9.547-5.66 18.19-14.42 22c-8.754 3.812-18.95 2.077-25.94-4.407l-112.1-104c-10.24-9.5-10.24-25.69 0-35.19l112.1-104c6.992-6.484 17.18-8.218 25.94-4.406C154.4 133.8 160.1 142.5 160.1 151.1L160.1 224H480C497.7 224 512 238.3 512 256z">
                            </path>
                        </svg></span>
                </a>
                <a class="slick-slider-pagination-next-btn">
                    <span class="uagb-svg-wrapper"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M504.3 273.6l-112.1 104c-6.992 6.484-17.18 8.218-25.94 4.406c-8.758-3.812-14.42-12.45-14.42-21.1L351.9 288H32C14.33 288 .0002 273.7 .0002 255.1S14.33 224 32 224h319.9l0-72c0-9.547 5.66-18.19 14.42-22c8.754-3.809 18.95-2.075 25.94 4.41l112.1 104C514.6 247.9 514.6 264.1 504.3 273.6z">
                            </path>
                        </svg></span>
                </a>
            </div>
        </div>
    </div>
<?php else:
    echo "No posts were found";
endif; ?>

<script>
    (function ($) {
        $('.slick-slider').slick({
            centerMode: true,
            arrows: false,
            centerPadding: '60px',
            slidesToShow: 3,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
            ]
        });

        $(".slick-slider-pagination-prev-btn").click(function () {
            $(".slick-slider").slick("slickPrev");
        });

        $(".slick-slider-pagination-next-btn").click(function () {
            $(".slick-slider").slick("slickNext");
        });
    }(jQuery))
</script>