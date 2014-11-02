<?php
// Frontend View of Slider

// Enqueue Stylesheet and Script only where loaded
wp_enqueue_style('recent-posts-flexslider-widget-styles');
wp_enqueue_script('recent-posts-flexslider-script');

// Query DB for slides
$flex_args = array(
    'cat' => $categories,
    'post_status' => 'publish',
    'post_type' => $post_type_array,
    'showposts' => $slider_count,
    'ignore_sticky_posts' => true,
);

$flex_query = new WP_Query($flex_args);

// Call class to display slider
$display = new Recent_Posts_FlexSlider();

?>

<div class="section-head"><?php if (!empty($title)) {
        echo $title;
    }; ?></div>

<div id="slider-wrap">
    <div class="flexslider" <?php /* Remove margin if only one slide */
    if ($slider_count == 1) {
        echo 'style="margin: 0;"';
    } ?>>
        <ul class="slides">
            <?php
            if ($flex_query->have_posts()) : while ($flex_query->have_posts()): $flex_query->the_post();
                $output = '<li style="text-align:center; max-height: ' . $slider_height . 'px;">';

                // Start link of slide to post (option set on Appearance->Widgets)
                if ($post_link == 'true'):
                    $output .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                endif;

                $output .= '<div style="height: ' . $slider_height . 'px">';
                $output .= $display->get_recent_post_flexslider_image("medium-thumb");
                $output .= '</div>';

                // Display Post Title and/or Excerpt (option set on Appearance->Widgets)
                if ($post_title == 'true' || $post_excerpt == 'true'):
                    $output .= '<div class="flexslider-caption"><div class="flexslider-caption-inner">';
                    if ($post_title == 'true'):
                        $output .= '<p>' . get_the_title() . '</p>';
                    endif;
//                    if ($post_excerpt == 'true'):
//                        $output .= '<p>' . $display->recent_post_flexslider_excerpt(get_the_content(), $excerpt_length) . '</p>';
//                    endif;
                    $output .= '</div></div>';
                endif;

                // End link of slide to post (if option is selected in widget options)
                if ($post_link == 'true'):
                    $output .= '</a>';
                endif;

                $output .= '</li>';

                echo $output;
            endwhile; endif;
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>

<script type="text/javascript">
    (function ($) {
        "use strict";
        $(function () {
            jQuery('.flexslider').flexslider({
                animation: 'slide',
                animationLoop: false,
                itemWidth: 300,
                itemMargin: 30,
                minItems: 3,
                maxItems: 4,
                controlNav: false,
                slideshow: false,
//                itemMargin: 10,
            });
        });
    }(jQuery));
</script>