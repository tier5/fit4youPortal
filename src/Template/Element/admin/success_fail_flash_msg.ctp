<?php
if($this->Session->check('Message.op_error'))
{
    ?>
    <div class="alert alert-error">
        <a class="close" data-dismiss="alert" href="#">×</a>
        <h4 class="alert-heading">Sorry action not completed</h4>
        <?php echo $this->Session->flash('op_error');?>
    </div>
    <?php
}
?>
<?php
if($this->Session->check('Message.op_success'))
{
    ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <strong><?php echo $this->Session->flash('op_success');?></strong>
        </div>       
    <?php
}
?>