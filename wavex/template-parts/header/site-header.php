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
<header class="site-header" id="site-header">
	<div class="site-header__inner">
		<div class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<svg class="site-brand__mark" width="28" height="28" viewBox="0 0 28 28" aria-hidden="true" focusable="false"><path d="M3 7h22l-5 14h-4l-3-8-3 8H6L3 7z" fill="currentColor"/></svg>
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
