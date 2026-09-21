<?php
/**
 * Seed the Mister Hypnosis audience sections, testimonials and home-page copy.
 *
 * Usage: wp eval-file tools/seed-mrh-content.php
 *
 * Re-running is safe: posts are matched by slug and updated in place.
 *
 * @package mrh
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit( "Run this through WP-CLI: wp eval-file tools/seed-mrh-content.php\n" );
}

/**
 * Create or update a post and its meta.
 *
 * @param string $post_type Post type.
 * @param string $slug      Post slug.
 * @param string $title     Post title.
 * @param string $content   Post content.
 * @param array  $meta      Field name => value.
 * @param int    $order     Menu order.
 * @return int
 */
function mrh_seed_post( $post_type, $slug, $title, $content, array $meta, $order ) {
	$existing = get_posts(
		array(
			'post_type'      => $post_type,
			'name'           => $slug,
			'posts_per_page' => 1,
			'post_status'    => 'any',
		)
	);

	$args = array(
		'post_type'    => $post_type,
		'post_name'    => $slug,
		'post_title'   => $title,
		'post_content' => $content,
		'post_status'  => 'publish',
		'menu_order'   => $order,
	);

	if ( $existing ) {
		$args['ID'] = $existing[0]->ID;
	}

	$post_id = wp_insert_post( $args, true );

	if ( is_wp_error( $post_id ) ) {
		WP_CLI::warning( sprintf( '%s: %s', $slug, $post_id->get_error_message() ) );

		return 0;
	}

	foreach ( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
		update_post_meta( $post_id, '_' . $key, 'field_mrh_' . $key );
	}

	WP_CLI::log( sprintf( '%s %s', $existing ? 'updated' : 'created', $slug ) );

	return (int) $post_id;
}

$audiences = array(
	array(
		'slug'    => 'grad-nights-proms',
		'title'   => 'High School Grad Nights & Proms',
		'content' => 'A school-sanctioned, squeaky-clean comedy hypnosis show built for graduating classes. Volunteers come from the audience, the laughs come from the situations rather than the language, and every routine is chosen so that no student is embarrassed in front of their class.',
		'meta'    => array(
			'audience_kicker'  => 'Grad Night & Prom',
			'audience_tagline' => 'The all-night entertainment that keeps the class in one room.',
			'audience_points'  => "100% clean — approved by activities directors and PTA boards\nRuns 45–90 minutes, or repeated sets across an all-night event\nFully self-contained sound and lighting\nWorks in gyms, theatres, cafeterias and cruise or park venues\nReferences from Orange County and Los Angeles districts on request",
			'audience_video'   => '954992581',
			'audience_cta'     => 'Check your Grad Night date',
		),
	),
	array(
		'slug'    => 'corporate-events',
		'title'   => 'Corporate Functions',
		'content' => 'Holiday parties, sales kick-offs, awards nights and client appreciation events. Richard tailors the show around your team, folds in your company names and in-jokes, and keeps every routine safe for a room that includes executives, spouses and clients.',
		'meta'    => array(
			'audience_kicker'  => 'Corporate & Association',
			'audience_tagline' => 'Your team becomes the entertainment — safely.',
			'audience_points'  => "Customised to your company, products and people\nStrolling close-up magic available during cocktails\nNo alcohol-dependent or off-colour material\nStage, ballroom or outdoor tent\nFull liability insurance and W-9 on file",
			'audience_video'   => '955007390',
			'audience_cta'     => 'Request a corporate quote',
		),
	),
	array(
		'slug'    => 'college-events',
		'title'   => 'College Events',
		'content' => 'Welcome week, family weekend, late-night programming and Greek life events. A hypnosis show fills a student union with a crowd that stays, participates and posts about it — and the show scales from a 100-seat lounge to a packed campus auditorium.',
		'meta'    => array(
			'audience_kicker'  => 'Colleges & Universities',
			'audience_tagline' => 'Late-night programming that actually draws a crowd.',
			'audience_points'  => "Ideal for welcome week, family weekend and late-night series\nStudent volunteers drive the whole show\nSocial-media friendly moments built in\nTravels nationally; block booking discounts for consortiums\nNACA-style contracting and tech rider provided",
			'audience_video'   => '879489607',
			'audience_cta'     => 'Check campus availability',
		),
	),
);

