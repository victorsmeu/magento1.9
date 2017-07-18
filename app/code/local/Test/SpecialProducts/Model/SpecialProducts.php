<?php
class Test_SpecialProducts_Model_SpecialProducts extends Mage_Core_Model_Abstract
{
    protected $_productInstance = null;
    
    public function _construct()
    {
        parent::_construct();
        $this->_init('test_specialProducts/specialProducts');
    }

    public function getProductInstance() {
        if (!$this->_productInstance) {
            $this->_productInstance = Mage::getSingleton('test_specialProducts/specialProducts_product');
        }
        return $this->_productInstance;
    }

    protected function _afterSave() {
        $this->getProductInstance()->saveSpecialProductsRelation($this);
        return parent::_afterSave();
    }

    public function getSelectedProducts() {
        if (!$this->hasSelectedProducts()) {
            $products = array();
            foreach ($this->getSelectedProductsCollection() as $product) {
                $products[] = $product;
            }
            $this->setSelectedProducts($products);
        }
        return $this->getData('selected_products');
    }

    public function getSelectedProductsCollection() {
        $collection = $this->getProductInstance()->getProductCollection($this);
        return $collection;
    }

}
