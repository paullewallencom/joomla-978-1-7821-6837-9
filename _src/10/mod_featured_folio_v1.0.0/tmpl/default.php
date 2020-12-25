<?php
defined('_JEXEC') or die;

?>
<div class="featured_folio<?php echo $moduleclass_sfx ?>">
	<div class="row-striped">
		<?php foreach ($list as $item) : ?>
			<div class="myfolio">
				<div class="folio_title">
					<?php echo '<a href="index.php?option=com_folio&view=folio&id='.(int)$item->id.'">'.$item->title.'</a>'; ?>
				</div>

				<div class="folio_element">
					<a href="<?php echo $item->url; ?>" rel="nofollow">
						<img src="<?php echo $item->image; ?>" width="<?php echo $imagewidth; ?>">
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>