$order = 0;

foreach ( $audiences as $audience ) {
	$order += 10;

	mrh_seed_post(
		MRH_AUDIENCE_POST_TYPE,
		$audience['slug'],
		$audience['title'],
		$audience['content'],
		$audience['meta'],
		$order
	);
}

$testimonials = array(
	array(
		'slug'    => 'dana-hills-activities',
		'title'   => 'Activities Office, Dana Hills High School',
		'content' => 'Richard had 600 seniors laughing for an hour and not one parent complaint. He is the only hypnotist we book for Grad Night.',
		'meta'    => array( 'testimonial_role' => 'Activities Director' ),
	),
	array(
		'slug'    => 'regional-sales-kickoff',
		'title'   => 'Regional Sales Kick-Off',
		'content' => 'He worked our product names into the routines and our VP ended up on stage. Best closing night we have had.',
		'meta'    => array( 'testimonial_role' => 'Event Manager, Fortune 500 technology firm' ),
	),
	array(
		'slug'    => 'student-programming-board',
		'title'   => 'Student Programming Board',
		'content' => 'We had a line out the door twenty minutes before showtime and students still talk about it in the spring.',
		'meta'    => array( 'testimonial_role' => 'Late-Night Programming Chair' ),
	),
);

$order = 0;

foreach ( $testimonials as $testimonial ) {
	$order += 10;

	mrh_seed_post(
		MRH_TESTIMONIAL_POST_TYPE,
		$testimonial['slug'],
		$testimonial['title'],
		$testimonial['content'],
		$testimonial['meta'],
		$order
	);
}

$front_id = (int) get_option( 'page_on_front' );

if ( $front_id ) {
	$home = array(
		'hero_kicker'        => 'Mister Hypnosis',
		'hero_heading'       => 'Richard Rumble',
		'hero_intro'         => 'Thirty years of stage hypnosis and magic for Grad Nights, colleges and corporate events. Member of The Magic Castle in Hollywood, the National Guild of Hypnotists and the International Brotherhood of Magicians.',
		'hero_video'         => '955007390',
		'about_heading'      => 'About Richard Rumble',
		'about_body'         => "Richard Rumble has spent three decades making audiences the stars of the show. His comedy hypnosis sets fill high school gyms, college unions and hotel ballrooms, and his close-up magic has earned him membership at The Magic Castle in Hollywood.\n\nEvery show is built clean from the ground up, so a Grad Night committee, a principal and a corporate HR team can all book the same act with confidence.",
		'credentials_list'   => "NLP Master Practitioner\nAmerican Board of Hypnotherapy\nNational Guild of Hypnotists\nSociety of Applied Hypnosis\nInternational Brotherhood of Magicians\nThe Magic Castle, Hollywood CA",
		'audiences_heading'  => 'A different show for every room',
		'audiences_intro'    => 'Grad Night, corporate ballroom or campus late-night — same performer, different show.',
		'contact_heading'    => 'Check your date',
		'contact_intro'      => 'Send the date and the room, and Sandee will confirm availability and pricing within one business day.',
		'contact_recipients' => 'hypno2u@hotmail.com, hypno2u@icloud.com, richard@misterhypnosis.com',
		'contact_success'    => 'Thank you — your enquiry is in. Sandee or Richard will reply within one business day.',
		'footer_phone'       => '(714) 322-0207',
		'footer_email'       => 'richard@misterhypnosis.com',
		'footer_address'     => 'P.O. Box 596, Dana Point, CA 92629',
	);

	foreach ( $home as $key => $value ) {
		update_post_meta( $front_id, $key, $value );
		update_post_meta( $front_id, '_' . $key, 'field_mrh_' . $key );
	}

	WP_CLI::log( 'home page fields seeded' );
} else {
	WP_CLI::warning( 'No static front page is set, so home-page fields were skipped.' );
}

WP_CLI::success( 'Mister Hypnosis content seeded.' );
