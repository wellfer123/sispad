<div id="<?php echo $this->name; ?>" class="popeye">
    <ul>
     <?php foreach($images as $img): ?>
     <li><a href="<?php echo $this->imageDir.'/'.$img; ?>">
             <img src="<?php echo $this->imageDir.'/'.$img; ?>"/></a></li>
     <?php endforeach; ?>
    </ul>
</div>
