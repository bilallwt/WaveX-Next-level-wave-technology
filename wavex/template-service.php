<?php
/**
 * Template Name: Service Page
 * Template Post Type: page
 *
 * Individual service page under /services/.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$slug     = (string) get_post_field( 'post_name', get_the_ID() );
$services = wavex_services();
$details  = wavex_service_details();
$scenes   = wavex_studio_scenes();
$detail   = isset( $details[ $slug ] ) ? $details[ $slug ] : null;
$scene    = isset( $scenes[ $slug ] ) ? $scenes[ $slug ] : null;
$svc      = isset( $services[ $slug ] ) ? $services[ $slug ] : array( 'icon' => 'code', 'title' => get_the_title() );

$group_label = __( 'Services', 'wavex' );
$group_key   = null;
$group_id    = 'web';
foreach ( wavex_studio_groups() as $gid => $group ) {
	if ( in_array( $slug, $group['services'], true ) ) {
		$group_label = $group['label'];
		$group_key   = $group;
		$group_id    = $gid;
		break;
	}
}

// Other services in the same area: shown on the ring and as related cards.
$others = array();
if ( $group_key ) {
	foreach ( $group_key['services'] as $other ) {
		if ( $other !== $slug ) {
			$others[] = $other;
		}
	}
}
$ring_items = array();
foreach ( array_slice( $others, 0, 4 ) as $other ) {
	$ring_items[] = array(
		'icon'  => $services[ $other ]['icon'],
		'label' => $services[ $other ]['title'],
		'url'   => wavex_url( 'services/' . $other ),
	);
}

$steps = wavex_approach_steps();
$flow  = array(
	array( $steps[0]['title'], $steps[0]['text'], 'chat' ),
	array( $steps[1]['title'], $steps[1]['text'], 'compass' ),
	array( $steps[2]['title'], $steps[2]['text'], 'code' ),
	array( __( 'Launch & support', 'wavex' ), $steps[3]['text'] . ' ' . $steps[4]['text'], 'rocket' ),
);

while ( have_posts() ) :
	the_post();
	?>
	<div class="gtheme gtheme--<?php echo esc_attr( $group_id ); ?>">

	<header class="svc-hero">
		<span class="svc-hero__orb" aria-hidden="true"></span>
		<div class="svc-hero__copy">
			<?php get_template_part( 'template-parts/components/breadcrumbs' ); ?>
			<p class="eyebrow"><?php echo esc_html( $group_label ); ?></p>
			<h1 class="svc-hero__title"><?php the_title(); ?></h1>
			<p class="svc-hero__text"><?php echo esc_html( $detail ? $detail['intro'] : ( has_excerpt() ? get_the_excerpt() : '' ) ); ?></p>
			<div class="hero__actions hero__actions--left">
				<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => get_the_title() ) ); ?>
				<?php wavex_button( __( 'Free Consultation', 'wavex' ), wavex_url( 'free-consultation' ), 'ghost' ); ?>
			</div>
		</div>
		<div class="svc-hero__vis" data-vis>
			<?php
			$core = '<span class="rg__core-icon">' . wavex_icon( $svc['icon'] ) . '</span><span class="rg__core-name">' . esc_html( $svc['title'] ) . '</span>';
			wavex_ring_v( 'orbit', $ring_items ? $ring_items : array( array( 'icon' => $svc['icon'], 'label' => $svc['title'] ) ), $core, 'rg--svc' );
			?>
		</div>
	</header>

	<nav class="pagebar" aria-label="<?php esc_attr_e( 'On this page', 'wavex' ); ?>">
		<span class="pagebar__label"><?php esc_html_e( 'On this page', 'wavex' ); ?></span>
		<ul>
			<li><a href="#overview"><?php esc_html_e( 'Overview', 'wavex' ); ?></a></li>
			<?php if ( $scene ) : ?><li><a href="#svc-how"><?php esc_html_e( 'How it works', 'wavex' ); ?></a></li><?php endif; ?>
			<li><a href="#svc-process"><?php esc_html_e( 'Our process', 'wavex' ); ?></a></li>
			<?php if ( $detail ) : ?><li><a href="#svc-faq"><?php esc_html_e( 'FAQs', 'wavex' ); ?></a></li><?php endif; ?>
		</ul>
	</nav>

	<?php if ( $detail ) : ?>
		<section class="section" id="overview" aria-labelledby="svc-inc">
			<div class="svc-grid">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'What is included', 'wavex' ); ?></p>
					<h2 class="section__title" id="svc-inc"><?php esc_html_e( 'What this service covers', 'wavex' ); ?></h2>
					<ul class="inc-grid">
						<?php foreach ( $detail['includes'] as $i => $item ) : ?>
							<li class="inc-card">
								<span class="inc-card__num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<span><?php echo esc_html( $item ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
					<?php if ( get_the_content() ) : ?>
						<div class="entry-content"><?php the_content(); ?></div>
					<?php endif; ?>
				</div>
				<aside class="svc-card">
					<span class="svc-card__icon"><?php echo wavex_icon( 'chat' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3><?php esc_html_e( 'Tell us what needs to work better.', 'wavex' ); ?></h3>
					<p><?php esc_html_e( 'Share your goals or an existing project. A short message is enough to start.', 'wavex' ); ?></p>
					<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => get_the_title() ) ); ?>
					<p class="svc-card__note"><a href="<?php echo esc_url( wavex_url( 'free-consultation' ) ); ?>"><?php esc_html_e( 'Or request a free consultation', 'wavex' ); ?></a></p>
				</aside>
			</div>
		</section>
	<?php else : ?>
		<div class="wrap wrap--narrow" id="overview"><div class="entry-content"><?php the_content(); ?></div></div>
	<?php endif; ?>

	<?php if ( $scene ) : ?>
		<section class="studio studio--single" id="svc-how" aria-labelledby="svc-how-title">
			<div class="studio__inner">
				<header class="studio__head studio__head--left">
					<p class="eyebrow"><?php esc_html_e( 'See how it works', 'wavex' ); ?></p>
					<h2 class="section__title" id="svc-how-title"><?php esc_html_e( 'What happens behind the scenes', 'wavex' ); ?></h2>
					<p><em><?php esc_html_e( 'An illustration of the process.', 'wavex' ); ?></em></p>
				</header>
				<div class="sx sx--single" data-studio-single>
					<div class="studio__main">
						<?php get_template_part( 'template-parts/components/scene-panel', null, array( 'slug' => $slug, 'gkey' => $group_id, 'single' => true ) ); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="section" id="svc-process" aria-labelledby="svc-proc-title">
		<p class="eyebrow"><?php esc_html_e( 'From the first conversation', 'wavex' ); ?></p>
		<h2 class="section__title" id="svc-proc-title"><?php esc_html_e( 'A clear path to launch.', 'wavex' ); ?></h2>
		<ol class="flow">
			<?php foreach ( $flow as $n => $step ) : ?>
				<li class="flow__item">
					<span class="flow__node"><?php echo wavex_icon( $step[2] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="flow__card">
						<span class="flow__num"><?php echo esc_html( str_pad( (string) ( $n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<h3><?php echo esc_html( $step[0] ); ?></h3>
						<p><?php echo esc_html( $step[1] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
		<p><a class="link-arrow" href="<?php echo esc_url( wavex_url( 'our-approach' ) ); ?>"><?php esc_html_e( 'Explore our full process', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
	</section>

	<?php if ( $detail ) : ?>
		<section class="section section--tint" id="svc-faq" aria-labelledby="svc-faq-title">
			<div class="faq">
				<div class="faq__intro">
					<p class="eyebrow"><?php esc_html_e( 'Before we begin', 'wavex' ); ?></p>
					<h2 class="section__title" id="svc-faq-title"><?php esc_html_e( 'Your questions, answered.', 'wavex' ); ?></h2>
					<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'faq' ) ); ?>"><?php esc_html_e( 'View all FAQs', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
				</div>
				<?php get_template_part( 'template-parts/components/faq-list', null, array( 'items' => $detail['faqs'], 'open_first' => true ) ); ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $others ) : ?>
		<section class="section" aria-labelledby="svc-rel">
			<header class="section__head"><div><p class="eyebrow"><?php esc_html_e( 'Connect the pieces', 'wavex' ); ?></p><h2 class="section__title" id="svc-rel"><?php esc_html_e( 'Explore related services.', 'wavex' ); ?></h2></div>
				<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'services' ) ); ?>"><?php esc_html_e( 'All services', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></header>
			<div class="card-grid card-grid--3">
				<?php foreach ( array_slice( $others, 0, 3 ) as $other ) : ?>
					<a class="service-card" href="<?php echo esc_url( wavex_url( 'services/' . $other ) ); ?>">
						<span class="service-card__icon"><?php echo wavex_icon( $services[ $other ]['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h3 class="service-card__title"><?php echo esc_html( $services[ $other ]['title'] ); ?></h3>
						<p class="service-card__text"><?php echo esc_html( $services[ $other ]['text'] ); ?></p>
						<span class="service-card__go"><?php esc_html_e( 'Explore service', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	</div>
	<?php
endwhile;

get_template_part( 'template-parts/sections/contact-split' );
get_footer();
