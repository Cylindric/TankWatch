<h1>Tanks</h1>

<table class="table table-hover table-condensed">
    <?php foreach ($tanks as $tank): ?>
        <tr>
            <td><?php echo $this->Html->link($tank['Tank']['name'], array('action' => 'view', $tank['Tank']['id'])); ?></td>
            <td><?php echo $tank['Tank']['width']; ?> x <?php echo $tank['Tank']['depth']; ?> x <?php echo $tank['Tank']['height']; ?></td>
            <td>
                <button class="btn btn-mini">
                    <?php
                    echo $this->Html->link(
                            'Edit', array('action' => 'edit', $tank['Tank']['id']));
                    ?>
                </button>
                <button class="btn btn-mini">
                    <?php
                    echo $this->Form->postLink(
                            'Delete', array('action' => 'delete', $tank['Tank']['id']), array('confirm' => 'Are you sure?'));
                    ?>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>