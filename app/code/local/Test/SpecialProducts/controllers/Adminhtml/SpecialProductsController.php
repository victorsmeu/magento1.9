<?php

class Test_SpecialProducts_Adminhtml_SpecialProductsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Special Products'))->_title($this->__('Special Products'));
        $this->loadLayout();
        $this->_setActiveMenu('catalog/products');
        $this->_addContent($this->getLayout()->createBlock('test_specialProducts/adminhtml_specialProducts'));
        $this->renderLayout();
    }
    
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('test_specialProducts/adminhtml_grid')->toHtml()
        );
    }
    
    public function newAction()
    {
        $this->_forward('edit');
//        $this->loadLayout();
//        $this->_addContent($this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit'))
//             ->_addLeft($this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit_tabs'));
//        $this->renderLayout();
    }
    
//    public function editAction()
//    {
//        $this->loadLayout();
//        $this->_addContent($this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit'))
//             ->_addLeft($this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit_tabs'));
//        $this->renderLayout();
//    }
    
    public function editAction()
    {
        $specialProductsId = $this->getRequest()->getParam('id');
        $specialProductsModel = Mage::getModel('test_specialProducts/specialProducts')->load($specialProductsId);
        if ($specialProductsModel->getId() || $specialProductsId == 0) {
            Mage::register('specialProducts_data', $specialProductsModel);
            $this->loadLayout();
            $this->_setActiveMenu('catalog/products');
            //$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            //$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit'))
                 ->_addLeft($this->getLayout()->createBlock('test_specialProducts/adminhtml_form_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('test_SpecialProducts')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function productsAction(){
        //$this->_initEntity(); //if you don't have such a method then replace it with something that will get you the entity you are editing.
        $this->loadLayout();
        $this->getLayout()
             ->getBlock('products.grid')
             ->setProducts($this->getRequest()->getPost('products', null));
        $this->renderLayout();
        
    }
    
    public function productsgridAction(){
        $this->_initForm();
        $this->loadLayout();
        $this->getLayout()->getBlock('products.grid')
            ->setProducts($this->getRequest()->getPost('products', null));
        $this->renderLayout();
    }
    
    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            try {
                $postData = $this->getRequest()->getPost();
                print_r('<pre>');
                print_r($postData);
                die();
                $specialProductsModel = Mage::getModel('test_specialProducts/specialProducts');
                
                if(null !== ($this->getRequest()->getParam('id'))) {
                    $specialProductsModel->setId($this->getRequest()->getParam('id'));
                }
                $specialProductsModel->setName($postData['name'])
                        ->setStartDate($postData['start_date'])
                        ->setDuration($postData['duration'])
                        ->setCategory($postData['category'])
                        ->setNbProducts($postData['nb_products']);
                $specialProductsModel->save();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setSpecialProductsData(false);
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setSpecialProductsData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $specialProductsModel = Mage::getModel('specialProducts/specialProducts');
                $specialProductsModel->setId($this->getRequest()->getParam('id'))
                        ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

}
