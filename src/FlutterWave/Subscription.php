<?php

/**
 * @author Techlup Solutions
 */

namespace Techlup\FlutterWave;

class Subscription extends App
{
    /**
     * @var string the reference id.
     */
    private string $ref;

    /**
     * @var float the amount the customer is required to pay
     */
    private float $amount;

    /**
     * @var string the currency paid.
     */
    private string $currency = 'KES';

    /**
     * @var string the plan id
     */
    private string $plan_id;

    /**
     * @var Customer the customer
     */
    private Customer $customer;

    /**
     * @var string the redirect
     */
    private string $redirect_url;

    /**
     * @var string the title
     */
    private string $title = 'Subscribe';

    /**
     * @var string the description
     */
    private string $description = '';

    /**
     * Constructs a new Subscription class
     *
     * @param string $secret_key the secret key used to authenticate flutter-wave API
     */
    public function __construct(string $secret_key)
    {
        # initialize the parent
        parent::__construct($secret_key);
    }

    /**
     * Sets the reference
     *
     * @param string $ref the transaction reference to be used later on redirect.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setRef(string $ref): Subscription
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * Sets the amount
     *
     * @param float $amount the amount the customer is required to pay.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setAmount(float $amount): Subscription
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Sets the currency
     *
     * @param string $currency the currency paid. Default: 'KES'.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setCurrency(string $currency): Subscription
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Sets the plan id
     *
     * @param string $plan_id the flutter-wave plan id.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setPlanId(string $plan_id): Subscription
    {
        $this->plan_id = $plan_id;
        return $this;
    }

    /**
     * Sets the customer
     *
     * @param Customer $customer the customer.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setCustomer(Customer $customer): Subscription
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Sets the redirect URL
     *
     * @param string $redirect_url the redirect URL.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setRedirectUrl(string $redirect_url): Subscription
    {
        $this->redirect_url = $redirect_url;
        return $this;
    }

    /**
     * Sets the description
     *
     * @param string $description the description.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setDescription(string $description): Subscription
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Sets the title
     *
     * @param string $title the title shown on flutter-wave checkout page. Default: 'Checkout'.
     * @returns Subscription the updated instance of the Subscription class.
     */
    public function setTitle(string $title): Subscription
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

        # Define the payload
        $request = [
            'tx_ref' => $this->ref,
            'redirect_url' => $this->redirect_url,
            'customer' => $this->customer->toArray(),
            'payment_plan' => $this->plan_id,
            'amount'=> $this->amount,
            'currency'=> $this->currency,
            'meta' => [
                'price' => $this->amount
            ],
            'customizations' => [
                'title' => $this->title,
                'description' => $this->description
            ]
        ];
        # End payload.

        # Call flutter-wave endpoint
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
        # End endpoint call

        return json_decode($response);
    }

}