<h1>Add New Tank</h1>
<?php echo $this->Form->create('Tank', array('class' => 'form-vertical')); ?>
<fieldset>

    <?php
    echo $this->Form->input('name', array(
        'label' => 'Name',
        'type' => 'text',
        'class' => 'span2',
        'placeholder' => 'tank name',
        'helpInline' => 'A name for this tank.',
    ));
    ?>

    <?php
    echo $this->Form->input('width', array(
        'label' => 'Width',
        'type' => 'text',
        'class' => 'span1',
        'append' => 'cm',
        'placeholder' => '0.00',
        'helpInline' => 'The width across the front of the tank.',
    ));
    ?>

    <?php
    echo $this->Form->input('depth', array(
        'label' => 'Depth',
        'type' => 'text',
        'class' => 'span1',
        'append' => 'cm',
        'placeholder' => '0.00',
        'helpInline' => 'The front-to-back depth of the tank.',
    ));
    ?>

    <?php
    echo $this->Form->input('height', array(
        'label' => 'Height',
        'type' => 'text',
        'class' => 'span1',
        'append' => 'cm',
        'placeholder' => '0.00',
        'helpInline' => 'The height of the tank.',
    ));
    ?>

    <?php
    echo $this->Form->input('volume', array(
        'label' => 'Volume',
        'type' => 'text',
        'class' => 'span1',
        'append' => 'L',
        'placeholder' => '0.00',
        'helpBlock' => 'Enter the volume of water in this tank.',
    ));
    ?>

    <?php
    echo $this->Form->submit('Add', array(
        'class' => 'btn btn-primary',
    ));
    ?>

</fieldset>
<?php echo $this->Form->end(); ?>
