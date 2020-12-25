<?php
defined('_JEXEC') or die;

class FolioControllerUpdfolios extends JControllerAdmin
{
	public function getModel($name = 'Folio', $prefix = 'FolioModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	public function saveOrderAjax()
	{
		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		$model = $this->getModel();

		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		JFactory::getApplication()->close();
	}
}