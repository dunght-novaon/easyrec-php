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
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Hafael\Easyrec\Utility;
use Hafael\Easyrec\ConfigInterface;
use Psr\Http\Message\RequestInterface;
use Hafael\Easyrec\Exception\Handler;
use Psr\Http\Message\ResponseInterface;
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
     * @param  \Hafael\Easyrec\ConfigInterface  $client
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
        $this->perPage = (int) $perPage;

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
        $this->offset = (int) $offset;

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
    public function execute($httpMethod, $url, array $parameters = [])
    {
        try {
            $parameters = array_merge($parameters, [
                'apikey' => isset($parameters['apiKey'])?$parameters['apiKey']:$this->config->getApiKey(),
                'tenantid' => isset($parameters['tenantId'])?$parameters['tenantId']:$this->config->getTenantId(),
            ]);

            $parameters = Utility::prepareParameters($parameters);

            $response = $this->getClient()->{$httpMethod}('api/'.$this->config->getApiVersion().'/json/'.$url, [ 'query' => $parameters ]);

            // Add a key to the array with a list of all items' ID
            if (Utility::doesEndpointListItems($url))
            {


                // Check that we have got the expected array
                if ( ! is_null($response) AND array_key_exists('recommendedItems', $response))
                {
                    // Prevent from iterating over an empty array

                    if (is_array($response->recommendedItems) AND !empty($response->recommendedItems))
                    {
                        $ids = [];
                        foreach ($response->recommendedItems as $item)
                        {
                            $ids[] = $item->id;
                        }

                        $response->listIds = $ids;
                    }
                }
            }

            return json_decode((string) $response->getBody(), true);
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
            'base_uri' => $this->baseUrl(), 'handler' => $this->createHandler()
        ]);
    }

    /**
     * Create the client handler.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createHandler()
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {

            $config = $this->config;

            if ($idempotencykey = $config->getIdempotencyKey()) {
                $request = $request->withHeader('Idempotency-Key', $idempotencykey);
            }

            if ($accountId = $config->getAccountId()) {
                $request = $request->withHeader('Easyrec-Account', $accountId);
            }

            $request = $request->withHeader('Easyrec-Version', $config->getApiVersion());

            $request = $request->withHeader('User-Agent', 'VerdeIT-Easyrec/'.$config->getVersion());

            $request = $request->withHeader('Authorization', 'Basic '.base64_encode($config->getApiKey()));

            return $request;
        }));

        $stack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, TransferException $exception = null) {
            return $retries < 3 && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500));
        }, function ($retries) {
            return (int) pow(2, $retries) * 1000;
        }));

        return $stack;
    }
}