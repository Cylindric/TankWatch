<h1>Edit Species</h1>
<?php echo $this->Form->create('Species', array('class' => 'form-vertical')); ?>
<fieldset>
    <legend><?php echo $this->data['Species']['name']; ?></legend>

    <?php
    echo $this->Form->input('name', array(
        'label' => 'Name',
        'type' => 'text',
        'placeholder' => 'species name',
        'helpInline' => 'A name for this species.',
    ));
    ?>

    <?php
    echo $this->Form->input('scientific_name', array(
        'label' => 'Scientific Name',
        'type' => 'text',
        'placeholder' => 'scientific name',
        'helpInline' => 'The Scientific name of this species.',
    ));
    ?>

    <?php
    echo $this->Form->input('scientific_class', array(
        'label' => 'Scientific Class',
        'type' => 'text',
        'placeholder' => 'scientific class',
        'helpInline' => 'The Scientific class of this species.',
    ));
    ?>

    <?php
    echo $this->Form->submit('Add', array(
        'class' => 'btn btn-primary',
    ));
    ?>

</fieldset>
<?php echo $this->Form->end(); ?>
