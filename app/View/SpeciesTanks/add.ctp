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
        'type' => 'hidden',
    ));
    ?>
    <?php
    echo $this->Form->input('species_name', array(
        'type' => 'text',
        'placeholder' => 'species',
        'data-provide' => 'typeahead',
        'data-minLength' => 2,
        'autocomplete' => 'off',
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

<?php $this->Html->scriptStart(); ?>
$("#SpeciesTankSpeciesName").typeahead({
  source: function (query, process) {
    $.get('/species/typeahead.json', { q: query }, function (data) {
      labels = []
      mapped = {}

      $.each(data.species, function (i, item) {
        mapped[item.name] = item.id
        labels.push(item.name)
      })

      process(labels)
    })
  }
, updater: function (item) {
    $('#SpeciesTankSpeciesId').val(mapped[item]);
    return item;
  }
})
<?php echo $this->Html->scriptEnd(); ?>
