<?php
/**
 * Long-form service guide: sticky contents rail, numbered section cards,
 * process timeline, "why" tiles and FAQs.
 * Args: slug, rich (from wavex_service_content), group_id.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug  = $args['slug'];
$rich  = $args['rich'];
$topic = get_the_title();

wavex_autolink_state( true );
foreach ( $rich['sections'] as $sec_pre ) {
	foreach ( array_merge( array( $sec_pre ), isset( $sec_pre['subs'] ) ? $sec_pre['subs'] : array() ) as $blk ) {
		foreach ( isset( $blk['links'] ) ? $blk['links'] : array() as $l ) {
			wavex_autolink_mark( $l[0] );
		}
	}
}

$content = array();
$groups  = array( 'process' => null, 'why' => null, 'faq' => null, 'final' => null, 'related' => null );
foreach ( $rich['sections'] as $sec ) {
	if ( 'content' === $sec['kind'] ) {
		$content[] = $sec;
	} else {
		$groups[ $sec['kind'] ] = $sec;
	}
}

// Contents rail entries.
$toc = array();
foreach ( $content as $n => $sec ) {
	$toc[] = array( 0 === $n ? 'overview' : 'sec-' . ( $n + 1 ), $sec['title'] );
}
if ( $groups['process'] ) {
	$toc[] = array( 'svc-process', __( 'Our process', 'wavex' ) );
}
if ( $groups['why'] ) {
	$toc[] = array( 'svc-why', __( 'Why WaveX', 'wavex' ) );
}
if ( $groups['faq'] ) {
	$toc[] = array( 'svc-faq', __( 'FAQs', 'wavex' ) );
}

/**
 * Print paragraphs, check chips and links of a block.
 *
 * @param array $b Block with optional paras, bullets, after, links.
 */
