<dl id="<?php echo $this->name; ?>" class="Accordion">
   <?php foreach($this->panels as $panel): ?>
	<dt><?php echo $panel['header']; ?></dt>
	<dd><?php echo $panel['body']; ?></dd>
   <?php endforeach; ?>
</dl>