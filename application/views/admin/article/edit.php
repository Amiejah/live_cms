<h3><?php echo empty( $article->id ) ? 'Add a new article' : 'Edit article ' . $article->title; ?></h3>
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
        <tbody>
            <tr>
                <td width="25%">Publication date</td>
                <td><?php echo form_input('pub_date', set_value('pub_date', $article->pub_date), 'class="datepicker"'); ?></td>
            </tr>
            <tr>
                <td width="25%">Title</td>
                <td><?php echo form_input('title', set_value('title', $article->title), 'class="form-control"'); ?></td>
            </tr>
            <tr>
                <td width="25%">Slug</td>
                <td><?php echo form_input('slug', set_value('email', $article->slug), 'class="form-control"'); ?></td>
            </tr>
            <tr>
                <td width="25%">Body</td>
                <td><?php echo form_textarea('body', set_value('email', $article->body), 'class="mce form-control"'); ?></td>
            </tr>
        </tbody>
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
                    echo form_checkbox('use_custom_meta', 'true', set_value('use_custom_meta', $article->use_custom_meta) );?>
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