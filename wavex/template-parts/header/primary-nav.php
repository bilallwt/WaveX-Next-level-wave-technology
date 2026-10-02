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
$tones = array(
	array( 'var(--blue)', 'var(--blue-t)' ),
	array( 'var(--blue)', 'var(--blue-t)' ),
	array( 'var(--purple)', 'var(--purple-t)' ),
	array( 'var(--green)', 'var(--green-t)' ),
	array( 'var(--teal)', 'var(--teal-t)' ),
	array( 'var(--blue)', 'var(--blue-t)' ),
);
$wx = wavex_contact();
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
			$mega_tone = isset( $tones[ $i ] ) ? $tones[ $i ] : $tones[0];
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

					<div class="mega" id="<?php echo esc_attr( $mega_id ); ?>" style="--g: <?php echo esc_attr( $mega_tone[0] ); ?>; --g-t: <?php echo esc_attr( $mega_tone[1] ); ?>;">
						<div class="mega__panel">
							<div class="mx<?php echo ! empty( $item['promo'] ) ? ' mx--promo' : ''; ?>">
								<?php if ( ! empty( $item['promo'] ) ) : ?>
									<aside class="mx__side">
										<span class="mx__rings" aria-hidden="true"></span>
										<span class="mx__side-icon"><?php echo wavex_icon( $item['promo'][0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
										<h3><?php echo esc_html( $item['promo'][1] ); ?></h3>
										<p><?php echo esc_html( $item['promo'][2] ); ?></p>
										<a class="btn btn--primary" href="<?php echo esc_url( wavex_url( $item['promo'][4] ) ); ?>"><?php echo esc_html( $item['promo'][3] ); ?></a>
									</aside>
								<?php endif; ?>
								<div class="mx__main">
									<div class="mx__top">
										<span class="mx__kicker"><i></i><?php echo esc_html( $item['label'] ); ?></span>
										<a class="mx__all" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'View everything', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
										<button type="button" class="mega__close"><span class="screen-reader-text"><?php esc_html_e( 'Close', 'wavex' ); ?></span><?php echo wavex_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
									</div>
									<div class="mx__cols" style="--n: <?php echo (int) count( $item['columns'] ); ?>;">
										<?php foreach ( $item['columns'] as $column ) : ?>
											<section class="mx__col" aria-label="<?php echo esc_attr( $column['title'] ); ?>">
												<h3 class="mx__title"><?php echo esc_html( $column['title'] ); ?></h3>
												<ul>
													<?php
													foreach ( $column['links'] as $link ) :
														$meta = wavex_link_meta( $link[1] );
														?>
														<li>
															<a class="mx-tile" href="<?php echo esc_url( wavex_url( $link[1] ) ); ?>">
																<span class="mx-tile__icon"><?php echo wavex_icon( $meta['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
																<span class="mx-tile__txt"><strong><?php echo esc_html( $link[0] ); ?></strong><?php echo $meta['desc'] ? '<em>' . esc_html( $meta['desc'] ) . '</em>' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
											</section>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="primary-nav__contact">
		<?php if ( $wx['whatsapp'] ) : ?>
			<a class="btn btn--whatsapp" href="<?php echo esc_url( $wx['whatsapp'] ); ?>" target="_blank" rel="noopener"><?php echo wavex_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'WhatsApp', 'wavex' ); ?></a>
		<?php endif; ?>
		<a class="btn btn--primary" href="<?php echo esc_url( $wx['email_url'] ); ?>"><?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Email', 'wavex' ); ?></a>
		<a class="btn btn--ghost" href="<?php echo esc_url( wavex_url( 'free-consultation' ) ); ?>"><?php esc_html_e( 'Free Consultation', 'wavex' ); ?></a>
	</div>
</nav>
