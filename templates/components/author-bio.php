<!-- Author Page  -->
<div class="grid-parent">

    <div class="author-info">
      <figure class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 360 ); ?>
      </figure><!-- .author-avatar -->
      <div class="author-details">
        <h2><?php printf( __( 'About %s', 'nona' ), get_the_author() ); ?></h2>
        <p>
          <?php the_author_meta( 'description' ); ?>
        </p>

        <?php
          $um = get_user_meta(get_the_author_meta('ID'));
          $contacts = array(
            'twitter'      => $um['twitter'][0],
            'instagram'    => $um['instagram'][0],
            'linkedin'     => $um['linkedin'][0],
            'googleplus'   => $um['googleplus'][0],
            // 'facebook'   => $um['facebook'][0],
            // 'pinterest'    => $um['pinterest'][0],
            // 'tumblr'        => $um['tumblr'][0],
            // 'youtube'     => $um['youtube'][0],
            // 'vimeo'       => $um['vimeo'][0],
            // 'flickr'        => $um['flickr'][0],
            
            'behance'      => $um['behance'][0]
          ); ?>
         <ul class="social-links cf">
        <?php foreach ($contacts as $method => $contact) : ?>
          
          <?php if ($contact) { ?>
              <li><a class="<?php echo $method; ?>-author author-social" href="https://twitter.com/<?php echo $contact; ?>">
                  <i class="fa fa-<?php echo $method; ?>"></i><?php echo $method; ?></a></li>
          <?php } ?>

        <?php endforeach; ?>
          </ul>

      </div><!-- .author-details -->
    </div><!-- .author-info -->
</div>
