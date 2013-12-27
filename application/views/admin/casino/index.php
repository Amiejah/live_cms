<section>
    <h2>Casino Manager</h2>
    <?php echo anchor('admin/casino/edit', 'Add Casino'); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Title</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php if( count( $widgets ) ) : foreach( $widgets as $widget): ?>
                <tr>
                    <td><?php echo anchor('admin/casino/edit/' . $widget->widget_id, $widget->widget_title);?></td>
                    <td><?php echo anchor('admin/casino/edit/' . $widget->widget_id, 'edit');?></td>
                    <td><?php echo anchor('admin/casino/delete/' . $widget->widget_id,'delete');?></td>
                </tr>
            <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">We couldn't find any Casino's</td>
                </tr>
            <?php endif; ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </tfoot>
    </table>
</section>