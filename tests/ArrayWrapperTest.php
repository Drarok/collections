<?php

namespace Zerifas\Collections\Test;

use PHPUnit\Framework\TestCase;

use Zerifas\Collections\ArrayWrapper;

class ArrayWrapperTest extends TestCase
{
    public function testFilterAssoc()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $actual = (new ArrayWrapper($data))
            ->filter(function ($value, $key) {
                return $key !== 'key1';
            })
            ->toArray()
        ;

        $this->assertEquals($expected, $actual, 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testFilterIndexed()
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            'value2',
            'value3',
        ];

        $actual = (new ArrayWrapper($data))
            ->filter(function ($value, $key) {
                return $key > 0;
            })
            ->toArray()
        ;

        $this->assertEquals($expected, $actual, 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testMapAssoc()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            'key1' => 'key1 value1',
            'key2' => 'key2 value2',
            'key3' => 'key3 value3',
        ];

        $arr = new ArrayWrapper($data);
        $actual = $arr->map(function ($value, $key) {
            return sprintf('%s %s', $key, $value);
        });

        $this->assertEquals($expected, $actual->getArrayCopy(), 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testMapIndexed()
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            '0 value1',
            '1 value2',
            '2 value3',
        ];

        $arr = new ArrayWrapper($data);
        $actual = $arr->map(function ($value, $key) {
            return sprintf('%s %s', $key, $value);
        });

        $this->assertEquals($expected, $actual->getArrayCopy(), 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testGet()
    {
        $data = [
            0 => 'item0',
            'one' => 'item1',
        ];

        $arr = new ArrayWrapper($data);

        $this->assertEquals('item0', $arr->get(0));
        $this->assertEquals('item1', $arr->get('one'));
        $this->assertSame(null, $arr->get('no such key'));
        $this->assertSame(42, $arr->get('no such key', 42));
    }
}
