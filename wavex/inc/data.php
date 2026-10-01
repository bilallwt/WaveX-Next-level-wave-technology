<?php
/**
 * Structural data: services, projects and mega menus.
 *
 * This is the single source for navigation, the Services overview, the footer
 * and page seeding, so a service is never duplicated in more than one place.
 * Descriptions are neutral one-liners; no statistics, clients or claims.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Service groups shown on the Services overview.
 *
 * @return array<string,string> slug => label.
 */
function wavex_service_groups() {
	return array(
		'web-wordpress' => __( 'Web & WordPress', 'wavex' ),
		'mobile-apps'   => __( 'Mobile Apps', 'wavex' ),
		'seo-marketing' => __( 'SEO & Marketing', 'wavex' ),
	);
}

/**
 * All services. One entry (and one page) per service.
 * "groups" lists every overview group the service is shown in.
 *
 * @return array<string,array>
 */
function wavex_services() {
	return array(
		'web-development'         => array(
			'title'  => __( 'Web Development', 'wavex' ),
			'icon'   => 'code',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Websites built to fit your business and your goals.', 'wavex' ),
		),
		'responsive-web-design'   => array(
			'title'  => __( 'Responsive Web Design', 'wavex' ),
			'icon'   => 'layout',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Website design that works across screen sizes and devices.', 'wavex' ),
		),
		'website-redesign'        => array(
			'title'  => __( 'Website Redesign', 'wavex' ),
			'icon'   => 'refresh',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Refresh and improve an existing website.', 'wavex' ),
		),
		'ecommerce-development'   => array(
			'title'  => __( 'E-commerce Development', 'wavex' ),
			'icon'   => 'cart',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Online stores for selling products and services.', 'wavex' ),
		),
		'wordpress-development'   => array(
			'title'  => __( 'WordPress Development', 'wavex' ),
			'icon'   => 'wordpress',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Custom WordPress websites you can manage yourself.', 'wavex' ),
		),
		'wordpress-design'        => array(
			'title'  => __( 'WordPress Design', 'wavex' ),
			'icon'   => 'pen',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Design for WordPress websites and themes.', 'wavex' ),
		),
		'website-maintenance'     => array(
			'title'  => __( 'Website Maintenance', 'wavex' ),
			'icon'   => 'wrench',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Ongoing care and support for your website.', 'wavex' ),
		),
		'api-integration'         => array(
			'title'  => __( 'API Integration', 'wavex' ),
			'icon'   => 'link',
			'groups' => array( 'web-wordpress', 'mobile-apps' ),
			'text'   => __( 'Connect your website or app with other platforms and services.', 'wavex' ),
		),
		'custom-software-development' => array(
			'title'  => __( 'Custom Software Development', 'wavex' ),
			'icon'   => 'cube',
			'groups' => array( 'web-wordpress' ),
			'text'   => __( 'Software built around your specific requirements.', 'wavex' ),
		),
		'technical-seo'           => array(
			'title'  => __( 'Technical SEO', 'wavex' ),
			'icon'   => 'search',
			'groups' => array( 'web-wordpress', 'seo-marketing' ),
			'text'   => __( 'Technical foundations that help search engines crawl your site.', 'wavex' ),
		),
		'mobile-app-development'  => array(
			'title'  => __( 'Mobile App Development', 'wavex' ),
			'icon'   => 'mobile',
			'groups' => array( 'mobile-apps' ),
			'text'   => __( 'Mobile applications, from idea to launch.', 'wavex' ),
		),
		'mobile-app-design'       => array(
			'title'  => __( 'Mobile App Design', 'wavex' ),
			'icon'   => 'pen',
			'groups' => array( 'mobile-apps' ),
			'text'   => __( 'Interface and experience design for mobile apps.', 'wavex' ),
		),
		'mvp-development'         => array(
			'title'  => __( 'MVP & Product Discovery', 'wavex' ),
			'icon'   => 'rocket',
			'groups' => array( 'mobile-apps' ),
			'text'   => __( 'Shape your idea and plan a first version.', 'wavex' ),
		),
		'app-modernization'       => array(
			'title'  => __( 'App Modernization', 'wavex' ),
			'icon'   => 'refresh',
			'groups' => array( 'mobile-apps' ),
			'text'   => __( 'Update and improve an existing application.', 'wavex' ),
		),
		'app-maintenance'         => array(
			'title'  => __( 'App Maintenance', 'wavex' ),
			'icon'   => 'wrench',
			'groups' => array( 'mobile-apps' ),
			'text'   => __( 'Ongoing support for your mobile app.', 'wavex' ),
		),
		'search-engine-optimization' => array(
			'title'  => __( 'Search Engine Optimization', 'wavex' ),
			'icon'   => 'search',
			'groups' => array( 'seo-marketing' ),
			'text'   => __( 'Improve how your website appears in search results.', 'wavex' ),
		),
		'on-page-seo'             => array(
			'title'  => __( 'On-page SEO', 'wavex' ),
			'icon'   => 'check',
			'groups' => array( 'seo-marketing' ),
			'text'   => __( 'Optimize page content and structure for search.', 'wavex' ),
		),
		'digital-marketing'       => array(
			'title'  => __( 'Digital Marketing', 'wavex' ),
			'icon'   => 'megaphone',
			'groups' => array( 'seo-marketing' ),
			'text'   => __( 'Reach and grow your audience online.', 'wavex' ),
		),
		'content-marketing'       => array(
			'title'  => __( 'Content Marketing', 'wavex' ),
			'icon'   => 'pen',
			'groups' => array( 'seo-marketing' ),
			'text'   => __( 'Content that supports your marketing goals.', 'wavex' ),
		),
		'social-media-marketing'  => array(
			'title'  => __( 'Social Media Strategy', 'wavex' ),
			'icon'   => 'share',
			'groups' => array( 'seo-marketing' ),
			'text'   => __( 'A plan for your social media presence.', 'wavex' ),
		),
		'digital-strategy'        => array(
			'title'  => __( 'Digital Strategy', 'wavex' ),
			'icon'   => 'compass',
			'groups' => array( 'seo-marketing' ),
			'text'   => __( 'Plan your digital direction and next steps.', 'wavex' ),
		),
	);
}

