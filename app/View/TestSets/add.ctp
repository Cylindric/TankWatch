<?php
asort($tests);
?>
<h1>Add Test Set</h1>
<?php echo $this->Form->create('TestSet', array('class' => 'form-vertical')); ?>
	<fieldset>

		<?php echo $this->Form->input('name', array(
            'type' => 'text',
        )); ?>

        <?php echo $this->Form->input('Test', array(
            'label' => 'Tests',
            'multiple' => 'checkbox', 
            'options' => $tests
        )); ?>

        <?php echo $this->Form->submit('Add', array(
            'class' => 'btn btn-primary',
        )); ?>

	</fieldset>
<?php echo $this->Form->end(); ?>
