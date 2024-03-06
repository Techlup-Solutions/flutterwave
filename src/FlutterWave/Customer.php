<?php

/**
 * @author Techlup Solutions
 */

namespace Techlup\FlutterWave;


class Customer{
    /**
     * @var string The customer email
     */
    public string $email;
    /**
     * @var string The customer first name
     */
    public string $first_name;
    /**
     * @var string The customer last name
     */
    public string $last_name;

    /**
     * Converts the Customer object to an associative array.
     *
     * This method retrieves the properties and their corresponding values of the Customer object
     * and returns them as an associative array.
     *
     * @return array An associative array containing the properties and their values of the Customer object.
     */
    public function toArray(): array{
        return get_object_vars($this);
    }
}