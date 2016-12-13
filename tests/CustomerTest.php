<?php

namespace AnalogBridge;

class CustomerTest extends TestCase
{

    public function testCustomerCreate()
    {
        $params =[
            'email' => null,
            'metadata' => [
                'user_id' => 1616
            ],
            'shipping' => [
                'city' => 'skokie',
                'state' => 'il'
            ]
        ];

        $customer = new Customer(self::API_KEY);
        $response = $customer->create($params);

        $this->assertTrue(!empty($response->auth));

        return $response;
    }

    public function testCustomerGet()
    {
        $customer = new Customer(self::API_KEY);

        $cus_id = $this->testCustomerCreate()->cus_id;

        $response = $customer->get($cus_id);

        $this->assertTrue(!empty($response->auth));

    }

    public function testCustomerDelete()
    {
        $customer = new Customer(self::API_KEY);

        $cus_id = $this->testCustomerCreate()->cus_id;

        $customer->delete($cus_id);

        return;
    }



    public function testCustomerUpdate()
    {
        $customer = new Customer(self::API_KEY);

        $email = "test@gmail.com";
        $city = "Utopia";

        $params = [
            'email' => $email,
        ];

        $cus_id = $this->testCustomerCreate()->cus_id;

        //test update: 1. email, 2. metadata 3. shipping

        $response = $customer->update($cus_id, $params);

        $this->assertEquals($email, $response->email);

        $this->assertTrue(!empty($response->auth));

        $params2 = [
            'email' => "test@test.com",
            'metadata' => [
                'user_id' => 2616,
                'custom' => [
                    'a' => 2,
                    'b' => 3
                ]
            ],
            'shipping' => [
                'city' => $city,
                'state' => 'il'
            ]
        ];

        $response2 = $customer->update($cus_id, $params2);

        $this->assertEquals(2, count(get_object_vars($response2->metadata)));

        $this->assertEquals($city, $response2->shipping->city);
    }

}
