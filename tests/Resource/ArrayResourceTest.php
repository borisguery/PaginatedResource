<?php
/*
* This file is part of the BgyPaginatedResource package.
*
* (c) Boris Guéry <http://borisguery.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Bgy\PaginatedResource;

use Bgy\PaginatedResource\Resource\ArrayResource;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class ArrayResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     * @param array  $data
     * @param string $key
     */
    public function testArrayResource($data, $key, $expected)
    {
        $resource = new ArrayResource($data, $key);
        $this->assertSame($key, $resource->getDataKey());
        $this->assertSame($data, $resource->getData());
        $this->assertSame($expected, $resource->getPaging());
    }

    public static function dataProvider()
    {
        return array(
            array(
                array('Foo', 'Bar', 'Baz', 'Fiz', 'Fuz', 'Faz'),
                'foo',
                array(
                    'total_item_count'    => 6,
                    'total_page_count'    => 1,
                    'item_count_per_page' => 6,
                    'current_page'        => 1,
                    'current_item_count'  => 6,
                )
            ),
            array(
                range(0, 99),
                'range',
                array(
                    'total_item_count'    => 100,
                    'total_page_count'    => 1,
                    'item_count_per_page' => 100,
                    'current_page'        => 1,
                    'current_item_count'  => 100,
                )
            )
        );
    }
}
