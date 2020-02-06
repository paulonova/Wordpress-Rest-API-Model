

<?php  
        //WordPress REST API

              $url = "http://www.pharma-industry.se/wp-json/wp/v2/posts?_embed";
              $url_cat = "http://www.pharma-industry.se/wp-json/wp/v2/posts?categories=5&per_page=9";

              $response = wp_remote_get($url_cat);

              $posts = json_decode( wp_remote_retrieve_body( $response ) );

              if ( !empty( $posts ) ) {

                  // For each post.
                  foreach ( $posts as $post ) {
                    $theJob = esc_html( $post->title->rendered );
                    $link = esc_url( $post->link );
                    $background = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'thumbnail');
                    // $image = esc_url( $post->_embedded->featuredmedia->media_details->sizes->thumbnail );
                    $image = esc_url( $post->featured_image_src);
                    $exerpt = $post->excerpt->rendered;                    
                    ?>

                    <div onclick="window.open('<?php echo $link; ?>')" class="col-sm-6 col-lg-4 animated fadeIn">
                      <div class="card card-position">
                      <div class="shadow-bottom"></div>
                        <img class="img-fluid card-img img-fix"  
                              style="min-height: 170px; background: url('<?php echo $image; ?>')">
                        
                        <div class="overlay"></div>
                        <div class="card-body new-job-body">
                          <h5 class="card-title new-job-title"><?php echo $theJob;?></h5>
                          <p></p>
                          <p class="card-text new-job-text"><?php echo wp_trim_words( $exerpt, 18, '...' );?></p>
                        </div>
                      
                      </div>                    
                    </div>                    
        <?php 
                       
                  }    
              }


              // Write this in functions.php in the wordpress site that you want to get the image! (Thumbnail)

              //add post thumbnails to RSS images
              function cwc_rss_post_thumbnail($content) {
                global $post;
                if(has_post_thumbnail($post->ID)) {
                    $content = '<p>' . get_the_post_thumbnail($post->ID) .
                    '</p>' . get_the_excerpt();
                }

                return $content;
              }
              add_filter('the_excerpt_rss', 'cwc_rss_post_thumbnail');
              add_filter('the_content_feed', 'cwc_rss_post_thumbnail');
              add_theme_support( 'post-thumbnails' );




              add_action( 'rest_api_init', 'add_thumbnail_to_JSON' );
              function add_thumbnail_to_JSON() {
              //Add featured image
              register_rest_field( 
                  'post', // Where to add the field (Here, blog posts. Could be an array)
                  'featured_image_src', // Name of new field (You can call this anything)
                  array(
                      'get_callback'    => 'get_image_src',
                      'update_callback' => null,
                      'schema'          => null,
                      )
                  );
              }

              function get_image_src( $object, $field_name, $request ) {
                $feat_img_array = wp_get_attachment_image_src(
                  $object['featured_media'], // Image attachment ID
                  'thumbnail',  // Size.  Ex. "thumbnail", "large", "full", etc..
                  true // Whether the image should be treated as an icon.
                );
                return $feat_img_array[0];
              }











        ?>


        
