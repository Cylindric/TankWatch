<h1>Test Set: <?php echo $testset['TestSet']['name']; ?></h1>

<table>
<?php foreach ($results as $result): ?>

    <tr>
        <td><?php echo $result['Result']['time']?></td>
        <td><?php echo $result['Test']['name']?></td>
    </tr>

<?php endforeach; ?>
</table>