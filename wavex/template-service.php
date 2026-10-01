<?php
/**
 * Template Name: Service Page
 * Template Post Type: page
 *
 * Individual service page under /services/. Shows the service's animated
 * "how it works" scene, what is included, FAQs and related services.
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
$service  = isset( $services[ $slug ] ) ? $services[ $slug ] : null;
$detail   = isset( $details[ $slug ] ) ? $details[ $slug ] : null;
$scene    = isset( $scenes[ $slug ] ) ? $scenes[ $slug ] : null;

// Group label for the eyebrow.
$group_label = __( 'Services', 'wavex' );
foreach ( wavex_studio_groups() as $group ) {
	if ( in_array( $slug, $group['services'], true ) ) {
		$group_label = $group['label'];
		$group_key   = $group;
		break;
	}
}

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/components/page-hero', null, array(
		'eyebrow' => $group_label,
		'title'   => get_the_title(),
		'text'    => $detail ? $detail['intro'] : ( has_excerpt() ? get_the_excerpt() : '' ),
	) );
	?>
	<div class="wrap">
		<div class="hero__actions hero__actions--left">
			<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => get_the_title() ) ); ?>
			<?php wavex_button( __( 'Free Consultation', 'wavex' ), wavex_url( 'free-consultation' ), 'ghost' ); ?>
		</div>
	</div>

	<?php if ( $scene ) : ?>
		<section class="studio studio--single" aria-labelledby="svc-how">
			<div class="studio__inner">
				<header class="studio__head studio__head--left">
					<p class="eyebrow"><?php esc_html_e( 'How it works', 'wavex' ); ?></p>
					<h2 class="section__title" id="svc-how"><?php echo esc_html( $scene['title'] ); ?></h2>
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

	<?php if ( $detail ) : ?>
		<section class="section" aria-labelledby="svc-inc">
			<div class="svc-grid">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'What is included', 'wavex' ); ?></p>
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
					<h3><?php esc_html_e( 'Talk to us about this', 'wavex' ); ?></h3>
					<p><?php esc_html_e( 'Tell us what you need. A short message is enough to start.', 'wavex' ); ?></p>
					<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => get_the_title() ) ); ?>
					<p class="svc-card__note"><a href="<?php echo esc_url( wavex_url( 'free-consultation' ) ); ?>"><?php esc_html_e( 'Or request a free consultation', 'wavex' ); ?></a></p>
				</aside>
			</div>
		</section>

		<section class="section section--mix" aria-labelledby="svc-faq">
			<div class="faq">
				<div class="faq__intro">
					<p class="eyebrow"><?php esc_html_e( 'FAQ', 'wavex' ); ?></p>
					<h2 class="section__title" id="svc-faq"><?php esc_html_e( 'Common questions', 'wavex' ); ?></h2>
					<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'faq' ) ); ?>"><?php esc_html_e( 'All questions', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
				</div>
				<?php get_template_part( 'template-parts/components/faq-list', null, array( 'items' => $detail['faqs'], 'open_first' => true ) ); ?>
			</div>
		</section>
	<?php else : ?>
		<div class="wrap wrap--narrow"><div class="entry-content"><?php the_content(); ?></div></div>
	<?php endif; ?>

	<?php
	// Related services from the same group.
	$related = array();
	if ( isset( $group_key ) ) {
		foreach ( $group_key['services'] as $other ) {
			if ( $other !== $slug && count( $related ) < 3 ) {
				$related[] = $other;
			}
		}
	}
	if ( $related ) :
		?>
		<section class="section" aria-labelledby="svc-rel">
			<header class="section__head"><h2 class="section__title" id="svc-rel"><?php esc_html_e( 'Related services', 'wavex' ); ?></h2>
				<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'services' ) ); ?>"><?php esc_html_e( 'All services', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></header>
			<div class="card-grid card-grid--3">
				<?php foreach ( $related as $other ) : ?>
					<a class="service-card" href="<?php echo esc_url( wavex_url( 'services/' . $other ) ); ?>">
						<span class="service-card__icon"><?php echo wavex_icon( $services[ $other ]['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h3 class="service-card__title"><?php echo esc_html( $services[ $other ]['title'] ); ?></h3>
						<p class="service-card__text"><?php echo esc_html( $services[ $other ]['text'] ); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
	<?php
endwhile;

get_template_part( 'template-parts/sections/contact-split' );
get_footer();
