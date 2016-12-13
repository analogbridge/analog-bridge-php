<?php

namespace AnalogBridge;

class Product extends AnalogBridge
{
    public function __construct()
    {
        $this->keyRequired = false;
        parent::__construct();
    }

    public function all()
    {
        $url = "products";
        return $this->request("GET", $url);
    }
}