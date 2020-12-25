<?php
defined('_JEXEC') or die;

abstract class mod_featured_folioHelper
{
	public static function getList(&$params)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('id, title, image, url');
		$query->from('#__folio');
		$query->where('featured=1');
		$query->where("image NOT LIKE ''");
		$query->order('ordering DESC');
		$db->setQuery($query, 0, $params->get('count', 5));

		try
		{
			$results = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JError::raiseError(500, $e->getMessage());
			return false;
		}

		foreach ($results as $k => $result)
		{
			$results[$k] = new stdClass;
			$results[$k]->title = htmlspecialchars( $result->title );
			$results[$k]->id = htmlspecialchars( $result->id );
			$results[$k]->image = htmlspecialchars( $result->image );
			$results[$k]->url = htmlspecialchars( $result->url );
		}

		return $results;
	}
}