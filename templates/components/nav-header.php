<!-- Start Navigation wrapper -->
<div class="navwrap hide-on-mobile hide-on-tablet">
  <nav role="navigation" class="menu-header">
    <?php wp_nav_menu( array(
        'container'    => false,
        'theme_location' => 'primary',
        'menu_id'      => 'top-menu',
        'menu_class'     => 'standard-nav',
        'before'         => '',
        'after'          => '',
        'link_before'    => '',
        'link_after'     => '',
        'depth'          => 0
      )
    ); ?>
  </nav>
</div>