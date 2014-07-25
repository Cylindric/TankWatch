<h1>Add Species</h1>
<?php
    echo $this->Form->create($species);
    echo $this->Form->input('name');
    echo $this->Form->input('scientific_name');
    echo $this->Form->button(__('Save Species'));
    echo $this->Form->end();
?>