<?php
/**
 * FAQ (slug: faq).
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
		'text'  => has_excerpt() ? get_the_excerpt() : __( 'Answers to common questions about our services, process and how to get started.', 'wavex' ),
	) );
endwhile;

$groups = wavex_faq_groups();
?>
<div class="wrap">
	<div class="faq-layout">
		<nav class="faq-layout__nav" aria-label="<?php esc_attr_e( 'FAQ topics', 'wavex' ); ?>">
			<p class="faq-layout__label"><?php esc_html_e( 'Topics', 'wavex' ); ?></p>
			<ul>
				<?php foreach ( $groups as $key => $group ) : ?>
					<li><a href="#faq-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $group['label'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>
		<div class="faq-layout__body">
			<?php foreach ( $groups as $key => $group ) : ?>
				<section class="faq-group" id="faq-<?php echo esc_attr( $key ); ?>" aria-labelledby="faq-<?php echo esc_attr( $key ); ?>-t">
					<h2 class="faq-group__title" id="faq-<?php echo esc_attr( $key ); ?>-t"><?php echo esc_html( $group['label'] ); ?></h2>
					<?php get_template_part( 'template-parts/components/faq-list', null, array( 'items' => $group['items'] ) ); ?>
				</section>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<section class="section section--mix" aria-labelledby="faq-more">
	<div class="split-note">
		<div>
			<h2 class="section__title" id="faq-more"><?php esc_html_e( 'Still have a question?', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Message us and we will answer it directly.', 'wavex' ); ?></p>
		</div>
		<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => __( 'a question', 'wavex' ) ) ); ?>
	</div>
</section>
<?php
get_footer();
