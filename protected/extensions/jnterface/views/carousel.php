<div id="<?php echo $this->name; ?>" class="carousel">
    <?php foreach($this->items as $item): ?>
        <a href="<?php  echo $item['link']; ?>" title="<?php echo $item['caption']; ?>" <?php if($this->useThickBox) echo 'class="thickbox"'; ?>>
            <img src="<?php echo $item['image']; ?>" width="100%" /></a>
    <?php endforeach; ?>
</div>
