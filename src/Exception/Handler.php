<?php
/**
 * Part of the Easyrec package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Easyrec
 * @version    0.0.1
 * @author     VerdeIT
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017-2017, VerdeIT
 * @link       https://github.com/hafael/easyrec
 */

namespace Hafael\Easyrec\Exception;

use GuzzleHttp\Exception\ClientException;


class Handler
{
    /**
     * List of mapped exceptions and their corresponding error types.
     *
     * @var array
     */
    protected $exceptionsByErrorType = [

        // Card errors are the most common type of error you should expect to handle
        'card_error' => 'CardError',

    ];

    /**
     * List of mapped exceptions and their corresponding status codes.
     *
     * @var array
     */
    protected $exceptionsByStatusCode = [

        // Often missing a required parameter
        400 => 'BadRequest', // General Bad request
        301 => 'BadRequest', //Item requires an id!
        303 => 'BadRequest', //Item requires a description!
        304 => 'BadRequest', //Item requires a URL!
        305 => 'BadRequest', //Item requires a valid Rating Value!
        308 => 'BadRequest', //Missing parameter: active (true|false)
        401 => 'BadRequest', //A session id required!

        // Invalid Stripe API key provided
        //401 => 'Unauthorized',
        299 => 'Unauthorized', //Wrong APIKey/Tenant combination!

        // Parameters were valid but request failed
        402 => 'InvalidRequest',
        910 => 'InvalidRequest', //The provided token is not valid!
        912 => 'InvalidRequest', //Operation failed! itemType XXX not found for tenant YYY

        // The requested item doesn't exist
        214 => 'NotFound', //Item does not exist!
        404 => 'NotFound', //Tenant does not exist!
        500 => 'NotFound', //ItemFrom Id does not exist!
        501 => 'NotFound', //ItemTo Id does not exist!
        502 => 'NotFound', //Association Type does not exist!
        503 => 'NotFound', //Invalid Assoc Value (use a decimal value between 0-100)!
        504 => 'NotFound', //ItemFrom Id must differ from ItemTo Id!
        300 => 'NotFound', //Item does not exist!
        700 => 'NotFound', //Cluster id required!
        701 => 'NotFound', //The provided cluster does not exist!
        799 => 'NotFound', //Cannot add cluster at this position! No parent cluster selected!


        // Something went wrong on Stripe's end
        //500 => 'ServerError',
        //502 => 'ServerError',
        //503 => 'ServerError',
        //504 => 'ServerError',

    ];

    /**
     * Constructor.
     *
     * @param  \GuzzleHttp\Exception\ClientException  $exception
     * @return void
     * @throws \Hafael\Easyrec\Exception\EasyrecException
     */
    public function __construct(ClientException $exception)
    {
        $response = $exception->getResponse();

        $statusCode = $response->getStatusCode();

        $rawOutput = json_decode($response->getBody(true), true);

        $error = isset($rawOutput['error']) ? $rawOutput['error'] : [];

        $errorCode = isset($error['code']) ? $error['code'] : null;

        $errorType = isset($error['type']) ? $error['type'] : null;

        $message = isset($error['message']) ? $error['message'] : null;

        $missingParameter = isset($error['param']) ? $error['param'] : null;

        $this->handleException(
            $message, $statusCode, $errorType, $errorCode, $missingParameter, $rawOutput
        );
    }

    /**
     * Guesses the FQN of the exception to be thrown.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @param  string  $errorType
     * @param  string  $errorCode
     * @param  string  $missingParameter
     * @return void
     * @throws \Hafael\Easyrec\Exception\EasyrecException
     */
    protected function handleException($message, $statusCode, $errorType, $errorCode, $missingParameter, $rawOutput)
    {
        if ($statusCode === 400 && $errorCode === 'rate_limit') {
            $class = 'ApiLimitExceeded';
        } elseif ($statusCode === 400 && $errorType === 'invalid_request_error') {
            $class = 'MissingParameter';
        } elseif ($statusCode === 299) {
            $class = 'MissingParameter';
        } elseif (array_key_exists($errorType, $this->exceptionsByErrorType)) {
            $class = $this->exceptionsByErrorType[$errorType];
        } elseif (array_key_exists($statusCode, $this->exceptionsByStatusCode)) {
            $class = $this->exceptionsByStatusCode[$statusCode];
        } else {
            $class = 'Easyrec';
        }

        $class = "\\Hafael\\Easyrec\\Exception\\{$class}Exception";

        $instance = new $class($message, $statusCode);

        $instance->setErrorCode($errorCode);
        $instance->setErrorType($errorType);
        $instance->setMissingParameter($missingParameter);
        $instance->setRawOutput($rawOutput);

        throw $instance;
    }
}