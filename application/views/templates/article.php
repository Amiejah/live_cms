<div class="col-lg-9">
    <article>
        <h2><?php echo e($article->title)?></h2>
        <p class="pubdate"><?php echo e($article->pub_date);?></p>
        <div class="">
            <?php echo $article->body;?>
        </div>
    </article>
</div>

<div class="sidebar widgets-sidebar col-lg-3">
    <?php $this->load->view('sidebar');?>
</div>