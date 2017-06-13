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


class Clusters extends Api
{
    /**
     * This API call will return all cluster names of a given tenant..
     *
     * @return array|mixed
     */
    public function clusters()
    {
        return $this->_get("clusters");
    }

    /**
     * This API will return all items of a given cluster.
     *
     * @param $clusterId
     * @param $strategy
     * @param $useFallback
     * @param $requestedItemType
     * @param boolean $withProfile
     * @return array|mixed
     */
    public function itemsOfCluster($clusterId, $strategy = null, $useFallback = false, $requestedItemType = null, $withProfile = false)
    {
        return $this->_get("itemsofcluster", [
            "clusterid" => $clusterId,
            "numberOfResults" => $this->getPerPage(),
            "offset" => $this->getOffset(),
            "strategy" => $strategy,
            "usefallback" => $useFallback,
            "requesteditemtype" => $requestedItemType,
            "withProfile" => $withProfile
        ]);
    }

    /**
     * With this API call you can create a new cluster.
     *
     * @param $token
     * @param $clusterId
     * @param null $clusterDescription
     * @param bool $clusterParent
     * @return array|mixed
     */
    public function view($token, $clusterId, $clusterDescription = null, $clusterParent = false)
    {
        return $this->_get("createcluster", [
            "token" => $token,
            "clusterid" => $clusterId,
            "clusterdescription" => $clusterDescription,
            "clusterparent" => $clusterParent,
        ]);
    }


}