<?php
if ( ! function_exists( 'orcp_dashboard_widget_blog' ) ) :

     /**
      * Displays Blog Articles from a chosen RSS feed
      **/
     function orcp_dashboard_widget_blog() {

          global $wp_meta_boxes;

          // add a custom dashboard widget
          wp_add_dashboard_widget( 'dashboard_custom_feed', __('From the XLD Studios Blog', 'orcp'), 'orcp_dashboard_widget_blog_output' ); //add new RSS feed output
     }

     add_action( 'wp_dashboard_setup', 'orcp_dashboard_widget_blog' );

     function orcp_dashboard_widget_blog_output() {

          echo '<div class="rss-widget">';

               wp_widget_rss_output(array(
                    'url'          => __( 'http://www.bernskioldmedia.com/en/feed', 'orcp' ),
                    'title'        => __('The Latest from Bernskiold Media', 'orcp'),
                    'items'        => 2,
                    'show_summary' => 1,
                    'show_author'  => 0,
                    'show_date'    => 1,
               ));

          echo "</div>";
     }

endif;