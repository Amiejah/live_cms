<?php $this->load->view( 'admin/components/page_head' );?>
    <style>
        body {background:#555;}
    </style>

    <div class="modal show">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php $this->load->view($subview);?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $this->load->view( 'admin/components/page_footer' );?>
