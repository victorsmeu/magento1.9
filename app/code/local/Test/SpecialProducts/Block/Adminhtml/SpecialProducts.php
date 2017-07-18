<?php
 
class Test_SpecialProducts_Block_Adminhtml_SpecialProducts extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'test_specialProducts';
        $this->_controller = 'adminhtml';
        $this->_headerText = Mage::helper('test_specialProducts')->__('Special Products');
        parent::__construct();
    }
}