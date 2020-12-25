<?php
defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

JHtml::_('stylesheet', 'mod_featured_folio/style.css', array(), true);

$list = mod_featured_folioHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$imagewidth = htmlspecialchars($params->get('imagewidth'));
require JModuleHelper::getLayoutPath('mod_featured_folio', $params->get('layout', 'default'));