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
		$this->sidebar = JHtmlSidebar::render();
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
		if ($canDo->get('core.edit.state')) {

			JToolbarHelper::publish('folios.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('folios.unpublish', 'JTOOLBAR_UNPUBLISH', true);

			JToolbarHelper::archiveList('folios.archive');
			JToolbarHelper::checkin('folios.checkin');
		}
		$state	= $this->get('State');
		if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'folios.delete', 'JTOOLBAR_EMPTY_TRASH');
		} elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('folios.trash');
		}
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_folio');
		}

		JHtmlSidebar::setAction('index.php?option=com_folio&view=folios');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_state',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);
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