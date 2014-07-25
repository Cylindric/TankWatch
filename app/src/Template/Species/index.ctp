<h1>Species</h1>

<?= $this->Html->link('Add Species', ['controller'=>'Species', 'action' => 'add']) ?>
<table>
    <tr>
    </tr>
    <?php foreach ($species as $s): ?>

    <tr>
        <td><?= $s->id ?></td>
        <td>
            <?= $this->Html->link($s->name, ['controller' => 'Species', 'action' => 'view', $s->id]) ?>
        </td>
        <td><?= $s->created->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Form->postLink('Delete', ['action' => 'delete', $s->id], ['confirm' => 'Are you sure?']) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $s->id]) ?>
        </td>
    </tr>

    <?php endforeach; ?>
</table>