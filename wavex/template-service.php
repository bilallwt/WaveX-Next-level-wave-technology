<?php
/**
 * Template Name: Service Page
 * Template Post Type: page
 *
 * Individual service page under /services/: overview, animated "how it works"
 * scene, process, FAQs and related services.
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
$hero_images = array(
	'web'    => array( 'img_web', 'img-web.jpg', __( 'A code editor next to a live dashboard preview', 'wavex' ) ),
	'mobile' => array( 'img_mobile', 'img-mobile.jpg', __( 'Two smartphones showing app screens', 'wavex' ) ),
	'seo'    => array( 'img_seo', 'img-seo.jpg', __( 'A search bar above a rising growth chart', 'wavex' ) ),
);
$hero_img = $hero_images[ $group_id ];

// Four-step process (Support is merged with Launch).
$steps = wavex_approach_steps();
$four  = array(
	array( $steps[0]['title'], $steps[0]['text'] ),
	array( $steps[1]['title'], $steps[1]['text'] ),
	array( $steps[2]['title'], $steps[2]['text'] ),
	array( __( 'Launch & support', 'wavex' ), $steps[3]['text'] . ' ' . $steps[4]['text'] ),
);

while ( have_posts() ) :
	the_post();
	?>
	<header class="svc-hero">
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
		<div class="svc-hero__visual">
			<?php wavex_theme_image( $hero_img[0], $hero_img[1], $hero_img[2], 'svc-hero__img', array( 'fetchpriority' => 'high', 'width' => 1024, 'height' => 768 ) ); ?>
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
					<p class="eyebrow"><?php esc_html_e( 'Made for your business', 'wavex' ); ?></p>
					<h2 class="section__title" id="svc-inc"><?php esc_html_e( 'What this service covers', 'wavex' ); ?></h2>
					<ul class="ticks ticks--one ticks--big">
						<?php foreach ( $detail['includes'] as $item ) : ?>
							<li><span><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $item ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<?php if ( get_the_content() ) : ?>
						<div class="entry-content"><?php the_content(); ?></div>
					<?php endif; ?>
				</div>
				<aside class="svc-card">
					<p class="eyebrow"><?php esc_html_e( 'Start with a conversation', 'wavex' ); ?></p>
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
					<p class="eyebrow"><?php esc_html_e( 'How it works', 'wavex' ); ?></p>
					<h2 class="section__title" id="svc-how-title"><?php echo esc_html( $scene['title'] ); ?></h2>
					<p><?php echo esc_html( $scene['text'] ); ?> <em><?php esc_html_e( 'Illustration of the process.', 'wavex' ); ?></em></p>
				</header>
				<div class="studio__shell studio__shell--single" data-studio-single>
					<div class="studio__main">
						<div class="studio__panel" data-code="<?php echo esc_attr( wp_json_encode( $scene['code'] ) ); ?>">
							<div class="stage"<?php echo ( 'wordpress' === $scene['scene'] ) ? '' : ' aria-hidden="true"'; ?>>
								<?php get_template_part( 'template-parts/studio/scene', $scene['scene'] ); ?>
							</div>
							<div class="studio__bottom">
								<figure class="code code--live" aria-label="<?php esc_attr_e( 'Example code, illustrative', 'wavex' ); ?>">
									<figcaption class="code__bar"><span class="code__dot"></span><span class="code__dot"></span><span class="code__dot"></span><span class="code__file"><?php esc_html_e( 'example code', 'wavex' ); ?></span></figcaption>
									<pre class="code__body"><code class="studio__code" aria-hidden="true"></code><noscript><?php echo esc_html( implode( "\n", $scene['code'] ) ); ?></noscript></pre>
								</figure>
								<ol class="studio__steps">
									<?php foreach ( $scene['steps'] as $step ) : ?>
										<li><?php echo esc_html( $step ); ?></li>
									<?php endforeach; ?>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="section section--tint" id="svc-process" aria-labelledby="svc-proc-title">
		<p class="eyebrow"><?php esc_html_e( 'From the first conversation', 'wavex' ); ?></p>
		<h2 class="section__title" id="svc-proc-title"><?php esc_html_e( 'A clear path to launch.', 'wavex' ); ?></h2>
		<ol class="steps steps--four">
			<?php foreach ( $four as $n => $step ) : ?>
				<li class="steps__item">
					<span class="steps__num"><?php echo esc_html( str_pad( (string) ( $n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3 class="steps__title"><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
		<p><a class="link-arrow" href="<?php echo esc_url( wavex_url( 'our-approach' ) ); ?>"><?php esc_html_e( 'Explore our full process', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
	</section>

	<?php if ( $detail ) : ?>
		<section class="section" id="svc-faq" aria-labelledby="svc-faq-title">
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

	<?php
	$related = array();
	if ( $group_key ) {
		foreach ( $group_key['services'] as $other ) {
			if ( $other !== $slug && count( $related ) < 3 ) {
				$related[] = $other;
			}
		}
	}
	if ( $related ) :
		?>
		<section class="section section--tint" aria-labelledby="svc-rel">
			<header class="section__head"><div><p class="eyebrow"><?php esc_html_e( 'Connect the pieces', 'wavex' ); ?></p><h2 class="section__title" id="svc-rel"><?php esc_html_e( 'Explore related services.', 'wavex' ); ?></h2></div>
				<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'services' ) ); ?>"><?php esc_html_e( 'All services', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></header>
			<div class="card-grid card-grid--3">
				<?php foreach ( $related as $other ) : ?>
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
	<?php
endwhile;

get_template_part( 'template-parts/sections/contact-split' );
get_footer();
