<?php
namespace Propcom\ProductImporter\Controller\Adminhtml\Import;

use \Magento\Framework\App\State;
use \Magento\Catalog\Model\Product as MageProduct;
use \Magento\Backend\App\Action\Context;

class Product extends \Magento\Backend\App\Action
{
	protected $_state;
	protected $_product;
	protected $_todays_date;
	protected $_added_date;

	public function __construct(Context $context, State $state, MageProduct $product)
	{
		parent::__construct($context);

		$this->_state = $state;
		$this->_product = $product;
		$this->_todays_date = date("m/d/Y");
		$this->_added_date = date("m/d/Y", strtotime("+17 day"));
	}



	public function createSimpleProduct($options = [])
	{
		try {
			$this->_product->setWebsiteIds(array(1));
			$this->_product->setAttributeSetId(4);
			$this->_product->setTypeId('simple');
			$this->_product->setCreatedAt(strtotime('now'));
			$this->_product->setName('Test Sample Products');
			$this->_product->setSku('add-sku-1');
			$this->_product->setWeight(1.0000);
			// add weight of product
			$this->_product->setStatus(1);
			$category_id = array('4,5');
			// add your catagory id
			$this->_product->setCategoryIds($category_id);
			// Product Category
			$this->_product->setTaxClassId(0);
			// type of tax class
			// (0 - none, 1 - default, 2 - taxable, 4 - shipping)
			$this->_product->setVisibility(4);
			// catalog and search visibility
			$this->_product->setManufacturer(28);
			// manufacturer id
			$this->_product->setColor(24);
			//print_r($_product);die;
			$this->_product->setNewsFromDate($this->_todays_date);
			// product set as new from
			$this->_product->setNewsToDate($this->_added_date);
			// add image path hear
//			$this->_product->setImage('/testimg/test.jpg');
			// add small image path hear
//			$this->_product->setSmallImage('/testimg/test.jpg');
			// add Thumbnail image path hear
//			$this->_product->setThumbnail('/testimg/test.jpg');
			// product set as new to
			$this->_product->setCountryOfManufacture('UK');
			// country of manufacture (2-letter country code)
			$this->_product->setPrice(100.99);
			// price in form 100.99
			$this->_product->setCost(88.33);
			// price in form 88.33
			$this->_product->setSpecialPrice(99.85);
			// special price in form 99.85
//			$this->_product->setSpecialFromDate('06/1/2016');
			// special price from (MM-DD-YYYY)
//			$this->_product->setSpecialToDate('06/30/2018');
			// special price to (MM-DD-YYYY)
//			$this->_product->setMsrpEnabled(1);
			// enable MAP
//			$this->_product->setMsrpDisplayActualPriceType(1);
			// display actual price
			// (1 - on gesture, 2 - in cart, 3 - before order confirmation, 4 - use config)
//			$this->_product->setMsrp(99.99);
			// Manufacturer's Suggested Retail Price
			$this->_product->setMetaTitle('test meta title 2');
			$this->_product->setMetaKeyword('test meta keyword 2');
			$this->_product->setMetaDescription('test meta description 2');
			$this->_product->setDescription('This is a long description');
			$this->_product->setShortDescription('This is a short description');
			$this->_product->setStockData(
				array(
					'use_config_manage_stock' => 0,
					// checkbox for 'Use config settings'
					'manage_stock'            => 1, // manage stock
//					'min_sale_qty' => 1, // Shopping Cart Minimum Qty Allowed
//					'max_sale_qty' => 2, // Shopping Cart Maximum Qty Allowed
//					'is_in_stock' => 1, // Stock Availability of product
					'qty'                     => 100 // qty of product
				)
			);

			$this->_product->save();
			// get id of product
			$get_product_id = $this->_product->getId();
			echo "Upload simple product id :: " . $get_product_id . "\n";
		} catch (\Exception $e) {

			die($e->getMessage());
		}
	}

	public function execute()
	{


		die("Hello - backend");
	}

	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Propcom_ProductImporter::product');
	}
}
