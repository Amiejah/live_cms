<div class="modal-header">
    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
    <h4 class="modal-title">Login</h4>
    <p>Please log in using your credentials</p>
</div>
<div class="modal-body">
    <?php
        echo validation_errors();
        echo form_open();
    ?>
        <table>
            <tr>
                <td>Email:</td>
                <td><?php echo form_input('email'); ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?php echo form_password('password'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?></td>
            </tr>
        </table>
    <?php echo form_close(); ?>
</div>