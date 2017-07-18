<?php
$installer = $this;
$installer->startSetup();
$installer->run("
— DROP TABLE IF EXISTS {$this->getTable('test_specialproducts')};
CREATE TABLE {$this->getTable('test_specialproducts')} (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `start_date` date NOT NULL,
 `duration` int(11) NOT NULL,
 `category` int(10) unsigned NOT NULL,
 `nb_products` int(10) unsigned NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();
