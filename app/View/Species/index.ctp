<h1>Species</h1>

<table class="table table-hover table-condensed">
    <?php foreach ($species as $species): ?>
        <tr>
            <td>
                <?php echo $this->Html->link($species['Species']['name'], array('action' => 'view', $species['Species']['id'])); ?>
            </td>
            <td>
                <?php echo $species['Species']['scientific_name']; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
