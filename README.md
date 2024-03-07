# FlutterWave Integration Documentation

This PHP script provides a demonstration of integrating with the FlutterWave API for handling subscription, deactivating subscriptions, and payments. Please note that this code is intended for testing purposes only and should be appropriately modified and secured before use in a production environment.

## Installation

1. Clone this repository to your local machine.
2. Navigate to the directory containing the cloned repository.
3. Run `composer install` to install the required dependencies.

## Configuration

- Ensure you have a FlutterWave account and obtain the required API keys.
- Set your FlutterWave secret key in the `$secrete_key` variable inside the script.

## Functions

### Create a Customer

- Description: Creates a new customer in the FlutterWave system.
- Parameters:
    - `$email`: Email address of the customer.
    - `$firstName`: First name of the customer.
    - `$lastName`: Last name of the customer.
- Returns: JSON response containing the details of the created customer.

#### Sample Code

```php
// Define customer details
$email = 'user@example.com';
$firstName = 'John';
$lastName = 'Doe';

// Create a new customer
$customer = new \Techlup\FlutterWave\Customer();
$customer->email = $email;
$customer->first_name = $firstName;
$customer->last_name= $lastName;
```

### Subscribe A User

- Description: Initiates a subscription checkout process for a customer.
- Parameters: None
- Returns: JSON response containing the checkout details.

#### Sample Code

```php
$subscription = new \Techlup\FlutterWave\Subscription($secrete_key);
$response = $subscription->setRedirectUrl($redirect_url)
    ->setCustomer($customer)
    ->setPlanId('117407')
    ->setRef('test')
    ->setAmount(10)
    ->setCurrency('KES')
    ->checkout();

print_r($response);
```

### Deactivate Subscription

- Description: Deactivates a subscription.
- Parameters: None
- Returns: JSON response confirming the deactivation of the subscription.

#### Sample Code

```php
$subscription = new \Techlup\FlutterWave\Subscription($secrete_key);
$response = $subscription->deactivate('127064');

print_r($response);
```

### Process Payment

- Description: Initiates a payment checkout process.
- Parameters: None
- Returns: JSON response containing the checkout details.

#### Sample Code

```php
$payment = new \Techlup\FlutterWave\Payment($secrete_key);
$response = $payment->setAmount(10)
    ->setRef('test')
    ->setCurrency('KES')
    ->setOptions('card')
    ->setRedirectUrl($redirect_url)
    ->setCustomer($customer)
    ->checkout();

print_r($response);
```

## Usage

1. Set up the required configuration as mentioned above.
2. Call the desired function(s) based on your integration needs.
3. Handle the responses accordingly in your application.

## Note

- This code is provided for testing purposes and should be thoroughly reviewed, modified, and secured before use in a production environment.
- Ensure that your FlutterWave account is properly configured with the necessary plans and payment options.
- Handle the responses appropriately in your application to provide feedback to users.
- Make sure to sanitize and validate user inputs before passing them to these functions to prevent security vulnerabilities.
