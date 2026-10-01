<?php
/**
 * Primary navigation with mega menus. Items come from wavex_primary_menu().
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = wavex_primary_menu();
?>
<nav id="primary-nav" class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'wavex' ); ?>">
	<ul class="primary-nav__list">
		<?php
		foreach ( $items as $i => $item ) :
			$has_mega = ! empty( $item['columns'] );
			$is_cta   = ! empty( $item['cta'] );
			$url      = wavex_url( $item['path'] );
			$is_here  = ( '' === $item['path'] ) ? is_front_page() : ( ! $has_mega && is_page( basename( $item['path'] ) ) );
			$li_class = 'primary-nav__item';
			$li_class .= $has_mega ? ' has-mega' : '';
			$li_class .= $is_cta ? ' is-cta' : '';
			$li_class .= $is_here ? ' is-current' : '';
			$mega_id  = 'mega-' . (int) $i;
			?>
			<li class="<?php echo esc_attr( $li_class ); ?>">
				<?php if ( $is_cta ) : ?>
					<a class="btn btn--primary btn--sm" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
				<?php else : ?>
					<a class="primary-nav__link" href="<?php echo esc_url( $url ); ?>"<?php echo $is_here ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $item['label'] ); ?></a>
				<?php endif; ?>

				<?php if ( $has_mega ) : ?>
					<button class="primary-nav__toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $mega_id ); ?>">
						<?php echo wavex_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span class="screen-reader-text">
							<?php
							/* translators: %s: menu item label. */
							echo esc_html( sprintf( __( 'Toggle %s submenu', 'wavex' ), $item['label'] ) );
							?>
						</span>
					</button>

					<div class="mega" id="<?php echo esc_attr( $mega_id ); ?>">
						<div class="mega__panel">
							<div class="mega__grid<?php echo ! empty( $item['promo'] ) ? ' has-promo' : ''; ?>">
								<?php
								foreach ( $item['columns'] as $column ) :
									$head_meta = wavex_link_meta( $column['links'][0][1] );
									?>
									<section class="mega__col" aria-label="<?php echo esc_attr( $column['title'] ); ?>">
										<header class="mega__head">
											<h3 class="mega__title"><?php echo esc_html( $column['title'] ); ?></h3>
											<span class="mega__head-icon"><?php echo wavex_icon( $head_meta['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
										</header>
										<ul class="mega__links">
											<?php foreach ( $column['links'] as $link ) : ?>
												<li><a href="<?php echo esc_url( wavex_url( $link[1] ) ); ?>"><?php echo esc_html( $link[0] ); ?></a></li>
											<?php endforeach; ?>
										</ul>
									</section>
								<?php endforeach; ?>

								<?php if ( ! empty( $item['promo'] ) ) : ?>
									<aside class="mega__promo">
										<span class="mega__promo-icon"><?php echo wavex_icon( $item['promo'][0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
										<h3><?php echo esc_html( $item['promo'][1] ); ?></h3>
										<p><?php echo esc_html( $item['promo'][2] ); ?></p>
										<a class="btn btn--primary" href="<?php echo esc_url( wavex_url( $item['promo'][4] ) ); ?>"><?php echo esc_html( $item['promo'][3] ); ?></a>
									</aside>
								<?php endif; ?>
							</div>
							<div class="mega__foot">
								<button type="button" class="mega__close"><?php esc_html_e( 'Close', 'wavex' ); ?> <?php echo wavex_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
