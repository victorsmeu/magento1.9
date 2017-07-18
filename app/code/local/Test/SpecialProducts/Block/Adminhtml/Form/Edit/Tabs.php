<?php

class Test_SpecialProducts_Block_Adminhtml_Form_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
  public function __construct()
  {
      parent::__construct();
      $this->setId('form_tabs');
      $this->setDestElementId('edit_form'); // this should be same as the form id define above
      $this->setTitle(Mage::helper('test_specialProducts')->__('Product Information'));
  }
 
  protected function _beforeToHtml()
  {
      $this->addTab('form_section1', array(
          'label'     => Mage::helper('test_specialProducts')->__('Item Information'),
          'title'     => Mage::helper('test_specialProducts')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit_tab_form')->toHtml(),
      ));
      
      $this->addTab('form_section2', array(
          'label'     => Mage::helper('test_specialProducts')->__('Products'),
          'title'     => Mage::helper('test_specialProducts')->__('Products'),
          //'content'   => $this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit_tab_products')->toHtml(),
          'url'   => $this->getUrl('*/*/products', array('_current' => true)),
          'class'    => 'ajax'
      ));
      
      return parent::_beforeToHtml();
  }
}
