<?php

namespace AnalogBridge;

class Order extends AnalogBridge
{
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    public function all($cus_id)
    {
        $url = "customers/{$cus_id}/orders";
        return $this->request("GET", $url);
    }

    public function get($cus_id, $order_id)
    {
        $url = "customers/{$cus_id}/orders/{$order_id}";
        return $this->request("GET", $url);
    }

    public function import_ready()
    {
        $url = "orders/import-ready";
        return $this->request("GET", $url);
    }
}