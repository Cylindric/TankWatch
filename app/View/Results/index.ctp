<h1>Test Results</h1>
<table class="table table-hover table-condensed">
	<?php foreach ($results as $result): ?>
	<tr>
		<td><?php echo $result['Result']['time']; ?></td>
		<td><?php echo $result['Test']['name']; ?> <?php echo (strlen($result['Test']['code']) == 0 ? '' : '(' . $result['Test']['code'] . ')'); ?></td>
		<td class="result-value"><?php echo sprintf($result['Test']['display_format'], $result['Result']['value']) . $result['Unit']['abbreviation']; ?></td>
		<td><button class="btn btn-mini">
		<?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $result['Result']['id']),
                array('confirm' => 'Are you sure?'));
        ?>
        </button></td>
	</tr>
	<?php endforeach; ?>
</table>

<button class="btn btn-primary" onclick="location.href='<?php echo $this->Html->url('/Results/add'); ?>';">Add New</button>