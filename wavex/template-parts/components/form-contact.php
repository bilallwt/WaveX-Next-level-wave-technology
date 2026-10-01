<?php
/**
 * Contact form (posts to admin-post.php, handled in inc/forms.php).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$status = wavex_form_status();
?>
<form class="form" id="form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<?php get_template_part( 'template-parts/components/form-notice', null, array( 'status' => $status ) ); ?>
	<input type="hidden" name="action" value="wavex_enquiry">
	<input type="hidden" name="form_type" value="contact">
	<input type="hidden" name="wavex_t" value="<?php echo esc_attr( time() ); ?>">
	<?php wp_nonce_field( 'wavex_enquiry', 'wavex_nonce' ); ?>
	<p class="form__hp" aria-hidden="true"><label>Website <input type="text" name="wavex_website" tabindex="-1" autocomplete="off"></label></p>

	<div class="form__row">
		<p class="form__field"><label for="c-name"><?php esc_html_e( 'Your name', 'wavex' ); ?></label><input id="c-name" name="name" type="text" required autocomplete="name"></p>
		<p class="form__field"><label for="c-email"><?php esc_html_e( 'Email', 'wavex' ); ?></label><input id="c-email" name="email" type="email" required autocomplete="email"></p>
	</div>
	<div class="form__row">
		<p class="form__field"><label for="c-phone"><?php esc_html_e( 'Phone or WhatsApp (optional)', 'wavex' ); ?></label><input id="c-phone" name="phone" type="tel" autocomplete="tel"></p>
		<p class="form__field">
			<label for="c-topic"><?php esc_html_e( 'What is it about?', 'wavex' ); ?></label>
			<select id="c-topic" name="topic">
				<?php foreach ( wavex_contact_topics() as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
	</div>
	<p class="form__field"><label for="c-message"><?php esc_html_e( 'Your message', 'wavex' ); ?></label><textarea id="c-message" name="message" rows="6" required minlength="10"></textarea></p>
	<p class="form__check"><label><input type="checkbox" name="consent" value="1" required>
		<span>
			<?php
			printf(
				/* translators: %s: link to the Privacy Notice. */
				esc_html__( 'I agree that WaveX Technology may use my details to reply to this message, as described in the %s.', 'wavex' ),
				'<a href="' . esc_url( wavex_url( 'privacy-policy' ) ) . '">' . esc_html__( 'Privacy Notice', 'wavex' ) . '</a>'
			);
			?>
		</span></label></p>
	<p><button type="submit" class="btn btn--primary"><?php esc_html_e( 'Send message', 'wavex' ); ?></button></p>
</form>
