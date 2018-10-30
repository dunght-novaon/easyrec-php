<?php

namespace Hafael\Easyrec\Tests;


class EasyrecTest extends \PHPUnit\Framework\TestCase
{
    public function testAdd()
    {
        $result = 1 + 1;
        $this->assertEquals(2, $result, 'Wrong add 1 vs 1');
        $this->assertEquals(3, $result, 'Wrong add 1 vs 1');
    }
}