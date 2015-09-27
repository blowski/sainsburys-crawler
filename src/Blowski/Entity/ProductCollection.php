<?php

namespace Blowski\Entity;

class ProductCollection
{

    private $products = [];

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getSumOfUnitPrices()
    {
        $running_total = 0;
        foreach($this->products as $product) {
            $running_total += $product->getUnitPrice();
        }
        return $running_total;
    }

    public function toArray()
    {
        $products_array = [];
        foreach($this->products as $product) {
            $products_array[] = [
                'title' => $product->getTitle(),
                'size' => $product->getSize(),
                'unit_price' => number_format($product->getUnitPrice() / 100, 2),
                'description' => $product->getDescription(),
            ];
        }
        return $products_array;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

}