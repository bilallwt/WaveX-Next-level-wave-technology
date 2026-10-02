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
							<div class="mx2" data-mx>
								<div class="mx2__rail">
									<p class="mx2__kicker"><i></i><?php echo esc_html( $item['label'] ); ?></p>
									<div class="mx2__tabs">
										<?php
										foreach ( $item['columns'] as $ci => $column ) :
											$head_meta = wavex_link_meta( $column['links'][0][1] );
											?>
											<button type="button" class="mx2__tab" data-pane="<?php echo (int) $ci; ?>" aria-controls="<?php echo esc_attr( $mega_id . '-p' . $ci ); ?>">
												<span class="mx2__tab-ico"><?php echo wavex_icon( $head_meta['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
												<span class="mx2__tab-t"><?php echo esc_html( $column['title'] ); ?></span>
												<span class="mx2__tab-n"><?php echo (int) count( $column['links'] ); ?></span>
											</button>
										<?php endforeach; ?>
									</div>
									<?php if ( ! empty( $item['promo'] ) ) : ?>
										<a class="mx2__promo" href="<?php echo esc_url( wavex_url( $item['promo'][4] ) ); ?>">
											<span class="mx2__promo-ico"><?php echo wavex_icon( $item['promo'][0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
											<strong><?php echo esc_html( $item['promo'][1] ); ?></strong>
											<span class="mx2__promo-text"><?php echo esc_html( $item['promo'][2] ); ?></span>
											<em><?php echo esc_html( $item['promo'][3] ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></em>
										</a>
									<?php endif; ?>
								</div>
								<div class="mx2__panes">
									<?php foreach ( $item['columns'] as $ci => $column ) : ?>
										<section class="mx2__pane" id="<?php echo esc_attr( $mega_id . '-p' . $ci ); ?>" data-pane="<?php echo (int) $ci; ?>" aria-label="<?php echo esc_attr( $column['title'] ); ?>">
											<h3 class="mx2__ptitle"><?php echo esc_html( $column['title'] ); ?></h3>
											<ul class="mx2__grid">
												<?php
												foreach ( $column['links'] as $link ) :
													$meta = wavex_link_meta( $link[1] );
													?>
													<li>
														<a class="mx2-card" href="<?php echo esc_url( wavex_url( $link[1] ) ); ?>">
															<span class="mx2-card__ico"><?php echo wavex_icon( $meta['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
															<span class="mx2-card__txt"><strong><?php echo esc_html( $link[0] ); ?></strong><?php echo $meta['desc'] ? '<em>' . esc_html( $meta['desc'] ) . '</em>' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
															<span class="mx2-card__go"><?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										</section>
									<?php endforeach; ?>
									<div class="mx2__foot">
										<a class="mx2__all" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'View everything', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
									</div>
								</div>
								<button type="button" class="mega__close"><span class="screen-reader-text"><?php esc_html_e( 'Close', 'wavex' ); ?></span><?php echo wavex_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
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
