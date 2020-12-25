<?php
defined('_JEXEC') or die;

if($controller = JFactory::getApplication()->input->get('controller','folio.php','WORD'))
{
	if(file_exists($controller))
	{
		require_once $controller;
	}
}

$document = JFactory::getDocument();
$cssFile = "./media/com_folio/css/site.stylesheet.css";
$document->addStyleSheet($cssFile, 'text/css', null, array());

$controller	= JControllerLegacy::getInstance('Folio');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();