$render_block = static function ( $b ) use ( $slug ) {
	foreach ( isset( $b['paras'] ) ? $b['paras'] : array() as $p ) {
		echo '<p>' . wavex_autolink( esc_html( $p ), $slug, 1 ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	if ( ! empty( $b['bullets'] ) ) {
		echo '<ul class="sc__chips">';
		foreach ( $b['bullets'] as $li ) {
			echo '<li>' . wavex_icon( 'check' ) . '<span>' . esc_html( $li ) . '</span></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '</ul>';
	}
	foreach ( isset( $b['after'] ) ? $b['after'] : array() as $p ) {
		echo '<p>' . wavex_autolink( esc_html( $p ), $slug, 1 ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	if ( ! empty( $b['links'] ) ) {
		echo '<p class="sc__links">';
		foreach ( $b['links'] as $l ) {
			printf( '<a class="link-arrow" href="%s">%s %s</a>', esc_url( wavex_content_link( $l[0] ) ), esc_html( $l[1] ), wavex_icon( 'arrow' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '</p>';
	}
};

$step_icons = array( 'chat', 'compass', 'code', 'check', 'rocket', 'refresh', 'shield' );
?>
<div class="sg" data-guide>
	<aside class="sg__rail" aria-label="<?php esc_attr_e( 'On this page', 'wavex' ); ?>">
		<div class="sg__rail-card">
			<p class="sg__rail-title"><span class="sg__prog" aria-hidden="true"></span><?php esc_html_e( 'On this page', 'wavex' ); ?></p>
			<ol class="sg__toc">
				<?php foreach ( $toc as $i => $t ) : ?>
					<li><a href="#<?php echo esc_attr( $t[0] ); ?>" data-sg-link><span class="sg__n"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><span class="sg__t"><?php echo esc_html( $t[1] ); ?></span></a></li>
				<?php endforeach; ?>
			</ol>
			<div class="sg__rail-cta">
				<strong><?php esc_html_e( 'Talk to us', 'wavex' ); ?></strong>
				<?php wavex_cta_button( __( 'WhatsApp', 'wavex' ), $topic, 'whatsapp' ); ?>
				<?php wavex_cta_button( __( 'Email', 'wavex' ), $topic, 'email' ); ?>
			</div>
		</div>
	</aside>

	<div class="sg__main">
		<?php
		$gap = 0;
		foreach ( $content as $n => $sec ) :
			$sid = $toc[ $n ][0];
			?>
			<article class="sc" id="<?php echo esc_attr( $sid ); ?>" data-collapsible>
				<header class="sc__head">
					<span class="sc__ico"><?php echo wavex_icon( wavex_section_icon( $sec['title'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="sc__titles">
						<span class="sc__no"><?php echo esc_html( sprintf( /* translators: %s: section number. */ __( 'Part %s', 'wavex' ), str_pad( (string) ( $n + 1 ), 2, '0', STR_PAD_LEFT ) ) ); ?></span>
						<h2 class="sc__title"><?php echo esc_html( $sec['title'] ); ?></h2>
					</div>
					<button class="sc__toggle" type="button" aria-expanded="true" aria-controls="<?php echo esc_attr( $sid ); ?>-body" hidden><?php echo wavex_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="screen-reader-text"><?php esc_html_e( 'Show or hide this section', 'wavex' ); ?></span></button>
				</header>
				<div class="sc__body" id="<?php echo esc_attr( $sid ); ?>-body">
					<?php $render_block( $sec ); ?>
					<?php if ( ! empty( $sec['subs'] ) ) : ?>
						<div class="sc__subs">
							<?php foreach ( $sec['subs'] as $k => $sub ) : ?>
								<div class="sc__sub">
									<span class="sc__sub-n"><?php echo esc_html( str_pad( (string) ( $k + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
									<h3><?php echo esc_html( $sub['title'] ); ?></h3>
									<?php $render_block( $sub ); ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $sec['ctas'] ) ) : ?>
						<?php
						$cta_head = ( count( $sec['ctas'] ) > 1 ) ? $sec['ctas'][0] : '';
						$cta_btn  = end( $sec['ctas'] );
						?>
						<div class="sc__cta">
							<strong><?php echo esc_html( $cta_head ? $cta_head : $sec['title'] ); ?></strong>
							<?php wavex_cta_button( $cta_btn, $topic . ': ' . $sec['title'], 'whatsapp' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</article>
			<?php
			$gap = empty( $sec['ctas'] ) ? $gap + 1 : 0;
			if ( $gap >= 3 && $n < count( $content ) - 1 ) {
				get_template_part(
					'template-parts/service/cta-band',
					null,
					array(
						'title' => sprintf( /* translators: %s: service name. */ __( 'Thinking about %s?', 'wavex' ), $topic ),
						'text'  => __( 'Tell us what you need. A short message is enough to start.', 'wavex' ),
						'topic' => $topic,
						'tone'  => 'strip',
					)
				);
				$gap = 0;
			}
		endforeach;
		?>

		<?php if ( $groups['process'] ) : $proc = $groups['process']; ?>
			<article class="sc sc--process" id="svc-process">
				<header class="sc__head">
					<span class="sc__ico"><?php echo wavex_icon( 'compass' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="sc__titles"><span class="sc__no"><?php esc_html_e( 'How we work', 'wavex' ); ?></span><h2 class="sc__title"><?php echo esc_html( $proc['title'] ); ?></h2></div>
				</header>
				<div class="sc__body">
					<?php foreach ( isset( $proc['paras'] ) ? $proc['paras'] : array() as $p ) : ?><p><?php echo esc_html( $p ); ?></p><?php endforeach; ?>
					<ol class="tl">
						<?php foreach ( $proc['subs'] as $k => $step ) : ?>
							<li class="tl__item">
								<span class="tl__node"><?php echo wavex_icon( $step_icons[ $k % count( $step_icons ) ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<div class="tl__card">
									<span class="tl__no"><?php echo esc_html( str_pad( (string) ( $k + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
									<h3><?php echo esc_html( $step['title'] ); ?></h3>
									<?php foreach ( isset( $step['paras'] ) ? $step['paras'] : array() as $p ) : ?><p><?php echo esc_html( $p ); ?></p><?php endforeach; ?>
								</div>
							</li>
						<?php endforeach; ?>
					</ol>
					<?php if ( ! empty( $proc['ctas'] ) ) : ?>
						<div class="sc__cta">
							<strong><?php echo esc_html( $proc['ctas'][0] ); ?></strong>
							<?php wavex_cta_button( __( 'WhatsApp us', 'wavex' ), $topic, 'whatsapp' ); ?>
							<?php wavex_cta_button( __( 'Email us', 'wavex' ), $topic, 'email' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</article>
		<?php endif; ?>

		<?php if ( $groups['why'] ) : $why = $groups['why']; ?>
			<article class="sc sc--why" id="svc-why">
				<header class="sc__head">
					<span class="sc__ico"><?php echo wavex_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="sc__titles"><span class="sc__no"><?php esc_html_e( 'Why WaveX', 'wavex' ); ?></span><h2 class="sc__title"><?php echo esc_html( $why['title'] ); ?></h2></div>
				</header>
				<div class="sc__body">
					<?php $render_block( $why ); ?>
					<?php if ( ! empty( $why['subs'] ) ) : ?>
						<div class="sc__subs">
							<?php foreach ( $why['subs'] as $k => $sub ) : ?>
								<div class="sc__sub"><span class="sc__sub-n"><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><h3><?php echo esc_html( $sub['title'] ); ?></h3><?php $render_block( $sub ); ?></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</article>
		<?php endif; ?>

		<?php if ( $groups['faq'] ) : $faq = $groups['faq']; ?>
			<article class="sc sc--faq" id="svc-faq">
				<header class="sc__head">
					<span class="sc__ico"><?php echo wavex_icon( 'help' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="sc__titles"><span class="sc__no"><?php esc_html_e( 'Before we begin', 'wavex' ); ?></span><h2 class="sc__title"><?php echo esc_html( $faq['title'] ); ?></h2></div>
				</header>
				<div class="sc__body">
					<?php
					$items = array();
					foreach ( $faq['subs'] as $q ) {
						$items[] = array( $q['title'], isset( $q['paras'] ) ? implode( ' ', $q['paras'] ) : '' );
					}
					get_template_part( 'template-parts/components/faq-list', null, array( 'items' => $items, 'open_first' => true, 'link_slug' => $slug ) );
					?>
				</div>
			</article>
		<?php endif; ?>
	</div>
</div>

<?php if ( $groups['related'] ) : $rel = $groups['related']; ?>
	<section class="section" aria-labelledby="svc-rel-t">
		<p class="eyebrow"><?php esc_html_e( 'Connect the pieces', 'wavex' ); ?></p>
		<h2 class="section__title" id="svc-rel-t"><?php echo esc_html( $rel['title'] ); ?></h2>
		<?php foreach ( isset( $rel['paras'] ) ? $rel['paras'] : array() as $p ) : ?><p class="rs-process__lead"><?php echo esc_html( $p ); ?></p><?php endforeach; ?>
		<div class="card-grid card-grid--4">
			<?php foreach ( $rel['subs'] as $sub ) : ?>
				<?php
				$target = ! empty( $sub['links'] ) ? $sub['links'][0][0] : '';
				$svc    = wavex_services();
				$icon   = isset( $svc[ $target ] ) ? $svc[ $target ]['icon'] : 'grid';
				?>
				<a class="service-card" href="<?php echo esc_url( $target ? wavex_content_link( $target ) : wavex_url( 'services' ) ); ?>">
					<span class="service-card__icon"><?php echo wavex_icon( $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3 class="service-card__title"><?php echo esc_html( $sub['title'] ); ?></h3>
					<p class="service-card__text"><?php echo esc_html( isset( $sub['paras'][0] ) ? $sub['paras'][0] : '' ); ?></p>
					<span class="service-card__go"><?php esc_html_e( 'Explore service', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</section>
<?php endif; ?>

<?php if ( $groups['final'] ) : $fin = $groups['final']; ?>
	<section class="final-cta rs-final" aria-labelledby="svc-final-t">
		<div class="final-cta__inner">
			<h2 class="final-cta__title" id="svc-final-t"><?php echo esc_html( $fin['title'] ); ?></h2>
			<?php foreach ( isset( $fin['paras'] ) ? $fin['paras'] : array() as $p ) : ?><p><?php echo esc_html( $p ); ?></p><?php endforeach; ?>
			<div class="hero__actions">
				<?php wavex_cta_button( ! empty( $fin['ctas'][0] ) ? $fin['ctas'][0] : $rich['cta'][0], $topic, 'whatsapp' ); ?>
				<?php wavex_cta_button( __( 'Email us', 'wavex' ), $topic, 'email' ); ?>
				<?php
				$fin_second = ! empty( $fin['ctas'][1] ) ? $fin['ctas'][1] : __( 'Contact WaveX Technology', 'wavex' );
				wavex_button( $fin_second, wavex_url( false !== stripos( $fin_second, 'services' ) ? 'services' : 'contact' ), 'ghost' );
				?>
			</div>
		</div>
	</section>
<?php endif; ?>
