<div id="<?php echo $this->name; ?>" class="fisheye">
    <div class="fisheyeContainter">

        <?php foreach($this->menu as $item): ?>
            <a href="<?php echo $item['link']; ?>" class="fisheyeItem"><img src="<?php echo $item['image']; ?>" width="<?php echo $this->itemWidth; ?>" /><span><?php echo $item['title']; ?></span></a>
        <?php endforeach; ?>

    </div>
</div>

