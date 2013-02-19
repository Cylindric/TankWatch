<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Register'); ?></legend>
        <?php echo $this->Form->input('username'); ?>
        <?php echo $this->Form->input('password'); ?>
        <?php echo $this->Form->input('email'); ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>