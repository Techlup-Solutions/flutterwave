<?php

/**
 * @author Techlup Solutions
 */

namespace Techlup\FlutterWave;

class Payment extends App
{

    /**
     * @var float the amount the customer is required to pay
     */
    private float $amount;

    /**
     * @var string the currency paid.
     */
    private string $currency = 'KES';

    /**
     * @var string the payment options.
     */
    private string $options = 'card';

    /**
     * @var string the redirect
     */
    private string $redirect_url;

    /**
     * @var Customer the customer
     */
    private Customer $customer;

    /**
     * @var string the title
     */
    private string $title = 'Checkout';

    /**
     * @var string the description
     */
    private string $description = '';


    /**
     * Constructs a new Payment class
     *
     * @param string $secret_key the secret key used to authenticate flutter-wave API
     */
    public function __construct(string $secret_key)
    {
        //initialize the parent
        parent::__construct($secret_key);
    }

    /**
     * Sets the amount
     *
     * @param float $amount the amount the customer is required to pay.
     * @returns Payment the updated instance of the Payment class.
     */
    public function setAmount(float $amount): Payment
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Sets the currency
     *
     * @param string $currency the currency paid. Default: 'KES'.
     * @returns Payment the updated instance of the Payment class.
     */
    public function setCurrency(string $currency): Payment
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Sets the payment options
     *
     * @param string $options the payment options. Default: 'card'.
     * @returns Payment the updated instance of the Payment class.
     */
    public function setOptions(string $options): Payment
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Sets the redirect URL
     *
     * @param string $redirect_url the redirect URL.
     * @returns Payment the updated instance of the Payment class.
     */
    public function setRedirectUrl(string $redirect_url): Payment
    {
        $this->redirect_url = $redirect_url;
        return $this;
    }

    /**
     * Sets the customer
     *
     * @param Customer $customer the customer.
     * @returns Payment the updated instance of the Payment class.
     */
    public function setCustomer(Customer $customer): Payment
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Sets the description
     *
     * @param string $description the description.
     * @returns Payment the updated instance of the Payment class.
     */
    public function setDescription(string $description): Payment
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Sets the title
     *
     * @param string $title the title shown on flutter-wave checkout page. Default: 'Checkout'.
     * @returns Payment the updated instance of the Payment class.
     */
    public function setTitle(string $title): Payment
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Checks Out The Customer
     *
     * @returns stdClass the response from flutter-wave API.
     */
    public function checkout(): \stdClass{

        $request = [
            'tx_ref' => time(),
            'amount' => $this->amount,
            'currency' => $this->currency,
            'payment_options' => $this->options,
            'redirect_url' => $this->redirect_url,
            'customer' => $this->customer->toArray(),
            'meta' => [
                'price' => $this->amount
            ],
            'customizations' => [
                'title' => $this->title,
                'description' => $this->description
            ]
        ];

        // Call flutter-wave endpoint
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Constants::PAYMENTS_ENDPOINT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '. $this->secret_key,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

}