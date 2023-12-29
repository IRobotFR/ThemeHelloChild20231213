<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


// add_filter( 'wp_nav_menu_items', 'add_extra_item_to_nav_menu', 10, 2 );
// function add_extra_item_to_nav_menu( $items, $args ) {
// 	$items 	.= '<li><a href="#">Admin</a></li>';
// 	$args['menu'] = 'Visiteur';
// 	$args['container'] = 'div';
// 	$args['menu'] = 'Visiteur';

// 	var_dump($args);
//     return $items;
// }

// wp_nav_menu( array(
// 	'theme_location' => is_user_logged_in() ? 'menu=7' : 'menu=6'
// ) );


// Essai pour cibler le menu du header

function wpc_wp_nav_menu_args( $args = '' ) {
	if( is_user_logged_in()) { 
		if( 'menu-1' == $args['theme_location'] ) { 
		//top_navigation is specific to Avada in my case
			$args['menu'] = 'connecte';
		}
	} else { 
		if( 'menu-1' == $args['theme_location'] ) { 
		//again, top_navigation is specific to Avada in my case
			$args['menu'] = 'visiteur';
		}
	} 
		return $args;
	}
	add_filter( 'wp_nav_menu_args', 'wpc_wp_nav_menu_args' );



// Debit widget pour affichage images posts

	function hstngr_register_widget() {
		register_widget( 'hstngr_widget' );
		}
		
		add_action( 'widgets_init', 'hstngr_register_widget' );
		
		class hstngr_widget extends WP_Widget {
		
		function __construct() {
	// widget ID + widget name + widget description
			parent::__construct('hstngr_widget',
			__('Hostinger Sample Widget', ' hstngr_widget_domain'),
			array( 'description' => __( 'Hostinger Widget Tutorial', 'hstngr_widget_domain' ), )
			);
		}
	
	// // debut formulaire client
	
	//     public function widget( $args, $instance ) {
	//         // $title = apply_filters( 'widget_title', $instance['title'] );
	//         $title = '';
	
	//         echo $args['before_widget'];
	
	// //if title is present
	//         if ( ! empty( $title ) )
	//         echo $args['before_title'] . $title . $args['after_title'];
	// //output
	//         echo __( 'Hello, World from Tilo', 'hstngr_widget_domain' );
	//         echo $args['after_widget'];
	//     }
	// // fin formulaire
	
	// fin formulaire
	
	
	// debut affichage a gauche sur elementor    
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
			else
			$title = __( 'Default Title', 'hstngr_widget_domain' );
	?>
		<p>administration</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
	
	<?php
		}
	
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
		}
		
		}










