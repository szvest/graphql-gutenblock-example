<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load PHP registration of blocks after plugins (such as Gutenberg) have been loaded.
 */
add_action( 'plugins_loaded', function() {
	require_once( trailingslashit( dirname( __FILE__ ) ) . 'graphql-recent-posts/block.php' );
});

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * `wp-blocks`: includes block type registration and related functions.
 *
 * @since 1.0.0
 */
function graphql_gutenblock_example_cgb_block_assets() {
	// Styles.
	wp_enqueue_style(
		'graphql_gutenblock_example-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: filemtime — Gets file modification time.
	);
} // End function graphql_gutenblock_example_cgb_block_assets().

// Hook: Frontend assets.
add_action( 'enqueue_block_assets', 'graphql_gutenblock_example_cgb_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * `wp-blocks`: includes block type registration and related functions.
 * `wp-element`: includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */
function graphql_gutenblock_example_cgb_editor_assets() {
	// Scripts.
	wp_enqueue_script(
		'graphql_gutenblock_example-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ), // Dependencies, defined above.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	/**
	 * Enqueue styles for the Ant Design component library
	 */
	wp_enqueue_style(
		'antd',
		'https://cdnjs.cloudflare.com/ajax/libs/antd/3.6.4/antd.min.css',
		array( 'graphql_gutenblock_example-cgb-block-editor-css' )
	);

	// Styles.
	wp_enqueue_style(
		'graphql_gutenblock_example-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: filemtime — Gets file modification time.
	);
} // End function graphql_gutenblock_example_cgb_editor_assets().

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'graphql_gutenblock_example_cgb_editor_assets' );
