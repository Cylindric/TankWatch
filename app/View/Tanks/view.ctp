<h1><?php echo $tank['Tank']['name']; ?> (<?php echo $tank['Tank']['width']; ?> x <?php echo $tank['Tank']['depth']; ?> x <?php echo $tank['Tank']['height']; ?>)</h1>

<div class="span6">
    <h2>Inhabitants</h2>
    <table class="table table-condensed">
        <?php foreach ($inhabitants as $inhabitant): ?>
            <tr>
                <td><?php echo $inhabitant['Species']['name']; ?></td>
                <td><?php echo $inhabitant[0]['quantity']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button class="btn btn-primary" onclick="location.href='<?php echo $this->Html->url(array('controller' => 'SpeciesTanks', 'action' => 'add', $tank['Tank']['id'])); ?>';">Add New</button>
</div>


<div class="span6">
    <h2>Inhabitant Log</h2>
    <table class="table table-condensed"> 
        <?php foreach ($tank['SpeciesTank'] as $log): ?>

            <tr class="<?php echo ($log['quantity'] < 0) ? 'error' : (($log['quantity'] > 0) ? 'success' : ''); ?>">
                <td><?php echo $this->Time->format('d/m/Y', $log['created']); ?></td>
                <td><?php echo $log['Species']['name']; ?></td>
                <td><?php echo $log['quantity']; ?></td>
                <td><?php echo $log['note']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>