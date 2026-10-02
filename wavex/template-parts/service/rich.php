<?php
/**
 * Long-form service content: numbered sections, process, why, related, FAQs and closing CTA.
 * Args: slug, rich (from wavex_service_content), group_id, scene (bool).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug     = $args['slug'];
$rich     = $args['rich'];
$group_id = $args['group_id'];
$topic    = get_the_title();
$icons    = array( 'chat', 'compass', 'code', 'check', 'rocket', 'refresh', 'shield' );

$content = array();
$groups  = array( 'process' => null, 'why' => null, 'faq' => null, 'final' => null, 'related' => null );
foreach ( $rich['sections'] as $sec ) {
	if ( 'content' === $sec['kind'] ) {
		$content[] = $sec;
	} else {
		$groups[ $sec['kind'] ] = $sec;
	}
}

/**
 * Print paragraphs, bullet chips and links of a block.
 *
 * @param array $b Block with optional paras, bullets, after, links.
 */
$render_block = static function ( $b ) {
	foreach ( isset( $b['paras'] ) ? $b['paras'] : array() as $p ) {
		echo '<p>' . esc_html( $p ) . '</p>';
	}
	if ( ! empty( $b['bullets'] ) ) {
		echo '<ul class="rs__chips">';
		foreach ( $b['bullets'] as $li ) {
			echo '<li>' . wavex_icon( 'check' ) . '<span>' . esc_html( $li ) . '</span></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '</ul>';
	}
	foreach ( isset( $b['after'] ) ? $b['after'] : array() as $p ) {
		echo '<p>' . esc_html( $p ) . '</p>';
	}
	if ( ! empty( $b['links'] ) ) {
		echo '<p class="rs__links">';
		foreach ( $b['links'] as $l ) {
			printf( '<a class="link-arrow" href="%s">%s %s</a>', esc_url( wavex_content_link( $l[0] ) ), esc_html( $l[1] ), wavex_icon( 'arrow' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '</p>';
	}
};

$scene_after = min( 1, count( $content ) - 1 );
foreach ( $content as $n => $sec ) :
	$sid = 0 === $n ? 'overview' : 'sec-' . ( $n + 1 );
	?>
	<section class="rs <?php echo ( $n % 2 ) ? 'rs--alt' : ''; ?>" id="<?php echo esc_attr( $sid ); ?>" aria-labelledby="<?php echo esc_attr( $sid ); ?>-t">
		<div class="rs__inner">
			<header class="rs__head">
				<span class="rs__num"><?php echo esc_html( str_pad( (string) ( $n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
				<h2 class="rs__title" id="<?php echo esc_attr( $sid ); ?>-t"><?php echo esc_html( $sec['title'] ); ?></h2>
			</header>
			<div class="rs__body">
				<?php $render_block( $sec ); ?>
				<?php if ( ! empty( $sec['subs'] ) ) : ?>
					<div class="rs__subs">
						<?php foreach ( $sec['subs'] as $sub ) : ?>
							<article class="rs__sub">
								<h3><?php echo esc_html( $sub['title'] ); ?></h3>
								<?php $render_block( $sub ); ?>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $sec['ctas'] ) ) : ?>
					<?php
					$cta_head = ( count( $sec['ctas'] ) > 1 ) ? $sec['ctas'][0] : '';
					$cta_btn  = end( $sec['ctas'] );
					?>
					<div class="rs__cta">
						<?php if ( $cta_head ) : ?><strong><?php echo esc_html( $cta_head ); ?></strong><?php endif; ?>
						<?php wavex_cta_button( $cta_btn, $topic . ': ' . $sec['title'], 'whatsapp' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
	if ( $n === $scene_after && $args['scene'] ) {
		get_template_part( 'template-parts/service/scene', null, array( 'slug' => $slug, 'group_id' => $group_id ) );
	}
endforeach;

if ( $groups['process'] ) :
	$proc = $groups['process'];
	?>
	<section class="section rs-process" id="svc-process" aria-labelledby="svc-proc-title">
		<p class="eyebrow"><?php esc_html_e( 'How we work', 'wavex' ); ?></p>
		<h2 class="section__title" id="svc-proc-title"><?php echo esc_html( $proc['title'] ); ?></h2>
		<?php foreach ( isset( $proc['paras'] ) ? $proc['paras'] : array() as $p ) : ?>
			<p class="rs-process__lead"><?php echo esc_html( $p ); ?></p>
		<?php endforeach; ?>
		<ol class="flow flow--n">
			<?php foreach ( $proc['subs'] as $k => $step ) : ?>
				<li class="flow__item">
					<span class="flow__node"><?php echo wavex_icon( $icons[ $k % count( $icons ) ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="flow__card">
						<span class="flow__num"><?php echo esc_html( str_pad( (string) ( $k + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<?php foreach ( isset( $step['paras'] ) ? $step['paras'] : array() as $p ) : ?><p><?php echo esc_html( $p ); ?></p><?php endforeach; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
		<?php if ( ! empty( $proc['ctas'] ) ) : ?>
			<div class="rs__cta">
				<strong><?php echo esc_html( $proc['ctas'][0] ); ?></strong>
				<?php wavex_cta_button( __( 'Talk to us on WhatsApp', 'wavex' ), $topic, 'whatsapp' ); ?>
				<?php wavex_cta_button( __( 'Email us', 'wavex' ), $topic, 'email' ); ?>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>

<?php if ( $groups['why'] ) : $why = $groups['why']; ?>
	<section class="rs rs--why" id="svc-why" aria-labelledby="svc-why-t">
		<div class="rs__inner">
			<header class="rs__head">
				<span class="rs__num"><?php echo wavex_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h2 class="rs__title" id="svc-why-t"><?php echo esc_html( $why['title'] ); ?></h2>
			</header>
			<div class="rs__body">
				<?php $render_block( $why ); ?>
				<?php if ( ! empty( $why['subs'] ) ) : ?>
					<div class="rs__subs">
						<?php foreach ( $why['subs'] as $sub ) : ?>
							<article class="rs__sub"><h3><?php echo esc_html( $sub['title'] ); ?></h3><?php $render_block( $sub ); ?></article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $groups['related'] ) : $rel = $groups['related']; ?>
	<section class="section" aria-labelledby="svc-rel-t">
		<p class="eyebrow"><?php esc_html_e( 'Connect the pieces', 'wavex' ); ?></p>
		<h2 class="section__title" id="svc-rel-t"><?php echo esc_html( $rel['title'] ); ?></h2>
		<?php foreach ( isset( $rel['paras'] ) ? $rel['paras'] : array() as $p ) : ?><p class="rs-process__lead"><?php echo esc_html( $p ); ?></p><?php endforeach; ?>
		<div class="card-grid card-grid--3">
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

<?php if ( $groups['faq'] ) : $faq = $groups['faq']; ?>
	<section class="section section--tint" id="svc-faq" aria-labelledby="svc-faq-title">
		<div class="faq">
			<div class="faq__intro">
				<p class="eyebrow"><?php esc_html_e( 'Before we begin', 'wavex' ); ?></p>
				<h2 class="section__title" id="svc-faq-title"><?php echo esc_html( $faq['title'] ); ?></h2>
				<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'faq' ) ); ?>"><?php esc_html_e( 'View all FAQs', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			</div>
			<?php
			$items = array();
			foreach ( $faq['subs'] as $q ) {
				$items[] = array( $q['title'], isset( $q['paras'] ) ? implode( ' ', $q['paras'] ) : '' );
			}
			get_template_part( 'template-parts/components/faq-list', null, array( 'items' => $items, 'open_first' => true ) );
			?>
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
