<?php
/** Scene: WordPress development (interactive drag and drop). @package WaveX */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mk-wpe" data-wp-demo>
	<div class="mk-wpe__bar">
		<span class="mk-wpe__dots"><i></i><i></i><i></i></span>
		<span class="mk-url"><?php esc_html_e( 'WordPress editor', 'wavex' ); ?></span>
		<button type="button" class="mk-wpe__btn" data-wp-reset><?php esc_html_e( 'Reset', 'wavex' ); ?></button>
		<button type="button" class="mk-wpe__btn mk-wpe__btn--go" data-wp-publish><?php esc_html_e( 'Publish', 'wavex' ); ?></button>
	</div>
	<p class="mk-wpe__hint"><?php esc_html_e( 'Try it: drag a block onto the page, or press a block to add it.', 'wavex' ); ?></p>
	<div class="mk-wpe__body">
		<div class="mk-wpe__side" role="group" aria-label="<?php esc_attr_e( 'Blocks', 'wavex' ); ?>">
			<button type="button" class="mk-chip" data-block="heading"><?php esc_html_e( 'Heading', 'wavex' ); ?></button>
			<button type="button" class="mk-chip" data-block="image"><?php esc_html_e( 'Image', 'wavex' ); ?></button>
			<button type="button" class="mk-chip" data-block="text"><?php esc_html_e( 'Text', 'wavex' ); ?></button>
			<button type="button" class="mk-chip" data-block="button"><?php esc_html_e( 'Button', 'wavex' ); ?></button>
			<button type="button" class="mk-chip" data-block="gallery"><?php esc_html_e( 'Gallery', 'wavex' ); ?></button>
		</div>
		<div class="mk-wpe__canvas" data-wp-canvas aria-live="polite">
			<p class="mk-wpe__empty"><?php esc_html_e( 'Drop blocks here', 'wavex' ); ?></p>
		</div>
	</div>
	<span class="mk-tag mk-tag--g mk-wpe__done" data-wp-done hidden><?php esc_html_e( 'Published', 'wavex' ); ?></span>
	<span class="mk-ghost" data-wp-ghost hidden></span>
	<svg class="mk-cursor" data-wp-cursor hidden width="22" height="22" viewBox="0 0 22 22" aria-hidden="true"><path d="M3 2l14 8-6 2 4 7-3 1.6-4-7-5 4V2z" fill="#0f1b4d" stroke="#fff" stroke-width="1.5" stroke-linejoin="round"/></svg>
</div>
