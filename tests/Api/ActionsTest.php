<?php

namespace Hafael\Easyrec\Tests\Api;


use Hafael\Easyrec\Api\Actions;
use Hafael\Easyrec\Config;

require_once(__DIR__ . '/../../vendor/autoload.php');

class ActionsTest extends AbstractApiTest
{
    public function createApi()
    {
        // config
        $config = new Config(
            self::VERSION,
            self::BASE_URL,
            self::API_KEY,
            self::TENANT_ID,
            self::API_VERSION,
            self::TOKEN
        );

        // api
        $this->api = new Actions($config);
    }

    /**
     * @return Actions
     */
    public function getApi()
    {
        return $this->api;
    }

    public function testView()
    {
        $sessionId = 'SESSIONID001';
        $itemId = 'ITEMID001';
        $itemDescription = 'ITEMID001 DESC';
        $itemUrl = 'http://localhost:8001/shop/ITEMID001';

        $result = $this->getApi()->view(
            $sessionId,
            $itemId,
            $itemDescription,
            $itemUrl,
            $itemImageUrl = null,
            $itemType = null,
            $userId = null,
            $actionTime = null,
            $actionInfo = null
        );

        $this->assertTrue(is_array($result));
    }

    public function testBuy()
    {
        $sessionId = 'dddd';
        $itemId = 'ddd';
        $itemDescription = 'ddd';
        $itemUrl = 'dddd';

        $result = $this->getApi()->buy(
            $sessionId,
            $itemId,
            $itemDescription,
            $itemUrl,
            $itemImageUrl = null,
            $itemType = null,
            $userId = null,
            $actionTime = null,
            $actionInfo = null
        );

        $this->assertTrue(is_array($result));
    }

    public function testRate()
    {
        $sessionId = 'dddd';
        $itemId = 'ddd';
        $itemDescription = 'ddd';
        $itemUrl = 'dddd';
        $ratingValue = 4;

        $result = $this->getApi()->rate(
            $sessionId,
            $itemId,
            $itemDescription,
            $itemUrl,
            $ratingValue,
            $itemImageUrl = null,
            $itemType = null,
            $userId = null,
            $actionTime = null,
            $actionInfo = null
        );

        $this->assertTrue(is_array($result));
    }

    public function testSendAction()
    {
        $sessionId = 'dddd';
        $itemId = 'ddd';
        $itemDescription = 'ddd';
        $itemUrl = 'dddd';
        $ratingValue = 4;
        $actionType = 'fdf';
        $actionValue = 'fdf';

        $result = $this->getApi()->sendAction(
            $sessionId,
            $itemId,
            $itemDescription,
            $itemUrl,
            $itemImageUrl = null,
            $actionType,
            $actionValue,
            $itemType = null,
            $userId = null,
            $actionTime = null,
            $actionInfo = null
        );

        $this->assertTrue(is_array($result));
    }

    public function testTrack()
    {
        $sessionId = 'fdsfs';
        $recType = 'fdsfs';
        $itemToId = 'fdsfs';

        $result = $this->getApi()->track(
            $sessionId,
            $recType,
            $itemToId,
            $itemToType = null,
            $itemFromId = null,
            $itemFromType = null,
            $userId = null
        );

        $this->assertTrue(is_array($result));
    }
}