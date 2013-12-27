<div class="col-lg-9">
    <article>
        <h2><?php echo e($widget_content->widget_title)?></h2>
        <div class="">
            <?php echo $widget_content->widget_description;?>
        </div>
    </article>
</div>

<div class="sidebar widgets-sidebar col-lg-3">
    <?php $this->load->view('sidebar');?>
</div>