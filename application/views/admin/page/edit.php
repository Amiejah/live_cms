<h3><?php echo empty( $page->id ) ? 'Add a new page' : 'Edit page ' . $page->title; ?></h3>
    <?php
        echo validation_errors();
        echo form_open();
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td colspan="2"><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
            </tr>
        </thead>
        <tr>
            <td width="25%">Parent</td>
            <td>
                <?php
                    echo form_dropdown('parent_id', $pages_no_parent, $this->input->post( 'parent_id' ) ? $this->input->post( 'parent_id') : $page->parent_id, 'class="form-control"');
                ?>
            </td>
        </tr>
        <tr>
            <td width="25%">Template</td>
            <td>
                <?php
                    echo form_dropdown('template', array( 'homepage' => 'Homepage', 'page' => 'Page', 'contact' => 'Contact'), $this->input->post( 'template' ) ? $this->input->post( 'template') : $page->template, 'class="form-control"');
                ?>
            </td>
        </tr>
        <tr>
            <td width="25%">Page type <em>(default pages will be added to the menu)</em></td>
            <td>
                <?php
                    echo form_dropdown('page_type', array('page' => 'Default Menu Pages', 'custom' => 'Lose pages (Not used as menu item)'), $this->input->post('page') ? $this->input->post('page') : $page->page_type, 'class="form-control"');
                ?>
            </td>
        </tr>
        <tr>
            <td width="25%">Title</td>
            <td><?php echo form_input('title', set_value('title', $page->title), 'class="form-control"'); ?></td>
        </tr>
        <tr>
            <td width="25%">Slug/URL</td>
            <td><?php echo form_input('slug', set_value('slug', $page->slug), 'class="form-control"'); ?></td>
        </tr>
        <tr>
            <td width="25%">Body</td>
            <td><?php echo form_textarea('body', set_value('body', $page->body), 'class="mce form-control"'); ?></td>
        </tr>
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
                    echo form_checkbox('use_custom_meta', 'true', set_value('use_custom_meta', $page->use_custom_meta) );?>
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
    <?php echo form_close(); ?>