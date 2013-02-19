<h1>Add New Tank</h1>
<?php echo $this->Form->create('Tank', array('class' => 'form-vertical')); ?>
	<fieldset>

        <div class="controls controls-row">
            <?php echo $this->Form->input('name', array('label' => 'Name', 'placeholder' => 'name')); ?>
        </div>

        <div class="controls controls-row">
            
            <div class="input-append span1">
                <?php echo $this->Form->input('width', array('type' => 'text', 'label' => 'Width', 'placeholder' => '0.00', 'class' => 'span1')); ?>
                <span class="add-on">cm</span>
            </div>
            
            <div class="input-append span1">
                <?php echo $this->Form->input('depth', array('type' => 'text', 'label' => 'Depth', 'placeholder' => '0.00', 'class' => 'span1')); ?>
                <span class="add-on">cm</span>
            </div>
            
            <div class="input-append span1">
                <?php echo $this->Form->input('height', array('type' => 'text', 'label' => 'Height', 'placeholder' => '0.00', 'class' => 'span1')); ?>
                <span class="add-on">cm</span>
            </div>            
            
            <div class="input-append span1">
                <?php echo $this->Form->input('volume', array('type' => 'text', 'label' => 'Height', 'placeholder' => '0.00', 'class' => 'span1')); ?>
                <span class="add-on">L</span>
            </div>
            
        </div>
        
        <?php echo $this->Form->submit('Save', array('class' => 'btn btn-primary')); ?>

	</fieldset>
<?php echo $this->Form->end(); ?>
