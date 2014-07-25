<h1><?= h($species->name) ?></h1>
<p><?= h($species->scientific_name) ?></p>
<p><small>Created: <?= $species->created->format(DATE_RFC850) ?></small></p>