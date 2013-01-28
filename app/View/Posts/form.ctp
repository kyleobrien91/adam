<?php 
	echo $this->Form->create('Post',array('url'=>array('action'=>'form')));?>
    <fieldset>
        <legend><?php __('Post Details');?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('body');
        echo $this->Form->input('Tag.Tag');
        ?>
    </fieldset>
<?php echo $this->Form->end('Submit');?>