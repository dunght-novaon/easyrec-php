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

namespace Hafael\Easyrec\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\RequestInterface;
use Hafael\Easyrec\Utility;
use Hafael\Easyrec\ConfigInterface;
use Hafael\Easyrec\Exception\Handler;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;

abstract class Api implements ApiInterface
{
    /**
     * The Config repository instance.
     *
     * @var \Hafael\Easyrec\ConfigInterface
     */
    protected $config;

    /**
     * Number of items to return per page.
     *
     * @var null|int
     */
    protected $perPage;

    /**
     * 0-Based index to specify with which item to start the result - useful for paging.
     *
     * @var null|int
     */
    protected $offset;

    /**
     * Constructor.
     *
     * @param  \Hafael\Easyrec\ConfigInterface $client
     * @return void
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function baseUrl()
    {
        return $this->config->getBaseUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * {@inheritdoc}
     */
    public function setPerPage($perPage)
    {
        $this->perPage = (int)$perPage;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOffset()
    {
        return $this->perPage;
    }

    /**
     * {@inheritdoc}
     */
    public function setOffset($offset)
    {
        $this->offset = (int)$offset;

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function _get($url = null, $parameters = [])
    {
        if ($perPage = $this->getPerPage()) {
            $parameters['numberOfResults'] = $perPage;
        }

        return $this->execute('get', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _head($url = null, array $parameters = [])
    {
        return $this->execute('head', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _delete($url = null, array $parameters = [])
    {
        return $this->execute('delete', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _put($url = null, array $parameters = [])
    {
        return $this->execute('put', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _patch($url = null, array $parameters = [])
    {
        return $this->execute('patch', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _post($url = null, array $parameters = [])
    {
        return $this->execute('post', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _options($url = null, array $parameters = [])
    {
        return $this->execute('options', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($httpMethod, $url, array $parameters = [], $async = false, $callback = null)
    {
        try {
            $parameters = array_merge($parameters, [
                'apikey' => isset($parameters['apiKey']) ? $parameters['apiKey'] : $this->config->getApiKey(),
                'tenantid' => isset($parameters['tenantId']) ? $parameters['tenantId'] : $this->config->getTenantId(),
                'token' => isset($parameters['token']) ? $parameters['token'] : $this->config->getToken(),
            ]);

            $parameters = Utility::transformArrayIntoHttpQuery($parameters);

            /** @var RequestInterface $request */
            $request = $this->getClient()->createRequest(
                $httpMethod,
                'api/' . $this->config->getApiVersion() . '/json/' . $url,
                [
                    'future' => $async
                ]
            );

            // set request headers
            $config = $this->config;
            if ($token = $config->getToken()) {
                $request->addHeader('Easyrec-Token', $token);
            }
            $request->addHeader('Easyrec-Version', $config->getApiVersion());
            $request->addHeader('User-Agent', 'VerdeIT-Easyrec-PHP/' . $config->getVersion());
            $request->addHeader('Authorization', 'Basic ' . base64_encode($config->getApiKey()));

            // set query
            $request->setQuery($parameters);

            // send
            $response = $this->getClient()->send($request);

            // sync handle
            if (!$async) {
                if (is_callable($callback)) {
                    call_user_func_array($callback, json_decode((string)$response->getBody(), true));
                }

                return [
                    'message' => 'success!',
                    'response' => json_decode((string)$response->getBody(), true)
                ];
            }

            // async handle
            /** @var FutureResponse $response */
            $response
                ->then(
                    function ($response) {
                        // This is called when the request succeeded
                        echo 'Success: ' . $response->getStatusCode();
                        // Returning a value will forward the value to the next promise
                        // in the chain.
                        return $response;
                    },
                    function ($error) {
                        // This is called when the exception failed.
                        echo 'Exception: ' . $error->getMessage();
                        // Throwing will "forward" the exception to the next promise
                        // in the chain.
                        throw $error;
                    }
                )
                ->then(
                    function ($response) use ($url, $callback) {
                        // This is called after the first promise in the chain. It
                        // receives the value returned from the first promise.
                        echo $response->getReasonPhrase();

                        // Add a key to the array with a list of all items' ID
                        if (Utility::doesEndpointListItems($url)) {
                            // Check that we have got the expected array
                            if (!is_null($response) AND array_key_exists('recommendedItems', $response)) {
                                // Prevent from iterating over an empty array

                                if (is_array($response->recommendedItems) AND !empty($response->recommendedItems)) {
                                    $ids = [];
                                    foreach ($response->recommendedItems as $item) {
                                        $ids[] = $item->id;
                                    }

                                    $response->listIds = $ids;
                                }
                            }
                        }

                        if (is_callable($callback)) {
                            call_user_func_array($callback, json_decode((string)$response->getBody(), true));
                        }
                    },
                    function ($error) use ($callback) {
                        // This is called if the first promise error handler in the
                        // chain rethrows the exception.
                        echo 'Error: ' . $error->getMessage();

                        if (is_callable($callback)) {
                            call_user_func_array($callback, []);
                        }
                    }
                );

            return [
                'message' => 'request sent!'
            ];
        } catch (ClientException $e) {
            new Handler($e);
        }
    }

    /**
     * Returns an Http client instance.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getClient()
    {
        return new Client([
            'base_url' => $this->baseUrl(),
            'timeout' => 5, // response
            'connect_timeout' => 5 // connection
        ]);
    }
}