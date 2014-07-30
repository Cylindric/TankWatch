<h1><?= h($species->name) ?></h1>
<p><?= h($species->scientific_name) ?></p>
<p><small>Created: <?= $species->created->format(DATE_RFC850) ?></small></p>

<?php foreach($species->speciesproperties as $prop): ?>
<?= $prop->propertytype->name?>: <?= $prop->min_property->value?> - <?= $prop->max_property->value?> <?= $prop->propertytype->code?>
<?php endforeach; ?>