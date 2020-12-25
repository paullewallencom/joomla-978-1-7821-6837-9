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
		echo '<p>' . JText::_('COM_FOLIO_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}