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




	function hstngr_register_widget() {
		register_widget( 'hstngr_widget' );
		}
		
		add_action( 'widgets_init', 'hstngr_register_widget' );
		
		class hstngr_widget extends WP_Widget {
		
	function __construct() {
	// widget ID + widget name + widget description
		parent::__construct('hstngr_widget', __('Hostinger Sample Widget', ' hstngr_widget_domain'),
		array( 'description' => __( 'Hostinger Widget Tutorial', 'hstngr_widget_domain' ), )
		);
	}
	
	
	// debut formulaire client
	
	public function widget( $args, $instance ) {
	//    var_dump(get_posts());
	
	//    extract($args);
	
	// Paramètres du widget – Je récupère les 4 articles les plus récents
		$args = array('posts_per_page' => -1);
	
	// Récupération des articles dans la variable $lastposts
		$lastposts = get_posts($args);
	//    $thumburl = get_the_post_thumbnail($post->ID);
	
	
	
	// Boucle pour afficher les articles
	
	echo '<form id="order-form" action="mailto:planty.drinks@gmail.com" method="post" enctype="text/plain"><div class="productimage">';
	foreach ( $lastposts as $post ) : setup_postdata($post); ?>
	<article>
		<div class="product-info">
			<?php echo get_the_post_thumbnail($post->ID); ?>
			<div><h3><?php echo $post->post_title; ?> </h3></div>
		</div>
	<input class="formcomnbr" type="number" name="<?php echo $post->post_name; ?>" value="0">
	</article>
	<?php endforeach;
	echo '</div>';   
	
	?>
	
	
	<div class="formulairedeuxcolonnes">
		<article>
			<h3>Vos informations</h3>
			<p><label>Nom</p><p>
		<span><input size="40" class= "formulairecommande2" value="" type="text" name="nom-famille" id="nomformcomm" /></span>
			</p>
			<p><label>Prénom</p><p>
			<span><input size="40" class= "formulairecommande2" value="" type="text" name="prenom" id="nomformcomm" /></span>
			</p>
			<p><label>E-mail</p><p>
			<span><input size="40" class= "formulairecommande2" value="" type="text" name="email" id="nomformcomm" /></span>
			</p>
		</article>
		<article>
			<h3>Livraison</h3>
			<p><label>Adresse de livraison</p><p>
			<span><input size="40" class= "formulairecommande2" value="" type="text" name="nomderue" id="nomformcomm" /></span>
			</p>
			<p><label>Code postal</p><p>
			<span><input size="40" class= "formulairecommande2" value="" type="text" name="codepostal" id="nomformcomm" /></span>
			</p>
			<p><label>Ville</p><p>
			<span><input size="40" class= "formulairecommande2" value="" type="text" name="ville" id="nomformcomm" /></span>
			</p>
	</div>
	<div class="boutonenvoyercommande">
			<p><input id="IDEnvoiCommande" tpye="submit" value="Commander" />
			</p>
	</article>
	</div>
	</form>
	<?php
		}
	
	// fin formulaire
	
	
		
		}
	