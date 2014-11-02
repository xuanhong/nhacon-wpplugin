<?php
/*
Plugin Name: Facebook Plugin
Description: Site specific code changes for example.com
*/
/* Start Adding Functions Below this Line */


/* Stop Adding Functions Below this Line */
class facebook_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
// Base ID of your widget
            'facebook_widget',

// Widget name will appear in UI
            __('Widget Facebook', 'facebook_widget_domain'),

// Widget description
            array('description' => __('Widget facebook social', 'facebook_widget_domain'),)
        );
    }

// Creating widget front-end
// This is where the action happens
    public function widget($args, $instance)
    {
        /* Our variables from the widget settings. */
        $title = apply_filters('widget_title', $instance['title'] );
        $page_url = $instance['page_url'];
        $faces = $instance['faces'];
        $stream = $instance['stream'];
        $header = $instance['header'];
        $width = $instance['width'];
        $height = $instance['height'];
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        ?>

        <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $page_url; ?>&amp;width=<?php echo $width; ?>&amp;height=<?php echo $height; ?>&amp;show_faces=<?php if($faces) { echo 'true'; } else { echo 'false'; } ?>&amp;colorscheme=light&amp;stream=<?php if($stream) { echo 'true'; } else { echo 'false'; } ?>&amp;show_border=false&amp;header=<?php if($header) { echo 'true'; } else { echo 'false'; } ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
<?php
// This is where you run the code and display the output
//        echo __('Hello, World!', 'facebook_widget_domain');
        echo $args['after_widget'];
    }

// Widget Backend
    public function form($instance)
    {
        /* Set up some default widget settings. */
        $defaults = array( 'title' => 'Facebook', 'page_url' => 'http://www.facebook.com/envato', 'width' => 300, 'height' => 260, 'faces' => 'on', 'stream' => 'off', 'header' => 'off' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
        </p>

        <!-- Page URL -->
        <p>
            <label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Facebook Page URL:</label>
            <input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" style="width:90%;" />
            <small>Example: http://www.facebook.com/envato</small>
        </p>

        <!-- Faces -->
        <p>
            <label for="<?php echo $this->get_field_id( 'faces' ); ?>">Show Faces:</label>
            <input type="checkbox" id="<?php echo $this->get_field_id( 'faces' ); ?>" name="<?php echo $this->get_field_name( 'faces' ); ?>" <?php checked( (bool) $instance['faces'], true ); ?> />
        </p>

        <!-- Stream -->
        <p>
            <label for="<?php echo $this->get_field_id( 'stream' ); ?>">Show Stream:</label>
            <input type="checkbox" id="<?php echo $this->get_field_id( 'stream' ); ?>" name="<?php echo $this->get_field_name( 'stream' ); ?>" <?php checked( (bool) $instance['stream'], true ); ?> />
        </p>

        <!-- Header -->
        <p>
            <label for="<?php echo $this->get_field_id( 'header' ); ?>">Show Header:</label>
            <input type="checkbox" id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" <?php checked( (bool) $instance['header'], true ); ?> />
        </p>

        <!-- Widget Width -->
        <p>
            <label for="<?php echo $this->get_field_id( 'width' ); ?>">Like Box width:</label>
            <input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:20%;" />
        </p>

        <!-- Widget Height -->
        <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>">Like Box height:</label>
            <input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" style="width:20%;" />
        </p>
    <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['page_url'] = $new_instance['page_url'];
        $instance['faces'] = $new_instance['faces'];
        $instance['stream'] = $new_instance['stream'];
        $instance['header'] = $new_instance['header'];
        $instance['width'] = $new_instance['width'];
        $instance['height'] = $new_instance['height'];

        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function facebook_load_widget()
{
    register_widget('facebook_widget');
}
add_action('widgets_init', 'facebook_load_widget');
?>
