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
		'title' => get_the_title(),
		'text'  => has_excerpt() ? get_the_excerpt() : __( 'A technology and digital services company helping businesses and organizations build, improve, launch and grow.', 'wavex' ),
	) );
	?>
	<div class="wrap wrap--narrow">
		<div class="entry-content"><?php the_content(); ?></div>
	</div>
	<?php
endwhile;

$areas = array(
	'web-wordpress' => array( 'layout', __( 'Web & WordPress', 'wavex' ), __( 'Websites, WordPress platforms and e-commerce, built and looked after.', 'wavex' ) ),
	'mobile-apps'   => array( 'mobile', __( 'Mobile Apps', 'wavex' ), __( 'Mobile applications from product discovery through design, development and support.', 'wavex' ) ),
	'seo-marketing' => array( 'megaphone', __( 'SEO & Marketing', 'wavex' ), __( 'Search visibility, content, social media and the strategy that ties them together.', 'wavex' ) ),
);
$services = wavex_services();
?>
<section class="section section--tint" aria-labelledby="about-cap">
	<header class="section__head section__head--stack">
		<p class="eyebrow"><?php esc_html_e( 'What we do', 'wavex' ); ?></p>
		<h2 class="section__title" id="about-cap"><?php esc_html_e( 'Technology capabilities', 'wavex' ); ?></h2>
	</header>
	<div class="areas">
		<?php foreach ( $areas as $group => $area ) : ?>
			<article class="area">
				<span class="area__icon"><?php echo wavex_icon( $area[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="area__title"><?php echo esc_html( $area[1] ); ?></h3>
				<p class="area__text"><?php echo esc_html( $area[2] ); ?></p>
				<ul class="area__list">
					<?php
					foreach ( $services as $slug => $service ) :
						if ( in_array( $group, $service['groups'], true ) ) :
							?>
							<li><a href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>"><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $service['title'] ); ?></a></li>
							<?php
						endif;
					endforeach;
					?>
				</ul>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="section" aria-labelledby="about-sol">
	<div class="why">
		<div class="why__intro">
			<p class="eyebrow"><?php esc_html_e( 'Digital solutions', 'wavex' ); ?></p>
			<h2 class="section__title" id="about-sol"><?php esc_html_e( 'The kind of solutions we provide', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'We work with businesses and organizations that need to build something new, improve what they have, or reach more people online.', 'wavex' ); ?></p>
			<?php wavex_button( __( 'See our work', 'wavex' ), wavex_url( 'our-work' ), 'ghost' ); ?>
		</div>
		<ul class="why__list">
			<li class="why__item"><span class="why__icon"><?php echo wavex_icon( 'layout' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><div><h3><?php esc_html_e( 'Websites and WordPress platforms', 'wavex' ); ?></h3><p><?php esc_html_e( 'New builds, redesigns, online stores and ongoing maintenance.', 'wavex' ); ?></p></div></li>
			<li class="why__item"><span class="why__icon"><?php echo wavex_icon( 'mobile' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><div><h3><?php esc_html_e( 'Mobile applications', 'wavex' ); ?></h3><p><?php esc_html_e( 'From early product discovery to modernization and maintenance.', 'wavex' ); ?></p></div></li>
			<li class="why__item"><span class="why__icon"><?php echo wavex_icon( 'cube' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><div><h3><?php esc_html_e( 'Custom software and integrations', 'wavex' ); ?></h3><p><?php esc_html_e( 'Software shaped around your workflow, connected through APIs.', 'wavex' ); ?></p></div></li>
			<li class="why__item"><span class="why__icon"><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><div><h3><?php esc_html_e( 'Search and digital marketing', 'wavex' ); ?></h3><p><?php esc_html_e( 'SEO, content, social media and digital strategy.', 'wavex' ); ?></p></div></li>
		</ul>
	</div>
</section>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
