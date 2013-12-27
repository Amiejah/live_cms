<?php $this->load->view( 'includes/header' );?>
    <div class="col-lg-12">
        <div class="row">
            <?php echo $this->load->view( 'templates/' . $subview );?>
        </div>
     </div>
<?php $this->load->view( 'includes/footer' );?>