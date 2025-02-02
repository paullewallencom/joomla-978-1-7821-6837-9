<?php
defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_folio/helpers/route.php';

class PlgSearchFolio extends JPlugin
{
	protected $autoloadLanguage = true;

	public function onContentSearchAreas()
	{
		static $areas = array(
			'folio' => 'PLG_SEARCH_FOLIO_FOLIO'
		);
		return $areas;
	}

	public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null)
	{
		$db = JFactory::getDbo();
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$groups = implode(',', $user->getAuthorisedViewLevels());

		$searchText = $text;

		if (is_array($areas))
		{
			if (!array_intersect($areas, array_keys($this->onContentSearchAreas())))
			{
				return array();
			}
		}

		$sContent = $this->params->get('search_content', 1);
		$sArchived = $this->params->get('search_archived', 1);
		$limit = $this->params->def('search_limit', 50);
		$state = array();
		if ($sContent)
		{
			$state[] = 1;
		}
		if ($sArchived)
		{
			$state[] = 2;
		}

		$text = trim($text);
		if ($text == '')
		{
			return array();
		}
		$section = JText::_('PLG_SEARCH_FOLIO');

		$wheres = array();
		switch ($phrase)
		{
			case 'exact':
				$text = $db->quote('%' . $db->escape($text, true) . '%', false);
				$wheres2 = array();
				$wheres2[] = 'a.url LIKE ' . $text;
				$wheres2[] = 'a.description LIKE ' . $text;
				$wheres2[] = 'a.title LIKE ' . $text;
				$where = '(' . implode(') OR (', $wheres2) . ')';
				break;

			case 'all':
			case 'any':
			default:
				$words = explode(' ', $text);
				$wheres = array();
				foreach ($words as $word)
				{
					$word = $db->quote('%' . $db->escape($word, true) . '%', false);
					$wheres2 = array();
					$wheres2[] = 'a.url LIKE ' . $word;
					$wheres2[] = 'a.description LIKE ' . $word;
					$wheres2[] = 'a.title LIKE ' . $word;
					$wheres[] = implode(' OR ', $wheres2);
				}
				$where = '(' . implode(($phrase == 'all' ? ') AND (' : ') OR ('), $wheres) . ')';
				break;
		}

		switch ($ordering)
		{
			case 'oldest':
				$order = 'a.created ASC';
				break;

			case 'popular':
				$order = 'a.id DESC';
				break;

			case 'alpha':
				$order = 'a.title ASC';
				break;

			case 'category':
				$order = 'c.title ASC, a.title ASC';
				break;

			case 'newest':
			default:
				$order = 'a.created DESC';
		}

		$return = array();
		if (!empty($state))
		{
			$query = $db->getQuery(true);
			//sqlsrv changes
			$case_when = ' CASE WHEN ';
			$case_when .= $query->charLength('a.alias', '!=', '0');
			$case_when .= ' THEN ';
			$a_id = $query->castAsChar('a.id');
			$case_when .= $query->concatenate(array($a_id, 'a.alias'), ':');
			$case_when .= ' ELSE ';
			$case_when .= $a_id . ' END as slug';

			$case_when1 = ' CASE WHEN ';
			$case_when1 .= $query->charLength('c.alias', '!=', '0');
			$case_when1 .= ' THEN ';
			$c_id = $query->castAsChar('c.id');
			$case_when1 .= $query->concatenate(array($c_id, 'c.alias'), ':');
			$case_when1 .= ' ELSE ';
			$case_when1 .= $c_id . ' END as catslug';

			$query->select(
				'a.title AS title, a.description AS text, a.created AS created, a.url, '
					. $case_when . ',' . $case_when1 . ', '
					. $query->concatenate(array($db->quote($section), "c.title"), " / ") . ' AS section, \'1\' AS browsernav'
			);
			$query->from('#__folio AS a')
				->join('INNER', '#__categories AS c ON c.id = a.catid')
				->where('(' . $where . ') AND a.state in (' . implode(',', $state) . ') AND  c.published=1 AND  c.access IN (' . $groups . ')')
				->order($order);

			// Filter by language
			if ($app->isSite() && JLanguageMultilang::isEnabled())
			{
				$tag = JFactory::getLanguage()->getTag();
				$query->where('a.language in (' . $db->quote($tag) . ',' . $db->quote('*') . ')')
					->where('c.language in (' . $db->quote($tag) . ',' . $db->quote('*') . ')');
			}

			$db->setQuery($query, 0, $limit);
			$rows = $db->loadObjectList();

			$return = array();
			if ($rows)
			{
				foreach ($rows as $key => $row)
				{
					$rows[$key]->href = FolioHelperRoute::getFolioRoute($row->slug, $row->catslug);
				}

				foreach ($rows as $key => $folio)
				{
					if (searchHelper::checkNoHTML($folio, $searchText, array('url', 'text', 'title')))
					{
						$return[] = $folio;
					}
				}
			}
		}
		return $return;
	}
}
