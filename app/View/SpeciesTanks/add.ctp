<h1>Add Species to Tank</h1>
<?php
echo $this->Form->create('SpeciesTank', array(
    'class' => 'form-vertical',
    'inputDefaults' => array('div' => false))
);
?>
<fieldset>
    <?php echo $this->Form->input('tank_id', array('type' => 'hidden')); ?>
    <?php
    echo $this->Form->input('species_id', array(
        'type' => 'text',
        'placeholder' => 'species',
    ));
    ?>
    <?php
    echo $this->Form->input('quantity', array(
        'type' => 'number',
        'class' => 'input-mini',
        'placeholder' => '0',
    ));
    ?>

    <?php
    echo $this->Form->submit('Add', array(
        'class' => 'btn btn-primary',
    ));
    ?>
</fieldset>
<?php echo $this->Form->end(); ?>
