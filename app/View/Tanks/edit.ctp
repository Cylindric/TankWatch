<h1>Edit Tank</h1>
<?php
echo $this->Form->create('Tank', array(
    'class' => 'form-vertical',
    'inputDefaults' => array('div' => false))
);
?>
<fieldset>
    <legend><?php echo $this->data['Tank']['name']; ?></legend>

    <?php
    echo $this->Form->input('name', array(
        'type' => 'text',
        'class' => 'span2',
        'placeholder' => 'tank name',
    ));
    ?>

    <div class="row-fluid">
        <div class="span1">
            <?php
            echo $this->Form->input('width', array(
                'type' => 'text',
                'append' => 'cm',
                'class' => 'span10',
                'placeholder' => '0.00',
            ));
            ?>
        </div>
        <div class="span1">
            <?php
            echo $this->Form->input('depth', array(
                'type' => 'text',
                'append' => 'cm',
                'class' => 'span10',
                'placeholder' => '0.00',
            ));
            ?>
        </div>
        <div class="span1">
            <?php
            echo $this->Form->input('height', array(
                'type' => 'text',
                'append' => 'cm',
                'placeholder' => '0.00',
                'class' => 'span10',
            ));
            ?>
        </div>
    </div>    
    <?php
    echo $this->Form->input('volume', array(
        'label' => 'Water Volume',
        'type' => 'text',
        'class' => 'span1',
        'append' => 'L',
        'placeholder' => '0.00',
    ));
    ?>

    <?php
    echo $this->Form->submit('Save', array(
        'class' => 'btn btn-primary',
    ));
    ?>
</fieldset>
<?php echo $this->Form->end(); ?>
