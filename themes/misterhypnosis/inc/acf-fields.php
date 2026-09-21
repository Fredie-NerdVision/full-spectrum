<?php
/**
 * ACF field groups. Only ACF free field types are used.
 *
 * @package mrh
 */

add_action(
	'acf/init',
	function () {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key'      => 'group_mrh_home',
				'title'    => __( 'Home Page Sections', 'mrh' ),
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
						'key'   => 'field_mrh_tab_hero',
						'label' => __( 'Hero', 'mrh' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_mrh_hero_kicker',
						'label'        => __( 'Kicker', 'mrh' ),
						'name'         => 'hero_kicker',
						'type'         => 'text',
						'default_value'=> 'Mister Hypnosis',
					),
					array(
						'key'          => 'field_mrh_hero_heading',
						'label'        => __( 'Headline', 'mrh' ),
						'name'         => 'hero_heading',
						'type'         => 'text',
						'default_value'=> 'Richard Rumble',
					),
					array(
						'key'       => 'field_mrh_hero_intro',
						'label'     => __( 'Intro', 'mrh' ),
						'name'      => 'hero_intro',
						'type'      => 'textarea',
						'rows'      => 3,
						'new_lines' => 'wpautop',
					),
					array(
						'key'           => 'field_mrh_hero_portrait',
						'label'         => __( 'Portrait', 'mrh' ),
						'name'          => 'hero_portrait',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
						'instructions'  => __( 'Not shown in the current hero layout — the stage photo below doubles as the portrait.', 'mrh' ),
					),
					array(
						'key'           => 'field_mrh_hero_background',
						'label'         => __( 'Stage photo', 'mrh' ),
						'name'          => 'hero_background',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
					),
					array(
						'key'          => 'field_mrh_hero_video',
						'label'        => __( 'Sizzle reel Vimeo ID', 'mrh' ),
						'name'         => 'hero_video',
						'type'         => 'text',
						'instructions' => __( 'Numbers only, e.g. 955007390. Keep reels under 90 seconds.', 'mrh' ),
					),
					array(
						'key'   => 'field_mrh_tab_about',
						'label' => __( 'About & Credentials', 'mrh' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_mrh_about_heading',
						'label'        => __( 'Heading', 'mrh' ),
						'name'         => 'about_heading',
						'type'         => 'text',
						'default_value'=> 'A Magic Castle Member Who Works Clean',
					),
					array(
						'key'          => 'field_mrh_about_body',
						'label'        => __( 'Body copy', 'mrh' ),
						'name'         => 'about_body',
						'type'         => 'wysiwyg',
						'toolbar'      => 'basic',
						'media_upload' => 0,
					),
					array(
						'key'           => 'field_mrh_about_image',
						'label'         => __( 'Magic Castle credential photo', 'mrh' ),
						'name'          => 'about_image',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
					),
					array(
						'key'          => 'field_mrh_credentials_list',
						'label'        => __( 'Memberships & credentials', 'mrh' ),
						'name'         => 'credentials_list',
						'type'         => 'textarea',
						'rows'         => 6,
						'new_lines'    => '',
						'instructions' => __( 'One per line.', 'mrh' ),
						'default_value'=> "NLP Master Practitioner\nAmerican Board of Hypnotherapy\nNational Guild of Hypnotists\nSociety of Applied Hypnosis\nInternational Brotherhood of Magicians\nThe Magic Castle, Hollywood CA",
					),
					array(
						'key'           => 'field_mrh_credentials_badge',
						'label'         => __( 'Credential badge', 'mrh' ),
						'name'          => 'credentials_badge',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
						'instructions'  => __( 'A membership mark such as the Magic Castle logo. White-on-transparent PNG reads best against the dark background.', 'mrh' ),
					),
					array(
						'key'   => 'field_mrh_tab_audiences',
						'label' => __( 'Audiences', 'mrh' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_mrh_audiences_heading',
						'label'        => __( 'Heading', 'mrh' ),
						'name'         => 'audiences_heading',
						'type'         => 'text',
						'default_value'=> 'Who Is In The Room?',
					),
					array(
						'key'       => 'field_mrh_audiences_intro',
						'label'     => __( 'Intro', 'mrh' ),
						'name'      => 'audiences_intro',
						'type'      => 'textarea',
						'rows'      => 2,
						'new_lines' => 'wpautop',
					),
					array(
						'key'   => 'field_mrh_tab_contact',
						'label' => __( 'Booking', 'mrh' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_mrh_contact_heading',
						'label'        => __( 'Heading', 'mrh' ),
						'name'         => 'contact_heading',
						'type'         => 'text',
						'default_value'=> 'Book Mister Hypnosis',
					),
					array(
						'key'       => 'field_mrh_contact_intro',
						'label'     => __( 'Intro', 'mrh' ),
						'name'      => 'contact_intro',
						'type'      => 'textarea',
						'rows'      => 3,
						'new_lines' => 'wpautop',
					),
					array(
						'key'          => 'field_mrh_contact_recipients',
						'label'        => __( 'Send enquiries to', 'mrh' ),
						'name'         => 'contact_recipients',
						'type'         => 'text',
						'instructions' => __( 'Comma separated. Every submission is also stored under Enquiries.', 'mrh' ),
						'default_value'=> 'hypno2u@hotmail.com, hypno2u@icloud.com',
					),
					array(
						'key'          => 'field_mrh_contact_success',
						'label'        => __( 'Thank-you message', 'mrh' ),
						'name'         => 'contact_success',
						'type'         => 'text',
						'default_value'=> 'Thank you — Richard will be in touch within one business day.',
					),
					array(
						'key'   => 'field_mrh_tab_footer',
						'label' => __( 'Footer', 'mrh' ),
						'name'  => '',
						'type'  => 'tab',
					),
					array(
						'key'          => 'field_mrh_footer_phone',
						'label'        => __( 'Phone', 'mrh' ),
						'name'         => 'footer_phone',
						'type'         => 'text',
						'default_value'=> '(714) 322-0207',
					),
					array(
						'key'          => 'field_mrh_footer_email',
						'label'        => __( 'Email', 'mrh' ),
						'name'         => 'footer_email',
						'type'         => 'text',
						'default_value'=> 'richard@misterhypnosis.com',
					),
					array(
						'key'          => 'field_mrh_footer_address',
						'label'        => __( 'Mailing address', 'mrh' ),
						'name'         => 'footer_address',
						'type'         => 'text',
						'default_value'=> 'P.O. Box 596, Dana Point, CA 92629',
					),
					array(
						'key'   => 'field_mrh_footer_facebook',
						'label' => __( 'Facebook URL', 'mrh' ),
						'name'  => 'footer_facebook',
						'type'  => 'url',
					),
					array(
						'key'   => 'field_mrh_footer_instagram',
						'label' => __( 'Instagram URL', 'mrh' ),
						'name'  => 'footer_instagram',
						'type'  => 'url',
					),
				),
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_mrh_audience',
				'title'    => __( 'Audience Section', 'mrh' ),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => MRH_AUDIENCE_POST_TYPE,
						),
					),
				),
				'fields'   => array(
					array(
						'key'          => 'field_mrh_audience_kicker',
						'label'        => __( 'Kicker', 'mrh' ),
						'name'         => 'audience_kicker',
						'type'         => 'text',
						'instructions' => __( 'e.g. High schools', 'mrh' ),
					),
					array(
						'key'   => 'field_mrh_audience_tagline',
						'label' => __( 'Tagline', 'mrh' ),
						'name'  => 'audience_tagline',
						'type'  => 'text',
					),
					array(
						'key'          => 'field_mrh_audience_points',
						'label'        => __( 'Selling points', 'mrh' ),
						'name'         => 'audience_points',
						'type'         => 'textarea',
						'rows'         => 5,
						'new_lines'    => '',
						'instructions' => __( 'One per line.', 'mrh' ),
					),
					array(
						'key'          => 'field_mrh_audience_video',
						'label'        => __( 'Vimeo ID', 'mrh' ),
						'name'         => 'audience_video',
						'type'         => 'text',
						'instructions' => __( 'Numbers only. Replaces the old AudioAcrobat players with a responsive HTML5 embed.', 'mrh' ),
					),
					array(
						'key'          => 'field_mrh_audience_cta',
						'label'        => __( 'Button label', 'mrh' ),
						'name'         => 'audience_cta',
						'type'         => 'text',
						'default_value'=> 'Check your date',
					),
				),
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_mrh_testimonial',
				'title'    => __( 'Testimonial Details', 'mrh' ),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => MRH_TESTIMONIAL_POST_TYPE,
						),
					),
				),
				'fields'   => array(
					array(
						'key'          => 'field_mrh_testimonial_role',
						'label'        => __( 'Role & organisation', 'mrh' ),
						'name'         => 'testimonial_role',
						'type'         => 'text',
						'instructions' => __( 'e.g. Activities Director, Dana Hills High School', 'mrh' ),
					),
					array(
						'key'          => 'field_mrh_testimonial_audience',
						'label'        => __( 'Show this testimonial with', 'mrh' ),
						'name'         => 'testimonial_audience',
						'type'         => 'post_object',
						'post_type'    => array( MRH_AUDIENCE_POST_TYPE ),
						'return_format'=> 'id',
						'allow_null'   => 1,
						'ui'           => 1,
						'instructions' => __( 'Optional. Leave blank to show in the general testimonial row.', 'mrh' ),
					),
					array(
						'key'          => 'field_mrh_testimonial_video',
						'label'        => __( 'Vimeo ID', 'mrh' ),
						'name'         => 'testimonial_video',
						'type'         => 'text',
						'instructions' => __( 'Optional video version of this testimonial.', 'mrh' ),
					),
				),
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_mrh_client',
				'title'    => __( 'Client Logo', 'mrh' ),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => MRH_CLIENT_POST_TYPE,
						),
					),
				),
				'fields'   => array(
					array(
						'key'          => 'field_mrh_client_logo',
						'label'        => __( 'Logo', 'mrh' ),
						'name'         => 'client_logo',
						'type'         => 'image',
						'return_format'=> 'id',
						'preview_size' => 'mrh-logo',
						'instructions' => __( 'Transparent PNG or SVG works best. Leave blank to use the featured image.', 'mrh' ),
					),
					array(
						'key'   => 'field_mrh_client_url',
						'label' => __( 'Website', 'mrh' ),
						'name'  => 'client_url',
						'type'  => 'url',
					),
				),
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_mrh_gallery',
				'title'    => __( 'Gallery Image', 'mrh' ),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => MRH_MEDIA_POST_TYPE,
						),
					),
				),
				'fields'   => array(
					array(
						'key'          => 'field_mrh_gallery_image',
						'label'        => __( 'Image', 'mrh' ),
						'name'         => 'gallery_image',
						'type'         => 'image',
						'return_format'=> 'id',
						'preview_size' => 'mrh-card',
						'instructions' => __( 'Leave blank to use the featured image.', 'mrh' ),
					),
					array(
						'key'          => 'field_mrh_gallery_caption',
						'label'        => __( 'Caption', 'mrh' ),
						'name'         => 'gallery_caption',
						'type'         => 'text',
						'instructions' => __( 'Shown under the image and used as the alt text.', 'mrh' ),
					),
				),
			)
		);
	}
);
