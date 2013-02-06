<h1>Results</h1>
<table class="table table-hover table-condensed">
	<?php foreach ($results as $result): ?>
	<tr>
		<td><?php echo $result['Result']['time']; ?></td>
		<td><?php echo $result['Test']['name']; ?> <?php echo (strlen($result['Test']['code']) == 0 ? '' : '(' . $result['Test']['code'] . ')'); ?></td>
		<td><?php echo $result['Result']['value']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>