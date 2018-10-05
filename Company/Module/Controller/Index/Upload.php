<?php
namespace Company\Module\Controller\Index;

class Upload extends \Magento\Framework\App\Action\Action
{

    protected $_productFactory;
    protected $_storeManager;
    protected $_registry;
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_productFactory = $productFactory;
        $this->_storeManager = $storeManager;
        $this->_registry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {
        $file =  fopen($_FILES['file']['tmp_name'], "r");
        $header = fgetcsv($file); // get data headers and skip 1st row
        $summaryProduct = array();
        $required_data_fields = 3;

        while ( $row = fgetcsv($file, 3000, ",") ) {

            $data_count = count($row);
            if ($data_count < 1) {
                continue;
            }
       
            $data = array();
            $data = array_combine($header, $row);

            $productData = $this->getImagePathFromSku($data['sku']);
            
            if(is_array($productData) and !is_null($productData)) {
               array_push($summaryProduct, $productData); 
            }
            
        }

        $this->_registry->register('custom_summary_products', $summaryProduct);
        return $this->resultPageFactory->create();
    }

    public function getImagePathFromSku($sku)
    {
        $product = $this->_productFactory->create()->loadByAttribute('sku', $sku);

        if($product) {
            $mediaurl= $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $imagepath = $mediaurl.'catalog/product'.$product->getImage();
            // return 'sku : '.$sku.' - image : <img widht="150" height="150" src='.$imagepath.' />';
            $result = array('sku' => $sku, 'product_name'=> $product->getName(), 'path_image' => $imagepath);

            return $result;
        } else {
            return;
        }
    }
}
