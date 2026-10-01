<?php
/**
 * Header bar: logo, primary navigation (with mega menus) and mobile toggle.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php $wx = wavex_contact(); ?>
<div class="topbar">
	<div class="topbar__inner">
		<p class="topbar__tag"><strong><?php esc_html_e( 'Technology built around your business', 'wavex' ); ?></strong> <span><?php esc_html_e( 'Websites. Apps. Digital growth.', 'wavex' ); ?></span></p>
		<ul class="topbar__links">
			<li><a href="<?php echo esc_url( wavex_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact our team', 'wavex' ); ?></a></li>
			<?php if ( $wx['whatsapp'] ) : ?>
				<li><a href="<?php echo esc_url( $wx['whatsapp'] ); ?>" target="_blank" rel="noopener"><?php echo wavex_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'WhatsApp', 'wavex' ); ?></a></li>
			<?php endif; ?>
			<li><a href="<?php echo esc_url( $wx['email_url'] ); ?>"><?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $wx['email'] ? antispambot( $wx['email'] ) : __( 'Email us', 'wavex' ) ); ?></a></li>
		</ul>
	</div>
</div>
<header class="site-header" id="site-header">
	<div class="site-header__inner">
		<div class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<svg class="site-brand__mark" width="30" height="30" viewBox="0 0 30 30" fill="none" aria-hidden="true" focusable="false"><path d="M2 9c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="currentColor" stroke-width="3.2" stroke-linecap="round"/><path d="M2 16c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="#19c3d6" stroke-width="3.2" stroke-linecap="round"/><path d="M2 23c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="currentColor" stroke-opacity=".45" stroke-width="3.2" stroke-linecap="round"/></svg>
					<span class="site-brand__name"><?php bloginfo( 'name' ); ?></span>
				</a>
			<?php endif; ?>
		</div>

		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
			<span class="nav-toggle__open"><?php echo wavex_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<span class="nav-toggle__close"><?php echo wavex_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'wavex' ); ?></span>
		</button>

		<?php get_template_part( 'template-parts/header/primary-nav' ); ?>
	</div>
</header>
