<?php
class Test_SpecialProducts_Model_Mysql4_SpecialProducts extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('test_specialProducts/specialProducts', 'id');
    }
}
