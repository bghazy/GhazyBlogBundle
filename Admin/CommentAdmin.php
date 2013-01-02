<?php 
namespace Ghazy\BlogBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
 
class CommentAdmin extends Admin
{
	protected $datagridValues = array(
			'_sort_order' => 'DESC',
			'_sort_by' => 'created_at'
	);
	
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->add('email')
		->add('body')
		->add('is_activated')
		;
	}
	
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('email')
		->add('body')
		->add('is_activated')
		;
	}
	
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->add('email')
		->add('body')
		->add('is_activated')
		->add('_action', 'actions', array(
				'actions' => array(
						'view' => array(),
						'edit' => array(),
						'delete' => array(),
				)
		))
		;
	}
}