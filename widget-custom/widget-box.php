<?php
/*
Plugin Name: Widget Plugin
Description: Site specific code changes for example.com
*/
/* Start Adding Functions Below this Line */


/* Stop Adding Functions Below this Line */
class wpb_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
// Base ID of your widget
            'wpb_widget',

// Widget name will appear in UI
            __('Widget Box', 'wpb_widget_domain'),

// Widget description
            array('description' => __('Widget suggestion box', 'wpb_widget_domain'),)
        );
    }

// Creating widget front-end
// This is where the action happens
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
?>
        <style>
            h4.ad-header-box{
                font-size: 14px;
                line-height: 30px;
                font-family: "Helvetica";
                color: #000000;
                border-bottom: none !important;
                text-align: center;
                font-weight: bold !important;
            }
            .widget-ad{
                text-align: center;
            }
            .clear{
                clear: both;
            }
            .title-box{
                line-height: 30px;
            }
            .title-box a{
                font-size: 17px;
                font-weight: bold;
            }
            .price{
                line-height: 20px;
                font-size: 15px;
                color: #e54d45 !important;
            }
        </style>
        <?php if(is_home()){ ?>
        <h4 class="ad-header-box"><?php _e('Smart Box Gia Đình', 'mvp-text'); ?></h4>
        <div class="widget-ad">
            <?php
            $f_api = "https://nhacon.com/api/boxTemplate?nested=true&filter=[{'property':'root_category_id','value':8}]&ctime=1412737314465";
            $family_box_data = $this->get_data_from_api($f_api);
            $f_box = $this->array_random($family_box_data->data->bundleTemplate);
            ?>
            <div class="image-box">
                <img src="<?php echo $f_box->images[0]->image_url ?>" />
            </div>
            <div class="clear"></div>
            <div class="title-box">
                <a target="_blank" href="https://nhacon.com/boxdetail.html?id=<?php echo $f_box->id;  ?>">
                    <?php echo $f_box->name; ?>
                </a>
            </div>
            <div class="clear"></div>
            <div class="price"><?php echo number_format($f_box->price,0,'.','.'); ?> VNĐ </div>
        </div><!--widget-ad-->
        <div class="clear"></div>
        <h4 class="ad-header-box"><?php _e('Smart Box Em Bé', 'mvp-text'); ?></h4>
        <div class="widget-ad">
            <?php
            $b_api = "https://nhacon.com/api/boxTemplate?nested=true&filter=[{'property':'root_category_id','value':1}]&ctime=1412737314465";
            $baby_box_data = $this->get_data_from_api($b_api);
            $b_box = $this->array_random($baby_box_data->data->bundleTemplate);
            ?>
            <div class="image-box">
                <img src="<?php echo $b_box->images[0]->image_url ?>" />
            </div>
            <div class="clear"></div>
            <div class="title-box">
                <a target="_blank" href="https://nhacon.com/boxdetail.html?id=<?php echo $b_box->id;  ?>">
                    <?php echo $b_box->name; ?>
                </a>
            </div>
            <div class="clear"></div>
            <div class="price"><?php echo number_format($b_box->price,0,'.','.'); ?> VNĐ </div>
        </div>
        <div class="clear"></div>
        <!--widget-ad-->
        <h4 class="ad-header-box"><?php _e('Smart Box Làm Đẹp', 'mvp-text'); ?></h4>
        <div class="widget-ad">
            <?php
            $m_api = "https://nhacon.com/api/boxTemplate?nested=true&filter=[{'property':'root_category_id','value':2}]&ctime=1412737314465";
            $beauty_box_data = $this->get_data_from_api($m_api);
            $m_box = $this->array_random($beauty_box_data->data->bundleTemplate);
            ?>
            <div class="image-box">
                <img src="<?php echo $m_box->images[0]->image_url ?>" />
            </div>
            <div class="clear"></div>
            <div class="title-box">
                <a target="_blank" href="https://nhacon.com/boxdetail.html?id=<?php echo $m_box->id;  ?>">
                    <?php echo $m_box->name; ?>
                </a>
            </div>
            <div class="clear"></div>
            <div class="price"><?php echo number_format($m_box->price,0,'.','.'); ?> VNĐ </div>
        </div><!--widget-ad-->
    <?php }else{ ?>
        <?php
        $category = get_the_category();
        if(empty($category[0]->parent)){
            $root_cat = $category[0];
        }else{
            $root_cat = $category[1];
        }
        ?>
        <?php if($root_cat->slug == 'em-be'){ ?>
            <h4 class="ad-header-box"><?php _e('Smart Box Em Bé', 'mvp-text'); ?></h4>
            <div class="widget-ad">
                <?php
                $b_api = "https://nhacon.com/api/boxTemplate?nested=true&filter=[{'property':'root_category_id','value':1}]&ctime=1412737314465";
                $baby_box_data = $this->get_data_from_api($b_api);
                $b_box = $this->array_random($baby_box_data->data->bundleTemplate);
                ?>
                <div class="image-box">
                    <img src="<?php echo $b_box->images[0]->image_url ?>" />
                </div>
                <div class="clear"></div>
                <div class="title-box">
                    <a target="_blank" href="https://nhacon.com/boxdetail.html?id=<?php echo $b_box->id;  ?>">
                        <?php echo $b_box->name; ?>
                    </a>
                </div>
                <div class="clear"></div>
                <div class="price"><?php echo number_format($b_box->price,0,'.','.'); ?> VNĐ </div>
            </div>
        <?php } ?>
        <?php if($root_cat->slug == 'gia-dinh'){ ?>
            <h4 class="ad-header-box"><?php _e('Smart Box Gia đình', 'mvp-text'); ?></h4>
            <div class="widget-ad">
                <?php
                $f_api = "https://nhacon.com/api/boxTemplate?nested=true&filter=[{'property':'root_category_id','value':8}]&ctime=1412737314465";
                $family_box_data = $this->get_data_from_api($f_api);
                $f_box = $this->array_random($family_box_data->data->bundleTemplate);
                ?>
                <div class="image-box">
                    <img src="<?php echo $f_box->images[0]->image_url ?>" />
                </div>
                <div class="clear"></div>
                <div class="title-box">
                    <a target="_blank" href="https://nhacon.com/boxdetail.html?id=<?php echo $f_box->id;  ?>">
                        <?php echo $f_box->name; ?>
                    </a>
                </div>
                <div class="clear"></div>
                <div class="price"><?php echo number_format($f_box->price,0,'.','.'); ?> VNĐ</div>
            </div>
        <?php } ?>
        <?php if($root_cat->slug == 'lam-dep'){ ?>
            <h4 class="ad-header-box"><?php _e('Smart Box Làm đẹp', 'mvp-text'); ?></h4>
            <div class="widget-ad">
                <?php
                $m_api = "https://nhacon.com/api/boxTemplate?nested=true&filter=[{'property':'root_category_id','value':2}]&ctime=1412737314465";
                $beauty_box_data = $this->get_data_from_api($m_api);
                $m_box = $this->array_random($beauty_box_data->data->bundleTemplate);
                ?>
                <div class="image-box">
                    <img src="<?php echo $m_box->images[0]->image_url ?>" />
                </div>
                <div class="clear"></div>
                <div class="title-box">
                    <a target="_blank" href="https://nhacon.com/boxdetail.html?id=<?php echo $m_box->id;  ?>">
                        <?php echo $m_box->name; ?>
                    </a>
                </div>
                <div class="clear"></div>
                <div class="price"><?php echo number_format($m_box->price,0,'.','.'); ?> VNĐ </div>
            </div>
        <?php } ?>
    <?php } ?>
        <?php
// This is where you run the code and display the output
//        echo __('Hello, World!', 'wpb_widget_domain');
        echo $args['after_widget'];
    }
    function get_data_from_api($api)
    {
        $ch = curl_init();
//        $timeout = 5;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$api);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data);
    }
    function array_random($arr, $num = 1) {
        shuffle($arr);

        $r = array();
        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }
        return $num == 1 ? $r[0] : $r;
    }
// Widget Backend
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Suggest Box', 'wpb_widget_domain');
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
    <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget()
{
    register_widget('wpb_widget');
}

add_action('widgets_init', 'wpb_load_widget');
?>
