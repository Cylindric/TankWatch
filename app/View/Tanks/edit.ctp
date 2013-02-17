<h1>Edit Tank</h1>
<?php echo $this->Form->create('Tank', array('class' => 'form-vertical')); ?>
	<fieldset>
        <legend><?php echo $this->data['Tank']['name']; ?></legend>
        
        <div class="controls controls-row">
            <label for="name" class="span1">Name</label>
        </div>
        <div class="controls controls-row">
            <input name="data[Tank][name]" type="text" class="span3" id="name" placeholder="enter a name" value="<?php echo $this->data['Tank']['name']; ?>" />
        </div>

        <div class="controls controls-row">
            <label for="width" class="span1">Width</label>
            <label for="depth" class="span1">Depth</label>
            <label for="height" class="span1">Height</label>
        </div>
        <div class="controls controls-row">
            <div class="input-append span1">
                <input name="data[Tank][width]" type="text" class="span1" id="width" placeholder="0.00" value="<?php echo $this->data['Tank']['width']; ?>" />
                <span class="add-on">cm</span>
            </div>
            <div class="input-append span1">
                <input name="data[Tank][depth]" type="text" class="span1" id="depth" placeholder="0.00" value="<?php echo $this->data['Tank']['depth']; ?>" />
                <span class="add-on">cm</span>
            </div>
            <div class="input-append span1">
                <input name="data[Tank][height]" type="text" class="span1" id="height" placeholder="0.00" value="<?php echo $this->data['Tank']['height']; ?>" />
                <span class="add-on">cm</span>
            </div>
        </div>
        
        <?php echo $this->Form->submit('Save', array(
            'class' => 'btn btn-primary',
        )); ?>

	</fieldset>
<?php echo $this->Form->end(); ?>
