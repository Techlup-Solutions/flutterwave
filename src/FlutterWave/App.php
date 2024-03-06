<?php

/**
 * @author Techlup Solutions
 */

namespace Techlup\FlutterWave; 

class App{

    /**
     * @var string the secret key used to authenticate flutter-wave API
     */
    protected string $secret_key;

    /**
     * Constructs a new App class
     * 
     * @param  string $secret_key the secret key used to authenticate flutter-wave API
     */
    public function __construct(string $secret_key) {
        $this->secret_key = $secret_key;
    }
    
}