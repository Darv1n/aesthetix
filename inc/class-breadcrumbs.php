<?php
/**
 * Aesthetix_Breadcrumbs Class.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates a breadcrumbs menu for the site based on the current page that's being viewed by the user.
 *
 * @access public
 */
class Aesthetix_Breadcrumbs {

	/**
	 * Array of items belonging to the current breadcrumb trail.
	 *
	 * @access public
	 * @var    array
	 */
	public $items = array();

	/**
	 * Arguments used to build the breadcrumb trail.
	 *
	 * @access public
	 * @var    array
	 */
	public $args = array();

	/**
	 * Items counter.
	 *
	 * @access public
	 * @var    int
	 */
	public $i = 0;

	/**
	 * Sets up the breadcrumb trail properties.  Calls the `Aesthetix_Breadcrumbs::add_items()` method to creat the array of breadcrumb items.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Set the args, labels and items properties.
		$this->add_args();
		$this->add_labels();
		$this->add_items();
	}

	/**
	 * Formats the HTML output for the breadcrumb trail.
	 *
	 * @access public
	 * @return string
	 */
	public function get_output() {

		// Set up variables that we'll need.
		$breadcrumb    = '';
		$item_count    = count( $this->items );
		$item_position = 0;

		// Connect the breadcrumb trail if there are items in the trail.
		if ( $item_count > 0 ) {

			// Open the unordered list.
			$breadcrumb .= sprintf( '<ol class="breadcrumbs-list breadcrumbs-list-%s">', $this->args['style'] );

			// Loop through the items and add them to the list.
			foreach ( $this->items as $item ) {

				// Iterate the item position.
				++$item_position;

				// Add list item classes.
				$item_classes   = array();
				$item_classes[] = 'breadcrumbs-item';
				$rel = '';

				if ( 1 === $item_position && 1 < $item_count ) {
					$item_classes[] = 'breadcrumbs-item-begin';
					$rel = ' rel="home"';
				} elseif ( $item_count === $item_position ) {
					$item_classes[] = 'breadcrumbs-item-end';
				}

				$link_classes = get_link_classes( 'breadcrumbs-link' );

				// Separator.
				if ( $item_count === $item_position ) {
					$sep  = '';
					$item = sprintf( '<span class="breadcrumbs-span">%s</span>', esc_html( trim( $item['label'] ) ) );
				} else {
					$sep = '<span class="breadcrumbs-sep">' . $this->args['separator'] . '</span>';
					$item = sprintf( '<a href="%s" class="%s"%s>%s</a>', esc_url( trailingslashit( $item['link'] ) ), esc_attr( implode( ' ', $link_classes ) ), $rel, esc_html( trim( $item['label'] ) ) );
				}

				// Build the list item.
				$breadcrumb .= sprintf( '<li class="%s">%s%s</li>', esc_attr( implode( ' ', $item_classes ) ), $item, $sep );
			}

			// Close the unordered list.
			$breadcrumb .= '</ol>';

			// Wrap the breadcrumb trail.
			$breadcrumb = sprintf(
				'<%1$s id="breadcrumbs" role="navigation" aria-label="%2$s" class="breadcrumbs">%3$s%4$s%5$s</%1$s>',
				tag_escape( $this->args['container'] ),
				esc_attr( $this->labels['aria_label'] ),
				$this->args['before'],
				$breadcrumb,
				$this->args['after']
			);
		}

		// Allow developers to filter the breadcrumb trail HTML.
		$breadcrumb = apply_filters( 'breadcrumb_html', $breadcrumb, $this->args );

		return $breadcrumb;
	}

