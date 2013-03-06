<h1>Species</h1>

<table class="table table-hover table-condensed">
    <?php foreach ($species as $species): ?>
        <tr>
            <td>
                <?php echo $this->Html->link($species['Species']['name'], array('action' => 'edit', $species['Species']['id'])); ?>
            </td>
            <td>
                <?php echo $species['Species']['scientific_name']; ?>
            </td>
            <td>
                <button class="btn btn-mini">
                    <?php
                    echo $this->Form->postLink(
                            'Delete', array('action' => 'delete', $species['Species']['id']), array('confirm' => 'Are you sure?'));
                    ?>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<button class="btn btn-primary" onclick="location.href='<?php echo $this->Html->url('/Species/add'); ?>';">Add New</button>