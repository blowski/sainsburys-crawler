<?php

namespace Blowski\Services;

use Blowski\Entity\Product;
use Blowski\Entity\ProductCollection;
use Blowski\Nodes\CategoryPage;
use Blowski\Nodes\CategoryPageProductNode;
use Blowski\Nodes\ProductPage;
use Symfony\Component\DomCrawler\Crawler;

class CategoryPageToJsonTransformer
{

    public $page_manager;

    public function __construct(PageManager $page_manager)
    {
        $this->page_manager = $page_manager;
    }

    public function getPageManager()
    {
        return $this->page_manager;
    }

    public function transform($category_page_url, $pretty_print_json = false)
    {
        $crawler = new Crawler;
        $crawler->addHtmlContent($this->page_manager->getPage($category_page_url), 'ISO-8859-1');
        $category_page = new CategoryPage($crawler);
        $product_collection = new ProductCollection();

        $category_page->getProducts()->each( function(Crawler $category_page_product_node, $i) use ($product_collection) {
            try {
                $product_node = new CategoryPageProductNode($category_page_product_node);
                $url_of_product_page = $product_node->getProductHref();
                $crawler = new Crawler;
                $crawler->addHtmlContent($this->page_manager->getPage($url_of_product_page), 'ISO-8859-1');
                $product_page = new ProductPage($crawler);
                $product = new Product();
                $product
                    ->setTitle($product_node->getTitle())
                    ->setDescription($product_page->getDescription())
                    ->setUnitPrice($product_node->getUnitPrice())
                    ->setSize($this->page_manager->getSizeOfPage($url_of_product_page))
                ;
                $product_collection->addProduct($product);
            } catch(\InvalidArgumentException $ex) {
                return $ex->getLine() . " – " . $ex->getFile();
            }

        });

        return json_encode([
            'results' => $product_collection->toArray(),
            'total' => $product_collection->getSumOfUnitPrices() / 100
        ], $pretty_print_json ? JSON_PRETTY_PRINT : 0);
    }

}