	/**
	 * Echo the breadcrumb trail.
	 *
	 * @access public
	 * @return string
	 */
	public function the_output() {

		echo $this->get_output(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Adds the args property. Parses the inputted args array with the defaults.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_args() {

		$defaults = array(
			'container'     => 'nav',
			'before'        => '',
			'after'         => '',
			'style'         => 'inline', // inline, block.
			'show_on_front' => true,
			'home_icon'     => true,
			'network'       => false,
			'show_title'    => true,
			'labels'        => array(),
			'post_taxonomy' => array(),
			'echo'          => true,
			'schema'        => true,
			'separator'     => get_aesthetix_options( 'breadcrumbs_separator' ),
		);

		$this->args = apply_filters( 'aesthetix_get_breadcrumbs_args', wp_parse_args( $this->args, $defaults ) );
	}

	/**
	 * Adds the labels property. Parses the inputted labels array with the defaults.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_labels() {

		$defaults = array(
			'aria_label'          => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'aesthetix' ),
			'home'                => esc_html__( 'Home', 'aesthetix' ),
			'error_404'           => esc_html__( '404 Not Found', 'aesthetix' ),
			'archives'            => esc_html__( 'Archives', 'aesthetix' ),
			'search'              => esc_html__( 'Search results for', 'aesthetix' ), // Translators: %s is the search query. The HTML entities are opening and closing curly quotes.
			'paged'               => esc_html__( 'Page %s', 'aesthetix' ), // Translators: %s is the page number.
			'paged_comments'      => esc_html__( 'Comments page %s', 'aesthetix' ), // Translators: %s is the page number.
			'archive_minute'      => esc_html__( 'Minute %s', 'oceanwp' ),
			'archive_week'        => esc_html__( 'Week %s', 'oceanwp' ), // Translators: Weekly archive title. %s is the week date format.
			'archive_minute_hour' => esc_html__( 'Hour %s', 'oceanwp' ), // "%s" is replaced with the translated date/time format.
			'archive_hour'        => esc_html__( 'Hour %s', 'oceanwp' ), // "%s" is replaced with the translated date/time format.
			'archive_day'         => esc_html__( 'Day %s', 'aesthetix' ), // "%s" is replaced with the translated date/time format.
			'archive_month'       => esc_html__( 'Month %s', 'aesthetix' ), // "%s" is replaced with the translated date/time format.
			'archive_year'        => esc_html__( 'Year %s', 'aesthetix' ), // "%s" is replaced with the translated date/time format.
		);

		$this->labels = apply_filters( 'aesthetix_get_breadcrumbs_labels', wp_parse_args( $this->args['labels'], $defaults ) );
	}

	/**
	 * Runs through the various WordPress conditional tags to check the current page being viewed.  Once
	 * a condition is met, a specific method is launched to add items to the `$items` array.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_items() {

		if ( is_multisite() && ! is_main_site() && $this->args['network'] === true ) {
			$this->add_network_home_item();
		}

		$this->add_site_home_item();

		if ( is_home() ) {
			$this->add_home_item();
		} elseif ( is_search() ) {
			$this->add_search_items();
		} elseif ( is_404() ) {
			$this->add_404_items();
		} elseif ( is_singular() ) {

			// Get the queried post.
			$post    = get_queried_object();
			$post_id = get_queried_object_id();

			global $wp_rewrite;

			$permalink_structure = trim( $wp_rewrite->permalink_structure, '/' );
			$permalink_structure = array_map( 'trim' , explode( '/', $permalink_structure ) );

			foreach ( $permalink_structure as $key => $permalink_value ) {
				$permalink_value = trim( $permalink_value, '%' );

				switch ( $permalink_value ) {
					case 'year':
						$this->add_post_year_item( $post_id );
						break;
					case 'monthnum':
						$this->add_post_month_item( $post_id );
						break;
					case 'day':
						$this->add_post_day_item( $post_id );
						break;
					case 'author':
						$this->add_post_author_item( $post_id );
						break;
					case 'postname':
						$this->add_post_parents( $post_id );
						break;
					case 'category':
						if ( get_aesthetix_options( 'breadcrumbs_' . $post->post_type . '_archive_display' ) ) {
							$this->add_post_type_archive_item( $post->post_type );
						}
						if ( get_aesthetix_options( 'breadcrumbs_' . $post->post_type . '_term' ) !== false && get_aesthetix_options( 'breadcrumbs_' . $post->post_type . '_term' ) !== 'empty' ) {
							$this->add_post_terms( $post_id, get_aesthetix_options( 'breadcrumbs_' . $post->post_type . '_term' ) );
						}
						break;
					default:
						break;
				}
			}
		} elseif ( is_archive() ) {

			if ( is_post_type_archive() ) {
				$this->add_post_type_archive_item();
			} elseif ( is_category() || is_tag() || is_tax() ) {
				$this->add_archive_term_items();
			} elseif ( is_author() ) {
				$this->add_archive_author_item();
			} elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) ) {
				$this->add_archive_minute_hour_item();
			} elseif ( get_query_var( 'minute' ) ) {
				$this->add_archive_minute_item();
			} elseif ( get_query_var( 'hour' ) ) {
				$this->add_archive_hour_item();
			} elseif ( is_day() ) {
				$this->add_archive_day_item();
			} elseif ( get_query_var( 'w' ) ) {
				$this->add_archive_week_item();
			} elseif ( is_month() ) {
				$this->add_archive_month_item();
			} elseif ( is_year() ) {
				$this->add_archive_year_item();
			} else {
				$this->add_archive_default_item();
			}
		}

		// Add paged items if they exist.
		$this->add_paged_items();

		// Allow developers to overwrite the items for the breadcrumb trail.
		$this->items = apply_filters( 'aesthetix_get_breadcrumbs_items', $this->items, $this->args );
	}

	/**
	 * Adds the network (all sites) home page link to the items array.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_network_home_item() {

		if ( is_multisite() ) {
			$this->items[ $this->i ]['query'] = 'network_home';
			$this->items[ $this->i ]['link']  = trailingslashit( network_home_url() );
			$this->items[ $this->i ]['label'] = $this->labels['home'];
			$this->i++;
		}
	}

	/**
	 * Adds the current site's home page link to the items array.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_site_home_item() {

		$this->items[ $this->i ]['query'] = 'home';
		$this->items[ $this->i ]['link'] = trailingslashit( home_url() );

		if ( is_multisite() && ! is_main_site() && true === $this->args['network'] ) {
			$this->items[ $this->i ]['label'] = get_bloginfo( 'name' );
		} else {
			$this->items[ $this->i ]['label'] = $this->labels['home'];
		}

		$this->i++;
	}

	/**
	 * Adds blog page items to the items array.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_home_item() {

		$post_id = get_option( 'page_for_posts' );

		if ( (int) $post_id !== 0 ) {
			$this->items[ $this->i ]['id']    = $post_id;
			$this->items[ $this->i ]['query'] = 'page_home';
			$this->items[ $this->i ]['link']  = trailingslashit( get_permalink( $post_id ) );
			$this->items[ $this->i ]['label'] = get_the_title( $post_id );
			$this->i++;
		}
	}

	/**
	 * Adds the items to the trail items array for search results.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_search_items() {

		$this->items[ $this->i ]['link']  = trailingslashit( get_search_link() );
		$this->items[ $this->i ]['label'] = $this->labels['search'] . ': ' . get_search_query();
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for 404 pages.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_404_items() {

		$this->items[ $this->i ]['label'] = $this->labels['error_404'];
		$this->i++;
	}

	/**
	 * Adds archive post type to the items array.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_post_type_archive_item( $post_type = null ) {

		// if is null we try to get post type from query object.
		if ( is_null( $post_type ) ) {
			$object = get_queried_object();
			if ( get_class( $object ) === 'WP_Post_Type' ) {
				$post_type = $object->name;
			} elseif ( get_class( $object ) === 'WP_Post' ) {
				$post_type = $object->post_type;
			}
		}

		// Just in case.
		if ( is_null( $post_type ) ) {
			return;
		}

		if ( post_type_exists( $post_type ) ) {
			$post_type_object = get_post_type_object( $post_type );

			if ( $post_type_object->has_archive ) {

				// Add support for a non-standard label of 'archive_title' (special use case).
				$label = ! empty( $post_type_object->labels->archive_title ) ? $post_type_object->labels->archive_title : $post_type_object->labels->name;

				// Core filter hook.
				$label = apply_filters( 'post_type_archive_title', $label, $post_type_object->name );

				$this->items[ $this->i ]['query'] = 'post_type_archive';
				$this->items[ $this->i ]['link']  = trailingslashit( get_post_type_archive_link( $post_type ) );
				$this->items[ $this->i ]['label'] = $label;
				$this->i++;
			}
		} else {
			return;
		}
	}

	/**
	 * Adds a specific post's parents to the items array.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_post_parents( $post_id ) {

		$parents = array();

		while ( $post_id ) {

			// Get the post by ID.
			$post = get_post( $post_id );

			// If we hit a page that's set as the front page, bail.
			if ( $post->post_type === 'page' && get_option( 'show_on_front' ) === 'page' && get_option( 'page_on_front' ) === $post_id ) {
				break;
			}

			$parents[ $this->i ]['id']    = $post_id;
			$parents[ $this->i ]['query'] = 'post';
			$parents[ $this->i ]['link']  = trailingslashit( get_permalink( $post_id ) );
			$parents[ $this->i ]['label'] = get_the_title( $post_id );
			$this->i++;

			// If there's no longer a post parent, break out of the loop.
			if ( (int) $post->post_parent === 0 ) {
				break;
			}

			// Change the post ID to the parent post to continue looping.
			$post_id = $post->post_parent;
		}

		// If we have parent terms, reverse the array to put them in the proper order for the trail.
		if ( ! empty( $parents ) ) {
			$this->items = array_merge( $this->items, array_reverse( $parents ) );
		}
	}

	/**
	 * Adds a author of the post to the items array.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_post_author_item( $post_id ) {

		// Get the post by ID.
		$post = get_post( $post_id );

		if ( is_null( $post ) ) {
			return;
		}

		if ( get_userdata( $post->post_author ) ) {
			$this->items[ $this->i ]['id']    = $post->post_author;
			$this->items[ $this->i ]['query'] = 'author';
			$this->items[ $this->i ]['link']  = trailingslashit( get_author_posts_url( $post->post_author ) );
			$this->items[ $this->i ]['label'] = get_the_author_meta( 'display_name', $post->post_author );
			$this->i++;
		} else {
			return;
		}
	}

	/**
	 * Adds a link to the yearly archive.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_post_year_item( $post_id ) {

		// Get the post by ID.
		$post = get_post( $post_id );

		if ( is_null( $post ) ) {
			return;
		}

		$this->items[ $this->i ]['link']  = trailingslashit( get_year_link( get_the_time( 'Y', $post_id ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'aesthetix' ) ) );
		$this->i++;
	}

	/**
	 * Adds a link to the monthly archive.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_post_month_item( $post_id ) {

		// Get the post by ID.
		$post = get_post( $post_id );

		if ( is_null( $post ) ) {
			return;
		}

		$this->items[ $this->i ]['link']  = trailingslashit( get_month_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'aesthetix' ) ) );
		$this->i++;
	}

	/**
	 * Adds a link to the daily archive.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_post_day_item( $post_id ) {

		// Get the post by ID.
		$post = get_post( $post_id );

		if ( is_null( $post ) ) {
			return;
		}

		$this->items[ $this->i ]['link']  = trailingslashit( get_day_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ), get_the_time( 'd', $post_id ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_day'], get_the_time( esc_html_x( 'j', 'daily archives date format', 'aesthetix' ) ) );
		$this->i++;
	}

	/**
	 * Adds a post's terms from a specific taxonomy to the items array.
	 *
	 * @access protected
	 * @param  int     $post_id  The ID of the post to get the terms for.
	 * @param  string  $taxonomy The taxonomy to get the terms from.
	 * @return void
	 */
	protected function add_post_terms( $post_id, $taxonomy ) {

		// Get the post type.
		$post_type = get_post_type( $post_id );

		// Get the post categories.
		$terms = get_the_terms( $post_id, $taxonomy );

		// If this is a hierarchical post type and it has taxonomies, then we try to get the parent taxonomies.
		if ( $terms === false || is_wp_error( $terms ) ) {
			$post = get_post( $post_id );

			while ( $post_id ) {

				// Get the post by ID.
				$post = get_post( $post_id );

				// If there's no longer a post parent, break out of the loop.
				if ( (int) $post->post_parent === 0 ) {
					break;
				}

				// Get the post categories.
				$terms = get_the_terms( $post->post_parent, $taxonomy );

				if ( $terms && ! is_wp_error( $terms ) ) {
					break;
				}

				// Change the post ID to the parent post to continue looping.
				$post_id = $post->post_parent;
			}
		}

		// Check that categories were returned.
		if ( $terms && ! is_wp_error( $terms ) ) {

			// Sort the terms by ID and get the first category.
			if ( function_exists( 'wp_list_sort' ) ) {
				$terms = wp_list_sort( $terms, 'term_id' );
			} else {
				usort( $terms, '_usort_terms_by_ID' );
			}

			// If there is more than one term, then we try to find it in the current link.
			if ( $terms === 1 ) {
				$term_id = $terms[0]->term_id;
			} else {
				$path = wp_parse_url( get_permalink( $post_id ), PHP_URL_PATH );
				$path = array_map( 'trim' , explode( '/', trim( $path, '/' ) ) );

				foreach ( $terms as $key => $term ) {
					if ( in_array( $term->slug, $path, true ) ) {
						$term_id = $term->term_id;
						break;
					}
				}
			}

			// Just in case.
			if ( ! isset( $term_id ) ) {
				$term_id = $terms[0]->term_id;
			}

			$this->add_term_parents( $term_id, $taxonomy );
		}
	}

	/**
	 * Searches for term parents of hierarchical taxonomies.  This function is similar to the WordPress
	 * function get_category_parents() but handles any type of taxonomy.
	 *
	 * @param  int    $term_id  ID of the term to get the parents of.
	 * @param  string $taxonomy Name of the taxonomy for the given term.
	 * @return void
	 */
	function add_term_parents( $term_id, $taxonomy ) {

		// Set up some default arrays.
		$parents = array();

		// While there is a parent ID, add the parent term link to the $parents array.
		while ( $term_id ) {

			// Get the parent term.
			$term = get_term( $term_id, $taxonomy );

			if ( is_null( $term ) || is_wp_error( $term ) ) {
				break;
			}

			$parents[ $this->i ]['id']    = $term->term_id;
			$parents[ $this->i ]['query'] = 'term';
			$parents[ $this->i ]['link']  = trailingslashit( get_term_link( $term, $taxonomy ) );
			$parents[ $this->i ]['label'] = $term->name;
			$this->i++;

			// If there's no longer a post parent, break out of the loop.
			if ( (int) $term->parent === 0 ) {
				break;
			}

			// Change the post ID to the parent post to continue looping.
			$term_id = $term->parent;

		}

		// If we have parent terms, reverse the array to put them in the proper order for the trail.
		if ( ! empty( $parents ) ) {
			$this->items = array_merge( $this->items, array_reverse( $parents ) );
		}
	}

	/**
	 * Adds the items to the trail items array for terms archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_term_items() {

		$queried_object = get_queried_object();
		$post_types     = get_post_types( array(), 'objects' );

		foreach ( $post_types as $key => $post_type_object ) {

			if ( in_array( $queried_object->taxonomy, get_object_taxonomies( $key ), true ) ) {
				$post_type = $key;

				if ( $post_type_object->has_archive && get_aesthetix_options( 'breadcrumbs_' . $post_type . '_archive_display' ) ) {
					$this->add_post_type_archive_item( $post_type );
				}

				$this->add_term_parents( $queried_object->term_id, $queried_object->taxonomy );

				break;
			}
		}
	}

	/**
	 * Adds the items to the trail items array for user (author) archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_author_item() {

		if ( get_query_var( 'author', false ) && get_userdata( get_query_var( 'author' ) ) ) {
			$this->items[ $this->i ]['id']    = get_query_var( 'author' );
			$this->items[ $this->i ]['query'] = 'author';
			$this->items[ $this->i ]['link']  = trailingslashit( get_author_posts_url( get_query_var( 'author' ) ) );
			$this->items[ $this->i ]['label'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
			$this->i++;
		} else {
			return;
		}
	}

	/**
	 * Adds the items to the trail items array for minute + hour archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_minute_hour_item() {

		// Add the minute + hour item.
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_minute_hour'], get_the_time( esc_html_x( 'g:i a', 'minute and hour archives time format', 'oceanwp' ) ) );
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for minute archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_minute_item() {

		// Add the minute item.
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_minute'], get_the_time( esc_html_x( 'i', 'minute archives time format', 'oceanwp' ) ) );
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for hour archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_hour_item() {

		// Add the hour item.
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_hour'], get_the_time( esc_html_x( 'g a', 'hour archives time format', 'oceanwp' ) ) );
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for day archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_day_item() {

		$this->items[ $this->i ]['link']  = trailingslashit( get_year_link( get_the_time( 'Y' ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'oceanwp' ) ) );
		$this->i++;

		$this->items[ $this->i ]['link']  = trailingslashit( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'oceanwp' ) ) );
		$this->i++;

		$this->items[ $this->i ]['link']  = trailingslashit( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_day'],   get_the_time( esc_html_x( 'j', 'daily archives date format', 'oceanwp' ) ) );
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for week archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_week_item() {

		$this->items[ $this->i ]['link']  = trailingslashit( get_year_link( get_the_time( 'Y' ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'oceanwp' ) ) );
		$this->i++;

		$this->items[ $this->i ]['link']  = trailingslashit( add_query_arg( array( 'm' => get_the_time( 'Y' ), 'w' => get_the_time( 'W' ) ), home_url() ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_week'],  get_the_time( esc_html_x( 'W', 'weekly archives date format', 'oceanwp' ) ) );
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for month archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_month_item() {

		$this->items[ $this->i ]['link']  = trailingslashit( get_year_link( get_the_time( 'Y' ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'oceanwp' ) ) );
		$this->i++;

		$this->items[ $this->i ]['link']  = trailingslashit( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'oceanwp' ) ) );
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for year archives.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_year_item() {

		$this->items[ $this->i ]['link']  = trailingslashit( get_year_link( get_the_time( 'Y' ) ) );
		$this->items[ $this->i ]['label'] = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'oceanwp' ) ) );
		$this->i++;
	}

	/**
	 * Adds the items to the trail items array for archives that don't have a more specific method
	 * defined in this class.
	 *
	 * @access protected
	 * @return void
	 */
	protected function add_archive_default_item() {

		$this->items[ $this->i ]['label'] = $this->labels['archives'];
		$this->i++;
	}

	/**
	 * Adds the page/paged number to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_paged_items() {

		// If viewing a paged singular post.
		if ( is_singular() && 1 < get_query_var( 'page' ) ) {
			$this->items[ $this->i ]['label'] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'page' ) ) ) );
			$this->i++;
		}
		// If viewing a singular post with paged comments.
		elseif ( is_singular() && get_option( 'page_comments' ) && 1 < get_query_var( 'cpage' ) ) {
			$this->items[ $this->i ]['label'] = sprintf( $this->labels['paged_comments'], number_format_i18n( absint( get_query_var( 'cpage' ) ) ) );
			$this->i++;
		}
		// If viewing a paged archive-type page.
		elseif ( is_paged() ) {
			$this->items[ $this->i ]['label'] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'paged' ) ) ) );
			$this->i++;
		}
	}
}
