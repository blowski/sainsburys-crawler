<?php

namespace Blowski\Entity;

class Product
{

    protected $title;
    protected $size;
    protected $description;
    protected $unit_price;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @return Product
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return integer - notice the price will be in pence
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * @param integer $unit_price - notice the price *MUST* be in pence
     * @return Product
     */
    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;

        return $this;
    }

}