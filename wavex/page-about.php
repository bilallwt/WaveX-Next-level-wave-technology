<?php
/**
 * About Us (slug: about).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/components/page-hero', null, array(
		'title'   => get_the_title(),
		'eyebrow' => __( 'Who we are', 'wavex' ),
		'text'    => has_excerpt() ? get_the_excerpt() : __( 'A technology and digital services company helping businesses and organizations build, improve, launch and grow.', 'wavex' ),
	) );
	?>
	<section class="ab" aria-label="<?php esc_attr_e( 'About WaveX Technology', 'wavex' ); ?>">
		<div class="ab__main">
			<div class="entry-content prose ab__prose"><?php the_content(); ?></div>
		</div>
		<aside class="ab__side">
			<ul class="ab__stats">
				<li><strong><?php echo (int) count( wavex_services() ); ?></strong><span><?php esc_html_e( 'services across web, mobile and search', 'wavex' ); ?></span></li>
				<li><strong><?php echo (int) count( wavex_service_groups() ); ?></strong><span><?php esc_html_e( 'areas, handled by one team', 'wavex' ); ?></span></li>
				<li><strong><?php echo (int) count( wavex_projects() ); ?></strong><span><?php esc_html_e( 'projects in our work section', 'wavex' ); ?></span></li>
				<li><strong>5</strong><span><?php esc_html_e( 'steps from first message to support', 'wavex' ); ?></span></li>
			</ul>
			<div class="ab__talk">
				<p class="eyebrow"><?php esc_html_e( 'Get in touch', 'wavex' ); ?></p>
				<h3><?php esc_html_e( 'Talk to the team', 'wavex' ); ?></h3>
				<p><?php esc_html_e( 'Tell us about your project or ask us anything. A short message is enough to start.', 'wavex' ); ?></p>
				<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => __( 'WaveX Technology', 'wavex' ) ) ); ?>
				<p class="svc-card__note"><a href="<?php echo esc_url( wavex_url( 'our-approach' ) ); ?>"><?php esc_html_e( 'How we work', 'wavex' ); ?></a></p>
			</div>
		</aside>
	</section>
	<?php
endwhile;

$areas = array(
	'web-wordpress' => array( 'layout', __( 'Web & WordPress', 'wavex' ), __( 'Websites, WordPress platforms and e-commerce, built and looked after.', 'wavex' ) ),
	'mobile-apps'   => array( 'mobile', __( 'Mobile Apps', 'wavex' ), __( 'Mobile applications from product discovery through design, development and support.', 'wavex' ) ),
	'seo-marketing' => array( 'megaphone', __( 'SEO & Marketing', 'wavex' ), __( 'Search visibility, content, social media and the strategy that ties them together.', 'wavex' ) ),
);
$services = wavex_services();
?>
<section class="abc" aria-labelledby="about-cap">
	<div class="abc__inner">
		<header class="abc__head">
			<p class="eyebrow"><?php esc_html_e( 'What we do', 'wavex' ); ?></p>
			<h2 class="section__title" id="about-cap"><?php esc_html_e( 'Technology capabilities', 'wavex' ); ?></h2>
		</header>
		<div class="abc__grid">
			<?php foreach ( $areas as $group => $area ) : ?>
				<article class="abc-card gtheme gtheme--<?php echo esc_attr( 'web-wordpress' === $group ? 'web' : ( 'mobile-apps' === $group ? 'mobile' : 'seo' ) ); ?>">
					<header class="abc-card__head">
						<span class="abc-card__ico"><?php echo wavex_icon( $area[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h3><?php echo esc_html( $area[1] ); ?></h3>
					</header>
					<p><?php echo esc_html( $area[2] ); ?></p>
					<ul>
						<?php
						foreach ( $services as $slug => $service ) :
							if ( in_array( $group, $service['groups'], true ) ) :
								?>
								<li><a href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>"><?php echo wavex_icon( $service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $service['title'] ); ?></a></li>
								<?php
							endif;
						endforeach;
						?>
					</ul>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="abs" aria-labelledby="about-sol">
	<div class="abs__inner">
		<div class="abs__intro">
			<p class="eyebrow"><?php esc_html_e( 'Digital solutions', 'wavex' ); ?></p>
			<h2 class="section__title" id="about-sol"><?php esc_html_e( 'The kind of solutions we provide', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'We work with businesses and organizations that need to build something new, improve what they have, or reach more people online.', 'wavex' ); ?></p>
			<?php wavex_button( __( 'See our work', 'wavex' ), wavex_url( 'our-work' ), 'ghost' ); ?>
		</div>
		<ul class="abs__tiles">
			<li class="abs__tile abs__tile--a"><span class="abs__ico"><?php echo wavex_icon( 'layout' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><h3><?php esc_html_e( 'Websites and WordPress platforms', 'wavex' ); ?></h3><p><?php esc_html_e( 'New builds, redesigns, online stores and ongoing maintenance.', 'wavex' ); ?></p></li>
			<li class="abs__tile abs__tile--b"><span class="abs__ico"><?php echo wavex_icon( 'mobile' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><h3><?php esc_html_e( 'Mobile applications', 'wavex' ); ?></h3><p><?php esc_html_e( 'From early product discovery to modernization and maintenance.', 'wavex' ); ?></p></li>
			<li class="abs__tile abs__tile--c"><span class="abs__ico"><?php echo wavex_icon( 'cube' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><h3><?php esc_html_e( 'Custom software and integrations', 'wavex' ); ?></h3><p><?php esc_html_e( 'Software shaped around your workflow, connected through APIs.', 'wavex' ); ?></p></li>
			<li class="abs__tile abs__tile--d"><span class="abs__ico"><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><h3><?php esc_html_e( 'Search and digital marketing', 'wavex' ); ?></h3><p><?php esc_html_e( 'SEO, content, social media and digital strategy.', 'wavex' ); ?></p></li>
		</ul>
	</div>
</section>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
