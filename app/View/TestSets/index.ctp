<h1>Test Sets</h1>
<table class="table table-hover table-condensed">
	<?php foreach ($testsets as $testset): ?>
	<tr>
		<td><?php echo $this->html->link($testset['TestSet']['name'], array('action' => 'view', $testset['TestSet']['id'])); ?></td>
		<td><ul class="inline">
		<?php foreach ($testset['Test'] as $test): ?>
			<li><?php echo $test['code']; ?></li>
		<?php endforeach; ?>
		</ul></td>
		<td><button class="btn btn-mini">
		<?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $testset['TestSet']['id']),
                array('confirm' => 'Are you sure?'));
        ?>
        </button></td>
	</tr>
	<?php endforeach; ?>
</table>

<button class="btn btn-primary" onclick="location.href='<?php echo $this->Html->url(array('action' => 'add')); ?>';">Add New</button>