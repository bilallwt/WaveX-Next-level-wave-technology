<?php
/**
 * Page content data used by the inner-page templates.
 * Wording describes services and process only: no prices, timelines,
 * statistics, clients or awards.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Longer description, inclusions and FAQs for each service page.
 *
 * @return array<string,array>
 */
function wavex_service_details() {
	$d = array(
		'web-development'             => array(
			'intro'    => __( 'We design and build websites around your business goals, from focused brochure sites to larger custom builds. Each project starts with your requirements and ends with a website that is ready to launch and straightforward to maintain.', 'wavex' ),
			'includes' => array( __( 'Requirements gathering and page planning', 'wavex' ), __( 'Responsive layout and visual design', 'wavex' ), __( 'Custom features and integrations', 'wavex' ), __( 'Content setup and launch support', 'wavex' ), __( 'Testing across browsers and devices', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Do you build websites from scratch?', 'wavex' ), __( 'Yes. We can build a custom website around your requirements, or improve a website you already have.', 'wavex' ) ),
				array( __( 'Will my website work on mobile?', 'wavex' ), __( 'Yes. Responsive design is part of how we build websites, so they adapt to phones, tablets and desktops.', 'wavex' ) ),
			),
		),
		'responsive-web-design'       => array(
			'intro'    => __( 'Responsive design makes a website adapt to desktop, tablet and phone screens, so visitors get a clear and usable experience on whichever device they use.', 'wavex' ),
			'includes' => array( __( 'Mobile-first page layouts', 'wavex' ), __( 'Flexible grids and images', 'wavex' ), __( 'Readable typography on small screens', 'wavex' ), __( 'Touch-friendly navigation and buttons', 'wavex' ), __( 'Testing on common screen sizes', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Does responsive design mean a separate mobile site?', 'wavex' ), __( 'No. One website adapts itself to the screen it is viewed on.', 'wavex' ) ),
				array( __( 'Can you make my existing website responsive?', 'wavex' ), __( 'Often yes. We review the website and recommend whether to adapt it or redesign it.', 'wavex' ) ),
			),
		),
		'website-redesign'            => array(
			'intro'    => __( 'A redesign refreshes the look, structure and usability of an existing website while keeping the content and goals that still matter.', 'wavex' ),
			'includes' => array( __( 'Review of the current website', 'wavex' ), __( 'New layout and visual design', 'wavex' ), __( 'Clearer navigation and page structure', 'wavex' ), __( 'Content migration', 'wavex' ), __( 'Launch support', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Will I lose my existing content?', 'wavex' ), __( 'No. We plan the move so existing content is carried across into the new design.', 'wavex' ) ),
				array( __( 'How do you protect search visibility during a redesign?', 'wavex' ), __( 'We plan page addresses and structure carefully so important pages are handled properly when the new site goes live.', 'wavex' ) ),
			),
		),
		'ecommerce-development'       => array(
			'intro'    => __( 'We build online stores that present products clearly and guide customers from browsing to checkout.', 'wavex' ),
			'includes' => array( __( 'Product catalogue setup', 'wavex' ), __( 'Cart and checkout experience', 'wavex' ), __( 'Payment and order handling', 'wavex' ), __( 'Store management area', 'wavex' ), __( 'Integrations with the other systems you use', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Which platform will my store use?', 'wavex' ), __( 'We choose the approach with you, based on your products and requirements.', 'wavex' ) ),
				array( __( 'Can I manage products myself?', 'wavex' ), __( 'That is a normal goal. We set the store up so products and orders can be managed from an admin area.', 'wavex' ) ),
			),
		),
		'wordpress-development'       => array(
			'intro'    => __( 'We build custom WordPress websites and themes designed around your content, with an editing experience that lets you manage pages and posts yourself.', 'wavex' ),
			'includes' => array( __( 'Custom theme development', 'wavex' ), __( 'Custom content types and structures', 'wavex' ), __( 'Editing with the WordPress block editor', 'wavex' ), __( 'Plugins and integrations where they are needed', 'wavex' ), __( 'Development that follows WordPress best practices', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Do I need a page builder plugin?', 'wavex' ), __( 'Not necessarily. We can build a custom theme where WordPress manages your content without a page builder.', 'wavex' ) ),
				array( __( 'Can you work on an existing WordPress website?', 'wavex' ), __( 'Yes. We can review it and improve, extend or rebuild it.', 'wavex' ) ),
			),
		),
		'wordpress-design'            => array(
			'intro'    => __( 'WordPress design plans how your site looks and feels before it is built, so colours, type, layouts and templates work together as one system.', 'wavex' ),
			'includes' => array( __( 'Colour, type and spacing system', 'wavex' ), __( 'Page and template layouts', 'wavex' ), __( 'Blog and archive designs', 'wavex' ), __( 'Responsive designs for each screen size', 'wavex' ), __( 'Handover to development', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Is design included with development?', 'wavex' ), __( 'It can be. Design and development can be one project or handled separately.', 'wavex' ) ),
				array( __( 'Can you redesign my current WordPress theme?', 'wavex' ), __( 'Yes. We can restyle an existing site or create a new custom theme.', 'wavex' ) ),
			),
		),
		'website-maintenance'         => array(
			'intro'    => __( 'Routine care keeps your website up to date and working after launch, so you can focus on your business.', 'wavex' ),
			'includes' => array( __( 'Core, theme and plugin updates', 'wavex' ), __( 'Backups', 'wavex' ), __( 'Security checks', 'wavex' ), __( 'Fixing issues as they appear', 'wavex' ), __( 'Small changes and content updates', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'What does website maintenance cover?', 'wavex' ), __( 'Updates, backups, security checks and fixes. We agree the exact scope with you.', 'wavex' ) ),
				array( __( 'Can you maintain a website you did not build?', 'wavex' ), __( 'Often yes, after we review how it is built.', 'wavex' ) ),
			),
		),
		'api-integration'             => array(
			'intro'    => __( 'API integration connects your website, apps and other platforms so data moves where it is needed without manual copying.', 'wavex' ),
			'includes' => array( __( 'Review of the systems involved', 'wavex' ), __( 'Connections through documented APIs', 'wavex' ), __( 'Data mapping and synchronisation', 'wavex' ), __( 'Error handling and logging', 'wavex' ), __( 'Documentation of how it works', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'What is an API integration?', 'wavex' ), __( 'It lets two systems exchange information automatically, for example a website sending orders to another tool.', 'wavex' ) ),
				array( __( 'Can you integrate a tool that has no API?', 'wavex' ), __( 'It depends on the tool. We review the options with you and explain what is possible.', 'wavex' ) ),
			),
		),
		'custom-software-development' => array(
			'intro'    => __( 'When off-the-shelf tools do not fit, we build software around how your team actually works.', 'wavex' ),
			'includes' => array( __( 'Workflow and requirements analysis', 'wavex' ), __( 'Planning and interface design', 'wavex' ), __( 'Development of web-based software', 'wavex' ), __( 'Integration with your existing tools', 'wavex' ), __( 'Support and extension over time', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'When is custom software a good idea?', 'wavex' ), __( 'When your process is specific and existing tools force awkward workarounds.', 'wavex' ) ),
				array( __( 'Can custom software be extended later?', 'wavex' ), __( 'Yes. We plan it so new features can be added as your needs change.', 'wavex' ) ),
			),
		),
		'technical-seo'               => array(
			'intro'    => __( 'Technical SEO makes sure search engines can crawl, understand and index your website properly.', 'wavex' ),
			'includes' => array( __( 'Crawling and indexing review', 'wavex' ), __( 'XML sitemaps and robots settings', 'wavex' ), __( 'Page speed and Core Web Vitals review', 'wavex' ), __( 'Structured data (schema)', 'wavex' ), __( 'Canonical tags, redirects and URL structure', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'What is the difference between technical SEO and on-page SEO?', 'wavex' ), __( 'Technical SEO covers how the site is built and crawled. On-page SEO covers the content and markup of individual pages.', 'wavex' ) ),
				array( __( 'Does my website need technical SEO?', 'wavex' ), __( 'Any website that wants to be found in search can benefit. We start with a review.', 'wavex' ) ),
			),
		),
		'mobile-app-development'      => array(
			'intro'    => __( 'We develop mobile applications from the first idea through to launch, working from clear designs and agreed requirements.', 'wavex' ),
			'includes' => array( __( 'App planning and structure', 'wavex' ), __( 'Development of the agreed screens and features', 'wavex' ), __( 'Connections to your back end and other services', 'wavex' ), __( 'Testing on mobile devices', 'wavex' ), __( 'Launch support', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Can you build an app from just an idea?', 'wavex' ), __( 'Yes. We can start with MVP and product discovery to shape the idea first.', 'wavex' ) ),
				array( __( 'Do you maintain apps after launch?', 'wavex' ), __( 'Yes. App maintenance is one of our services.', 'wavex' ) ),
			),
		),
		'mobile-app-design'           => array(
			'intro'    => __( 'Mobile app design turns an idea into clear screens and flows that people find easy to use.', 'wavex' ),
			'includes' => array( __( 'User flows', 'wavex' ), __( 'Wireframes', 'wavex' ), __( 'Interface design', 'wavex' ), __( 'Interactive prototype', 'wavex' ), __( 'Design handover to development', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Do I need design before development?', 'wavex' ), __( 'Having clear designs first makes development smoother, so we usually recommend it.', 'wavex' ) ),
				array( __( 'Can you improve an existing app design?', 'wavex' ), __( 'Yes. We can review and refresh the screens of an existing app.', 'wavex' ) ),
			),
		),
		'mvp-development'             => array(
			'intro'    => __( 'MVP and product discovery help you decide what the first version of your product needs and what can wait.', 'wavex' ),
			'includes' => array( __( 'Idea and audience discussion', 'wavex' ), __( 'Feature prioritisation', 'wavex' ), __( 'Scope for a first version', 'wavex' ), __( 'Prototype or build plan', 'wavex' ), __( 'Roadmap for what comes next', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'What is an MVP?', 'wavex' ), __( 'A minimum viable product is a focused first version that lets you learn from real use before investing in more.', 'wavex' ) ),
				array( __( 'Do I need a finished idea?', 'wavex' ), __( 'No. Discovery is designed to help shape an early idea.', 'wavex' ) ),
			),
		),
		'app-modernization'           => array(
			'intro'    => __( 'App modernization updates an existing application with a current interface and cleaner foundations.', 'wavex' ),
			'includes' => array( __( 'Review of the current app', 'wavex' ), __( 'Interface refresh', 'wavex' ), __( 'Code improvements', 'wavex' ), __( 'Updates for current platform requirements', 'wavex' ), __( 'Release of the updated version', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Do I have to rebuild my app?', 'wavex' ), __( 'Not always. We review it first and recommend whether to update or rebuild.', 'wavex' ) ),
				array( __( 'Can you work on an app you did not build?', 'wavex' ), __( 'Often yes, after reviewing how it is built.', 'wavex' ) ),
			),
		),
		'app-maintenance'             => array(
			'intro'    => __( 'App maintenance keeps your app working as devices, platforms and your own needs change.', 'wavex' ),
			'includes' => array( __( 'Bug fixing', 'wavex' ), __( 'Compatibility updates', 'wavex' ), __( 'Performance checks', 'wavex' ), __( 'Small improvements', 'wavex' ), __( 'Release management', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Why does an app need maintenance?', 'wavex' ), __( 'Phones and platforms change over time, and apps need updates to keep working well.', 'wavex' ) ),
				array( __( 'How do I report an issue?', 'wavex' ), __( 'Message us on WhatsApp or email and we will take it from there.', 'wavex' ) ),
			),
		),
		'search-engine-optimization'  => array(
			'intro'    => __( 'Search engine optimization improves how your website is understood and presented in search results, so the right people can find you.', 'wavex' ),
			'includes' => array( __( 'SEO review of your website', 'wavex' ), __( 'Keyword and topic research', 'wavex' ), __( 'Page improvements', 'wavex' ), __( 'Technical fixes', 'wavex' ), __( 'Ongoing review of progress', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Can you guarantee rankings?', 'wavex' ), __( 'No one can honestly guarantee search rankings. We focus on improving the things that help your website be found.', 'wavex' ) ),
				array( __( 'Is SEO a one-time task?', 'wavex' ), __( 'It works best as ongoing improvement, because search and your own content keep changing.', 'wavex' ) ),
			),
		),
		'on-page-seo'                 => array(
			'intro'    => __( 'On-page SEO tunes the content and markup of each page so its purpose is clear to search engines and visitors.', 'wavex' ),
			'includes' => array( __( 'Page titles and meta descriptions', 'wavex' ), __( 'Heading structure', 'wavex' ), __( 'Content improvements', 'wavex' ), __( 'Image alt text', 'wavex' ), __( 'Internal linking', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Can you optimise pages I wrote myself?', 'wavex' ), __( 'Yes. We can suggest or make improvements to existing pages.', 'wavex' ) ),
				array( __( 'Do I need an SEO plugin?', 'wavex' ), __( 'A standard SEO plugin is often helpful. We can set it up as part of the work.', 'wavex' ) ),
			),
		),
		'digital-marketing'           => array(
			'intro'    => __( 'Digital marketing plans and runs the channels that reach your audience online, from search to social media and email.', 'wavex' ),
			'includes' => array( __( 'Goals and audience definition', 'wavex' ), __( 'Channel plan', 'wavex' ), __( 'Campaign setup', 'wavex' ), __( 'Content and messaging', 'wavex' ), __( 'Review and adjustment', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Which channels should I use?', 'wavex' ), __( 'It depends on your audience and goals. We help you choose and prioritise.', 'wavex' ) ),
				array( __( 'Do you also build the website?', 'wavex' ), __( 'Yes. Web, apps and marketing can be handled by one team.', 'wavex' ) ),
			),
		),
		'content-marketing'           => array(
			'intro'    => __( 'Content marketing plans and publishes useful content that supports your marketing goals and helps people find and understand your business.', 'wavex' ),
			'includes' => array( __( 'Topic planning around your audience', 'wavex' ), __( 'Writing and editing', 'wavex' ), __( 'Content calendar', 'wavex' ), __( 'Publishing', 'wavex' ), __( 'Review of what works', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Can you write for my business?', 'wavex' ), __( 'Yes, working from your knowledge and goals.', 'wavex' ) ),
				array( __( 'Where is the content published?', 'wavex' ), __( 'Usually on your website blog and your social channels, depending on the plan.', 'wavex' ) ),
			),
		),
		'social-media-marketing'      => array(
			'intro'    => __( 'A social media strategy decides what to post, where and when, so your channels stay consistent and purposeful.', 'wavex' ),
			'includes' => array( __( 'Platform selection', 'wavex' ), __( 'Content themes and tone of voice', 'wavex' ), __( 'Posting plan', 'wavex' ), __( 'Approach to engagement', 'wavex' ), __( 'Review and adjustment', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'Do I need to be on every platform?', 'wavex' ), __( 'No. We help you choose the platforms where your audience is.', 'wavex' ) ),
				array( __( 'Is this strategy only, or do you post too?', 'wavex' ), __( 'We can agree the scope with you, from planning only to broader support.', 'wavex' ) ),
			),
		),
		'digital-strategy'            => array(
			'intro'    => __( 'Digital strategy sets your goals, audience and priorities first, so every next step has a clear direction.', 'wavex' ),
			'includes' => array( __( 'Goal setting', 'wavex' ), __( 'Audience and market review', 'wavex' ), __( 'Channel and priority plan', 'wavex' ), __( 'Roadmap of next steps', 'wavex' ), __( 'Plan for measuring progress', 'wavex' ) ),
			'faqs'     => array(
				array( __( 'When do I need a digital strategy?', 'wavex' ), __( 'Before a big build or campaign, or whenever your online efforts feel scattered.', 'wavex' ) ),
				array( __( 'Does strategy lead into development?', 'wavex' ), __( 'It can. The roadmap often becomes the plan for websites, apps and marketing work.', 'wavex' ) ),
			),
		),
	);

	// Shared answers appended to every service.
	$shared = array(
		array( __( 'How much will it cost?', 'wavex' ), __( 'It depends on the scope of your project. Tell us what you need and we will discuss the options with you.', 'wavex' ) ),
		array( __( 'How long will it take?', 'wavex' ), __( 'That also depends on the scope. We will talk through timing once we understand your requirements.', 'wavex' ) ),
	);
	foreach ( $d as $slug => $row ) {
		$d[ $slug ]['faqs'] = array_merge( $row['faqs'], $shared );
	}
	return $d;
}

/**
 * Process steps for the Our Approach page.
 *
 * @return array[]
 */
function wavex_approach_steps() {
	return array(
		array(
			'icon'  => 'chat',
			'title' => __( 'Understand', 'wavex' ),
			'text'  => __( 'We start by listening. We learn about your business, your goals, your users and what you already have.', 'wavex' ),
			'items' => array( __( 'Discuss your requirements and goals', 'wavex' ), __( 'Review any existing website, app or systems', 'wavex' ), __( 'Clarify who the product is for', 'wavex' ) ),
			'need'  => __( 'From you: your goals, any existing material, and the people we should talk to.', 'wavex' ),
		),
		array(
			'icon'  => 'compass',
			'title' => __( 'Plan', 'wavex' ),
			'text'  => __( 'We turn what we learned into a plan you can agree with: what will be built, how it will be structured and how it will look.', 'wavex' ),
			'items' => array( __( 'Define the scope and structure', 'wavex' ), __( 'Agree the design direction', 'wavex' ), __( 'Decide how the work will be delivered', 'wavex' ) ),
			'need'  => __( 'From you: feedback on the plan and decisions on priorities.', 'wavex' ),
		),
		array(
			'icon'  => 'code',
			'title' => __( 'Develop', 'wavex' ),
			'text'  => __( 'We design and build the solution step by step, sharing progress so there are no surprises.', 'wavex' ),
			'items' => array( __( 'Design and build the agreed features', 'wavex' ), __( 'Review progress together', 'wavex' ), __( 'Test across devices and browsers', 'wavex' ) ),
			'need'  => __( 'From you: content, reviews and quick answers to questions.', 'wavex' ),
		),
		array(
			'icon'  => 'rocket',
			'title' => __( 'Launch', 'wavex' ),
			'text'  => __( 'Once everything is checked and approved, we launch your website, app or product.', 'wavex' ),
			'items' => array( __( 'Final checks and approval', 'wavex' ), __( 'Go-live support', 'wavex' ), __( 'Handover of what you need to manage it', 'wavex' ) ),
			'need'  => __( 'From you: final approval to go live.', 'wavex' ),
		),
		array(
			'icon'  => 'wrench',
			'title' => __( 'Support', 'wavex' ),
			'text'  => __( 'After launch we stay available for maintenance, fixes and improvements as your needs grow.', 'wavex' ),
			'items' => array( __( 'Website and app maintenance', 'wavex' ), __( 'Fixes and updates', 'wavex' ), __( 'Planning what to improve next', 'wavex' ) ),
			'need'  => __( 'From you: tell us what changes or what is not working.', 'wavex' ),
		),
	);
}

/**
 * "What to expect" points for the Why WaveX page.
 *
 * @return array[]
 */
function wavex_expectations() {
	return array(
		array( 'layers', __( 'One team across web, mobile and marketing', 'wavex' ), __( 'Websites, WordPress, mobile apps, custom software, SEO and digital marketing can be planned together, so the pieces fit.', 'wavex' ) ),
		array( 'compass', __( 'Work built around your requirements', 'wavex' ), __( 'Every project starts by understanding what you need, and we plan before we build.', 'wavex' ) ),
		array( 'chat', __( 'Plain-language communication', 'wavex' ), __( 'We explain options and trade-offs in clear terms, and you can reach us directly on WhatsApp or by email.', 'wavex' ) ),
		array( 'check', __( 'Honest scoping', 'wavex' ), __( 'We do not promise what we cannot deliver. We tell you what is realistic and why.', 'wavex' ) ),
		array( 'wrench', __( 'Support after launch', 'wavex' ), __( 'Website maintenance and app maintenance are available once your product is live.', 'wavex' ) ),
		array( 'shield', __( 'Respect for your information', 'wavex' ), __( 'We only use your details to respond to you. Read how in our Privacy Notice.', 'wavex' ) ),
	);
}

/**
 * Grouped FAQs for the FAQ page. No prices or timelines are stated.
 *
 * @return array<string,array>
 */
function wavex_faq_groups() {
	return array(
		'services'  => array(
			'label' => __( 'Services', 'wavex' ),
			'items' => array(
				array( __( 'What services does WaveX Technology offer?', 'wavex' ), __( 'We offer web development, responsive design, website redesign, e-commerce, WordPress development and design, website maintenance, API integration, custom software, mobile app development and design, MVP and product discovery, app modernization and maintenance, SEO, digital marketing, content marketing, social media strategy and digital strategy.', 'wavex' ) ),
				array( __( 'Can you handle a project from start to finish?', 'wavex' ), __( 'Yes. We can take a project from the first idea through design, development and launch, and support it afterwards.', 'wavex' ) ),
			),
		),
		'web'       => array(
			'label' => __( 'Web development', 'wavex' ),
			'items' => array(
				array( __( 'Can you build or redesign my website?', 'wavex' ), __( 'Yes. We build new websites and redesign existing ones, with responsive layouts that work on all screen sizes.', 'wavex' ) ),
				array( __( 'Do you build online stores?', 'wavex' ), __( 'Yes. E-commerce development is one of our services.', 'wavex' ) ),
			),
		),
		'wordpress' => array(
			'label' => __( 'WordPress', 'wavex' ),
			'items' => array(
				array( __( 'Will I be able to edit my WordPress website myself?', 'wavex' ), __( 'Yes. We build WordPress websites so you can manage pages, posts and media yourself.', 'wavex' ) ),
				array( __( 'Can you work on my existing WordPress website?', 'wavex' ), __( 'Yes. We can review, improve, extend or maintain it.', 'wavex' ) ),
			),
		),
		'mobile'    => array(
			'label' => __( 'Mobile applications', 'wavex' ),
			'items' => array(
				array( __( 'I only have an idea for an app. Can you help?', 'wavex' ), __( 'Yes. MVP and product discovery helps shape an early idea into a clear first version.', 'wavex' ) ),
				array( __( 'Can you update or maintain an existing app?', 'wavex' ), __( 'Yes. App modernization and app maintenance cover updating and looking after existing apps.', 'wavex' ) ),
			),
		),
		'software'  => array(
			'label' => __( 'Custom software', 'wavex' ),
			'items' => array(
				array( __( 'When should I choose custom software?', 'wavex' ), __( 'When your process is specific and existing tools do not fit. We start by understanding your workflow.', 'wavex' ) ),
				array( __( 'Can you connect software to my other tools?', 'wavex' ), __( 'Yes. API integration connects websites, apps and platforms.', 'wavex' ) ),
			),
		),
		'seo'       => array(
			'label' => __( 'SEO', 'wavex' ),
			'items' => array(
				array( __( 'Can you guarantee my website will rank first?', 'wavex' ), __( 'No one can honestly guarantee rankings. We improve the technical and content factors that help your website be found.', 'wavex' ) ),
				array( __( 'What is the difference between technical SEO and on-page SEO?', 'wavex' ), __( 'Technical SEO covers how your site is built and crawled. On-page SEO covers the content and markup of each page.', 'wavex' ) ),
			),
		),
		'marketing' => array(
			'label' => __( 'Digital marketing', 'wavex' ),
			'items' => array(
				array( __( 'What does digital marketing include?', 'wavex' ), __( 'Planning and running the channels that reach your audience, including content marketing and social media strategy.', 'wavex' ) ),
				array( __( 'Can you help me decide a strategy first?', 'wavex' ), __( 'Yes. Digital strategy sets goals, audience and priorities before the work begins.', 'wavex' ) ),
			),
		),
		'process'   => array(
			'label' => __( 'Project process', 'wavex' ),
			'items' => array(
				array( __( 'How does a project work?', 'wavex' ), __( 'We understand your requirements, plan the work, develop the solution, launch it and support it. You can read more on our Our Approach page.', 'wavex' ) ),
				array( __( 'Will I see progress along the way?', 'wavex' ), __( 'Yes. We share progress and review it with you during development.', 'wavex' ) ),
			),
		),
		'timelines' => array(
			'label' => __( 'Project timelines', 'wavex' ),
			'items' => array(
				array( __( 'How long will my project take?', 'wavex' ), __( 'It depends on the scope and how quickly decisions and content come together. We discuss timing once we understand your requirements.', 'wavex' ) ),
			),
		),
		'pricing'   => array(
			'label' => __( 'Pricing', 'wavex' ),
			'items' => array(
				array( __( 'How much will my project cost?', 'wavex' ), __( 'Cost depends on what you need. Message us or book a free consultation and we will talk through the options.', 'wavex' ) ),
			),
		),
		'support'   => array(
			'label' => __( 'Maintenance and support', 'wavex' ),
			'items' => array(
				array( __( 'Do you support my project after launch?', 'wavex' ), __( 'Yes. Website maintenance and app maintenance are available after launch.', 'wavex' ) ),
				array( __( 'How do I contact you for support?', 'wavex' ), __( 'Message us on WhatsApp or email. You can also use the contact form.', 'wavex' ) ),
			),
		),
		'start'     => array(
			'label' => __( 'Starting a project', 'wavex' ),
			'items' => array(
				array( __( 'How do I get started?', 'wavex' ), __( 'Message us on WhatsApp or email, or book a free consultation, and tell us about your idea or requirements.', 'wavex' ) ),
				array( __( 'Do I need a detailed brief?', 'wavex' ), __( 'No. A short description is enough to begin. We will ask the right questions.', 'wavex' ) ),
			),
		),
	);
}

/**
 * Enquiry topics for the contact form.
 *
 * @return array<string,string>
 */
function wavex_contact_topics() {
	return array(
		'general'   => __( 'General question', 'wavex' ),
		'website'   => __( 'Website project', 'wavex' ),
		'wordpress' => __( 'WordPress project', 'wavex' ),
		'mobile'    => __( 'Mobile application', 'wavex' ),
		'software'  => __( 'Software development', 'wavex' ),
		'seo'       => __( 'SEO', 'wavex' ),
		'marketing' => __( 'Digital marketing', 'wavex' ),
		'other'     => __( 'Other technology requirement', 'wavex' ),
	);
}
