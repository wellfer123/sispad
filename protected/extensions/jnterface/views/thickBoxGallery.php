
<?php foreach($images as $img): ?>
<a href="<?php echo $this->imageDir.'/'.$img; ?>" title="" class="thickbox" rel="<?php echo $this->name; ?>">
    <img src="<?php echo $this->imageDir.'/'.$img; ?>" width="<?php echo $this->reduction; ?>" height="<?php echo $this->reduction; ?>" />
</a>
<?php endforeach; ?>
