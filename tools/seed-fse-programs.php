<?php
/**
 * Seeds the Full Spectrum Educational program catalogue.
 *
 * Run once against a fresh install:
 *   wp eval-file tools/seed-fse-programs.php
 *
 * Re-running updates the existing programs in place (matched on slug) so the
 * catalogue copy can be maintained here and re-applied to staging.
 *
 * @package fse
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	fwrite( STDERR, "Run this through WP-CLI: wp eval-file tools/seed-fse-programs.php\n" );
	exit( 1 );
}

fse_seed_service_groups();

$programs = array(
	array(
		'slug'       => 'bubble-ology-101',
		'title'      => 'Bubble-Ology 101',
		'group'      => 'assembly-programs',
		'tagline'    => 'Surface tension, light and geometry — inside a bubble.',
		'discipline' => 'Science / STEM (NGSS aligned)',
		'audience'   => 'Preschool through 6th grade',
		'duration'   => '45-minute indoor assembly, optional hands-on workshops (needs an 8ft x 6ft stage area)',
		'excerpt'    => 'A 45-minute assembly that turns bubbles into a physics lab: states of matter, surface tension, reflection and refraction, and the geometry that decides a bubble\'s shape.',
		'content'    => 'Students discover why bubbles are round, how light bends through a soap film, and what NASA learned from bubbles in microgravity. Optional hands-on workshops let every class build giant bubbles and test their own shapes after the assembly.',
		'highlights' => array(
			'States of matter and molecular structure made visible',
			'Surface tension demonstrations students can try themselves',
			'Light reflection and refraction through a soap film',
			'Geometric bubble shapes — why cubes and pyramids are possible',
			'NASA space-bubble experiments and real medical and military applications',
		),
	),
	array(
		'slug'       => 'portable-planetarium',
		'title'      => 'Portable Planetarium Experience',
		'group'      => 'science-nights',
		'tagline'    => 'A 360° tour of the cosmos, inflated in your multipurpose room.',
		'discipline' => 'Astronomy & Space Science / STEM',
		'audience'   => 'K–8 and public library summer reading',
		'duration'   => 'Two sessions, approx. 30 participants per dome',
		'price'      => '$525 for two sessions',
		'excerpt'    => 'Our inflatable dome brings a full planetarium to your campus — Saturn\'s rings, the Orion Nebula, lunar craters and Jupiter\'s moons overhead, with a real meteorite passed hand to hand.',
		'content'    => 'Presented by "Astro-Nut" Richard Rumble in collaboration with credentialed educators, using NASA and JPL imagery. The dome is fire-retardant fabric with no rigid framing, and its accordion-fold design clears the space in seconds — a design certified by municipal Fire Marshals. Showcased at the Anaheim PTA Convention and at the Pasadena Civic Auditorium for the AIAA Foundation.',
		'highlights' => array(
			'360-degree guided tour of the night sky',
			'Saturn\'s rings, the Orion Nebula and Jupiter\'s moons',
			'Lunar crater topography and constellation navigation',
			'Students handle an authentic meteorite',
			'Fire Marshal certified dome with rapid accordion-fold evacuation',
		),
	),
	array(
		'slug'       => 'ticket-to-the-stars',
		'title'      => 'Ticket to the Stars',
		'group'      => 'assembly-programs',
		'tagline'    => 'A full-auditorium journey through the solar system.',
		'discipline' => 'Astronomy & Space Exploration',
		'audience'   => 'K–8, full auditorium assembly',
		'duration'   => 'Large-format multimedia assembly with student stage participation',
		'excerpt'    => 'Large visual display pieces and multimedia demonstrations carry a whole assembly from the inner planets to deep space, with students on stage throughout.',
		'content'    => 'Covers the inner and outer solar system, lunar cycles, solar physics and deep-space galaxies. Built for auditorium-scale audiences where a dome is not practical.',
		'highlights' => array(
			'Inner and outer solar system planets',
			'Lunar cycles and phases',
			'Solar physics demonstrations',
			'Deep-space galaxies',
			'Active student participation on stage',
		),
	),
	array(
		'slug'       => 'night-time-star-party',
		'title'      => 'Night Time Star Party',
		'group'      => 'science-nights',
		'tagline'    => 'A family evening under real telescopes.',
		'discipline' => 'Community & family evening science event',
		'audience'   => 'School families, libraries, scout troops, community centres',
		'duration'   => 'Evening event with multi-station telescope viewing',
		'excerpt'    => 'A guided sky tour pairing celestial myth with astrophysics, then multiple telescope stations so families can see Saturn\'s rings and the Orion Nebula for themselves.',
		'content'    => 'We integrate high school volunteers earning community service hours, Eagle Scouts and local college astronomy clubs, which makes the evening a community event rather than a presentation. Ask about astronomical face painting and crafts to run alongside the viewing stations.',
		'highlights' => array(
			'Guided tour of constellations and the myths behind them',
			'Multi-station telescope viewing for families',
			'Volunteer roles for high school students and Eagle Scouts',
			'Partnerships with local college astronomy clubs',
		),
	),
	array(
		'slug'       => 'its-not-magic-its-science',
		'title'      => 'It’s Not Magic, It’s Science!',
		'group'      => 'assembly-programs',
		'tagline'    => 'Every illusion performed twice — once as magic, once as science.',
		'discipline' => 'Applied physics, chemistry & scientific inquiry',
		'audience'   => 'K–8',
		'duration'   => 'Dual-presentation assembly',
		'excerpt'    => 'Each effect is performed as magic, then taken apart using the scientific method — the fastest way we know to get a room full of students asking "how, why, what if?"',
		'content'    => 'The show models scientific inquiry rather than describing it: students observe, form a hypothesis, then see the principle demonstrated plainly. Ideal ahead of a science fair or an inquiry unit.',
		'highlights' => array(
			'Illusions deconstructed with physics and chemistry',
			'Explicit modelling of the scientific method',
			'"How, why, what if?" questioning framework',
			'Pairs well with science fair season',
		),
	),
	array(
		'slug'       => 'mr-electric',
		'title'      => 'Mr. Electric: The Generating Knowledge Show',
		'group'      => 'assembly-programs',
		'tagline'    => 'Half a million volts of indoor lightning.',
		'discipline' => 'Electricity, energy & matter',
		'audience'   => 'K–8',
		'duration'   => 'Assembly, optional 7ft interactive robot upgrade',
		'excerpt'    => 'A 500,000-volt Tesla coil makes safe indoor lightning, Van de Graaff generators make hair stand up, and hand-crank generators let students produce four-inch sparks themselves.',
		'content'    => 'A high-energy look at electricity, charge and kinetic energy using equipment students will never see in a classroom. Add the seven-foot singing and dancing robot for younger audiences.',
		'highlights' => array(
			'500,000-volt Tesla coil generating safe indoor lightning',
			'Van de Graaff static generators',
			'Student-powered hand-crank generators producing 4-inch sparks',
			'Kinetic energy demonstrations',
			'Optional 7-foot interactive singing and dancing robot',
		),
	),
	array(
		'slug'       => 'crazy-about-chemistry',
		'title'      => 'Crazy About Chemistry',
		'group'      => 'science-nights',
		'tagline'    => 'Colour changes, polymer slime and safe household reactions.',
		'discipline' => 'Chemistry & material science',
		'audience'   => 'K–8 and summer library reading',
		'duration'   => '60 minutes',
		'excerpt'    => 'An hour of colour-changing reactions, polymer slime synthesis and bubbling solutions — all built from safe household compounds students can name.',
		'content'    => 'Every demonstration uses compounds families already have at home, so students leave able to repeat the science safely with a parent.',
		'highlights' => array(
			'Colour-changing chemical reactions',
			'Polymer slime synthesis',
			'Bubbling solutions from safe household compounds',
			'Static cling experiments',
		),
	),
	array(
		'slug'       => 'incredible-edible-science',
		'title'      => 'Incredible Edible Science',
		'group'      => 'assembly-programs',
		'tagline'    => 'Thermodynamics you can eat.',
		'discipline' => 'Food science & culinary physics',
		'audience'   => 'K–6, libraries and schools',
		'duration'   => 'Assembly or workshop format',
		'excerpt'    => 'Ice cream, popcorn and cotton candy become a lesson in phase changes, steam expansion and polymer crystallisation.',
		'content'    => 'Students watch liquid become solid, water become steam and sugar become crystal — then taste the results. Everyday thermodynamics, made memorable.',
		'highlights' => array(
			'Liquid-to-solid phase change through ice cream making',
			'Steam expansion demonstrated by popping corn',
			'Polymer crystallisation in cotton candy',
		),
	),
	array(
		'slug'       => 'fun-foam-party',
		'title'      => 'Fun Foam Party',
		'group'      => 'carnivals',
		'tagline'    => 'Field days and summer camps, buried in safe foam.',
		'discipline' => 'Sensory play / field days / summer camps / preschool events',
		'audience'   => 'Preschool through middle school',
		'duration'   => 'Outdoor, grass area required',
		'excerpt'    => 'Non-toxic, hypoallergenic, grass-safe foam turns a field day or camp afternoon into the event students talk about all year.',
		'content'    => 'Setup needs an outdoor grass area, a water faucet and a standard 110V outlet within 25 feet, plus adult supervision. The foam is non-irritating and safe for lawns and planting.',
		'highlights' => array(
			'Non-toxic, hypoallergenic and non-irritating foam',
			'Grass-safe — no damage to fields or planting',
			'Needs a faucet and a 110V outlet within 25 feet',
			'Ideal for field days, carnivals and summer camps',
		),
	),
	array(
		'slug'       => 'magicians-against-drugs',
		'title'      => 'Magicians Against Drugs Magic Show',
		'group'      => 'assembly-programs',
		'tagline'    => 'Red Ribbon Week with live animals and real stakes.',
		'discipline' => 'Substance abuse prevention / Red Ribbon Week',
		'audience'   => 'K–8',
		'duration'   => '45 minutes',
		'excerpt'    => 'A drug-awareness assembly built around magic: a dove, a rabbit, teachers on stage, and a rope illusion showing the seven minutes of life lost to a single cigarette — then restored.',
		'content'    => 'Written for Red Ribbon Week. The signature rope routine gives students a physical image for a statistic, and the restoration frames healthy choices as recoverable ones. Principals and teachers take part in the illusions.',
		'highlights' => array(
			'Live dove and rabbit',
			'Principal and teacher stage illusions',
			'Signature rope illusion: 7 minutes of lifespan per cigarette',
			'Positive close on healthy life choices',
		),
	),
	array(
		'slug'       => 'no-bully-zone',
		'title'      => 'NO BULLY ZONE Magic Show',
		'group'      => 'assembly-programs',
		'tagline'    => 'Naming physical, verbal and cyberbullying — and what to do next.',
		'discipline' => 'Anti-bullying / character education',
		'audience'   => 'K–8',
		'duration'   => '45 minutes',
		'excerpt'    => 'A character-education assembly that separates physical, verbal and cyberbullying, then gives students concrete conflict-resolution steps and permission to ask an adult for help.',
		'content'    => 'The magic carries the message: students learn to recognise the three forms of bullying, practise a response, and understand when a situation needs an adult. Empathy and kindness are framed as skills, not slogans.',
		'highlights' => array(
			'Differentiates physical, verbal and cyberbullying',
			'Practical conflict-resolution strategies',
			'When and how to seek adult help',
			'Builds empathy and kindness as everyday habits',
		),
	),
	array(
		'slug'       => 'bully-free-game-show',
		'title'      => 'Bully-Free Game Show Assembly',
		'group'      => 'assembly-programs',
		'tagline'    => 'Family Feud style, with buzzers and a signed membership card.',
		'discipline' => 'Social-emotional learning & peer dynamics',
		'audience'   => 'K–8, recommended split K–2 and 3–6+',
		'duration'   => 'Interactive game show assembly',
		'excerpt'    => 'Teams, buzzers and trivia turn social-emotional learning into a competition — and Richard Rumble grounds it in his own childhood experience of being bullied.',
		'content'    => 'Students work out the difference between tattling and telling, debate real scenarios as teams, and each leave with a signed Bully-Free Membership Card. Best run as two sessions split by grade band.',
		'highlights' => array(
			'Family Feud style format with team buzzers',
			'Richard Rumble shares his own story of overcoming bullying',
			'Tattling versus telling, worked through as a team',
			'Every student receives a signed Bully-Free Membership Card',
		),
	),
	array(
		'slug'       => 'astronaut-andy',
		'title'      => 'Astronaut Andy Magic Show',
		'group'      => 'assembly-programs',
		'tagline'    => 'Beating alien invaders with things you learn in books.',
		'discipline' => 'Literacy, reading incentive & space adventure',
		'audience'   => 'Pre-K through 5th grade',
		'duration'   => 'Assembly with printable classroom follow-up',
		'excerpt'    => 'Space explorer Astronaut Andy defeats an alien invasion using knowledge he found in books — a reading-incentive assembly that arrives with worksheets and reading lists.',
		'content'    => 'Ideal for kickoff week of a reading challenge or a library summer reading programme. Printable post-show worksheets and a themed reading list let teachers extend the story into the classroom.',
		'highlights' => array(
			'Story-driven reading incentive assembly',
			'Printable post-show classroom worksheets',
			'Themed reading lists for teachers and librarians',
			'Built for reading-challenge kickoffs',
		),
	),
	array(
		'slug'       => 'drum-circles-101',
		'title'      => 'Drumming to the Beat: Drum Circles 101',
		'group'      => 'assembly-programs',
		'tagline'    => 'Every student with an instrument in their hands.',
		'discipline' => 'Multicultural arts & rhythm workshop (Dream Shapers)',
		'audience'   => 'Preschool through high school',
		'duration'   => 'Workshop or assembly, instruments provided',
		'excerpt'    => 'An interactive rhythm and cultural drumming workshop where the whole group plays together — no musical experience required.',
		'content'    => 'Part of the Dream Shapers performing-arts collective. Works as a single assembly or as rotating class workshops through the day.',
		'highlights' => array(
			'Instruments provided for every participant',
			'Cultural context for the rhythms students play',
			'Assembly or rotating workshop formats',
		),
	),
	array(
		'slug'       => 'rumbledoor-earth-day',
		'title'      => 'Rumbledoor: Earth Day & Recycling Magic',
		'group'      => 'assembly-programs',
		'tagline'    => 'Environmental stewardship, delivered by a wizard.',
		'discipline' => 'Environmental education & conservation',
		'audience'   => 'K–6',
		'duration'   => '45-minute assembly',
		'excerpt'    => 'Professor Rumbledoor makes recycling, waste reduction and stewardship feel like a quest rather than a chore — built for Earth Day and Earth Week.',
		'content'    => 'Complex environmental topics land as story beats: what happens to what we throw away, why sorting matters, and what one class can change.',
		'highlights' => array(
			'Recycling and waste-stream basics',
			'Earth Day and Earth Week programming',
			'Actions a single classroom can take',
		),
	),
	array(
		'slug'       => 'wild-things-puppet-shows',
		'title'      => 'Wild Things & Puppet Shows',
		'group'      => 'assembly-programs',
		'tagline'    => 'Reptiles, arachnids and tropical birds, up close.',
		'discipline' => 'Nature, conservation & early childhood storytelling',
		'audience'   => 'Preschool through 5th grade',
		'duration'   => 'Assembly or library storytime',
		'excerpt'    => 'Students meet reptiles, arachnids, amphibians and tropical birds, and learn about habitats, endangered species and why preservation matters.',
		'content'    => 'For preschool and library audiences we pair the animals with puppet storytelling, which holds the attention of the youngest groups while the conservation message lands.',
		'highlights' => array(
			'Live reptiles, arachnids, amphibians and tropical birds',
			'Habitats and endangered species',
			'Puppet storytelling for preschool audiences',
		),
	),
	array(
		'slug'       => 'school-carnival-midway',
		'title'      => 'School Carnival & Festival Midway',
		'group'      => 'carnivals',
		'tagline'    => 'Face painting, balloon twisting, clowns and game booths.',
		'discipline' => 'Carnivals, festivals & fundraisers',
		'audience'   => 'Whole-school and family events',
		'duration'   => 'Half or full day',
		'excerpt'    => 'We staff the fun side of your carnival — face painting, balloon twisting, clowns, strolling magic and game booths — so your PTA can run the rest.',
		'content'    => 'Packages scale from a single face painter to a full midway. Tell us your expected attendance and we will size the crew.',
		'highlights' => array(
			'Face painting and balloon twisting',
			'Clowns and strolling magic',
			'Game booths and midway staffing',
		),
		'awaiting_photo' => true,
	),
	array(
		'slug'       => 'school-dance-game-show',
		'title'      => 'School Dances & Game Show Nights',
		'group'      => 'dances-proms',
		'tagline'    => 'DJ, lighting and a game show that gets everyone off the wall.',
		'discipline' => 'Middle and high school dances, proms',
		'audience'   => 'Grades 6–12',
		'duration'   => 'Evening event',
		'excerpt'    => 'A DJ and lighting package paired with an interactive game show — the combination that keeps a middle school dance moving instead of stalling.',
		'content'    => 'Add strolling close-up magic for prom receptions, where guests are seated and waiting.',
		'highlights' => array(
			'DJ and dance lighting package',
			'Interactive game show segments with buzzers',
			'Optional strolling close-up magic for prom receptions',
		),
		'awaiting_photo' => true,
	),
	array(
		'slug'       => 'grad-night-hypnosis',
		'title'      => 'Grad Night Comedy Hypnosis Show',
		'group'      => 'grad-nights',
		'tagline'    => 'The clean-comedy hypnosis show built for Grad Night.',
		'discipline' => 'Grad Night & senior class entertainment',
		'audience'   => 'High school seniors',
		'duration'   => 'Full-length stage show',
		'excerpt'    => 'Richard Rumble\'s clean-comedy hypnosis show puts the graduating class on stage and keeps the rest of the room laughing — a Grad Night anchor with no material to apologise for.',
		'content'    => 'Booked through Full Spectrum for schools, and presented as Mister Hypnosis. Clean comedy throughout, with volunteers drawn from the senior class.',
		'highlights' => array(
			'Clean comedy suitable for a school-sanctioned event',
			'Whole-audience participation, seniors on stage',
			'Member of the National Guild of Hypnotists and the Magic Castle',
		),
		'awaiting_photo' => true,
	),
);

$order = 0;

foreach ( $programs as $program ) {
	$order += 10;

	$existing = get_page_by_path( $program['slug'], OBJECT, FSE_PROGRAM_POST_TYPE );

	$postarr = array(
		'post_type'    => FSE_PROGRAM_POST_TYPE,
		'post_status'  => 'publish',
		'post_name'    => $program['slug'],
		'post_title'   => $program['title'],
		'post_excerpt' => $program['excerpt'],
		'post_content' => $program['content'],
		'menu_order'   => $order,
	);

	if ( $existing ) {
		$postarr['ID'] = $existing->ID;
		$post_id       = wp_update_post( $postarr, true );
	} else {
		$post_id = wp_insert_post( $postarr, true );
	}

	if ( is_wp_error( $post_id ) ) {
		WP_CLI::warning( $program['slug'] . ': ' . $post_id->get_error_message() );
		continue;
	}

	wp_set_object_terms( $post_id, $program['group'], FSE_PROGRAM_TAXONOMY );

	$meta = array(
		'program_tagline'        => $program['tagline'],
		'program_discipline'     => $program['discipline'],
		'program_audience'       => $program['audience'],
		'program_duration'       => $program['duration'],
		'program_price'          => $program['price'] ?? '',
		'program_highlights'     => implode( "\n", $program['highlights'] ),
		'program_awaiting_photo' => ! empty( $program['awaiting_photo'] ) ? 1 : 0,
	);

	foreach ( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
		update_post_meta( $post_id, '_' . $key, 'field_fse_' . $key );
	}

	WP_CLI::log( sprintf( '%s program: %s', $existing ? 'Updated' : 'Created', $program['title'] ) );
}

$group_meta = array(
	'assembly-programs' => array(
		'icon'    => '🫧',
		'nav'     => 'Assemblies',
		'blurb'   => 'Science, magic, kindness and reading shows for the whole school, K through 6.',
		'eyebrow' => 'Whole-school assemblies',
	),
	'science-nights'    => array(
		'icon'    => '🔬',
		'nav'     => 'Science Nights',
		'blurb'   => 'Family science evenings, the star dome and hands-on workshops kids do themselves.',
		'eyebrow' => 'Family evenings',
	),
	'carnivals'         => array(
		'icon'    => '🎪',
		'nav'     => 'Carnivals',
		'blurb'   => 'Face painting, foam, balloon animals and game booths for festivals and fundraisers.',
		'eyebrow' => 'Festivals & fundraisers',
	),
	'dances-proms'      => array(
		'icon'    => '🪩',
		'nav'     => 'Dances',
		'blurb'   => 'Music, lights and game shows for upper-grade dances and end-of-year parties.',
		'eyebrow' => 'Upper-grade parties',
	),
	'grad-nights'       => array(
		'icon'    => '🎉',
		'nav'     => 'Grad Nights',
		'blurb'   => 'Sixth-grade promotion and Grad Night entertainment, all clean comedy.',
		'eyebrow' => 'Send-offs & promotions',
	),
);

foreach ( $group_meta as $slug => $values ) {
	$term = get_term_by( 'slug', $slug, FSE_PROGRAM_TAXONOMY );

	if ( ! $term instanceof WP_Term ) {
		continue;
	}

	update_term_meta( $term->term_id, 'group_icon', $values['icon'] );
	update_term_meta( $term->term_id, '_group_icon', 'field_fse_group_icon' );
	update_term_meta( $term->term_id, 'group_blurb', $values['blurb'] );
	update_term_meta( $term->term_id, '_group_blurb', 'field_fse_group_blurb' );
	update_term_meta( $term->term_id, 'group_nav_label', $values['nav'] );
	update_term_meta( $term->term_id, '_group_nav_label', 'field_fse_group_nav_label' );
	update_term_meta( $term->term_id, 'group_eyebrow', $values['eyebrow'] );
	update_term_meta( $term->term_id, '_group_eyebrow', 'field_fse_group_eyebrow' );
}

$front_id = (int) get_option( 'page_on_front' );

if ( $front_id ) {
	$home = array(
		'hero_kicker'              => '★ Serving California schools & libraries since 1994',
		'hero_heading'             => 'Assemblies Your Students Love. <em>Paperwork You Can Trust.</em>',
		'hero_intro'               => 'Hands-on science, character education and magic assemblies for preschools, K-6 schools and public libraries — standards-aligned, Fire Marshal certified, fully insured, and on site with everything we need.',
		'hero_cta_label'           => 'Check Your Date',
		'hero_badge'               => '1,200+ assemblies booked',
		'quicknav_heading'         => 'What are you planning?',
		'quicknav_intro'           => 'Tap the kind of event you are putting together and jump straight to the shows that fit.',
		'programs_heading'         => 'Pick a show',
		'credentials_heading'      => 'Safe hands, happy principals',
		'credentials_body'         => "Every show is presented by a live-scan-cleared performer carrying $1M general liability coverage, with a W-9 and certificate of insurance ready for your district office. We arrive early, bring our own sound and props, and are packed up before the buses line up.",
		'credentials_points'       => "Fire Marshal certified planetarium dome — rapid accordion-fold evacuation\nNGSS-aligned science content, reviewed by credentialed educators\nFully insured; W-9 and certificate of insurance on file\nPurchase-order friendly, one invoice and one point of contact\n30 years serving preschools, K-12 schools and public libraries",
		'contact_heading'          => 'Check your date',
		'contact_intro'            => 'Tell us your date and grade levels and we will confirm availability and pricing within one business day. No deposit needed to hold a tentative date.',
		'contact_recipients'       => 'fullspectrument@hotmail.com',
		'contact_success'          => 'Thank you — your request is in. Sandee will reply within one business day.',
		'footer_tagline'           => 'Creating Good Times And Great Memories Is What We Do Best',
		'footer_secondary_tagline' => 'Once A Customer, Always A Friend',
		'footer_address'           => 'P.O. Box 596, Dana Point, CA 92629',
		'footer_phone'             => '(949) 496-6244',
	);

	foreach ( $home as $key => $value ) {
		update_post_meta( $front_id, $key, $value );
		update_post_meta( $front_id, '_' . $key, 'field_fse_' . $key );
	}

	WP_CLI::log( 'Home page fields seeded.' );
} else {
	WP_CLI::warning( 'No static front page is set, so home-page fields were skipped.' );
}

WP_CLI::success( 'Program catalogue seeded.' );