/**
 * Services featured as cards on the home page (keys of wavex_services()).
 *
 * @return string[]
 */
function wavex_featured_services() {
	return array(
		'web-development',
		'wordpress-development',
		'ecommerce-development',
		'mobile-app-development',
		'custom-software-development',
		'search-engine-optimization',
		'digital-marketing',
		'digital-strategy',
	);
}

/**
 * Top-level pages that live outside /services/.
 * path => [ title, template ('' for default) ].
 *
 * @return array<string,array>
 */
function wavex_core_pages() {
	return array(
		'services'          => array( __( 'Services', 'wavex' ), 'template-services.php' ),
		'about'             => array( __( 'About Us', 'wavex' ), '' ),
		'our-approach'      => array( __( 'Our Approach', 'wavex' ), '' ),
		'why-wavex'         => array( __( 'Why WaveX', 'wavex' ), '' ),
		'contact'           => array( __( 'Contact', 'wavex' ), '' ),
		'free-consultation' => array( __( 'Free Consultation', 'wavex' ), '' ),
		'faq'               => array( __( 'FAQ', 'wavex' ), '' ),
		'privacy-policy'    => array( __( 'Privacy Notice', 'wavex' ), '' ),
	);
}

/**
 * Portfolio projects. Only names and slugs are known; no details invented.
 *
 * @return array<string,array>
 */
function wavex_projects() {
	return array(
		'racelookup' => array(
			'title' => 'RaceLookup',
			'type'  => 'web',
		),
		'exoticpet'  => array(
			'title' => 'ExoticPet Wholesale',
			'type'  => 'web',
		),
		'grup-fund'  => array(
			'title' => 'The Grup Fund',
			'type'  => 'web',
		),
		'y2y'        => array(
			'title' => 'Y2Y App',
			'type'  => 'app',
		),
		'why-app'    => array(
			'title' => 'Why App',
			'type'  => 'app',
		),
	);
}

