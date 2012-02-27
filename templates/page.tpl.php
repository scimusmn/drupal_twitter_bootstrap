<?php

/**
 * @file
 * dtb's theme implementation to display a single Drupal page.
 */
?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <?php if ($site_name): ?><a class="brand" href="#"><?php print $site_name; ?></a><?php endif; ?>
      <div class="nav-collapse">
        <ul class="nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
<div class="container">
  <!-- Pre-content site header -->
  <div class="row">
    <!-- Define this -->
    <!-- Drupal header classes-->
    <div id="header" class="<?php print $secondary_menu ? 'with-secondary-menu': 'without-secondary-menu'; ?>"><div class="section clearfix">
      <!-- Logo -->
      <div class="span5">
        <?php if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" />
          </a>
        <?php endif; ?>
      </div>
      <!-- Masthead and navigation -->
      <div class="span11">
        <!-- Navigation row -->
        <div class="row">
          <div class="span7 offset4">
            <?php if ($main_menu): ?>
              <div id="main-menu" class="navigation">
                <?php print theme('links__system_main_menu', array(
                  'links' => $main_menu,
                  'attributes' => array(
                    'id' => 'main-menu-links',
                    'class' => array('links', 'clearfix'),
                  ),
                  'heading' => array(
                    'text' => t('Main menu'),
                    'level' => 'h2',
                    'class' => array('element-invisible'),
                  ),
                ));
                ?>
              </div> <!-- /#main-menu -->
            <?php endif; ?>
          </div> <!-- /.span7 offset4 -->
        </div> <!-- /.row -->

        <!-- Masthead row -->
        <div class="row">
          <div class="span11">
            <?php if ($site_name || $site_slogan): ?>
              <div class="row">
                <div class="span5 offset6">
                  <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) { print ' class="element-invisible"'; } ?>>
                    <?php if ($site_name): ?>
                      <?php if ($title): ?>
                        <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
                          <strong>
                            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                          </strong>
                        </div>
                      <?php else: /* Use h1 when the content title is empty */ ?>
                        <h1 id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
                          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                        </h1>
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($site_slogan): ?>
                      <div id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>>
                        <?php print $site_slogan; ?>
                      </div>
                    <?php endif; ?>
                  </div> <!-- /#name-and-slogan -->
                </div> <!-- /.span5 offset6 -->
              </div> <!-- /.row -->
            <?php endif; ?>
          </div>
        </div>
      </div> <!-- /Masthead and navigation -->

      <!-- ?? -->
      <?php print render($page['header']); ?>
      <!-- ?? -->

    </div></div> <!-- /.section, /#header -->
  </div> <!-- /.row, /Pre-content site header -->

  <!-- Website content -->
  <div class="content-container">

    <?php if ($messages): ?>
      <div id="messages"><div class="section clearfix">
        <?php print $messages; ?>
      </div></div> <!-- /.section, /#messages -->
    <?php endif; ?>

    <div id="main-wrapper" class="clearfix"><div id="main" class="clearfix">
      <?php if ($breadcrumb): ?>
        <div class="row">
          <div class="span16">
              <!--Rewrite the breadcrumb template code to make the links ULs-->
              <div id="breadcrumb"><?php print $breadcrumb; ?></div>
          </div>
        </div>
      <?php endif; ?>

      <?php
      // Define grid spans
      // This should probably move to template.php
      if ($page['sidebar_first'] && $page['sidebar_second']) {
        $sidebar_first_span = '4';
        $sidebar_second_span = '4';
        $content_span = '8';
      }
      elseif (!$page['sidebar_first'] && $page['sidebar_second']) {
        $sidebar_second_span = '5';
        $content_span = '11';
      }
      elseif ($page['sidebar_first'] && !$page['sidebar_second']) {
        $sidebar_first_span = '5';
        $content_span = '11';
      }
      elseif (!$page['sidebar_first'] && !$page['sidebar_second']) {
        $content_span = '16';
      }
      ?>

      <div class="row">
        <?php if ($page['sidebar_first']): ?>
          <!-- First sidebar -->
          <div class="span<?php print $sidebar_first_span; ?>">
            <div id="sidebar-first" class="column sidebar"><div class="section">
              <?php print render($page['sidebar_first']); ?>
            </div></div> <!-- /.section, /#sidebar-first -->
          </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="span<?php print $content_span; ?>">
          <div id="content" class="column"><div class="section">
            <a id="main-content"></a>

            <!-- Page title -->
            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
              <h1 class="title" id="page-title">
                <?php print $title; ?>
              </h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>

            <?php
            // We have to check for the primary element in the tabs
            // array. Even when there are no tabs the $tabs array will
            // be populated
            if ($tabs['#primary']):
            ?>
              <div class="tabs">
                <?php print render($tabs); ?>
              </div>
            <?php endif; ?>

            <!-- Page content -->
            <?php print render($page['help']); ?>

            <?php if ($action_links): ?>
              <ul class="action-links">
                <?php print render($action_links); ?>
              </ul>
            <?php endif; ?>
            <?php print render($page['content']); ?>

            <!-- Feed icons -->
            <?php print $feed_icons; ?>

          </div></div> <!-- /.section, /#content -->

        </div>

        <?php if ($page['sidebar_second']): ?>
          <!-- Second sidebar -->
          <div class="span<?php print $sidebar_second_span; ?>">
            <div id="sidebar-second" class="column sidebar"><div class="section">
              <?php print render($page['sidebar_second']); ?>
            </div></div> <!-- /.section, /#sidebar-second -->
          </div>
        <?php endif; ?>

      </div> <!-- /.row -->

    </div></div> <!-- /#main, /#main-wrapper -->

    <!-- Footer -->
    <div id="footer-wrapper"><div class="section">

      <?php if ($page['footer']): ?>
        <div id="footer" class="clearfix">
          <?php print render($page['footer']); ?>
        </div> <!-- /#footer -->
      <?php endif; ?>

    </div></div> <!-- /.section, /#footer-wrapper -->

  </div> <!-- /.content-container -->
</div> <!-- /.container -->
