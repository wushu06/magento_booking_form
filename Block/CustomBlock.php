<?php
namespace Tbb\Form\Block;


class CustomBlock extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    protected  $productRepository;
    protected $_categoryFactory;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        array $data = []
    )
    {
        $this->_categoryFactory = $categoryFactory;
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }


    public function loadMyProduct($sku)
    {
        return $this->productRepository->get($sku);
    }

    public function getCategory($categoryId)
    {

        $category = $this->_categoryFactory->create()->load($categoryId);

        return  $category;
    }




    public function dump($dump){
        $type = gettype($dump);
        switch ($type){
            case ('object'):
                echo $type;
                echo '<pre>';
                var_dump(get_class_methods($dump));
                echo '</pre>';
                break;
            case ('array'):
                echo $type;
                echo '<pre>';
                var_dump($dump);
                echo '</pre>';
                break;
            case ('string'):
                echo $type.' ';
                echo $dump;
                break;
            default:
                echo 'type not listed: '.$type;
                echo '<pre>';
                var_dump($dump);
                echo '</pre>';
                break;
        }
    }

}