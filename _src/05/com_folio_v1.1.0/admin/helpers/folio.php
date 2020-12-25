<?php
defined('_JEXEC') or die;

class FolioHelper
{
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_folio';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_folio.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_folio', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}