<section>
    <h2>Casino Manager - <?php echo empty( $widget->id ) ? 'Add a new casino' : 'Edit casino' . $widget->title; ?></h2>
    <?php
        echo validation_errors();
        echo form_open_multipart();
//        echo form_open_multipart();


    ?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <td colspan="2">
                <?php echo form_submit('submit','save', 'class="btn btn-primary"')?>
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width="25%">Title</td>
            <td><?php echo form_input('widget_title', set_value('widget_title', $widget->widget_title), 'class="form-control"');?></td>
        </tr>
        <tr>
            <td width="25%">Slug</td>
            <td><?php echo form_input('widget_slug', set_value('widget_slug', $widget->widget_slug), 'class="form-control"')?></td>
        </tr>
        <tr>
            <td width="25%">Description</td>
            <td><?php echo form_textarea('widget_description', set_value('widget_description', $widget->widget_description), 'class="mce" style="height:450px"');?></td>
        </tr>
        <tr>
            <td width="25%">Logo</td>
            <td>
                <label>
                    <?php echo form_upload('widget_image_upload', '', 'style="display:inline-block;"');?>
                    <?php echo (!empty($widget->widget_image_upload) ? $widget->widget_image_upload : '');?>
                </label>
            </td>
        </tr>
        <tr>
            <td width="25%">Status</td>
            <td><?php echo form_dropdown('widget_status', array(1 => 'Active', 2 => 'Inactive'), $this->input->post( 'widget_status' ) ? $this->input->post( 'widget_status') : $widget->widget_status, 'class="form-control"');?></td>
        </tr>
        <tr>
            <td width="25%">Ratings</td>
            <td>
                <?php echo form_dropdown('widget_ratings', array( 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'), $this->input->post('widget_ratings') ? $this->input->post('widget_ratings') : $widget->widget_ratings, 'class="form-control"');?>
            </td>
        </tr>
        <tr>
            <td width="25%">Welkomstbonus</td>
            <td>
                <?php echo form_input('widget_bonus', set_value('widget_bonus', $widget->widget_bonus), 'class="form-control"');?>
            </td>
        </tr>
        <tr>
            <td width="25%">External URL</td>
            <td>
                <?php echo form_input('widget_external_url', set_value('widget_external_url', $widget->widget_external_url), 'class="form-control"');?>
            </td>
        </tr>
        <tr>
            <td width="25%">Order</td>
            <td><?php echo form_input('widget_order',set_value('widget_order', $widget->widget_order), 'class="form-control"');?></td>
        </tr>
        </tbody>
        <tfoot>
        <td colspan="2">
            <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"');?>
        </td>
        </tfoot>
    </table>

    <h3>Meta data <em>(If not set, post data will be used )</em></h3>
    <!-- @todo GLOBAL SEO FUNCTIONS -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <td colspan="2">
                <p>Add your meta data here.</p>
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Use Your own meta data</td>
            <td>

                <?php
                echo form_checkbox('use_custom_meta', 'true', set_value('use_custom_meta', $widget->use_custom_meta) );?>
            </td>
        </tr>
        <tr>
            <td width="25%">Title</td>
            <td>
                <?php echo form_input('meta_title', set_value('meta_title', $meta->meta_title), 'class="form-control"'); ?>
            </td>
        </tr>
        <tr>
            <td width="25%">Description</td>
            <td>
                <?php echo form_textarea('meta_description', set_value('meta_description', $meta->meta_description), 'class="form-control" style="height:75px;"');?>
            </td>
        </tr>
        <tr>
            <td width="25%">Keywords</td>
            <td>
                <?php echo form_input('meta_keywords', set_value('meta_keywords', $meta->meta_keywords), 'class="form-control"'); ?>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
        </tr>
        </tfoot>
    </table>
    <?php
    echo form_close();
    ?>
</section>