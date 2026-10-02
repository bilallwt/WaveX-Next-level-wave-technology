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
<?php $wxc = wavex_contact(); ?>
<footer class="ft">
	<div class="ft__cta">
		<div class="ft__cta-copy">
			<h2><?php esc_html_e( 'Have a project in mind?', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Message us on WhatsApp or email. A short message is enough to start.', 'wavex' ); ?></p>
		</div>
		<div class="ft__cta-actions">
			<?php if ( $wxc['whatsapp'] ) : ?>
				<a class="btn btn--whatsapp" href="<?php echo esc_url( $wxc['whatsapp'] ); ?>" target="_blank" rel="noopener"><?php echo wavex_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Chat on WhatsApp', 'wavex' ); ?></a>
			<?php endif; ?>
			<a class="btn btn--primary" href="<?php echo esc_url( $wxc['email_url'] ); ?>"><?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Email us', 'wavex' ); ?></a>
		</div>
	</div>

	<div class="ft__grid">
		<div class="ft__brand">
			<a class="site-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<svg class="site-brand__mark" width="30" height="30" viewBox="0 0 30 30" fill="none" aria-hidden="true" focusable="false"><path d="M2 9c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="#fff" stroke-width="3.2" stroke-linecap="round"/><path d="M2 16c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="#19c3d6" stroke-width="3.2" stroke-linecap="round"/><path d="M2 23c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="#fff" stroke-opacity=".45" stroke-width="3.2" stroke-linecap="round"/></svg>
				<span class="site-brand__name"><?php bloginfo( 'name' ); ?></span>
			</a>
			<p><?php echo esc_html( wavex_opt( 'footer_text' ) ); ?></p>
			<?php if ( $email || $phone ) : ?>
				<ul class="ft__contact">
					<?php if ( $email ) : ?>
						<li><?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<li><?php echo wavex_icon( 'chat' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php foreach ( $groups as $group_slug => $group_label ) : ?>
			<details class="ft__col" open>
				<summary><span><?php echo esc_html( $group_label ); ?></span><?php echo wavex_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></summary>
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
			</details>
		<?php endforeach; ?>

		<details class="ft__col" open>
			<summary><span><?php esc_html_e( 'Company', 'wavex' ); ?></span><?php echo wavex_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></summary>
			<ul>
				<?php foreach ( $company as $link ) : ?>
					<li><a href="<?php echo esc_url( wavex_url( $link[1] ) ); ?>"><?php echo esc_html( $link[0] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</details>
	</div>

	<div class="ft__bottom">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'wavex' ); ?></p>
		<?php
		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu( array(
				'theme_location'  => 'footer',
				'container'       => 'nav',
				'container_class' => 'ft__legal',
				'depth'           => 1,
				'fallback_cb'     => false,
			) );
		} else {
			?>
			<nav class="ft__legal" aria-label="<?php esc_attr_e( 'Legal', 'wavex' ); ?>">
				<ul><li><a href="<?php echo esc_url( wavex_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Notice', 'wavex' ); ?></a></li></ul>
			</nav>
			<?php
		}
		?>
		<a class="ft__top" href="#site-header"><span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'wavex' ); ?></span><?php echo wavex_icon( 'arrow', 'is-up' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
	</div>
</footer>
