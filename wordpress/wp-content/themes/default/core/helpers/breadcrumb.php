<?php
/**
 * Breadcrumbs
 */
function fv_breadcrumbs( $homepage = '' ) {
  global $wp_query, $post, $author;

  ! empty( $homepage ) || $homepage = 'Página inicial';

	// Default html.
	$current_before = '<li class="active">';
  $current_after  = '</li>';

	if ( ! is_home() && ! is_front_page() || is_paged() ) {

		// First level.
		echo '<ul id="breadcrumbs" class="breadcrumb text-center font-bold uppercase">';
    echo '<li class="text-white"><a href="' . home_url() . '" rel="nofollow">' . $homepage . '</a></li>';


		/**
     * Single posts
     */
		if ( is_single() && ! is_attachment() ) {
			// Checks if is a custom post type.
			if ( 'post' != $post->post_type ) {
				$post_type = get_post_type_object( $post->post_type );
				if ( 'startups' != $post->post_type ) {
					echo '<li class="text-white"><a href="' . get_post_type_archive_link( $post_type->name ) . '">' . $post_type->label . '</a></li> ';
				}
        // Gets post type taxonomies.
        $taxonomies = get_object_taxonomies( $post_type->name );
			} else {
				$category = get_the_category();
				$category = $category[0];
				// Gets parent post terms.
				$parent_cat = get_term( $category->parent, 'category' );
				// Gets top term
				$cat_tree = get_category_parents($category, FALSE, ':');
				$top_cat = explode(':', $cat_tree);
				$top_cat = $top_cat[0];
				if ( $category->parent ) {
					if ( $parent_cat->parent ) {
						echo '<li class="text-white"><a href="' . get_term_link( $top_cat, 'category' ) . '">' . $top_cat . '</a></li>';
					}
					echo '<li class="text-white"><a href="' . get_term_link( $parent_cat ) . '">' . $parent_cat->name. '</a></li>';
				}
				echo '<li class="text-white"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
			}
      echo $current_before . get_the_title() . $current_after;


		/**
     * Single attachments
     */
		} elseif ( is_attachment() ) {
			$parent   = get_post( $post->post_parent );
			$category = get_the_category( $parent->ID );
			$category = $category[0];
			echo '<li class="text-white"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
			echo '<li class="text-white"><a href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a></li>';
			echo $current_before . get_the_title() . $current_after;
		// Page without parents.
		} elseif ( is_page() && ! $post->post_parent ) {
			echo $current_before . get_the_title() . $current_after;
		// Page with parents.
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page = get_page( $parent_id );
				$breadcrumbs[] = '<li class="text-white"><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			foreach ( $breadcrumbs as $crumb ) {
				echo $crumb . ' ';
			}
			echo $current_before . get_the_title() . $current_after;


    /**
     * Category archive
     */
		} elseif ( is_category() ) {
			$category_object  = $wp_query->get_queried_object();
			$category_id      = $category_object->term_id;
			$current_category = get_category( $category_id );
			$parent_category  = get_category( $current_category->parent );
			// Displays parent category.
			if ( 0 != $current_category->parent ) {
				$parents = get_category_parents( $parent_category, TRUE, false );
				$parents = str_replace( '<a', '<li class="text-white"><a', $parents );
				$parents = str_replace( '</a>', '</a></li>', $parents );
				echo $parents;
			}
			printf( '%sCategoria: %s%s', $current_before, single_cat_title( '', false ), $current_after );


    /**
     * Tags archive
     */
		} elseif ( is_tag() ) {
			printf( '%sTag: %s%s', $current_before, single_tag_title( '', false ), $current_after );


    /**
     * CPT archive
     */
		} elseif ( is_post_type_archive() ) {
			echo $current_before . post_type_archive_title( '', false ) . $current_after;


    /**
     * Search archive
     */
		} elseif ( is_search() ) {
			printf( '%sBusca por: &quot;%s&quot;%s', $current_before, get_search_query(), $current_after );


    /**
     * Author archive
     */
		} elseif ( is_author() ) {
			$userdata = get_userdata( $author );
			echo $current_before . 'Postado por' . ' ' . $userdata->display_name . $current_after;


    /**
     * Daily archive
     */
		} elseif ( is_day() ) {
			echo '<li class="text-white"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
			echo '<li class="text-white"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li>';
			echo $current_before . get_the_time( 'd' ) . $current_after;


    /**
     * Monthly archive
     */
		} elseif ( is_month() ) {
			echo '<li class="text-white"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
			echo $current_before . get_the_time( 'F' ) . $current_after;


    /**
     * Yearly archive
     */
		} elseif ( is_year() ) {
			echo $current_before . get_the_time( 'Y' ) . $current_after;


    /**
     * Archive fallback for custom taxonomies
     */
		} elseif ( is_archive() ) {
			$current_object = $wp_query->get_queried_object();
			$taxonomy       = get_taxonomy( $current_object->taxonomy );
			$term_name      = $current_object->name;
			// Displays the post type that the taxonomy belongs.
			if ( ! empty( $taxonomy->object_type ) ) {
        $_post_type = array_shift( $taxonomy->object_type );
        $post_type = get_post_type_object( $_post_type );
        echo '<li class="text-white"><a href="' . get_post_type_archive_link( $post_type->name ) . '">' . $post_type->label . '</a></li> ';
			}
			// Displays parent term.
			if ( 0 != $current_object->parent ) {
				$parent_term = get_term( $current_object->parent, $current_object->taxonomy );
				echo '<li class="text-white"><a href="' . get_term_link( $parent_term ) . '">' . $parent_term->name . '</a></li>';
			}
			echo $current_before . $taxonomy->label . ': ' . $term_name . $current_after;


    /**
     * 404 page
     */
		} elseif ( is_404() ) {
			echo $current_before . '404 Error' . $current_after;
		}


    /**
     * Get pagination
     */
		if ( get_query_var( 'paged' ) ) {
			echo ' <span class="text-white">(' . sprintf( 'Página %s', get_query_var( 'paged' ) ) . ')</span>';
		}
		echo '</ul>';
	}
}
