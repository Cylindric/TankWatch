<?php
if (!isset($class)) {
	$class = 'info';
}
if (!isset($title)) {
    $title = '';
}

$this->Html->scriptStart();
?>
$(function(){
    $.pnotify({
        title: '<?php echo $title; ?>',
        text: '<?php echo $message; ?>',
        type: '<?php echo $class; ?>',
        history: false
    });
});
<?php echo $this->Html->scriptEnd(); ?>