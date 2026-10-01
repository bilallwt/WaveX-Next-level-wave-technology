<?php
/**
 * Free consultation request form.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$status   = wavex_form_status();
$services = wavex_services();
?>
<form class="form" id="form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<?php get_template_part( 'template-parts/components/form-notice', null, array( 'status' => $status ) ); ?>
	<input type="hidden" name="action" value="wavex_enquiry">
	<input type="hidden" name="form_type" value="consultation">
	<input type="hidden" name="wavex_t" value="<?php echo esc_attr( time() ); ?>">
	<?php wp_nonce_field( 'wavex_enquiry', 'wavex_nonce' ); ?>
	<p class="form__hp" aria-hidden="true"><label>Website <input type="text" name="wavex_website" tabindex="-1" autocomplete="off"></label></p>

	<div class="form__row">
		<p class="form__field"><label for="f-name"><?php esc_html_e( 'Your name', 'wavex' ); ?></label><input id="f-name" name="name" type="text" required autocomplete="name"></p>
		<p class="form__field"><label for="f-email"><?php esc_html_e( 'Email', 'wavex' ); ?></label><input id="f-email" name="email" type="email" required autocomplete="email"></p>
	</div>
	<div class="form__row">
		<p class="form__field"><label for="f-phone"><?php esc_html_e( 'Phone or WhatsApp', 'wavex' ); ?></label><input id="f-phone" name="phone" type="tel" autocomplete="tel"></p>
		<fieldset class="form__field form__radio">
			<legend><?php esc_html_e( 'Best way to reach you', 'wavex' ); ?></legend>
			<label><input type="radio" name="prefer" value="email" checked> <?php esc_html_e( 'Email', 'wavex' ); ?></label>
			<label><input type="radio" name="prefer" value="whatsapp"> <?php esc_html_e( 'WhatsApp', 'wavex' ); ?></label>
		</fieldset>
	</div>

	<fieldset class="form__field form__services">
		<legend><?php esc_html_e( 'What are you interested in? (optional)', 'wavex' ); ?></legend>
		<?php foreach ( wavex_studio_groups() as $group ) : ?>
			<div class="form__group">
				<p class="form__group-title"><?php echo esc_html( $group['label'] ); ?></p>
				<?php foreach ( $group['services'] as $slug ) : ?>
					<label class="form__chip"><input type="checkbox" name="services[]" value="<?php echo esc_attr( $slug ); ?>"><span><?php echo esc_html( $services[ $slug ]['title'] ); ?></span></label>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</fieldset>

	<p class="form__field"><label for="f-message"><?php esc_html_e( 'Tell us about your project', 'wavex' ); ?></label><textarea id="f-message" name="message" rows="6" required minlength="10"></textarea></p>
	<p class="form__check"><label><input type="checkbox" name="consent" value="1" required>
		<span>
			<?php
			printf(
				/* translators: %s: link to the Privacy Notice. */
				esc_html__( 'I agree that WaveX Technology may use my details to reply to this request, as described in the %s.', 'wavex' ),
				'<a href="' . esc_url( wavex_url( 'privacy-policy' ) ) . '">' . esc_html__( 'Privacy Notice', 'wavex' ) . '</a>'
			);
			?>
		</span></label></p>
	<p><button type="submit" class="btn btn--primary"><?php esc_html_e( 'Request free consultation', 'wavex' ); ?></button></p>
</form>
