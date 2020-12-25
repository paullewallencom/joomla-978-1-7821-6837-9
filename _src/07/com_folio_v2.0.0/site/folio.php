<?php
defined('_JEXEC') or die;

$controller	= JControllerLegacy::getInstance('Folio');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();