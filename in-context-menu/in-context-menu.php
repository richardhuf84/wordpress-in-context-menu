<?php
/*
 Plugin Name: In Context Menu
 Plugin URI: http://richardhuf.com.au
 Description: Show the parents / children of a post as a menu. It finds the top most page id and then prints all the children in a menu
 Version: 1.0
 Author: Richard Huf
 Author URI: http://richardhuf.com.au
 License: GPL2
 */

/**
 *
 * In context sidebar
 *
 * Function that gets the top most parent of a post, and then prints all
 * children as a menu. Can be used to print an in context sidebar
 *
 * @param type var $post variable from within the loop
 * @return return type string
 * @example usage in_context_menu($post);
 *
 */
function in_context_menu($post) {

  // If post has parents or children, print the menu
  if ($post->post_parent || get_pages('child_of='.$post->ID)) {

    if ($post->post_parent)	{
      $ancestors = get_post_ancestors($post->ID);
      $root = count($ancestors)-1;
      $parent = $ancestors[$root];
    } else {
      $parent = $post->ID;
    }

    ?>

     <div class="page-submenu">
       <nav class="page-submenu__nav" itemscope itemtype="http://schema.org/SiteNavigationElement">
         <ul class="page-submenu__list">

           <?php
           wp_list_pages( array(
               'title_li'    => '',
               'child_of'    => $parent,
               'sort_column' => 'menu_order',
           ) );

           ?>
         </ul>
       </nav>
     </div>
   <?php
  }
}
