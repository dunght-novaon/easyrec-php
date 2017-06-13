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


class Imports extends Api
{
    /**
     * This call imports a rule.
     *
     * @param $token
     * @param $itemToId
     * @param null $itemToType
     * @param $itemFromId
     * @param null $itemFromType
     * @param null $assocType
     * @param null $assocValue
     * @return array|mixed
     */
    public function importRule($token, $itemToId, $itemToType = null, $itemFromId, $itemFromType = null, $assocType = null, $assocValue = null)
    {
        return $this->_get("importrule", [
            "token" => $token,
            "itemtoid" => $itemToId,
            "itemtotype" => $itemToType,
            "itemfromid" => $itemFromId,
            "itemfromtype" => $itemFromType,
            "assoctype" => $assocType,
            "assocvalue" => $assocValue,
        ]);
    }

    /**
     * This call imports or updates an item..
     *
     * @param $token
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param null $itemImageUrl
     * @param null $itemType
     * @param null $userId
     * @return array|mixed
     */
    public function importItem($token, $itemId, $itemDescription, $itemUrl, $itemImageUrl = null, $itemType = null, $userId = null)
    {
        return $this->_get("importitem", [
            "token" => $token,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "itemimageurl" => $itemImageUrl,
            "itemtype" => $itemType,
            "userid" => $userId,
        ]);
    }

    /**
     * This call sets an item active or inactive.
     *
     * @param $token
     * @param $itemId
     * @param null $itemType
     * @param $active
     *
     * @return array|mixed
     */
    public function setItemActive($token, $itemId, $itemType = null, $active)
    {
        return $this->_get("setitemactive", [
            "token" => $token,
            "itemid" => $itemId,
            "itemtype" => $itemType,
            "active" => $active,
        ]);
    }

    /**
     * If you want to load all item types of your tenant you can use the following API call
     *
     * @param $token
     * @return array|mixed
     */
    public function itemTypes($token)
    {
        return $this->_get("itemtypes", [
            "token" => $token
        ]);
    }

    /**
     * You can add an item type to your tenant using the following API call
     *
     * @param $token
     * @param $itemType
     * @param $visible
     * @return array|mixed
     */
    public function addItemType($token, $itemType, $visible)
    {
        return $this->_get("additemtype", [
            "token" => $token,
            "itemtype" => $itemType,
            "visible" => $visible,
        ]);
    }

    /**
     * You can delete an item type from your tenant using the following API call
     *
     * @param $token
     * @param $itemType
     * @return array|mixed
     */
    public function deleteItemType($token, $itemType)
    {
        return $this->_get("deleteitemtype", [
            "token" => $token,
            "itemtype" => $itemType,
        ]);
    }


}