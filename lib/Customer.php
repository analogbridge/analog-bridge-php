<?php

namespace AnalogBridge;

class Customer extends AnalogBridge
{
    public function __construct($apiKey = null)
    {
        parent::__construct($apiKey);
    }

    public function get($cus_id)
    {
        $url = "customers/" . $cus_id;
        return $this->request("GET", $url);
    }

    public function delete($cus_id)
    {
        $url = "customers/" . $cus_id;
        return $this->request("DELETE", $url);
    }

    public function create($params)
    {
        $url = "customers";
        return $this->request("POST", $url, $params);
    }

    public function update($cus_id, $params)
    {
        $url = "customers/" . $cus_id;
        return $this->request("POST", $url, $params);
    }

    public function all($params = [])
    {
        $url = "customers";
        return $this->request("GET", $url, $params);
    }
}