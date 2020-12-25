<?php
defined('_JEXEC') or die;

class FolioViewFolios extends JViewLegacy
{
	protected $items;

	protected $state;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->state		= $this->get('State');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		$canDo	= FolioHelper::getActions();
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_FOLIO_MANAGER_FOLIOS'), '');

		JToolbarHelper::addNew('folio.add');

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('folio.edit');
		}
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_folio');
		}
	}

	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}