<?php
defined('_JEXEC') or die;

require_once( JPATH_ROOT . '/components/com_komento/komento_plugins/abstract.php' );

class KomentoComfolio extends KomentoExtension
{
    public $_item;

    public $_map = array(
		'id' => 'id',
		'title' => 'title',
		'catid' => 'catid',
		'permalink' => 'permalink_field',
		'hits' => 'hits_field',
		'created_by' => 'created_by_field'
    );

    public function __construct( $component )
    {
    	parent::__construct( $component );
    }

    public function load( $cid )
    {
    	static $instances = array();

		if( !isset( $instances[$cid] ) )
		{
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true);

			$query->select('a.id AS id, a.title AS title, a.catid AS catid');
			$query->select('0 AS hits_field');
			$query->select('0 AS created_by_field');
			$query->from($db->quoteName('#__folio').' AS a');
			$query->where('a.id = '.(int)$cid);

			$db->setQuery((string)$query);
			$this->_item = $db->loadObject();

			$this->_item->permalink_field = "index.php?option=com_folio&view=folio&id=".(int)$this->_item->id;

			$instances[$cid] = $this->_item;
		}

    	$this->_item = $instances[$cid];

    	return $this;
    }

    public function getContentIds( $categories = '' )
    {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('a.id, a.title');
		$query->from($db->quoteName('#__folio').' AS a');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');
		$query->order('a.id');

		if( !empty( $categories ) )
		{
			if( is_array( $categories ) )
			{
				$categories = implode( ',', $categories );
			}

			// with category filters
			$query->where('a.catid IN '.$categories);
    	}

		$db->setQuery((string)$query);

    	return $db->loadResultArray();
    }

    public function getCategories()
    {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('c.id, c.title');
		$query->from($db->quoteName('#__categories').' AS c');
		$query->where('extension="com_folio"');

		$db->setQuery((string)$query);
		$categories = $db->loadObjectList();

    	return $categories;
    }

    public function isListingView()
    {
    	return JRequest::getCmd('view') == 'folios';
    }

    public function isEntryView()
    {
    	return JRequest::getCmd('view') == 'folio';
    }

    public function onExecute( &$article, $html, $view, $options = array() )
    {
		$model	= Komento::getModel( 'comments' );
		$count	= $model->getCount( $this->component, $this->getContentId() );
		$article->numOfComments = $count;

		return $html;
    }

	public function getComponentIcon()
	{
		return './components/com_komento/assets/images/cpanel/integrations.png';
	}

	public function getComponentName()
	{
		return 'Folio';
	}
}