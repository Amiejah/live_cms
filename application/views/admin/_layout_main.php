<?php $this->load->view( 'admin/components/page_head' );?>

<nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
<!--        <a class="navbar-brand" href="--><?php //echo site_url( 'admin/dashboard' );?><!--">Menu</a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url( 'admin/dashboard' );?>">Home</a></li>
            <li class="dropdown">
                <?php echo anchor( 'admin/page', 'Pages', 'class="dropdown-toggle" data-toggle="dropdown"');?>
                <ul class="dropdown-menu">
                    <li><?php echo anchor( 'admin/page', 'All pages' ); ?></li>
                    <li><?php echo anchor( 'admin/page/order', 'Order Pages' );?></li>
                </ul>
            </li>
            <li><?php echo anchor( 'admin/article', 'News articles' );?></li>
            <li><?php echo anchor( 'admin/casino', 'Casinos');?></li>
            <li><?php echo anchor( 'admin/user', 'Users' );?></li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <section>
               <?php
                if ( !empty( $subview)) {
                    echo $this->load->view( $subview );
                } else {
                    echo '<h1>Dashboard</h1>';
                }
               ?>
            </section>
        </div>
        <div class="col-lg-3">
            <section>
                <?php echo anchor('admin/user/logout', 'logout');?>
            </section>
        </div>
    </div>
</div>

<?php $this->load->view( 'admin/components/page_footer' );?>