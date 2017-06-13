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
     * @param null $itemImageUrl
     * @param null $itemType
     * @param null $userId
     * @param null $actionTime
     * @param null $actionInfo
     * @return array|mixed
     */
    public function view($sessionId, $itemId, $itemDescription, $itemUrl, $itemImageUrl = null, $itemType = null, $userId = null, $actionTime = null, $actionInfo = null)
    {

        return $this->_get("view", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "itemimageurl" => $itemImageUrl,
            "itemtype" => $itemType,
            "userid" => $userId,
            "actiontime" => $actionTime,
            "actioninfo" => $actionInfo,
        ]);
    }

    /**
     * Creates a new buy.
     *
     *
     * @param $sessionId
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param null $itemImageUrl
     * @param null $itemType
     * @param null $userId
     * @param null $actionTime
     * @param null $actionInfo
     * @return array|mixed
     */
    public function buy($sessionId, $itemId, $itemDescription, $itemUrl, $itemImageUrl = null, $itemType = null, $userId = null, $actionTime = null, $actionInfo = null)
    {
        return $this->_get("buy", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "itemimageurl" => $itemImageUrl,
            "itemtype" => $itemType,
            "userid" => $userId,
            "actiontime" => $actionTime,
            "actioninfo" => $actionInfo,
        ]);
    }

    /**
     * Creates a new rate.
     *
     *
     * @param $sessionId
     * @param $itemId
     * @param $itemDescription
     * @param $itemUrl
     * @param int $ratingValue
     * @param null $itemImageUrl
     * @param null $itemType
     * @param null $userId
     * @param null $actionTime
     * @param null $actionInfo
     * @return array|mixed
     */
    public function rate($sessionId, $itemId, $itemDescription, $itemUrl, int $ratingValue, $itemImageUrl = null, $itemType = null, $userId = null, $actionTime = null, $actionInfo = null)
    {
        return $this->_get("rate", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "ratingvalue" => $ratingValue,
            "itemimageurl" => $itemImageUrl,
            "itemtype" => $itemType,
            "userid" => $userId,
            "actiontime" => $actionTime,
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
     * @param $itemImageUrl
     * @param $actionType
     * @param null $actionValue
     * @param null $itemType
     * @param null $userId
     * @param null $actionTime
     * @param null $actionInfo
     * @return array|mixed
     */
    public function sendAction($sessionId, $itemId, $itemDescription, $itemUrl, $itemImageUrl, $actionType, $actionValue = null, $itemType = null, $userId = null, $actionTime = null, $actionInfo = null)
    {
        return $this->_get("sendaction", [
            "sessionid" => $sessionId,
            "itemid" => $itemId,
            "itemdescription" => $itemDescription,
            "itemurl" => $itemUrl,
            "actiontype" => $actionType,
            "actionvalue" => $actionValue,
            "itemimageurl" => $itemImageUrl,
            "itemtype" => $itemType,
            "userid" => $userId,
            "actiontime" => $actionTime,
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
     * @param $recType
     * @param $itemToId
     * @param null $itemToType
     * @param null $itemFromId
     * @param null $itemFromType
     * @param null $userId
     * @return array|mixed
     */
    public function track($sessionId, $recType, $itemToId, $itemToType = null, $itemFromId = null, $itemFromType = null, $userId = null)
    {
        return $this->_get("track", [
            "sessionid" => $sessionId,
            "rectype" => $recType,
            "itemtoid" => $itemToId,
            "itemtotype" => $itemToType,
            "itemfromid" => $itemFromId,
            "itemfromtype" => $itemFromType,
            "userid" => $userId,
        ]);
    }

}