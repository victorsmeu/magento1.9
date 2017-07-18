<?php

class Test_SpecialProducts_Block_Adminhtml_Form_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form(array(
                                      'id' => 'edit_form',
                                      'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                                      'method' => 'post',
                                      'enctype' => 'multipart/form-data'
                                   )
      );
 
      $form->setUseContainer(true);
      $this->setForm($form);
      
      if(Mage::getSingleton('adminhtml/session')->getSpecialProductsData())
      {
        $form->setValues(Mage::getSingleton('adminhtml/session')->getSpecialProductsData());
        Mage::getSingleton('adminhtml/session')->setSpecialProductsData(null);
      } elseif ( Mage::registry('specialProducts_data') ) {
        $form->setValues(Mage::registry('specialProducts_data')->getData());
      }
      return parent::_prepareForm();
  }
}
