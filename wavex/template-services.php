<?php
/**
 * Template Name: Services Overview
 * Template Post Type: page
 *
 * Lists every service once per group at /services/.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/components/page-hero', null, array(
		'title'   => get_the_title(),
		'eyebrow' => __( 'Everything we offer', 'wavex' ),
		'text'    => has_excerpt() ? get_the_excerpt() : __( 'Everything WaveX Technology offers, grouped by web and WordPress, mobile apps, and SEO and marketing.', 'wavex' ),
	) );
endwhile;

$services = wavex_services();
$areas    = array(
	'web-wordpress' => array( 'web', 'layout', __( 'Websites, WordPress platforms, e-commerce and the software that connects them.', 'wavex' ) ),
	'mobile-apps'   => array( 'mobile', 'mobile', __( 'Mobile apps from first idea through launch and ongoing support.', 'wavex' ) ),
	'seo-marketing' => array( 'seo', 'megaphone', __( 'Search visibility, content, social media and a clear digital strategy.', 'wavex' ) ),
);
$labels   = wavex_service_groups();
?>
<div class="sv" data-services>
	<div class="sv-bar">
		<ul class="sv-bar__jump">
			<?php foreach ( $areas as $group_slug => $area ) : ?>
				<li class="gtheme gtheme--<?php echo esc_attr( $area[0] ); ?>"><a href="#<?php echo esc_attr( $group_slug ); ?>"><i></i><?php echo esc_html( $labels[ $group_slug ] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<label class="sv-bar__search">
			<?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Find a service', 'wavex' ); ?></span>
			<input type="search" placeholder="<?php esc_attr_e( 'Find a service…', 'wavex' ); ?>" data-sv-filter autocomplete="off">
		</label>
	</div>

	<?php foreach ( $areas as $group_slug => $area ) : ?>
		<?php
		$list = array();
		foreach ( $services as $slug => $service ) {
			if ( in_array( $group_slug, $service['groups'], true ) ) {
				$list[ $slug ] = $service;
			}
		}
		?>
		<section class="sv-area gtheme gtheme--<?php echo esc_attr( $area[0] ); ?>" id="<?php echo esc_attr( $group_slug ); ?>" aria-labelledby="<?php echo esc_attr( $group_slug ); ?>-title" data-sv-area>
			<aside class="sv-area__panel">
				<span class="sv-area__ico"><?php echo wavex_icon( $area[1] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<p class="sv-area__count"><?php echo esc_html( sprintf( /* translators: %d: number of services. */ _n( '%d service', '%d services', count( $list ), 'wavex' ), count( $list ) ) ); ?></p>
				<h2 class="sv-area__title" id="<?php echo esc_attr( $group_slug ); ?>-title"><?php echo esc_html( $labels[ $group_slug ] ); ?></h2>
				<p><?php echo esc_html( $area[2] ); ?></p>
				<?php wavex_cta_button( sprintf( /* translators: %s: area name. */ __( 'Talk about %s', 'wavex' ), $labels[ $group_slug ] ), $labels[ $group_slug ], 'whatsapp' ); ?>
			</aside>
			<ul class="sv-grid">
				<?php foreach ( $list as $slug => $service ) : ?>
					<li data-sv-item data-text="<?php echo esc_attr( strtolower( $service['title'] . ' ' . $service['text'] ) ); ?>">
						<a class="sv-card" href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>">
							<span class="sv-card__badge"><span><?php echo wavex_icon( $service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>
							<span class="sv-card__body">
								<strong><?php echo esc_html( $service['title'] ); ?></strong>
								<span><?php echo esc_html( $service['text'] ); ?></span>
							</span>
							<span class="sv-card__go"><?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endforeach; ?>

	<p class="sv-empty" data-sv-empty hidden><?php esc_html_e( 'No service matches that search. Try another word, or message us and we will point you to the right one.', 'wavex' ); ?></p>
</div>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
