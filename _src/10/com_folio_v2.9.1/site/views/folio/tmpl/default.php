<?php defined('_JEXEC') or die; ?>

<div class="mypreview">
	<?php foreach ($this->items as $item) : ?>
		<div class="myfolio">
			<div class="folio_title">
				<?php echo $item->title; ?>
			</div>
			<div class="folio_element_full">
				<a href="<?php echo $item->url; ?>" target="_blank" rel="nofollow">
					<img src="<?php echo $item->image; ?>">
				</a>
			</div>
			<div class="folio_element_full">
				<strong><?php echo JText::_('COM_FOLIO_COMPANY');?></strong><?php echo $item->company; ?>
			</div>
			<div class="folio_element_full">
				<strong><?php echo JText::_('COM_FOLIO_PHONE');?></strong><?php echo $item->phone; ?>
			</div>
			<div class="folio_element_full">
				<?php echo $item->description; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
<div class="folio_element_full">
	<?php
		$item->text = $item->description;
		$item->introtext = $item->description;

		$options = array();
		if (class_exists('plgContentKomento'))
		{
			require_once JPATH_ROOT . '/components/com_komento/bootstrap.php';
			echo Komento::commentify('com_folio', $item, $options);
		}
	?>
</div>