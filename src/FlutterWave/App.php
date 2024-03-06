<?php

/**
 * @author Techlup Solutions
 */

namespace Techlup\FlutterWave; 

final class App{

    /**
     * @var String the secret key used to authenticate flutter-wave API
     */
    protected String $secret_key;

    /**
     * Constructs a new App class
     * 
     * @param  String $secret_key the secret key used to authenticate flutter-wave API
     */
    public function __construct(String $secret_key) {
        $this->secret_key = $secret_key;
    }
    
}