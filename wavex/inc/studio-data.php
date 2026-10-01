<?php
/**
 * Data for the home page "Studio": one illustrative animated scene per service.
 * Scenes show the general process; they are not client results.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Studio navigation groups (each service appears once).
 *
 * @return array<string,array>
 */
function wavex_studio_groups() {
	return array(
		'web'    => array(
			'label'    => __( 'Web & WordPress', 'wavex' ),
			'services' => array( 'web-development', 'responsive-web-design', 'website-redesign', 'ecommerce-development', 'wordpress-development', 'wordpress-design', 'website-maintenance', 'api-integration', 'custom-software-development' ),
		),
		'mobile' => array(
			'label'    => __( 'Mobile Apps', 'wavex' ),
			'services' => array( 'mobile-app-development', 'mobile-app-design', 'mvp-development', 'app-modernization', 'app-maintenance' ),
		),
		'seo'    => array(
			'label'    => __( 'SEO & Marketing', 'wavex' ),
			'services' => array( 'technical-seo', 'search-engine-optimization', 'on-page-seo', 'digital-marketing', 'content-marketing', 'social-media-marketing', 'digital-strategy' ),
		),
	);
}

/**
 * Scene content per service slug.
 *
 * @return array<string,array>
 */
function wavex_studio_scenes() {
	return array(
		'web-development'             => array(
			'scene' => 'web',
			'title' => __( 'A website takes shape, piece by piece', 'wavex' ),
			'text'  => __( 'Your requirements become a responsive website. Watch the layout assemble as the code is written.', 'wavex' ),
			'steps' => array( __( 'Plan the pages and content', 'wavex' ), __( 'Build the layout and features', 'wavex' ), __( 'Check it across screen sizes, then launch', 'wavex' ) ),
			'code'  => array( '<section class="hero">', '  <h1>Your business, online</h1>', '  <a href="/contact/">Get started</a>', '</section>', '/* adapts: phone to desktop */' ),
		),
		'responsive-web-design'       => array(
			'scene' => 'resp',
			'title' => __( 'One design, every screen size', 'wavex' ),
			'text'  => __( 'The same page re-arranges itself for desktop, tablet and phone so it stays easy to read and use.', 'wavex' ),
			'steps' => array( __( 'Design for the smallest screen first', 'wavex' ), __( 'Let the layout flow as space grows', 'wavex' ), __( 'Test on real device sizes', 'wavex' ) ),
			'code'  => array( '.cards { display: grid; gap: 16px; }', '@media (min-width: 600px) {', '  .cards { grid-template-columns: 1fr 1fr; }', '}', '@media (min-width: 960px) {', '  .cards { grid-template-columns: repeat(3, 1fr); }', '}' ),
		),
		'website-redesign'            => array(
			'scene' => 'redesign',
			'title' => __( 'From dated to modern, same content', 'wavex' ),
			'text'  => __( 'An existing website is refreshed with a clearer layout and design, keeping what already works.', 'wavex' ),
			'steps' => array( __( 'Review what the site does today', 'wavex' ), __( 'Redesign layout and visuals', 'wavex' ), __( 'Move content across and relaunch', 'wavex' ) ),
			'code'  => array( '// before: cramped, hard to scan', 'layout.update( {', '  spacing: "comfortable",', '  hierarchy: "clear",', '} );', '// after: modern and readable' ),
		),
		'ecommerce-development'       => array(
			'scene' => 'shop',
			'title' => __( 'From product page to confirmed order', 'wavex' ),
			'text'  => __( 'Products, cart and checkout are built as one smooth path for your customers.', 'wavex' ),
			'steps' => array( __( 'Set up products and catalogue', 'wavex' ), __( 'Build cart and checkout', 'wavex' ), __( 'Connect payments and order handling', 'wavex' ) ),
			'code'  => array( 'cart.add( product );', 'const total = cart.total();', 'await checkout.pay( total );', '// order confirmed' ),
		),
		'wordpress-development'       => array(
			'scene' => 'wordpress',
			'title' => __( 'Build pages by dragging blocks', 'wavex' ),
			'text'  => __( 'A custom WordPress theme is built to your design, then you assemble and edit pages with blocks. Try the editor on the right.', 'wavex' ),
			'steps' => array( __( 'Plan content types and layouts', 'wavex' ), __( 'Build a custom theme', 'wavex' ), __( 'Manage everything from the dashboard', 'wavex' ) ),
			'code'  => array( "register_post_type( 'project', array(", "  'public'   => true,", "  'supports' => array( 'title', 'editor' ),", ') );', '// now editable in WordPress' ),
		),
		'wordpress-design'            => array(
			'scene' => 'theme',
			'title' => __( 'One WordPress site, many looks', 'wavex' ),
			'text'  => __( 'Colours, type and spacing are designed as a system, so the whole site restyles consistently.', 'wavex' ),
			'steps' => array( __( 'Define colours and typography', 'wavex' ), __( 'Design the page templates', 'wavex' ), __( 'Apply them across the theme', 'wavex' ) ),
			'code'  => array( ':root {', '  --brand: #3b4de0;', '  --accent: #12b5cb;', '  --radius: 16px;', '}', '/* change once, update everywhere */' ),
		),
		'website-maintenance'         => array(
			'scene' => 'maint',
			'title' => __( 'Ongoing care, task by task', 'wavex' ),
			'text'  => __( 'Routine updates and checks are handled so your website stays up to date after launch.', 'wavex' ),
			'steps' => array( __( 'Keep software up to date', 'wavex' ), __( 'Take and check backups', 'wavex' ), __( 'Fix issues as they appear', 'wavex' ) ),
			'code'  => array( 'tasks.run( [', '  "update-core",', '  "update-plugins",', '  "backup",', '  "security-check",', '] );' ),
		),
		'api-integration'             => array(
			'scene' => 'api',
			'title' => __( 'Systems that talk to each other', 'wavex' ),
			'text'  => __( 'APIs connect your website, apps and other platforms so data moves where it is needed.', 'wavex' ),
			'steps' => array( __( 'Identify the systems to connect', 'wavex' ), __( 'Connect them through their APIs', 'wavex' ), __( 'Keep data flowing reliably', 'wavex' ) ),
			'code'  => array( 'const res = await fetch( url, {', '  headers: { Authorization: token },', '} );', 'const data = await res.json();', 'sync( website, app, data );' ),
		),
		'custom-software-development' => array(
			'scene' => 'software',
			'title' => __( 'Software shaped around your workflow', 'wavex' ),
			'text'  => __( 'When off-the-shelf tools do not fit, we build software around how your team actually works.', 'wavex' ),
			'steps' => array( __( 'Map your workflow', 'wavex' ), __( 'Build software around it', 'wavex' ), __( 'Maintain and extend it as needs change', 'wavex' ) ),
			'code'  => array( 'function approve( request ) {', '  if ( request.valid ) {', '    workflow.next( request );', '  }', '  return report.update();', '}' ),
		),
		'mobile-app-development'      => array(
			'scene' => 'mobile',
			'title' => __( 'An app, screen by screen', 'wavex' ),
			'text'  => __( 'Screens are designed, developed and connected into an app people can use on their phone.', 'wavex' ),
			'steps' => array( __( 'Design the screens and flow', 'wavex' ), __( 'Develop the app', 'wavex' ), __( 'Launch and keep it maintained', 'wavex' ) ),
			'code'  => array( 'export default function App() {', '  return (', '    <Screen title="Welcome">', '      <List items={ items } />', '    </Screen>', '  );', '}' ),
		),
		'mobile-app-design'           => array(
			'scene' => 'wire',
			'title' => __( 'From rough wireframe to finished design', 'wavex' ),
			'text'  => __( 'App screens start as simple boxes and are shaped into a clear, polished interface.', 'wavex' ),
			'steps' => array( __( 'Sketch the screens and flow', 'wavex' ), __( 'Define colours, type and components', 'wavex' ), __( 'Hand over a polished design', 'wavex' ) ),
			'code'  => array( 'screen("Home", {', '  layout: "wireframe",', '} );', 'screen.style( palette, type );', '// wireframe -> final design' ),
		),
		'mvp-development'             => array(
			'scene' => 'mvp',
			'title' => __( 'From a big idea to a focused first version', 'wavex' ),
			'text'  => __( 'Product discovery sorts ideas into what the first version needs and what can wait.', 'wavex' ),
			'steps' => array( __( 'Discover the idea and its users', 'wavex' ), __( 'Choose the core features', 'wavex' ), __( 'Build and launch a first version', 'wavex' ) ),
			'code'  => array( 'const mvp = features', '  .filter( f => f.core )', '  .slice( 0, 3 );', 'launch( mvp ); // learn, then grow' ),
		),
		'app-modernization'           => array(
			'scene' => 'modern',
			'title' => __( 'Bring an older app up to date', 'wavex' ),
			'text'  => __( 'An existing application is updated with a modern interface and cleaner foundations.', 'wavex' ),
			'steps' => array( __( 'Assess the current app', 'wavex' ), __( 'Update the interface and code', 'wavex' ), __( 'Release the modernized version', 'wavex' ) ),
			'code'  => array( '// legacy screen', 'const ui = modernize( legacyUi, {', '  design: "current",', '  code: "maintainable",', '} );', 'release( ui );' ),
		),
		'app-maintenance'             => array(
			'scene' => 'release',
			'title' => __( 'Keeping your app healthy after launch', 'wavex' ),
			'text'  => __( 'Issues are fixed and updates are released so the app keeps working as phones and needs change.', 'wavex' ),
			'steps' => array( __( 'Track reported issues', 'wavex' ), __( 'Fix and test the changes', 'wavex' ), __( 'Release an updated version', 'wavex' ) ),
			'code'  => array( 'issues.forEach( fix );', 'tests.run();', 'release( "1.0.1" );', '// update published' ),
		),
		'technical-seo'               => array(
			'scene' => 'seo',
			'title' => __( 'Helping search engines understand your site', 'wavex' ),
			'text'  => __( 'Technical foundations and page structure are checked and improved, item by item.', 'wavex' ),
			'steps' => array( __( 'Review how search engines see the site', 'wavex' ), __( 'Fix the technical foundations', 'wavex' ), __( 'Add structure so pages are understood', 'wavex' ) ),
			'code'  => array( '<link rel="canonical" href="/">', '<script type="application/ld+json">', '  { "@type": "Organization" }', '</script>', '<!-- sitemap.xml: ready -->' ),
		),
		'search-engine-optimization'  => array(
			'scene' => 'serp',
			'title' => __( 'Be easier to find when people search', 'wavex' ),
			'text'  => __( 'SEO improves how your pages are understood and presented in search results.', 'wavex' ),
			'steps' => array( __( 'Understand what people search for', 'wavex' ), __( 'Improve pages to match', 'wavex' ), __( 'Review and keep improving', 'wavex' ) ),
			'code'  => array( 'const query = "your service";', 'const results = search( query );', 'improve( yourPage, query );', '// clearer titles and content' ),
		),
		'on-page-seo'                 => array(
			'scene' => 'onpage',
			'title' => __( 'Every page element, working for search', 'wavex' ),
			'text'  => __( 'Titles, descriptions, headings and images on each page are tuned so their purpose is clear.', 'wavex' ),
			'steps' => array( __( 'Write clear titles and descriptions', 'wavex' ), __( 'Structure headings properly', 'wavex' ), __( 'Describe images and link pages', 'wavex' ) ),
			'code'  => array( '<title>Web Development | WaveX</title>', '<meta name="description" content="…">', '<h1>Web Development</h1>', '<img src="…" alt="Describes the image">' ),
		),
		'digital-marketing'           => array(
			'scene' => 'mkt',
			'title' => __( 'Channels working together', 'wavex' ),
			'text'  => __( 'Search, social, email and content are planned together to reach and grow your audience.', 'wavex' ),
			'steps' => array( __( 'Choose the right channels', 'wavex' ), __( 'Run and refine campaigns', 'wavex' ), __( 'Measure and improve', 'wavex' ) ),
			'code'  => array( 'const channels = [', '  "search", "social",', '  "email", "content",', '];', 'campaign.run( channels );', 'report.measure();' ),
		),
		'content-marketing'           => array(
			'scene' => 'cal',
			'title' => __( 'A content plan that fills the calendar', 'wavex' ),
			'text'  => __( 'Articles, guides and posts are planned and published to support your marketing goals.', 'wavex' ),
			'steps' => array( __( 'Plan topics around your audience', 'wavex' ), __( 'Create and edit the content', 'wavex' ), __( 'Publish and promote it', 'wavex' ) ),
			'code'  => array( 'calendar.add( {', '  type: "article",', '  topic: "How it works",', '  date: nextTuesday,', '} );', 'publish( calendar );' ),
		),
		'social-media-marketing'      => array(
			'scene' => 'social',
			'title' => __( 'A social media presence with a plan', 'wavex' ),
			'text'  => __( 'A clear strategy decides what to post, where and when, so your channels stay consistent.', 'wavex' ),
			'steps' => array( __( 'Pick the right platforms', 'wavex' ), __( 'Plan the posts and tone', 'wavex' ), __( 'Review what works and adjust', 'wavex' ) ),
			'code'  => array( 'plan.platforms( [ "A", "B" ] );', 'plan.schedule( posts );', 'review( engagement );', '// adjust the plan' ),
		),
		'digital-strategy'            => array(
			'scene' => 'road',
			'title' => __( 'A roadmap before the build', 'wavex' ),
			'text'  => __( 'Digital strategy sets goals, audience and channels first, so every next step has a direction.', 'wavex' ),
			'steps' => array( __( 'Define goals and audience', 'wavex' ), __( 'Choose channels and priorities', 'wavex' ), __( 'Set how progress is measured', 'wavex' ) ),
			'code'  => array( 'const strategy = {', '  goals, audience,', '  channels, priorities,', '  measure: "monthly",', '};', 'roadmap.build( strategy );' ),
		),
	);
}
