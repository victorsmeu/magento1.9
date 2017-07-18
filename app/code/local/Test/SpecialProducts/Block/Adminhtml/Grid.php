<?php
 
class Test_SpecialProducts_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('test_specialProducts_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setDefaultLimit(200);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('test_specialProducts/specialProducts')->getCollection();
        $collection->setPageSize(5);
        $collection->setCurPage(1);
//            ->join(array('a' => 'sales/order_address'), 'main_table.entity_id = a.parent_id AND a.address_type != \'billing\'', array(
//                'city'       => 'city',
//                'country_id' => 'country_id'
//            ))
//            ->join(array('c' => 'customer/customer_group'), 'main_table.customer_group_id = c.customer_group_id', array(
//                'customer_group_code' => 'customer_group_code'
//            ))
//            ->addExpressionFieldToSelect(
//                'fullname',
//                'CONCAT({{customer_firstname}}, \' \', {{customer_lastname}})',
//                array('customer_firstname' => 'main_table.customer_firstname', 'customer_lastname' => 'main_table.customer_lastname'))
//            ->addExpressionFieldToSelect(
//                'products',
//                '(SELECT GROUP_CONCAT(\' \', x.name)
//                    FROM sales_flat_order_item x
//                    WHERE {{entity_id}} = x.order_id
//                        AND x.product_type != \'configurable\')',
//                array('entity_id' => 'main_table.entity_id')
//            )
//        ;
 
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }
 
    protected function _prepareColumns()
    {
        $helper = Mage::helper('test_specialProducts');
 
        $this->addColumn('name', array(
            'header' => $helper->__('Name'),
            'index'  => 'name'
        ));
 
        $this->addColumn('start_date', array(
            'header' => $helper->__('Start date'),
            'type'   => 'date',
            'index'  => 'start_date'
        ));
// 
//        $this->addColumn('products', array(
//            'header'       => $helper->__('Products Purchased'),
//            'index'        => 'products',
//            'filter_index' => '(SELECT GROUP_CONCAT(\' \', x.name) FROM sales_flat_order_item x WHERE main_table.entity_id = x.order_id AND x.product_type != \'configurable\')'
//        ));
// 
//        $this->addColumn('fullname', array(
//            'header'       => $helper->__('Name'),
//            'index'        => 'fullname',
//            'filter_index' => 'CONCAT(customer_firstname, \' \', customer_lastname)'
//        ));
// 
//        $this->addColumn('city', array(
//            'header' => $helper->__('City'),
//            'index'  => 'city'
//        ));
// 
//        $this->addColumn('country', array(
//            'header'   => $helper->__('Country'),
//            'index'    => 'country_id',
//            'renderer' => 'adminhtml/widget_grid_column_renderer_country'
//        ));
// 
//        $this->addColumn('customer_group', array(
//            'header' => $helper->__('Customer Group'),
//            'index'  => 'customer_group_code'
//        ));
// 
//        $this->addColumn('grand_total', array(
//            'header'        => $helper->__('Grand Total'),
//            'index'         => 'grand_total',
//            'type'          => 'currency',
//            'currency_code' => $currency
//        ));
// 
//        $this->addColumn('shipping_method', array(
//            'header' => $helper->__('Shipping Method'),
//            'index'  => 'shipping_description'
//        ));
// 
//        $this->addColumn('order_status', array(
//            'header'  => $helper->__('Status'),
//            'index'   => 'status',
//            'type'    => 'options',
//            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
//        ));
 
 
        return parent::_prepareColumns();
    }
    
    protected function _getSelectedProducts()   // Used in grid to return selected customers values.
    {
        $customers = array_keys($this->getSelectedProducts());
        return $customers;
    }
 
    public function getSelectedProducts()
    {
        $tm_id = $this->getRequest()->getParam('id');
        if(!isset($tm_id)) {
            $tm_id = 0;
        }
        $products = array(1,2); // This is hard-coded right now, but should actually get values from database.
        $productIds = array();
 
        foreach($products as $product) {
            foreach($product as $prod) {
                $productIds[$prod] = array('position' => $prod);
            }
        }
        return $productIds;
    }
 
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
