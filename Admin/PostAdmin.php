<?php 
namespace Ghazy\BlogBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
 
class PostAdmin extends Admin
{
	protected $datagridValues = array(
			'_sort_order' => 'DESC',
			'_sort_by' => 'created_at'
	);
	
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->add('title', null, array('required'=>true))
		->add('tags', 'sonata_type_model', array(
                'expanded' => true, 
				'multiple'=> true
                ))
		->add('body', 'textarea', array(
        'attr' => array(
            'class' => 'tinymce',
            'data-theme' => 'medium'
        )
    ))
		->add('is_activated', null, array('required'=>false))
		;
	}
	
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('title')
		->add('body')
		->add('is_activated')
		;
	}
	
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->add('title')
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
