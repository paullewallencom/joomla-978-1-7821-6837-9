<?php
defined('_JEXEC') or die;

class FolioViewFolio extends JViewLegacy
{
	protected $item;

	protected $form;

	public function display($tpl = null)
	{
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

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
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$canDo		= FolioHelper::getActions($this->item->catid, 0);

		JToolbarHelper::title(JText::_('COM_FOLIO_MANAGER_FOLIO'), '');

		if ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_folio', 'core.create'))))
		{
			JToolbarHelper::apply('folio.apply');
			JToolbarHelper::save('folio.save');
		}
		if (count($user->getAuthorisedCategories('com_folio', 'core.create'))){
			JToolbarHelper::save2new('folio.save2new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && (count($user->getAuthorisedCategories('com_folio', 'core.create')) > 0))
		{
			JToolbarHelper::save2copy('folio.save2copy');
		}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('folio.cancel');
		}
		else
		{
			JToolbarHelper::cancel('folio.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}