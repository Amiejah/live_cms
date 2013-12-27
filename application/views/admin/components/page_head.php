<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap -->
    <link href="<?php echo site_url('css/bootstrap.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo site_url('css/admin/datepicker.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo site_url('css/admin/control.css'); ?>" rel="stylesheet"/>

    <script src="<?php echo site_url( 'js/jquery.js' );?>"></script>
    <script src="<?php echo site_url( 'js/bootstrap.min.js' ); ?>"></script>
    <script src="<?php echo site_url( 'js/admin/jquery-ui.js' );?>"></script>
    <script src="<?php echo site_url( 'js/admin/bootstrap-datepicker.js' ); ?>"></script>
    <script src="<?php echo site_url( 'js/admin/tinymce/tinymce.min.js' );?>"></script>
    <?php if( isset( $sortable ) && $sortable === TRUE ): ?>
    <script src="<?php echo site_url( 'js/admin/nestedSortable.js' );?>"></script>
    <?php endif;?>
    <script src="<?php echo site_url( 'js/admin/control.js' );?>"></script>
</head>
<body>