<?php
/**
 * Home: three alternating feature rows, one per service area, each with an image.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();

$rows = array(
	array(
		'group'   => 'web-wordpress',
		'tone'    => 'primary',
		'eyebrow' => __( 'Web & WordPress', 'wavex' ),
		'title'   => __( 'Websites engineered around how your business works', 'wavex' ),
		'text'    => __( 'From responsive design and WordPress development to e-commerce, API integration and maintenance, we build and look after websites you can manage and grow.', 'wavex' ),
		'items'   => array( 'web-development', 'wordpress-development', 'ecommerce-development', 'api-integration' ),
		'image'   => array( 'img_web', 'img-web.svg', __( 'Illustration of a website with code and an analytics card', 'wavex' ) ),
	),
	array(
		'group'   => 'mobile-apps',
		'tone'    => 'accent',
		'eyebrow' => __( 'Mobile Apps', 'wavex' ),
		'title'   => __( 'Apps shaped from first idea to launch and beyond', 'wavex' ),
		'text'    => __( 'Shape the idea with MVP and product discovery, design the experience, develop the app, then modernize and maintain it as your needs change.', 'wavex' ),
		'items'   => array( 'mvp-development', 'mobile-app-design', 'mobile-app-development', 'app-modernization' ),
		'image'   => array( 'img_mobile', 'img-mobile.svg', __( 'Illustration of two mobile app screens', 'wavex' ) ),
	),
	array(
		'group'   => 'seo-marketing',
		'tone'    => 'mix',
		'eyebrow' => __( 'SEO & Marketing', 'wavex' ),
		'title'   => __( 'Visibility built on solid technical foundations', 'wavex' ),
		'text'    => __( 'Technical and on-page SEO help search engines understand your site, while content, social media and digital strategy support the growth that follows.', 'wavex' ),
		'items'   => array( 'technical-seo', 'on-page-seo', 'content-marketing', 'digital-strategy' ),
		'image'   => array( 'img_seo', 'img-seo.svg', __( 'Illustration of a search bar and a growth chart', 'wavex' ) ),
	),
);
?>
<?php foreach ( $rows as $i => $row ) : ?>
	<section class="feature feature--<?php echo esc_attr( $row['tone'] ); ?><?php echo ( $i % 2 ) ? ' feature--flip' : ''; ?>" aria-labelledby="feature-<?php echo (int) $i; ?>">
		<div class="feature__inner">
			<div class="feature__media">
				<?php wavex_theme_image( $row['image'][0], $row['image'][1], $row['image'][2], 'feature__img', array( 'loading' => 'lazy' ) ); ?>
			</div>
			<div class="feature__copy">
				<p class="eyebrow"><?php echo esc_html( $row['eyebrow'] ); ?></p>
				<h2 class="section__title" id="feature-<?php echo (int) $i; ?>"><?php echo esc_html( $row['title'] ); ?></h2>
				<p><?php echo esc_html( $row['text'] ); ?></p>
				<ul class="ticks">
					<?php foreach ( $row['items'] as $slug ) : ?>
						<li>
							<a href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>">
								<?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php echo esc_html( $services[ $slug ]['title'] ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
				<a class="btn btn--primary" href="<?php echo esc_url( wavex_url( 'services#' . $row['group'] ) ); ?>">
					<?php
					/* translators: %s: service area name. */
					echo esc_html( sprintf( __( 'Explore %s', 'wavex' ), $row['eyebrow'] ) );
					?>
				</a>
			</div>
		</div>
	</section>
<?php endforeach; ?>
