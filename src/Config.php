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

namespace Hafael\Easyrec;


class Config implements ConfigInterface
{
    /**
     * The current package version.
     *
     * @var string
     */
    protected $version;

    /**
     * The required API Key to access this service.
     * (e.g. "8ab9dc3ffcdac576d0f298043a60517a")
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The Easyrec version.
     *
     * @var string
     */
    protected $apiVersion;

    /**
     * The required tenant id to identify your Website.
     * (e.g. "EASYREC_DEMO")
     *
     * @var string
     */
    protected $tenantId;

    /**
     * The required Easyrec server base url.
     * (e.g. "http://demo.easyrec.org")
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * The idempotency key.
     *
     * @var string
     */
    protected $idempotencyKey;

    /**
     * The managed account id.
     *
     * @var string
     */
    protected $accountId;

    /**
     * Constructor.
     *
     * @param  string  $version
     * @param  string  $baseUrl
     * @param  string  $apiKey
     * @param  string  $tenantId
     * @param  string  $apiVersion
     * @return void
     * @throws \RuntimeException
     */
    public function __construct($version, $baseUrl, $apiKey, $tenantId, $apiVersion)
    {
        $this->setVersion($version);

        $this->setBaseUrl($baseUrl ?: getenv('EASYREC_BASEURL'));

        $this->setApiKey($apiKey ?: getenv('EASYREC_API_KEY'));

        $this->setTenantId($tenantId ?: getenv('EASYREC_TENANT_ID'));

        $this->setApiVersion($apiVersion ?: getenv('EASYREC_API_VERSION') ?: '1.1');

        if (! $this->apiKey || ! $this->tenantId) {
            throw new \RuntimeException('The Easyrec API key is not defined!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritdoc}
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }

    /**
     * {@inheritdoc}
     */
    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;

        return $this;
    }



    /**
     * {@inheritdoc}
     */
    public function getIdempotencyKey()
    {
        return $this->idempotencyKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setIdempotencyKey($idempotencyKey)
    {
        $this->idempotencyKey = $idempotencyKey;

        return $this;
    }

    /**
     * Returns the managed account id.
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Sets the managed account id.
     *
     * @param  string  $accountId
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }
}