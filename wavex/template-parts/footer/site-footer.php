<?php
/**
 * Footer: brand, link columns, legal row.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$groups   = wavex_service_groups();
$services = wavex_services();
$email    = wavex_opt( 'contact_email' );
$phone    = wavex_opt( 'contact_phone' );

$company = array(
	array( __( 'About Us', 'wavex' ), 'about' ),
	array( __( 'Our Approach', 'wavex' ), 'our-approach' ),
	array( __( 'Why WaveX', 'wavex' ), 'why-wavex' ),
	array( __( 'Our Work', 'wavex' ), 'our-work' ),
	array( __( 'Blog', 'wavex' ), 'blog' ),
	array( __( 'FAQ', 'wavex' ), 'faq' ),
	array( __( 'Contact', 'wavex' ), 'contact' ),
	array( __( 'Free Consultation', 'wavex' ), 'free-consultation' ),
);
?>
<footer class="site-footer">
	<div class="site-footer__top">
		<div class="site-footer__brand">
			<a class="site-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<svg class="site-brand__mark" width="28" height="28" viewBox="0 0 28 28" aria-hidden="true" focusable="false"><path d="M3 7h22l-5 14h-4l-3-8-3 8H6L3 7z" fill="currentColor"/></svg>
				<span class="site-brand__name"><?php bloginfo( 'name' ); ?></span>
			</a>
			<p><?php echo esc_html( wavex_opt( 'footer_text' ) ); ?></p>
			<?php if ( $email || $phone ) : ?>
				<ul class="site-footer__contact">
					<?php if ( $email ) : ?>
						<li><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php foreach ( $groups as $group_slug => $group_label ) : ?>
			<nav class="site-footer__col" aria-label="<?php echo esc_attr( $group_label ); ?>">
				<h2 class="site-footer__title"><?php echo esc_html( $group_label ); ?></h2>
				<ul>
					<?php
					foreach ( $services as $slug => $service ) :
						if ( in_array( $group_slug, $service['groups'], true ) ) :
							?>
							<li><a href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>"><?php echo esc_html( $service['title'] ); ?></a></li>
							<?php
						endif;
					endforeach;
					?>
				</ul>
			</nav>
		<?php endforeach; ?>

		<nav class="site-footer__col" aria-label="<?php esc_attr_e( 'Company', 'wavex' ); ?>">
			<h2 class="site-footer__title"><?php esc_html_e( 'Company', 'wavex' ); ?></h2>
			<ul>
				<?php foreach ( $company as $link ) : ?>
					<li><a href="<?php echo esc_url( wavex_url( $link[1] ) ); ?>"><?php echo esc_html( $link[0] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>

	<div class="site-footer__bottom">
		<p>
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
			<?php esc_html_e( 'All rights reserved.', 'wavex' ); ?>
		</p>
		<?php
		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => 'nav',
				'container_class' => 'site-footer__legal',
				'depth'          => 1,
				'fallback_cb'    => false,
			) );
		} else {
			?>
			<nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Legal', 'wavex' ); ?>">
				<ul><li><a href="<?php echo esc_url( wavex_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Notice', 'wavex' ); ?></a></li></ul>
			</nav>
			<?php
		}
		?>
	</div>
</footer>
