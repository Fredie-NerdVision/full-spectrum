<?php
/**
 * ACF field groups, registered in code so the content model travels with the theme.
 *
 * Only field types available in ACF free are used, so the site keeps working if the
 * Pro licence lapses.
 *
 * @package fse
 */

add_action(
	'acf/init',
	function () {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key'      => 'group_fse_home',
				'title'    => __( 'Home Page Sections', 'fse' ),
				'location' => array(
					array(
						array(
							'param'    => 'page_type',
							'operator' => '==',
							'value'    => 'front_page',
						),
					),
				),
				'position' => 'acf_after_title',
				'style'    => 'seamless',
				'fields'   => array(
					array(
						'key'   => 'field_fse_tab_hero',
						'label' => __( 'Header', 'fse' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'           => 'field_fse_hero_banner',
						'label'         => __( 'Header banner (horizontal)', 'fse' ),
						'name'          => 'hero_banner',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
						'instructions'  => __( 'Wide banner artwork, at least 2400px across. Replaces the old hero photo.', 'fse' ),
					),
					array(
						'key'           => 'field_fse_hero_photo',
						'label'         => __( 'Hero photo', 'fse' ),
						'name'          => 'hero_photo',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
						'instructions'  => __( 'Shown beside the headline in a tilted frame. A wide shot of a real audience works best.', 'fse' ),
					),
					array(
						'key'          => 'field_fse_hero_kicker',
						'label'        => __( 'Kicker pill', 'fse' ),
						'name'         => 'hero_kicker',
						'type'         => 'text',
						'default_value'=> '★ Serving California schools & libraries since 1994',
					),
					array(
						'key'          => 'field_fse_hero_heading',
						'label'        => __( 'Headline', 'fse' ),
						'name'         => 'hero_heading',
						'type'         => 'text',
						'default_value'=> 'Assemblies Your Students Love. <em>Paperwork You Can Trust.</em>',
						'instructions' => __( 'Wrap a word or phrase in <em> to colour it amber.', 'fse' ),
					),
					array(
						'key'          => 'field_fse_hero_intro',
						'label'        => __( 'Intro paragraph', 'fse' ),
						'name'         => 'hero_intro',
						'type'         => 'textarea',
						'rows'         => 3,
						'new_lines'    => 'wpautop',
					),
					array(
						'key'          => 'field_fse_hero_cta_label',
						'label'        => __( 'Button label', 'fse' ),
						'name'         => 'hero_cta_label',
						'type'         => 'text',
						'default_value'=> 'Check Your Date',
					),
					array(
						'key'          => 'field_fse_hero_badge',
						'label'        => __( 'Photo badge', 'fse' ),
						'name'         => 'hero_badge',
						'type'         => 'text',
						'instructions' => __( 'Short proof point stuck on the hero photo. Leave blank to hide.', 'fse' ),
						'default_value'=> '1,200+ assemblies booked',
					),
					array(
						'key'   => 'field_fse_tab_quicknav',
						'label' => __( 'Quick Navigation', 'fse' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_fse_quicknav_heading',
						'label'        => __( 'Heading', 'fse' ),
						'name'         => 'quicknav_heading',
						'type'         => 'text',
						'default_value'=> 'What are you planning?',
					),
					array(
						'key'       => 'field_fse_quicknav_intro',
						'label'     => __( 'Intro', 'fse' ),
						'name'      => 'quicknav_intro',
						'type'      => 'textarea',
						'rows'      => 2,
						'new_lines' => 'wpautop',
					),
					array(
						'key'   => 'field_fse_tab_programs',
						'label' => __( 'Programs', 'fse' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_fse_programs_heading',
						'label'        => __( 'Heading', 'fse' ),
						'name'         => 'programs_heading',
						'type'         => 'text',
						'default_value'=> 'Pick A Show',
					),
					array(
						'key'       => 'field_fse_programs_intro',
						'label'     => __( 'Intro', 'fse' ),
						'name'      => 'programs_intro',
						'type'      => 'textarea',
						'rows'      => 2,
						'new_lines' => 'wpautop',
					),
					array(
						'key'   => 'field_fse_tab_credentials',
						'label' => __( 'Credentials', 'fse' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_fse_credentials_heading',
						'label'        => __( 'Heading', 'fse' ),
						'name'         => 'credentials_heading',
						'type'         => 'text',
						'default_value'=> 'Safe Hands, Happy Principals',
					),
					array(
						'key'       => 'field_fse_credentials_body',
						'label'     => __( 'Body copy', 'fse' ),
						'name'      => 'credentials_body',
						'type'      => 'wysiwyg',
						'media_upload' => 0,
						'toolbar'   => 'basic',
					),
					array(
						'key'          => 'field_fse_credentials_points',
						'label'        => __( 'Checklist', 'fse' ),
						'name'         => 'credentials_points',
						'type'         => 'textarea',
						'rows'         => 6,
						'instructions' => __( 'One point per line.', 'fse' ),
					),
					array(
						'key'           => 'field_fse_credentials_image',
						'label'         => __( 'Supporting photo', 'fse' ),
						'name'          => 'credentials_image',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
					),
					array(
						'key'   => 'field_fse_tab_contact',
						'label' => __( 'Contact', 'fse' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_fse_contact_heading',
						'label'        => __( 'Heading', 'fse' ),
						'name'         => 'contact_heading',
						'type'         => 'text',
						'default_value'=> 'Check Your Date',
					),
					array(
						'key'       => 'field_fse_contact_intro',
						'label'     => __( 'Intro', 'fse' ),
						'name'      => 'contact_intro',
						'type'      => 'textarea',
						'rows'      => 3,
						'new_lines' => 'wpautop',
					),
					array(
						'key'          => 'field_fse_contact_recipients',
						'label'        => __( 'Send enquiries to', 'fse' ),
						'name'         => 'contact_recipients',
						'type'         => 'text',
						'instructions' => __( 'Comma separated. Leave blank to use the WordPress admin email.', 'fse' ),
						'default_value'=> 'fullspectrument@hotmail.com',
					),
					array(
						'key'          => 'field_fse_contact_success',
						'label'        => __( 'Thank-you message', 'fse' ),
						'name'         => 'contact_success',
						'type'         => 'text',
						'default_value'=> 'Thank you — we have your request and will reply within one business day.',
					),
					array(
						'key'   => 'field_fse_tab_footer',
						'label' => __( 'Footer', 'fse' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_fse_footer_tagline',
						'label'        => __( 'Primary slogan', 'fse' ),
						'name'         => 'footer_tagline',
						'type'         => 'text',
						'default_value'=> 'Creating Good Times And Great Memories Is What We Do Best',
					),
					array(
						'key'          => 'field_fse_footer_secondary',
						'label'        => __( 'Secondary slogan', 'fse' ),
						'name'         => 'footer_secondary_tagline',
						'type'         => 'text',
						'default_value'=> 'Once A Customer, Always A Friend',
					),
					array(
						'key'          => 'field_fse_footer_address',
						'label'        => __( 'Mailing address', 'fse' ),
						'name'         => 'footer_address',
						'type'         => 'text',
						'default_value'=> 'P.O. Box 596, Dana Point, CA 92629',
					),
					array(
						'key'          => 'field_fse_footer_phone',
						'label'        => __( 'Phone', 'fse' ),
						'name'         => 'footer_phone',
						'type'         => 'text',
						'default_value'=> '(949) 496-6244',
					),
					array(
						'key'          => 'field_fse_footer_email',
						'label'        => __( 'Email', 'fse' ),
						'name'         => 'footer_email',
						'type'         => 'text',
						'default_value'=> 'programs@full-spectrum.org',
					),
				),
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_fse_program',
				'title'    => __( 'Program Details', 'fse' ),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => FSE_PROGRAM_POST_TYPE,
						),
					),
				),
				'fields'   => array(
					array(
						'key'          => 'field_fse_program_tagline',
						'label'        => __( 'Card tagline', 'fse' ),
						'name'         => 'program_tagline',
						'type'         => 'text',
						'instructions' => __( 'One line shown under the program name on the card.', 'fse' ),
					),
					array(
						'key'          => 'field_fse_program_discipline',
						'label'        => __( 'Discipline', 'fse' ),
						'name'         => 'program_discipline',
						'type'         => 'text',
						'instructions' => __( 'e.g. Science / STEM (NGSS Aligned)', 'fse' ),
					),
					array(
						'key'   => 'field_fse_program_audience',
						'label' => __( 'Target audience', 'fse' ),
						'name'  => 'program_audience',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_fse_program_duration',
						'label' => __( 'Format & duration', 'fse' ),
						'name'  => 'program_duration',
						'type'  => 'text',
					),
					array(
						'key'          => 'field_fse_program_highlights',
						'label'        => __( 'Highlights', 'fse' ),
						'name'         => 'program_highlights',
						'type'         => 'textarea',
						'rows'         => 6,
						'new_lines'    => '',
						'instructions' => __( 'One per line. Rendered as a bullet list.', 'fse' ),
					),
					array(
						'key'          => 'field_fse_program_price',
						'label'        => __( 'Pricing note', 'fse' ),
						'name'         => 'program_price',
						'type'         => 'text',
						'instructions' => __( 'Optional, e.g. $525 for two sessions.', 'fse' ),
					),
					array(
						'key'          => 'field_fse_program_awaiting_photo',
						'label'        => __( 'Photography still pending', 'fse' ),
						'name'         => 'program_awaiting_photo',
						'type'         => 'true_false',
						'ui'           => 1,
						'instructions' => __( 'Publishes the card with a branded placeholder graphic so copy can go live before photos arrive.', 'fse' ),
					),
				),
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_fse_service_group',
				'title'    => __( 'Quick Navigation Button', 'fse' ),
				'location' => array(
					array(
						array(
							'param'    => 'taxonomy',
							'operator' => '==',
							'value'    => FSE_PROGRAM_TAXONOMY,
						),
					),
				),
				'fields'   => array(
					array(
						'key'          => 'field_fse_group_icon',
						'label'        => __( 'Button icon', 'fse' ),
						'name'         => 'group_icon',
						'type'         => 'text',
						'instructions' => __( 'A single emoji or character shown on the quick-navigation button.', 'fse' ),
						'maxlength'    => 4,
					),
					array(
						'key'          => 'field_fse_group_eyebrow',
						'label'        => __( 'Section eyebrow', 'fse' ),
						'name'         => 'group_eyebrow',
						'type'         => 'text',
						'instructions' => __( 'Short line above the section heading, e.g. "Whole-school assemblies".', 'fse' ),
					),
					array(
						'key'          => 'field_fse_group_nav_label',
						'label'        => __( 'Menu label', 'fse' ),
						'name'         => 'group_nav_label',
						'type'         => 'text',
						'instructions' => __( 'Optional shorter wording for the header menu. Leave blank to use the full name.', 'fse' ),
					),
					array(
						'key'   => 'field_fse_group_blurb',
						'label' => __( 'Short blurb', 'fse' ),
						'name'  => 'group_blurb',
						'type'  => 'textarea',
						'rows'  => 2,
					),
					array(
						'key'           => 'field_fse_group_image',
						'label'         => __( 'Section image', 'fse' ),
						'name'          => 'group_image',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
					),
				),
			)
		);
	}
);
