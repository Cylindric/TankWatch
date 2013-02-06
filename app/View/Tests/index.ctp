<h1>Tests</h1>
<table class="table table-hover table-condensed">
	<?php foreach ($tests as $test): ?>
	<tr>
		<td><?php echo $test['Test']['name']; ?></td>
		<td><?php echo $test['Test']['code']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>