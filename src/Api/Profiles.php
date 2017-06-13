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


class Profiles extends Api
{
    /**
     * This method stores the given profile to the item defined by the tenantid,itemid and the itemtypeid.
     * If there is already a profile it will be overwritten..
     *
     * @param $itemId
     * @param $itemType
     * @param $profile
     * @return array|mixed
     */
    public function store($itemId, $itemType, $profile)
    {
        return $this->_post("profile/store", [
            "itemid" => $itemId,
            "itemtype" => $itemType,
            "profile" => $profile,
        ]);
    }

    /**
     * This method stores the given profile to the item defined by the tenantid,itemid and the itemtypeid.
     * If there is already a profile it will be overwritten..
     *
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param null $itemImageUrl
     * @param $itemType
     * @param $profile
     * @return array|mixed
     */
    public function storeItemWithProfile($itemId, $itemDescription, $itemUrl, $itemImageUrl = null, $itemType = null, $profile)
    {
        return $this->_post("profile/storeitemwithprofile", [
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "itemimageurl" => $itemImageUrl,
            "itemtype" => $itemType,
            "profile" => $profile,
        ]);
    }

    /**
     * This method deletes the profile of the item defined by the tenantid, itemid and the itemtypeid.
     *
     * @param $itemId
     * @param null $itemType
     * @return array|mixed
     */
    public function deleteProfile($itemId, $itemType = null)
    {
        return $this->_delete("profile/delete", [
            "itemid" => $itemId,
            "itemtype" => $itemType,
        ]);
    }

    /**
     * This method deletes a specific field of the profile which belongs to the item defined by the tenantid, itemid and the itemtypeid.
     * The field can be addressed by a JSONPath expression.
     *
     * @param $itemId
     * @param null $itemType
     * @param $path
     * @return array|mixed
     */
    public function deleteProfileField($itemId, $itemType = null, $path)
    {
        return $this->_delete("profile/field/delete", [
            "itemid" => $itemId,
            "itemtype" => $itemType,
            "path" => $path
        ]);
    }


    /**
     * This method returns the profile of the item defined by the tenantid, itemid and the itemtypeid.
     *
     * @param $itemId
     * @param $itemType
     * @return array|mixed
     */
    public function load($itemId, $itemType)
    {
        return $this->_get("profile/load", [
            "itemid" => $itemId,
            "itemtype" => $itemType,
        ]);
    }

    /**
     * This method returns the profile of the item defined by the tenantid, itemid and the itemtypeid.
     *
     * @param $itemId
     * @param $itemType
     * @param $path
     * @return array|mixed
     */
    public function loadProfileField($itemId, $itemType = null, $path)
    {
        return $this->_get("profile/field/load", [
            "itemid" => $itemId,
            "itemtype" => $itemType,
            "path" => $path
        ]);
    }

    /**
     * This method stores a value into a specific field of the profile which belongs to the item defined by the tenantid, itemid and the itemtypeid.
     * The field can be addressed by a JSONPath expression.
     *
     * @param $itemId
     * @param $itemType
     * @param $path
     * @param $key
     * @param $value
     * @return array|mixed
     */
    public function storeProfileField($itemId, $itemType = null, $path, $key, $value)
    {
        return $this->_put("profile/field/store", [
            "itemid" => $itemId,
            "itemtype" => $itemType,
            "path" => $path,
            "key" => $key,
            "value" => $value,
        ]);
    }

    /**
     * This method adds a value to a specific ARRAY field of the profile which belongs to the item defined by the tenantid, itemid and the itemtypeid.
     * The field can be addressed by a JSONPath expression.
     *
     * @param $itemId
     * @param $itemType
     * @param $path
     * @param $value
     * @return array|mixed
     */
    public function pushProfileField($itemId, $itemType = null, $path, $value)
    {
        return $this->_put("profile/field/push", [
            "itemid" => $itemId,
            "itemtype" => $itemType,
            "path" => $path,
            "value" => $value,
        ]);
    }




}