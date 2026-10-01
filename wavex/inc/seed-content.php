<?php
/**
 * Starter content written into pages when they are empty. Editors can change
 * everything afterwards in WordPress; existing content is never overwritten.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Starter HTML per page path.
 *
 * @return array<string,string>
 */
function wavex_starter_content() {
	$contact = esc_url( wavex_url( 'contact' ) );
	$privacy = esc_url( wavex_url( 'privacy-policy' ) );
	$date    = wp_date( get_option( 'date_format' ) );

	$about = '<p>' . esc_html__( 'WaveX Technology is a technology and digital services company. We help businesses and organizations build, improve, launch and grow their digital products and online presence.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'What we do', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'Our work covers three areas: web and WordPress, mobile apps, and SEO and marketing. That includes websites, WordPress development and design, e-commerce, API integration, custom software, mobile app development and design, MVP and product discovery, search engine optimization, digital marketing, content marketing, social media strategy and digital strategy.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'How we work', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'Every project starts by understanding your requirements. We plan the work with you, develop the solution, launch it, and stay available for support afterwards.', 'wavex' ) . '</p>';

	$privacy_html = '<p><em>' . esc_html( sprintf( /* translators: %s: date. */ __( 'Last updated: %s', 'wavex' ), $date ) ) . '</em></p>'
		. '<p>' . esc_html__( 'This Privacy Notice explains how WaveX Technology ("we", "us") collects, uses and protects personal information when you visit this website or contact us.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Information we collect', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'Information you give us: when you use our contact form or free consultation form, or message us by email or WhatsApp, we receive the details you provide, such as your name, email address, phone number, the services you are interested in and your message.', 'wavex' ) . '</p>'
		. '<p>' . esc_html__( 'Information collected automatically: like most websites, our hosting may record technical information such as IP address, browser type, pages visited and the time of the visit. This is used to keep the website secure and working.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'How we use your information', 'wavex' ) . '</h2>'
		. '<ul><li>' . esc_html__( 'To reply to your enquiries and consultation requests.', 'wavex' ) . '</li>'
		. '<li>' . esc_html__( 'To discuss, plan and deliver services you ask us about.', 'wavex' ) . '</li>'
		. '<li>' . esc_html__( 'To keep this website secure, prevent spam and fix technical problems.', 'wavex' ) . '</li>'
		. '<li>' . esc_html__( 'To meet legal obligations where they apply.', 'wavex' ) . '</li></ul>'
		. '<p>' . esc_html__( 'We do not sell your personal information.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Messaging apps', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'If you contact us through WhatsApp or email, your messages are also handled by those services under their own privacy terms. Please do not send sensitive information such as passwords or payment card details in a message.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Sharing your information', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'We share information only with service providers that help us run the website and communicate with you, such as hosting and email providers, and only as needed for those purposes. We may also disclose information if the law requires it.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Cookies', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'This website uses only the cookies needed for it to work. If analytics or marketing tools are added in future, this notice will be updated.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'How long we keep information', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'We keep enquiries for as long as needed to respond to you and to keep a reasonable record of our communication, and then delete them or anonymise them.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Your choices and rights', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'Depending on where you live, you may have the right to ask us for a copy of your personal information, to correct it, to delete it, or to object to or restrict how we use it. To make a request, contact us using the details on our Contact page.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Security', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'We take reasonable steps to protect personal information, but no method of transmission or storage is completely secure.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Children', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'This website is not directed at children, and we do not knowingly collect their personal information.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Changes to this notice', 'wavex' ) . '</h2>'
		. '<p>' . esc_html__( 'We may update this notice from time to time. The date at the top shows when it was last changed.', 'wavex' ) . '</p>'
		. '<h2>' . esc_html__( 'Contact us', 'wavex' ) . '</h2>'
		. '<p>' . sprintf(
			/* translators: %s: link to the Contact page. */
			esc_html__( 'If you have questions about this notice or your information, please get in touch through our %s.', 'wavex' ),
			'<a href="' . $contact . '">' . esc_html__( 'Contact page', 'wavex' ) . '</a>'
		) . '</p>';

	return array(
		'about'          => $about,
		'privacy-policy' => $privacy_html,
	);
}
