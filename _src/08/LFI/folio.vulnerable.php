<?php
defined('_JEXEC') or die;

if($controller = JRequest::getVar('controller'))
{
	require_once(JPATH_COMPONENT.'/controllers/'.$controller.'.php');
}

$document = JFactory::getDocument();
$cssFile = "./media/com_folio/css/site.stylesheet.css";
$document->addStyleSheet($cssFile, 'text/css', null, array());

$controller	= JControllerLegacy::getInstance('Folio');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();