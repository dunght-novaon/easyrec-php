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


class Actions extends Api
{

    /**
     * Creates a new view.
     *
     * @param $sessionId
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param $userId
     * @param $itemImageUrl
     * @param $actionTime
     * @param $itemType
     * @param $actionInfo
     * @return array
     */
    public function view($sessionId, $itemId, $itemDescription, $itemUrl, $userId, $itemImageUrl, $actionTime, $itemType, $actionInfo)
    {
        return $this->_get("view", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "userid" => $userId,
            "itemimageurl" => $itemImageUrl,
            "actiontime" => $actionTime,
            "itemtype" => $itemType,
            "actioninfo" => $actionInfo,
        ]);
    }

    /**
     * Creates a new buy.
     *
     * @param $sessionId
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param $userId
     * @param $itemImageUrl
     * @param $actionTime
     * @param $itemType
     * @param $actionInfo
     * @return array
     */
    public function buy($sessionId, $itemId, $itemDescription, $itemUrl, $userId, $itemImageUrl, $actionTime, $itemType, $actionInfo)
    {
        return $this->_get("buy", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "userid" => $userId,
            "itemimageurl" => $itemImageUrl,
            "actiontime" => $actionTime,
            "itemtype" => $itemType,
            "actioninfo" => $actionInfo,
        ]);
    }

    /**
     * Creates a new rate.
     *
     * @param $sessionId
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param $userId
     * @param $itemImageUrl
     * @param $ratingValue
     * @param $actionTime
     * @param $itemType
     * @param $actionInfo
     * @return array
     */
    public function rate($sessionId, $itemId, $itemDescription, $itemUrl, $userId, $itemImageUrl, $ratingValue, $actionTime, $itemType, $actionInfo)
    {
        return $this->_get("rate", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "userid" => $userId,
            "itemimageurl" => $itemImageUrl,
            "ratingvalue" => $ratingValue,
            "actiontime" => $actionTime,
            "itemtype" => $itemType,
            "actioninfo" => $actionInfo,
        ]);
    }

    /**
     * Creates a new custom action.
     *
     * While the view, buy and rate calls are tailored towards a typical eCommerce shop application,
     * easyrec allows for the definition of arbitrary new action types as required by the specific use case.
     * You can use the generic sendaction API call to send actions of any type to easyrec.
     * Use the actiontype parameter to specify the action. Note: action types must be created using the Admin GUI prior to being accepted as valid API calls.
     *
     * @param $sessionId
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param $userId
     * @param $itemImageUrl
     * @param $actionType
     * @param $actionValue
     * @param $actionTime
     * @param $itemType
     * @param $actionInfo
     * @return array
     */
    public function sendAction($sessionId, $itemId, $itemDescription, $itemUrl, $userId, $itemImageUrl, $actionType, $actionValue, $actionTime, $itemType, $actionInfo)
    {
        return $this->_get("sendaction", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "userid" => $userId,
            "itemimageurl" => $itemImageUrl,
            "actiontype" => $actionType,
            "actionvalue" => $actionValue,
            "actiontime" => $actionTime,
            "itemtype" => $itemType,
            "actioninfo" => $actionInfo,
        ]);
    }

    /**
     * Creates a new track.
     *
     * The track action can be used to track clicks on recommendations.
     * It should be called when a user clicks on a recommended item.
     * This way it can be tracked if the recommendations shown to users are appreciated.
     *
     * @param $sessionId
     * @param $itemFromId
     * @param $itemFromType
     * @param $itemToId
     * @param $itemToType
     * @param $recType
     * @param $userId
     * @return array
     */
    public function track($sessionId, $itemFromId, $itemFromType, $itemToId, $itemToType, $recType, $userId)
    {
        return $this->_get("track", [
            "sessionid" => $sessionId,
            "itemfromid" => $itemFromId,
            "itemfromtype" => $itemFromType,
            "itemtoid" => $itemToId,
            "itemtotype" => $itemToType,
            "rectype" => $recType,
            "userid" => $userId,
        ]);
    }

}