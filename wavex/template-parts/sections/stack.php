<?php
/**
 * Home: "capabilities as code" panel built from the services data.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$groups   = array(
	'web'    => 'web-wordpress',
	'mobile' => 'mobile-apps',
	'growth' => 'seo-marketing',
);
$limit    = 4;
?>
<section class="stack" aria-labelledby="stack-title">
	<div class="stack__inner">
		<div class="stack__copy">
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'How it fits together', 'wavex' ); ?></p>
			<h2 class="stack__title" id="stack-title"><?php esc_html_e( 'One connected stack of digital services', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Websites, apps, integrations, software and search visibility are designed to work together, so each piece supports the next.', 'wavex' ); ?></p>
			<ul class="stack__points">
				<li><?php echo wavex_icon( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'APIs connect your website, apps and platforms', 'wavex' ); ?></li>
				<li><?php echo wavex_icon( 'cube' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Custom software for what off-the-shelf tools cannot do', 'wavex' ); ?></li>
				<li><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Technical SEO built into the foundation', 'wavex' ); ?></li>
			</ul>
		</div>

		<figure class="code" aria-label="<?php esc_attr_e( 'Overview of WaveX services', 'wavex' ); ?>">
			<figcaption class="code__bar">
				<span class="code__dot"></span><span class="code__dot"></span><span class="code__dot"></span>
				<span class="code__file">wavex.services</span>
			</figcaption>
<pre class="code__body"><code><span class="tk-p">const</span> <span class="tk-v">wavex</span> = {
<?php
foreach ( $groups as $key => $group_slug ) :
	$titles = array();
	foreach ( $services as $service ) {
		if ( in_array( $group_slug, $service['groups'], true ) ) {
			$titles[] = $service['title'];
		}
	}
	$more = max( 0, count( $titles ) - $limit );
	echo '  <span class="tk-k">' . esc_html( $key ) . '</span>: [' . "\n";
	foreach ( array_slice( $titles, 0, $limit ) as $title ) {
		echo '    <span class="tk-s">"' . esc_html( $title ) . '"</span>,' . "\n";
	}
	if ( $more ) {
		/* translators: %d: number of additional services. */
		echo '    <span class="tk-c">// ' . esc_html( sprintf( __( '+ %d more', 'wavex' ), $more ) ) . '</span>' . "\n";
	}
	echo '  ],' . "\n";
endforeach;
?>
};</code></pre>
		</figure>
	</div>
</section>
