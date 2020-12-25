<?php
defined('_JEXEC') or die;

class FolioCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__folio';
		$options['extension'] = 'com_folio';
		parent::__construct($options);
	}
}