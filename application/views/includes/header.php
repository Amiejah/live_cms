<!DOCTYPE html>
<html>
<head>
    <title><?php echo $output_metadata->meta_title . ' - ' . $meta_title?></title>
    <meta charset="UTF-8">
    <meta name="keywords" content="<?php echo $output_metadata->meta_keywords;?>"/>
    <meta name="description" content="<?php echo $output_metadata->meta_description;?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap -->
    <link href="<?php echo site_url('css/font-awesome.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo site_url('css/bootstrap.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo site_url('css/control.css'); ?>" rel="stylesheet"/>
</head>
<body>


<section class="container box-shadow" id="wrapper">
    <header>
        <nav class="top-nav">
            <ul>
                <li><a href="#">Online casino top 10</a></li>
                <li><a href="#">iDeal casino</a></li>
                <li><a href="#">Verantwoord spelen</a></li>
            </ul>
        </nav>
    </header>
    <header>
        <!-- Logo -->
        <a href="/" class="logo pull-left" title="<?php echo $site_name;?>">
            <img src="http://stickymatje.nl/images/logo.jpg" class="img-responsive"/>
        </a>

        <section class="pull-right">
            <ul class="social-icons pull-right">
                <li><a class="social-btn facebook" href=""><i class="fa fa-facebook"></i></a></li>
                <li><a class="social-btn twitter" href=""><i class="fa fa-twitter"></i></a></li>
                <li><a class="social-btn linkedin" href=""><i class="fa fa-linkedin"></i></a></li>
                <li><a class="social-btn pinterest" href=""><i class="fa fa-pinterest"></i></a></li>
            </ul>
            <div class="clearfix"></div>
            <a href="mailto:support@centrum.nl">support@centrum.nl</a>
            <span>+48 880 450 120</span>
        </section>

        <div class="clearfix"></div>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <section class="col-lg-12">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php echo get_menu( $menu ); ?>
                </div><!-- /.navbar-collapse -->

            </section>
        </nav>
    </header>