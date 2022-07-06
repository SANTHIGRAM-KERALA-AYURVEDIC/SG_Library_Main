<?php 
// Do not allow directly accessing this file.
if ( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}

class Academix_Latest_Events_Widget extends WP_Widget{
     
    //setup the widget name, description , etc.
    public function __construct(){

		$widget_ops = array(
			'calssname' => 'academix_latest_events_widget',
			'description' => esc_html__('Display Latest Events Widget', 'academix')
		);

		parent::__construct('academix_latest_events', esc_html__('Academix Latest Events', 'academix'), $widget_ops);
    }

    //back-end display of widget
    public function form( $instance ){

    	$title = ( !empty( $instance['title'] ) ? $instance['title'] : 'Latest Events' );
    	$total = ( !empty( $instance['total'] ) ? absint( $instance['total'] ) : 3 );
        $show_btn = ( !empty( $instance['show_btn'] ) ? $instance['show_btn'] : '1' );
        $btn_text = ( !empty( $instance['btn_text'] ) ? $instance['btn_text'] : 'View all Events' );
        $btn_link = ( !empty( $instance['btn_link'] ) ? $instance['btn_link'] : '#' );

?>
    	<p>
	        <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php echo esc_html('Title:', 'academix');?></label>
	        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" value="<?php echo esc_attr( $title );?>">
        </p>
        <p>
	        <label for="<?php echo esc_attr($this->get_field_id('total'));?>"><?php echo esc_html('Number of Events:', 'academix');?></label>
	        <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id('total'));?>" name="<?php echo esc_attr($this->get_field_name('total'));?>" value="<?php echo esc_attr( $total );?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_text'));?>"><?php echo esc_html('Button Text', 'academix');?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_text'));?>" name="<?php echo esc_attr($this->get_field_name('btn_text'));?>" value="<?php echo esc_attr( $btn_text );?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link'));?>"><?php echo esc_html('Button Link', 'academix');?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link'));?>" name="<?php echo esc_attr($this->get_field_name('btn_link'));?>" value="<?php echo esc_attr( $btn_link );?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_btn'));?>"><?php echo esc_html('Show Button?', 'academix');?></label>
            <input <?php checked($show_btn, '1'); ?> type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_btn'));?>" name="<?php echo esc_attr($this->get_field_name('show_btn'));?>" value="1">
        </p>

    <?php
    }


    //update widget
     public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'total' ] = ( !empty( $new_instance[ 'total' ] ) ? absint( strip_tags( $new_instance[ 'total' ] ) ) : 0 );
        $instance[ 'show_btn' ] = ( !empty( $new_instance[ 'show_btn' ] ) ? strip_tags( $new_instance[ 'show_btn' ]) : '');
        $instance[ 'btn_text' ] = ( !empty( $new_instance[ 'btn_text' ] ) ? strip_tags( $new_instance[ 'btn_text' ]) : '');
        $instance[ 'btn_link' ] = ( !empty( $new_instance[ 'btn_link' ] ) ? strip_tags( $new_instance[ 'btn_link' ]) : '');
		
		return $instance;
		
	}

	//front-end display of widget 
    public function widget( $args, $instance){

    	$total = absint( $instance['total'] );

    	$post_args = array(
    		'post_type' => 'event',
    		'posts_per_page' => $total,
    		'order' => 'DESC'
    	);

	    $allowed_tags = array(
		    'div' => array(
			    'id' => array(),
			    'class' => array()
		    ),
		    'h4' => array(
			    'class' => array()
		    )
	    );

    	$post_query = new WP_Query( $post_args );
        echo '<div>';
	    echo wp_kses($args['before_widget'], $allowed_tags);

	    if( !empty( $instance['title'] )){
		    echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
	    }

    	if ( $post_query->have_posts() ):
         
            echo '<ul class="event-list list-unstyled">';

    		while( $post_query->have_posts() ) : $post_query->the_post();
            $prefix = '_academix_';
            $idd = get_the_ID();

            if( get_post_meta( $idd , $prefix . 'event_date', true) ){
                $event_date = get_post_meta( $idd , $prefix . 'event_date', true);
            } else{
                $event_date = '';
            }
            
    			echo '<li>';
                echo '<h4 class="title"><a href="'.esc_url( get_the_permalink( $idd ) ).'">'.get_the_title( $idd ).'</a></h4>';
                echo '<div class="date">'.date_i18n(get_option( 'date_format' ), $event_date).'</div>';
                echo '</li>';

    		endwhile;

            echo '</ul>';
            if( $instance['show_btn'] == '1' ){
            echo '<div class="action-wrap"><a href="'.esc_url($instance['btn_link']).'" class="btn btn-unsolemn btn-action">'.esc_html($instance['btn_text']).'</a></div>';
            }

    	endif;
        
        wp_reset_postdata();

	    echo wp_kses($args['after_widget'], $allowed_tags);
        echo '</div>';
    }
}

function academix_register_latest_events_widget(){
    register_widget('Academix_Latest_Events_Widget');
}
add_action('widgets_init', 'academix_register_latest_events_widget');