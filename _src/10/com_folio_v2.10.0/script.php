<?php
defined('_JEXEC') or die;

class com_folioInstallerScript
{
	function createSampleImages(){
		jimport( 'joomla.filesystem.file' );

		if(!file_exists(JPATH_SITE . "/images/com_folio/")){
			JFolder::create(JPATH_SITE. "/images/com_folio/");
		};

		if(!file_exists(JPATH_SITE. "/images/com_folio/index.html")){
			JFile::copy(JPATH_SITE."/media/com_folio/index.html",JPATH_SITE. "/images/com_folio/index.html");
		};

		if(!file_exists(JPATH_SITE. "/images/com_folio/chocolate.png")){
			JFile::copy(JPATH_SITE."/media/com_folio/images/chocolate.png",JPATH_SITE. "/images/com_folio/chocolate.png");
		};

		if(!file_exists(JPATH_SITE. "/images/com_folio/coin.png")){
			JFile::copy(JPATH_SITE."/media/com_folio/images/coin.png",JPATH_SITE. "/images/com_folio/coin.png");
		};

		if(!file_exists(JPATH_SITE. "/images/com_folio/cookie.png")){
			JFile::copy(JPATH_SITE."/media/com_folio/images/cookie.png",JPATH_SITE. "/images/com_folio/cookie.png");
		};
	}

	function install($parent)
	{
		$this->createSampleImages();
		$parent->getParent()->setRedirectURL('index.php?option=com_folio');
	}

	function uninstall($parent)
	{
		echo '<p>' . JText::_('COM_FOLIO_UNINSTALL_TEXT') . '</p>';
	}

	function update($parent)
	{
		$this->createSampleImages();
		echo '<p>' . JText::_('COM_FOLIO_UPDATE_TEXT') . '</p>';
	}

	function preflight($type, $parent)
	{
		echo '<p>' . JText::_('COM_FOLIO_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}

	function postflight($type, $parent)
	{
		$table = JTable::getInstance('Contenttype', 'JTable');
		if(!$table->load(array('type_alias' => 'com_folio.folio')))
		{
			$common	= new stdClass;
			$common->core_content_item_id	= 'id';
			$common->core_title				= 'title';
			$common->core_state				= 'state';
			$common->core_alias				= 'alias';
			$common->core_created_time		= 'created';
			$common->core_modified_time		= 'modified';
			$common->core_body				= 'description';
			$common->core_hits				= 'hits';
			$common->core_publish_up		= 'publish_up';
			$common->core_publish_down		= 'publish_down';
			$common->core_access			= 'access';
			$common->core_params			= 'params';
			$common->core_featured			= 'featured';
			$common->core_metadata			= 'metadata';
			$common->core_language			= 'language';
			$common->core_images			= 'images';
			$common->core_urls				= 'urls';
			$common->core_version			= 'version';
			$common->core_ordering			= 'ordering';
			$common->core_metakey			= 'metakey';
			$common->core_metadesc			= 'metadesc';
			$common->core_catid				= 'catid';
			$common->core_xreference		= 'xreference';
			$common->asset_id				= null;

			$field_mappings	= new stdClass;
			$field_mappings->common[]	= $common;
			$field_mappings->special	= array();

			$special	= new stdClass;
			$special->dbtable	= '#__folio';
			$special->key	= 'id';
			$special->type	= 'Folio';
			$special->prefix	= 'FolioTable';
			$special->config	= 'array()';

			$table_object	= new stdClass;
			$table_object->special	= $special;

			$contenttype['type_title'] = 'Folio';
			$contenttype['type_alias'] = 'com_folio.folio';
			$contenttype['table'] = json_encode($table_object);
			$contenttype['rules'] = '';
			$contenttype['router'] = 'FolioHelperRoute::getFolioRoute';
			$contenttype['field_mappings'] = json_encode($field_mappings);

			$table->save($contenttype);
		}

		echo '<p>' . JText::_('COM_FOLIO_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}