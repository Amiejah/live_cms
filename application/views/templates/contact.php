<div class="col-lg-9">
    <article>
        <h2><?php echo e($page->title);?></h2>
        <?php echo $page->body;?>
    </article>

    <section class="form">
        <?php
            echo validation_errors();
            echo form_open('','class="form-horizontal"');


            if( $this->uri->segment(2,0) == true && $this->uri->segment(2,0) == 'success'){
                echo '<div class="alert alert-success">Thank you for your email!</div>';
            }

        ?>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email address</label>
            <div class="col-sm-10">
                <?php echo form_input('userMail', '', 'class="form-control" placeholder="Enter your email" id="inputEmail"');?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <?php echo form_input('userName', '', 'class="form-control" placeholder="Enter your name" id="inputName"');?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="questionTextarea">Question</label>
            <div class="col-sm-10">
<!--                <textarea placeholder="Ask us anything" name="question" class="form-control"></textarea>-->
                <?php echo form_textarea('userQuestion', '', 'class="form-control" placeholder="Ask me anything" id="questionTextarea"');?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </div>
        <?php
            echo form_hidden('contactme', 'true');
            echo form_close();
        ?>
    </section>
</div>
<div class="sidebar widgets-sidebar col-lg-3">
    <?php echo $this->load->view('sidebar');?>
</div>

