<?php
/**
 * Home: interactive "see how it works" demo, one animated scene per development service.
 * Scenes are illustrations of the process, not client results.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$scenes = array(
	'web'      => array(
		'service' => 'web-development',
		'label'   => __( 'Web', 'wavex' ),
		'icon'    => 'code',
		'title'   => __( 'A website takes shape, piece by piece', 'wavex' ),
		'text'    => __( 'Your requirements become a responsive website. Watch the layout assemble as the code is written.', 'wavex' ),
		'steps'   => array( __( 'Plan the pages and content', 'wavex' ), __( 'Build the layout and features', 'wavex' ), __( 'Check it across screen sizes, then launch', 'wavex' ) ),
		'code'    => array( '<section class="hero">', '  <h1>Your business, online</h1>', '  <a href="/contact/">Get started</a>', '</section>', '/* adapts: phone to desktop */' ),
	),
	'wordpress' => array(
		'service' => 'wordpress-development',
		'label'   => __( 'WordPress', 'wavex' ),
		'icon'    => 'wordpress',
		'title'   => __( 'Content you can edit yourself', 'wavex' ),
		'text'    => __( 'A custom WordPress theme is built to your design, then you manage pages and posts from the dashboard.', 'wavex' ),
		'steps'   => array( __( 'Plan content types and layouts', 'wavex' ), __( 'Build a custom theme', 'wavex' ), __( 'Manage everything from the dashboard', 'wavex' ) ),
		'code'    => array( "register_post_type( 'project', array(", "  'public'   => true,", "  'supports' => array( 'title', 'editor' ),", ') );', '// now editable in WordPress' ),
	),
	'shop'     => array(
		'service' => 'ecommerce-development',
		'label'   => __( 'E-commerce', 'wavex' ),
		'icon'    => 'cart',
		'title'   => __( 'From product page to confirmed order', 'wavex' ),
		'text'    => __( 'Products, cart and checkout are built as one smooth path for your customers.', 'wavex' ),
		'steps'   => array( __( 'Set up products and catalogue', 'wavex' ), __( 'Build cart and checkout', 'wavex' ), __( 'Connect payments and order handling', 'wavex' ) ),
		'code'    => array( 'cart.add( product );', 'const total = cart.total();', 'await checkout.pay( total );', '// order confirmed' ),
	),
	'api'      => array(
		'service' => 'api-integration',
		'label'   => __( 'API', 'wavex' ),
		'icon'    => 'link',
		'title'   => __( 'Systems that talk to each other', 'wavex' ),
		'text'    => __( 'APIs connect your website, apps and other platforms so data moves where it is needed.', 'wavex' ),
		'steps'   => array( __( 'Identify the systems to connect', 'wavex' ), __( 'Connect them through their APIs', 'wavex' ), __( 'Keep data flowing reliably', 'wavex' ) ),
		'code'    => array( 'const res = await fetch( url, {', '  headers: { Authorization: token },', '} );', 'const data = await res.json();', 'sync( website, app, data );' ),
	),
	'software' => array(
		'service' => 'custom-software-development',
		'label'   => __( 'Software', 'wavex' ),
		'icon'    => 'cube',
		'title'   => __( 'Software shaped around your workflow', 'wavex' ),
		'text'    => __( 'When off-the-shelf tools do not fit, we build software around how your team actually works.', 'wavex' ),
		'steps'   => array( __( 'Map your workflow', 'wavex' ), __( 'Build software around it', 'wavex' ), __( 'Maintain and extend it as needs change', 'wavex' ) ),
		'code'    => array( 'function approve( request ) {', '  if ( request.valid ) {', '    workflow.next( request );', '  }', '  return report.update();', '}' ),
	),
	'mobile'   => array(
		'service' => 'mobile-app-development',
		'label'   => __( 'Mobile App', 'wavex' ),
		'icon'    => 'mobile',
		'title'   => __( 'An app, screen by screen', 'wavex' ),
		'text'    => __( 'Screens are designed, developed and connected into an app people can use on their phone.', 'wavex' ),
		'steps'   => array( __( 'Design the screens and flow', 'wavex' ), __( 'Develop the app', 'wavex' ), __( 'Launch and keep it maintained', 'wavex' ) ),
		'code'    => array( 'export default function App() {', '  return (', '    <Screen title="Welcome">', '      <List items={ items } />', '    </Screen>', '  );', '}' ),
	),
	'mvp'      => array(
		'service' => 'mvp-development',
		'label'   => __( 'MVP', 'wavex' ),
		'icon'    => 'rocket',
		'title'   => __( 'From a big idea to a focused first version', 'wavex' ),
		'text'    => __( 'Product discovery sorts ideas into what the first version needs and what can wait.', 'wavex' ),
		'steps'   => array( __( 'Discover the idea and its users', 'wavex' ), __( 'Choose the core features', 'wavex' ), __( 'Build and launch a first version', 'wavex' ) ),
		'code'    => array( 'const mvp = features', '  .filter( f => f.core )', '  .slice( 0, 3 );', 'launch( mvp ); // learn, then grow' ),
	),
	'seo'      => array(
		'service' => 'technical-seo',
		'label'   => __( 'Technical SEO', 'wavex' ),
		'icon'    => 'search',
		'title'   => __( 'Helping search engines understand your site', 'wavex' ),
		'text'    => __( 'Technical foundations and page structure are checked and improved, item by item.', 'wavex' ),
		'steps'   => array( __( 'Review how search engines see the site', 'wavex' ), __( 'Fix the technical foundations', 'wavex' ), __( 'Add structure so pages are understood', 'wavex' ) ),
		'code'    => array( '<link rel="canonical" href="/">', '<script type="application/ld+json">', '  { "@type": "Organization" }', '</script>', '<!-- sitemap.xml: ready -->' ),
	),
);
?>
<section class="magic" aria-labelledby="magic-title" data-magic>
	<div class="magic__inner">
		<header class="magic__head">
			<p class="eyebrow eyebrow--pill"><?php esc_html_e( 'See how it works', 'wavex' ); ?></p>
			<h2 class="section__title" id="magic-title"><?php esc_html_e( 'Watch each service come to life', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Choose a service to see, in a simple animation, what happens behind the scenes. These are illustrations of our process.', 'wavex' ); ?></p>
		</header>

		<div class="magic__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Development services', 'wavex' ); ?>">
			<?php
			$i = 0;
			foreach ( $scenes as $key => $scene ) :
				?>
				<button class="magic__tab" type="button" role="tab" id="tab-<?php echo esc_attr( $key ); ?>" aria-controls="panel-<?php echo esc_attr( $key ); ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>" tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>">
					<?php echo wavex_icon( $scene['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php echo esc_html( $scene['label'] ); ?>
				</button>
				<?php
				++$i;
			endforeach;
			?>
		</div>

		<?php
		$i = 0;
		foreach ( $scenes as $key => $scene ) :
			?>
			<div class="magic__panel" id="panel-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr( $key ); ?>"<?php echo 0 === $i ? '' : ' hidden'; ?> data-code="<?php echo esc_attr( wp_json_encode( $scene['code'] ) ); ?>">
				<div class="magic__left">
					<h3 class="magic__title"><?php echo esc_html( $scene['title'] ); ?></h3>
					<p><?php echo esc_html( $scene['text'] ); ?></p>

					<figure class="code code--live" aria-label="<?php esc_attr_e( 'Example code, illustrative', 'wavex' ); ?>">
						<figcaption class="code__bar">
							<span class="code__dot"></span><span class="code__dot"></span><span class="code__dot"></span>
							<span class="code__file"><?php esc_html_e( 'example code', 'wavex' ); ?></span>
						</figcaption>
						<pre class="code__body"><code class="magic__code" aria-hidden="true"></code><noscript><?php echo esc_html( implode( "\n", $scene['code'] ) ); ?></noscript></pre>
					</figure>

					<ol class="magic__steps">
						<?php foreach ( $scene['steps'] as $step ) : ?>
							<li><?php echo esc_html( $step ); ?></li>
						<?php endforeach; ?>
					</ol>

					<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'services/' . $scene['service'] ) ); ?>">
						<?php
						/* translators: %s: service label. */
						echo esc_html( sprintf( __( 'About %s', 'wavex' ), $scene['label'] ) );
						?>
						<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</div>

				<div class="stage" aria-hidden="true">
					<?php get_template_part( 'template-parts/magic/scene', $key ); ?>
				</div>
			</div>
			<?php
			++$i;
		endforeach;
		?>

		<div class="magic__cta">
			<p><strong><?php esc_html_e( 'Have something in mind?', 'wavex' ); ?></strong> <?php esc_html_e( 'Tell us about it and we will talk it through.', 'wavex' ); ?></p>
			<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => __( 'a development project', 'wavex' ) ) ); ?>
		</div>
	</div>
</section>
