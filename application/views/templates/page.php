<div class="col-lg-9">
    <article>
        <h2><?php echo e($page->title);?></h2>
        <?php echo $page->body;?>
    </article>
</div>
<div class="sidebar widgets-sidebar col-lg-3">
    <?php echo $this->load->view('sidebar');?>
</div>