/**
 * Shorthand: link to a service page.
 *
 * @param string $slug Service slug.
 * @return array [label, path]
 */
function wavex_svc_link( $slug ) {
	$services = wavex_services();
	return array( $services[ $slug ]['title'], 'services/' . $slug );
}

/**
 * Shorthand: link to a project page.
 *
 * @param string $slug Project slug.
 * @return array [label, path]
 */
function wavex_proj_link( $slug ) {
	$projects = wavex_projects();
	return array( $projects[ $slug ]['title'], 'our-work/' . $slug );
}

/**
 * Header navigation including the mega menus.
 *
 * Each item: label, path, optional 'columns' (heading + links) and 'cta'.
 *
 * @return array[]
 */
function wavex_primary_menu() {
	$all_services = array( __( 'Explore All Services', 'wavex' ), 'services' );
	$approach     = array( __( 'Our Approach', 'wavex' ), 'our-approach' );
	$why          = array( __( 'Why WaveX', 'wavex' ), 'why-wavex' );
	$consult      = array( __( 'Free Consultation', 'wavex' ), 'free-consultation' );
	$faq          = array( __( 'Common Questions', 'wavex' ), 'faq' );
	$all_projects = array( __( 'All Client Projects', 'wavex' ), 'our-work' );

	$menu = array(
		array(
			'label' => __( 'Home', 'wavex' ),
			'path'  => '',
		),
		array(
			'label'   => __( 'Web & WordPress', 'wavex' ),
			'path'    => 'services#web-wordpress',
			'columns' => array(
				array(
					'title' => __( 'Websites', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'web-development' ),
						wavex_svc_link( 'responsive-web-design' ),
						wavex_svc_link( 'website-redesign' ),
						wavex_svc_link( 'ecommerce-development' ),
					),
				),
				array(
					'title' => __( 'WordPress & Support', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'wordpress-development' ),
						wavex_svc_link( 'wordpress-design' ),
						wavex_svc_link( 'website-maintenance' ),
						$all_services,
					),
				),
				array(
					'title' => __( 'Connected Platforms', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'api-integration' ),
						wavex_svc_link( 'custom-software-development' ),
						wavex_svc_link( 'mobile-app-development' ),
						wavex_svc_link( 'technical-seo' ),
					),
				),
				array(
					'title' => __( 'Explore Our Work', 'wavex' ),
					'links' => array(
						wavex_proj_link( 'racelookup' ),
						wavex_proj_link( 'exoticpet' ),
						wavex_proj_link( 'grup-fund' ),
						$approach,
					),
				),
			),
		),
		array(
			'label'   => __( 'Mobile Apps', 'wavex' ),
			'path'    => 'services#mobile-apps',
			'columns' => array(
				array(
					'title' => __( 'Design & Development', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'mobile-app-development' ),
						wavex_svc_link( 'mobile-app-design' ),
						wavex_svc_link( 'mvp-development' ),
					),
				),
				array(
					'title' => __( 'Improve & Connect', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'app-modernization' ),
						wavex_svc_link( 'app-maintenance' ),
						wavex_svc_link( 'api-integration' ),
					),
				),
				array(
					'title' => __( 'From Idea to Launch', 'wavex' ),
					'links' => array(
						$approach,
						array( __( 'Project FAQs', 'wavex' ), 'faq' ),
						array( __( 'All Our Services', 'wavex' ), 'services' ),
						$consult,
					),
				),
				array(
					'title' => __( 'Our App Work', 'wavex' ),
					'links' => array(
						wavex_proj_link( 'y2y' ),
						wavex_proj_link( 'why-app' ),
						$all_projects,
						$why,
					),
				),
			),
		),
		array(
			'label'   => __( 'SEO & Marketing', 'wavex' ),
			'path'    => 'services#seo-marketing',
			'columns' => array(
				array(
					'title' => __( 'Search & Visibility', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'search-engine-optimization' ),
						wavex_svc_link( 'on-page-seo' ),
						wavex_svc_link( 'technical-seo' ),
					),
				),
				array(
					'title' => __( 'Content & Strategy', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'digital-marketing' ),
						wavex_svc_link( 'content-marketing' ),
						wavex_svc_link( 'social-media-marketing' ),
						wavex_svc_link( 'digital-strategy' ),
					),
				),
				array(
					'title' => __( 'Your Web Foundation', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'responsive-web-design' ),
						wavex_svc_link( 'website-redesign' ),
						wavex_svc_link( 'wordpress-development' ),
						array( __( 'All Our Services', 'wavex' ), 'services' ),
					),
				),
				array(
					'title' => __( 'Make Your Next Move', 'wavex' ),
					'links' => array(
						$why,
						$approach,
						$faq,
						array( __( 'Contact Our Team', 'wavex' ), 'contact' ),
					),
				),
			),
		),
		array(
			'label'   => __( 'Our Work', 'wavex' ),
			'path'    => 'our-work',
			'columns' => array(
				array(
					'title' => __( 'Websites & Platforms', 'wavex' ),
					'links' => array(
						wavex_proj_link( 'racelookup' ),
						wavex_proj_link( 'exoticpet' ),
						wavex_proj_link( 'grup-fund' ),
					),
				),
				array(
					'title' => __( 'Mobile Applications', 'wavex' ),
					'links' => array(
						wavex_proj_link( 'y2y' ),
						wavex_proj_link( 'why-app' ),
						$all_projects,
					),
				),
				array(
					'title' => __( 'Behind the Work', 'wavex' ),
					'links' => array(
						$approach,
						array( __( 'About WaveX', 'wavex' ), 'about' ),
						$why,
					),
				),
				array(
					'title' => __( 'Your Next Project', 'wavex' ),
					'links' => array(
						array( __( 'Explore Our Services', 'wavex' ), 'services' ),
						array( __( 'Project FAQs', 'wavex' ), 'faq' ),
						array( __( 'Start a Conversation', 'wavex' ), 'contact' ),
						$consult,
					),
				),
			),
		),
		array(
			'label'   => __( 'About', 'wavex' ),
			'path'    => 'about',
			'columns' => array(
				array(
					'title' => __( 'Meet WaveX', 'wavex' ),
					'links' => array(
						array( __( 'About Us', 'wavex' ), 'about' ),
						$approach,
						$why,
						array( __( 'Our Work', 'wavex' ), 'our-work' ),
					),
				),
				array(
					'title' => __( 'Our Expertise', 'wavex' ),
					'links' => array(
						wavex_svc_link( 'web-development' ),
						wavex_svc_link( 'mobile-app-development' ),
						wavex_svc_link( 'wordpress-development' ),
						wavex_svc_link( 'digital-marketing' ),
					),
				),
				array(
					'title' => __( 'Explore Our Work', 'wavex' ),
					'links' => array(
						wavex_proj_link( 'y2y' ),
						wavex_proj_link( 'racelookup' ),
						wavex_proj_link( 'exoticpet' ),
						array( __( 'All Projects', 'wavex' ), 'our-work' ),
					),
				),
				array(
					'title' => __( "Let's Connect", 'wavex' ),
					'links' => array(
						array( __( 'Contact Our Team', 'wavex' ), 'contact' ),
						$consult,
						$faq,
						array( __( 'Privacy Notice', 'wavex' ), 'privacy-policy' ),
					),
				),
			),
		),
		array(
			'label' => __( 'Contact', 'wavex' ),
			'path'  => 'contact',
		),
		array(
			'label' => __( 'Free Consultation', 'wavex' ),
			'path'  => 'free-consultation',
			'cta'   => true,
		),
	);

	/**
	 * Filter the header navigation structure.
	 *
	 * @param array[] $menu Menu items.
	 */
	return apply_filters( 'wavex_primary_menu', $menu );
}
