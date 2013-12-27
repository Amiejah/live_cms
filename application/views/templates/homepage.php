<div class="col-lg-9">
    <div class="row">
        <div class="col-lg-9">
            <?php if( isset( $articles ) ) echo get_excerpt( $articles[0] ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <?php if( isset( $articles ) ) echo get_excerpt( $articles[1] ); ?>
        </div>
        <div class="col-lg-4">
            <?php if( isset( $articles ) ) echo get_excerpt( $articles[2], 30 ); ?>
        </div>
    </div>
</div>
<div class="sidebar widgets-sidebar col-lg-3">
    <?php
        echo $this->load->view('sidebar');
    ?>
</div>