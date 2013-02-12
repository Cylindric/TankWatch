<h1>Add Result</h1>
<?php echo $this->Form->create('Result', array('class' => 'form-vertical')); ?>
	<fieldset>

        <?php echo $this->Form->input('test_set_id', array(
            'type' => 'select',
            'options' => $testsets,
        )); ?>

		<?php echo $this->Form->input('time', array(
			'class' => 'input-small',
            'placeholder' => 'dd/mm/yyyy',
            'type' => 'datetime',
        )); ?>

		<?php echo $this->Form->input('test_id', array(
            'type' => 'select',
            'options' => $tests,
        )); ?>

        <?php echo $this->Form->input('value', array(
            'type' => 'text',
            'placeholder' => '0.00',
            'class' => 'input-mini'
        )); ?>

        <?php echo $this->Form->submit('Add', array(
            'class' => 'btn btn-primary',
        )); ?>

	</fieldset>
<?php echo $this->Form->end(); ?>
