<!-- Mobile Menu -->
<nav id="mobile-menu" class="mobilemenu" role="navigation">
  <a class="m-titlelink" href="<?php echo home_url(); ?>">
    <?php echo bloginfo('name'); ?>
  </a>
  <a href="#" class="mob-menu-close">&#10006;</a>
  <?php wp_nav_menu( array(
      'container'    => false,
      'theme_location'  => 'mobile',
      'before'         => '',
      'after'          => '',
      'link_before'    => '',
      'link_after'     => '',
      'depth'          => 0
    )
  ); ?>
</nav>