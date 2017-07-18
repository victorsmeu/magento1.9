<?php
class Test_SpecialProducts_Model_Mysql4_SpecialProducts_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('test_specialProducts/specialProducts');
    }
}
