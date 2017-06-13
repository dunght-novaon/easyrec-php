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


class Rankings extends Api
{
    /**
     * This community ranking shows items that were viewed most by all users. 50 items are returned at most, results are sorted by relevance.
     *
     * @param null $clusterId
     * @param null $requestedItemType
     * @param null $timeRange
     * @return array|mixed
     */
    public function mostViewedItems($clusterId = null, $requestedItemType = null, $withProfile = null, $timeRange = null, $startDate = null, $endDate = null)
    {
        return $this->_get("mostvieweditems", [
            "clusterid" => $clusterId,
            "requesteditemtype" => $requestedItemType,
            "withProfile" => $withProfile,
            "timeRange" => $timeRange,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "numberOfResults" => $this->getPerPage(),
            "offset" => $this->getOffset(),
        ]);
    }

    /**
     * This community ranking shows items that were bought the most. No more than 50 items are returned, results are sorted by relevance.
     *
     * @param null $clusterId
     * @param null $requestedItemType
     * @param null $timeRange
     * @return array|mixed
     */
    public function mostBoughtItems($clusterId = null, $requestedItemType = null, $withProfile = null, $timeRange = null, $startDate = null, $endDate = null)
    {
        return $this->_get("mostboughtitems", [
            "clusterid" => $clusterId,
            "requesteditemtype" => $requestedItemType,
            "withProfile" => $withProfile,
            "timeRange" => $timeRange,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "numberOfResults" => $this->getPerPage(),
            "offset" => $this->getOffset(),
        ]);
    }

    /**
     * This community ranking shows items that were rated the most. No more than 50 items are returned, results are sorted by relevance.
     *
     * @param null $clusterId
     * @param null $requestedItemType
     * @param null $timeRange
     * @return array|mixed
     */
    public function mostRatedItems($clusterId = null, $requestedItemType = null, $withProfile = null, $timeRange = null, $startDate = null, $endDate = null)
    {
        return $this->_get("mostrateditems", [
            "clusterid" => $clusterId,
            "requesteditemtype" => $requestedItemType,
            "withProfile" => $withProfile,
            "timeRange" => $timeRange,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "numberOfResults" => $this->getPerPage(),
            "offset" => $this->getOffset(),
        ]);
    }

    /**
     * This community ranking shows the best rated items. Rating values range from 1 to 10.
     * The ranking only includes items that have an average ranking value greater than 5.5. No more than 50 items are returned, results are sorted by relevance.
     *
     * @param null $clusterId
     * @param null $userId
     * @param null $requestedItemType
     * @param null $withProfile
     * @param null $timeRange
     * @param null $startDate
     * @param null $endDate
     * @return array|mixed
     */
    public function bestRatedItems($clusterId = null, $userId = null, $requestedItemType = null, $withProfile = null, $timeRange = null, $startDate = null, $endDate = null)
    {
        return $this->_get("bestrateditems", [
            "clusterid" => $clusterId,
            "userid" => $userId,
            "requesteditemtype" => $requestedItemType,
            "withProfile" => $withProfile,
            "timeRange" => $timeRange,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "numberOfResults" => $this->getPerPage(),
            "offset" => $this->getOffset(),
        ]);
    }

    /**
     * This community ranking shows the worst rated items. Rating values range from 1 to 10.
     * The ranking only includes items that have an average ranking value less than 5.5. No more than 50 items are returned, results are sorted by relevance.
     *
     * @param null $clusterId
     * @param null $userId
     * @param null $requestedItemType
     * @param null $withProfile
     * @param null $timeRange
     * @param null $startDate
     * @param null $endDate
     * @return array|mixed
     */
    public function worstRatedItems($clusterId = null, $userId = null, $requestedItemType = null, $withProfile = null, $timeRange = null, $startDate = null, $endDate = null)
    {
        return $this->_get("worstrateditems", [
            "clusterid" => $clusterId,
            "userid" => $userId,
            "requesteditemtype" => $requestedItemType,
            "withProfile" => $withProfile,
            "timeRange" => $timeRange,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "numberOfResults" => $this->getPerPage(),
            "offset" => $this->getOffset(),
        ]);
    }




}