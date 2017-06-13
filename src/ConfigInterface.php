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


interface ConfigInterface
{
    /**
     * Returns the current package version.
     *
     * @return string
     */
    public function getVersion();

    /**
     * Sets the current package version.
     *
     * @param  string  $version
     * @return $this
     */
    public function setVersion($version);

    /**
     * Returns the current Easyrec server base URL.
     *
     * @return string
     */
    public function getBaseUrl();

    /**
     * Sets the current current Easyrec server base URL.
     *
     * @param  string  $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl);

    /**
     * Returns the Easyrec API key.
     *
     * @return string
     */
    public function getApiKey();

    /**
     * Sets the Easyrec API key.
     *
     * @param  string  $apiKey
     * @return $this
     */
    public function setApiKey($apiKey);

    /**
     * Returns the Easyrec API version.
     *
     * @return string
     */
    public function getApiVersion();

    /**
     * Sets the Easyrec API version.
     *
     * @param  string  $apiVersion
     * @return $this
     */
    public function setApiVersion($apiVersion);

    /**
     * Returns the Easyrec Tenant ID.
     *
     * @return string
     */
    public function getTenantId();

    /**
     * Sets the Easyrec Tenant ID.
     *
     * @param  string  $tenantId
     * @return $this
     */
    public function setTenantId($tenantId);

    /**
     * Returns the token key.
     *
     * @return string
     */
    public function getToken();

    /**
     * Sets the token key.
     *
     * @param  string  $token
     * @return $this
     */
    public function setToken($token);
}