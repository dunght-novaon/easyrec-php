<?php

namespace Hafael\Easyrec\Tests\Api;


use Hafael\Easyrec\Api\Imports;
use Hafael\Easyrec\Config;

require_once(__DIR__ . '/../../vendor/autoload.php');

class ImportsTest extends AbstractApiTest
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
        $this->api = new Imports($config);
    }

    /**
     * @return Imports
     */
    public function getApi()
    {
        return $this->api;
    }

    public function testImportRule()
    {
        $token = self::TOKEN;
        $itemToId = 'ITEMID001';
        $itemFromId = 'ITEMID002';
        $assocType = 'BOUGHT_TOGETHER';
        $assocValue = 55;

        $result = $this->getApi()->importRule(
            $token,
            $itemToId,
            $itemToType = null,
            $itemFromId,
            $itemFromType = null,
            $assocType,
            $assocValue
        );

        $this->assertTrue(is_array($result));
    }

    public function testImportItem()
    {
        $token = self::TOKEN;
        $itemId = 'ITEMID002';
        $itemDescription = 'ITEMID002 DESC';
        $itemUrl = 'http://localhost:8001/shop/ITEMID002';

        $result = $this->getApi()->importItem(
            $token,
            $itemId,
            $itemDescription,
            $itemUrl,
            $itemImageUrl = null,
            $itemType = null,
            $userId = null
        );

        $this->assertTrue(is_array($result));
    }

    public function testSetItemActive()
    {
        $token = self::TOKEN;
        $itemId = 'ITEMID002';
        $active = true;

        $result = $this->getApi()->setItemActive(
            $token,
            $itemId,
            $itemType = null,
            $active
        );

        $this->assertTrue(is_array($result));
    }

    public function testItemTypes()
    {
        $token = self::TOKEN;

        $result = $this->getApi()->itemTypes(
            $token
        );

        $this->assertTrue(is_array($result));
    }

    public function testAddItemType()
    {
        $token = self::TOKEN;
        $itemType = 'ITEM4';
        $visible = true;

        $result = $this->getApi()->addItemType(
            $token,
            $itemType,
            $visible
        );

        $this->assertTrue(is_array($result));
    }

    public function testDeleteItemType()
    {
        $token = self::TOKEN;
        $itemType = 'ITEM4';

        $result = $this->getApi()->deleteItemType(
            $token,
            $itemType
        );

        $this->assertTrue(is_array($result));
    }
}