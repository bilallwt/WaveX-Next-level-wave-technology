<?php
/**
 * Primary navigation with card-style mega menus. Items come from wavex_primary_menu().
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
							<div class="mega__grid">
								<?php
								foreach ( $item['columns'] as $c => $column ) :
									$head_meta = wavex_link_meta( $column['links'][0][1] );
									?>
									<section class="mega__col mega__col--<?php echo ( $c % 2 ) ? 'b' : 'a'; ?>" aria-label="<?php echo esc_attr( $column['title'] ); ?>">
										<header class="mega__head">
											<span class="mega__head-icon"><?php echo wavex_icon( $head_meta['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
											<h3 class="mega__title"><?php echo esc_html( $column['title'] ); ?></h3>
										</header>
										<ul class="mega__links">
											<?php
											foreach ( $column['links'] as $link ) :
												$meta = wavex_link_meta( $link[1] );
												?>
												<li>
													<a class="mega-card" href="<?php echo esc_url( wavex_url( $link[1] ) ); ?>">
														<span class="mega-card__icon">
															<?php if ( $meta['thumb'] ) : ?>
																<img src="<?php echo esc_url( $meta['thumb'] ); ?>" alt="" width="40" height="40" loading="lazy">
															<?php else : ?>
																<?php echo wavex_icon( $meta['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
															<?php endif; ?>
														</span>
														<span class="mega-card__body">
															<span class="mega-card__title"><?php echo esc_html( $link[0] ); ?></span>
															<?php if ( $meta['desc'] ) : ?>
																<span class="mega-card__desc"><?php echo esc_html( $meta['desc'] ); ?></span>
															<?php endif; ?>
														</span>
														<?php echo wavex_icon( 'arrow', 'mega-card__go' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</section>
								<?php endforeach; ?>
							</div>
							<div class="mega__foot">
								<p><strong><?php esc_html_e( 'Not sure where to start?', 'wavex' ); ?></strong> <?php esc_html_e( 'Tell us what you need and we will talk it through.', 'wavex' ); ?></p>
								<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'size' => 'sm', 'tone' => 'light' ) ); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
