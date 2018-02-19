<?php
/*
 * Plugin Panel Class
 */
class WPSL_Panel {
	public function __construct() {
		add_action( 'admin_menu', array(&$this, 'register_page') );
		add_action( 'admin_init', array(&$this, 'register_settings') );
	}
	public function register_page() {
		if( is_plugin_active('accessible-poetry/accessible-poetry.php') ) {
			add_submenu_page(
				'accessible-poetry',
				'Skiplinks',
				'Skiplinks',
				'manage_options',
				'submenu-page',
				array(&$this, 'create_page')
			);
		} else {
			add_menu_page(
				__( 'Accessibility', WPSL_ID ),
				__( 'Accessibility', WPSL_ID ),
				'manage_options',
				'accessibility',
				array(&$this, 'create_page'),
				'',
				32
			);
		}
	}
	public function register_settings() {
		$options = get_option(WPSL_ID);
		if( isset($_POST[WPSL_ID]) ) {
			foreach ($_POST[WPSL_ID] as $field_key => $field_value) {
				$options[$field_key] = $field_value;
				update_option(WPSL_ID, $options);
			}
		}
	}
	public function create_page() {
		$this->options = get_option( WPSL_ID );
		$everaccess_siteurl = ( is_rtl() ) ? 'https://www.everaccess.co.il/' : 'https://everaccess.io/';
		echo '<form method="post" action="">';
		settings_fields( WPSL_ID );
		?>
		<div id="wpsl-panel" class="wrap">
			<h1 class="wp-heading-inline"><?php echo WPSL_NAME;?></h1>
			<div class="wrap-everaccess">
				<div class="panel-content card">
					<div class="sections-wrap">
						<section>
							<h2><?php _e('General', WPSL_ID);?></h2>
							<?php wpsl_panel_field('select', 'side', __('Side', WPSL_ID), array(
								'none'  => __('Center', WPSL_ID),
								'right'  => __('Right', WPSL_ID),
								'left'  => __('Left', WPSL_ID),
							), 2, true);?>
						</section>
						<section>
							<h2><?php _e('Design', WPSL_ID);?></h2>
							<?php wpsl_panel_field('color', 'bgcolor', __('Background Color', WPSL_ID), '', 2, true);?>
							<?php wpsl_panel_field('color', 'color', __('Text Color', WPSL_ID), '', 2, true);?>
							<?php wpsl_panel_field('number', 'fontsize', __('Font Size (in pixels)', WPSL_ID), '', 2, true);?>
						</section>

						<section>
							<h2><?php _e('Structure', 'everaccess');?></h2>
							<p><?php _e('Set the structure of fixed components and default objects. to hide skip-link object simply leave the field enpty.', 'everaccess');?></p>

							<?php if( $taxonomies ) : ?>
								<div class="ea-panel-archives">
									<h3><?php _e('Archives', 'everaccess');?></h3>
									<?php foreach($taxonomies as $tax) : $taxonomy = get_taxonomy($tax); ?>
										<?php
										?>
										<?php if( $tax != 'post_format' ) : ?>
											<div class="ea-toggler">
												<button type="button" class="btn-toggler" data-id="#ea-pside-<?php echo $tax;?>"><?php echo $taxonomy->label;?></button>
											</div>
										<?php endif; ?>

									<?php endforeach; ?>
								</div>
							<?php endif; ?>


							<?php if( $post_types ) : ?>
								<div class="ea-panel-post_types">
									<h3><?php _e('Post Types', 'everaccess');?></h3>
									<?php foreach($post_types as $type) : ?>
										<?php if( $type->name != 'attachment') : ?>
											<div class="ea-toggler">
												<button type="button" class="btn-toggler" data-id="#ea-pside-<?php echo $type->name;?>"><?php echo $type->label;?></button>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</section>
					</div>
				</div>
				<div class="panel-side card">
					<?php if( $post_types ) : ?>
						<div class="wp-clearfix">
							<?php foreach($post_types as $type) : if( $type->name != 'attachment' ) : ?>

								<div id="ea-pside-<?php echo $type->name; ?>" class="ea-side-show toggler-content hidden">
									<h4><?php echo $type->label; ?></h4>
									<button type="button" class="ea-add-skiplink">Add</button>
									<ul class="menu ui-sortable">
									</ul>
								</div>
							<?php endif; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php
					if( $taxonomies ) {
						foreach($taxonomies as $tax) {
							$taxonomy = get_taxonomy($tax);
							if( $tax != 'post_format' ) {
								echo '<div id="ea-pside-' . $tax . '" class="ea-side-show toggler-content hidden">';
								echo '  <h4>' . $taxonomy->label . '</h4>';
								wpsl_panel_field('text', $tax . '-id', $taxonomy->label . ' ' . __('content ID', 'everaccess'), '', 2, true);
								wpsl_panel_field('text', $tax . '-text', $taxonomy->label . ' ' . __('content text', 'everaccess'), '', 2, true);
								wpsl_panel_field('text', $tax . '-sidebar-id', $taxonomy->label . ' ' . __('sidebar ID', 'everaccess'), '', 2, true);
								wpsl_panel_field('text', $tax . '-sidebar-text', $taxonomy->label . ' ' . __('sidebar text', 'everaccess'), '', 2, true);
								echo '</div>';
							}
						}
					}
					?>
				</div>
			</div>
		</div>
		<?php submit_button();?>
		</form>
		<?php
	}
}


new WPSL_Panel();