# Analog Bridge

Analog Bridge is comprised of a JavaScript client and REST API which enables
your users to import analog media directly into your app or website.

Full documentation at the [Analog Bridge docs](https://analogbridge.io/docs#php)

## Installation

Install with composer:

```php
composer require analogbridge/analog-bridge-php
```

Or download the source:

```sh
$ git clone https://github.com/analogbridge/analog-bridge-php.git
```

## Configure

Once you have your API Keys from Analog Bridge, you can initialize your configuration with your `secret_key` as

```php
$bridge = new \AnalogBridge\Customer("Your secret API Key");
```

## Usage

### Customer

#### Create Customer

To create a new customer using the API, usage

```php
$bridge = new \AnalogBridge\Customer("Your secret API Key");
$customer = $bridge->create([
    "email" => "demo@analogbridge.io",
    "shipping" => [
        "first_name" => "John",
        "last_name" => "Smith",
        "address1" => "3336 Commercial Ave",
        "city" => "Northbrook",
        "state" => "IL",
        "zip" => "60062",
        "phone" => "800-557-3508",
        "email" => "demo@analogbridge.io"
    ],
    "metadata" => [
        "user_id" => 123456
    ]
]);
```

#### Retrieve a Customer

We can easily retrieve a customer's details using their `customer_id`, for
example to find a customer with details with id `cus_12345678`

```php
$customer = $bridge->get("cus_12345678");
```

### Retrieve all customers

Analog Bridge provides an interface to retrieve all your customers very easily.
To retrieve all of your customers, you can use

```php
$customers = $bridge->all(["offset" => 100, "limit" => 100]);
```

#### Update a customer

Update an existing customer's information by using the `cus_id` from customer
creation. Any unprovided parameters will have no effect on the customer object.
The arguments for this call are mainly the same as for the customer creation
call.

```php
$bridge->update("cus_12345678", [
            "email" => "new-email@analogbridge.io",
            "shipping" => [
                "address1" => "123 Main St.",
                "city" => "New York",
                "state" => "NY",
                "zip" => "12345"
            ]
        ]);
```

#### Delete a customer

If we need to delete a customer, for example id `cus_123456789`, then we can
use

```php
$bridge->delete("cus_123456789");
```

### Order

#### List all customer orders

The Analog Bridge API allow us to retrieve all orders by a specific `customer`.
For example we want to retrieve all `orders` by customer id `cus_12345678`,
we can use

```php
$bridge = new \AnalogBridge\Order("Your secret API Key");
$order = $bridge->all("cus_3ab7aa6ec5feda6fe8a3");
```

#### List order details

If we need to retrieve the details for a specific order then we can use

```php
$order = $bridge->get("cus_3ab7aa6ec5feda6fe8a3", "ord_fe310b878dc3313c3c2e");
```

#### Retrieve import ready orders
Once customer orders have been processed and uploaded to our Cloud, they are import-ready for your system.
To retrieve the list of import ready orders, we can use

```php
$order = $bridge->import_ready();
```

### Listing Product

To retrieve the `products` simply use the following interface

```php
$bridge = new \AnalogBridge\Product();
$products = $bridge->all();
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/analogbridge/analog-bridge-php. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.


## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).
