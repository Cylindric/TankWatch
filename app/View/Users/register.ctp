<div class="users form">
Create an account, or <?php echo $this->Html->link('Login with Google', '/auth/google', array('class' => 'zocial google')); ?>

    <?php 
echo $this->Form->create('User', array(
    'class' => 'form-vertical',
    'inputDefaults' => array('div' => false))
);
?>
    <fieldset>
        <legend><?php echo __('Register'); ?></legend>
        <?php echo $this->Form->input('username', array(
            'append' => '<i class="icon-user"></i>',
        )); ?>
        <?php echo $this->Form->input('email', array(
            'append' => '<i class="icon-envelope"></i>',
        )); ?>
        <?php echo $this->Form->input('password', array(
            'type' => 'password',
            'label' => 'New password',
            'append' => '<i class="icon-lock"></i>',
        )); ?>
        <?php echo $this->Form->input('confirm_password', array(
            'type' => 'password',
            'label' => 'Repeat password',
            'append' => '<i class="icon-lock"></i>',
            'required' => true,
        )); ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>