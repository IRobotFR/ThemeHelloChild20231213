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
		
			$args['menu'] = 'connecte';
		}
	} else { 
		if( 'menu-1' == $args['theme_location'] ) { 
		
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
	
	// Paramètres du widget – Je récupère les articles les plus récents
		$args = array('posts_per_page' => -1);
	
	// Récupération des articles dans la variable $lastposts
		$lastposts = get_posts($args);
	
	
	
	// Boucle pour afficher les articles
	
	echo '<form id="order-form" action="mailto:planty.drinks@gmail.com" method="post" enctype="text/plain"><div class="productimage">';
	foreach ( $lastposts as $post ) : setup_postdata($post); ?>
	<div>
		<div class="product-info">
			<?php echo get_the_post_thumbnail($post->ID); ?>
			<div><h3><?php echo $post->post_title; ?> </h3></div>
		</div>
	<input class="formcomnbr" type="number" name="<?php echo $post->post_name; ?>" value="0">
	</div>
	<?php endforeach;
	echo '</div>';   
	
	?>
	
	
	<hr>
	
	<div class="formulairedeuxcolonnes">
	
		<article class="colonne1">
			<h3>Vos informations</h3>
			<div><label for="nom-famille">Nom</label>
				<input class= "formulairecommande2" value="" type="text" name="nom-famille" id="nomformcomm" />
			</div>
			<div><label for="prenom">Prénom</label>
				<input class= "formulairecommande2" value="" type="text" name="prenom" id="nomformcomm" />
			</div>
			<div><label for="email">E-mail</label>
				<input class= "formulairecommande2" value="" type="text" name="email" id="nomformcomm" />
			</div>
		</article>
		<article class="colonne2">
			<h3>Livraison</h3>
			<div><label for="adresse-livraison">Adresse de livraison</label>
				<input class= "formulairecommande2" value="" type="text" name="nomderue" id="nomformcomm" />
			</div>
			<div><label for="code-postal">Code postal</label>
				<input class= "formulairecommande2" value="" type="text" name="codepostal" id="nomformcomm" />
			</div>
			<div><label for="ville">Ville</label>
					<input class= "formulairecommande2" value="" type="text" name="ville" id="nomformcomm" />
			</div>
		</article>
		<article class="boutonenbas">
				<div class="boutonenvoyercommande">
				<p><input id="IDEnvoiCommande" tpye="submit" value="Commander" />
				</p>
				</div>
		</article>
	</div>
	
	</form>
	<?php
		}
	
	// fin formulaire
	
	
		
		}
	