<h1>Tanks</h1>

<table>
<?php foreach($tanks as $tank): ?>
	<tr>
		<td><?php echo $tank['Tank']['name']; ?></td>
	</tr>
<?php endforeach; ?>
</table>