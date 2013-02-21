<div class="users form">
<?php 
echo $this->Form->create('User', array(
    'class' => 'form-vertical',
    'inputDefaults' => array('div' => false))
);
?>
    <fieldset>
        <legend><?php echo __('Edit'); ?></legend>
        <?php echo $this->Form->input('old_password', array(
            'type' => 'password',
            'label' => 'Current password',
            'append' => '<i class="icon-lock"></i>',
            'required' => false,
            'placeholder' => 'unchanged',
        )); ?>
        <?php echo $this->Form->input('password', array(
            'type' => 'password',
            'label' => 'New password',
            'append' => '<i class="icon-lock"></i>',
            'required' => false,
            'placeholder' => 'unchanged',
        )); ?>
        <?php echo $this->Form->input('confirm_password', array(
            'type' => 'password',
            'label' => 'Repeat password',
            'append' => '<i class="icon-lock"></i>',
            'placeholder' => 'unchanged',
        )); ?>
        <?php echo $this->Form->input('email', array(
            'append' => '<i class="icon-envelope"></i>',
        )); ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>