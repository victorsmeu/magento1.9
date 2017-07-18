<?php
class Test_SpecialProducts_Block_Adminhtml_Form_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('test_specialProducts_form', array('legend'=>Mage::helper('test_specialProducts')->__('Item information')));
          
        $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('test_specialProducts')->__('Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
        ));
        
        $fieldset->addField('start_date', 'date', array(
          'label'     => Mage::helper('test_specialProducts')->__('Start date'),
          'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
          'image'     => $this->getSkinUrl('images/grid-cal.gif'),  
          'name'      => 'start_date',
        ));
        
        $fieldset->addField('duration', 'select', array(
          'label'     => Mage::helper('test_specialProducts')->__('Duration'),
          'values'    => [
                            '-1'=>'Please Select..', 
                            '1' => 'One week', 
                            '2' => 'One month', 
                            '3' => 'Forever'
          ],
          'name'      => 'duration',
        ));
        
        $fieldset->addField('category', 'select', array(
          'label'     => Mage::helper('test_specialProducts')->__('Category'),
          'name'      => 'category',
          'values'    => $this->getAllCategories()  
        ));
        
        $fieldset->addField('nb_products', 'text', array(
          'label'     => Mage::helper('test_specialProducts')->__('Nb of products'),
          'class'     => 'required-entry',
          'required'  => true,
          'value'     => '1',  
          'name'      => 'nb_products',
        ));
        
        if(Mage::getSingleton('adminhtml/session')->getSpecialProductsData())
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSpecialProductsData());
            Mage::getSingleton('adminhtml/session')->setSpecialProductsData(null);
        } elseif ( Mage::registry('specialProducts_data')) {
            $form->setValues(Mage::registry('specialProducts_data')->getData());
        }
          
        return parent::_prepareForm();
    }
    
    private function getAllCategories()
    {
        $categories = [];
        
        $category = Mage::getModel('catalog/category');
        $tree = $category->getTreeModel();
        $tree->load();
        $ids = $tree->getCollection()->getAllIds();
        
        //remove root id
        unset($ids[0]);
        
        if($ids){
            foreach($ids as $id){
                $cat = Mage::getModel('catalog/category');
                $cat->load($id);

                $categories[$cat->getId()] = $cat->getName();
            }
        }

        return $categories;
    }
}
