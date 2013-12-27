<?php $this->load->view( 'admin/components/page_head' );
    echo validation_errors();
    echo form_open('forgot_pass/doforget');
?>
    <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
        <h4 class="modal-title">Forgot Password</h4>
        <p>Reset your password</p>
    </div>
    <div class="modal-body">
        <section class="">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td valign="middle">
                            <p>Please enter your username or email address. You will receive a link to create a new password via email.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo form_input('email', '', 'class="form-control"');?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo form_submit('forgot_pass', 'Get new password', 'class="btn btn-primary"')?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
<?php
    echo form_close();
    $this->load->view( 'admin/components/page_footer' );
?>