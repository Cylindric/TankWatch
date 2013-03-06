<h1><?php echo $tank['Tank']['name']; ?> (<?php echo $tank['Tank']['width']; ?> x <?php echo $tank['Tank']['depth']; ?> x <?php echo $tank['Tank']['height']; ?>)</h1>

<div class="span6">
    <h2>Inhabitants</h2>
    <?php if (count($inhabitants) == 0): ?>
        <div class="well">You haven't added any creatures to your tank yet. Once you do, a list of the current inhabitants will be show here.</div>
    <?php else: ?>
        <table class="table table-condensed">
            <?php foreach ($inhabitants as $inhabitant): ?>
                <tr>
                    <td><?php echo $inhabitant['Species']['name']; ?></td>
                    <td><?php echo $inhabitant[0]['quantity']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <button class="btn btn-primary" onclick="location.href='<?php echo $this->Html->url(array('controller' => 'SpeciesTanks', 'action' => 'add', $tank['Tank']['id'])); ?>';">Add an inhabitant</button>
</div>


<div class="span6">
    <h2>Inhabitant Log</h2>
    <?php if (count($tank['SpeciesTank']) == 0): ?>
        <div class="well">You haven't added or removed any creatures from your tank yet. Once you do, the record of those actions will be shown here.</div>
    <?php else: ?>
        <table class="table table-condensed"> 
            <?php foreach ($tank['SpeciesTank'] as $log): ?>
                <tr id="speciestank_<?php echo $log['id']; ?>" class="<?php echo ($log['quantity'] < 0) ? 'error' : (($log['quantity'] > 0) ? 'success' : ''); ?>">
                    <td><?php echo $this->Time->format('d/m/Y', $log['created']); ?></td>
                    <td><?php echo $log['Species']['name']; ?></td>
                    <td><?php echo $log['quantity']; ?></td>
                    <td><?php echo $log['note']; ?></td>
                    <td><button type="button" class="close"><?php echo $this->Html->link('×', array('controller' => 'SpeciesTanks', 'action' => 'delete', $log['id']), array('class' => 'delete_row')); ?></button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>