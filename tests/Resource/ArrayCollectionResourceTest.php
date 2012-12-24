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

use Bgy\PaginatedResource\Resource\ArrayCollectionResource;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class ArrayCollectionResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     * @param array  $data
     * @param string $key
     */
    public function testArrayCollectionResource($data, $key, $expected)
    {
        $collection = $this->getMockBuilder('\Doctrine\Common\Collections\ArrayCollection')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $collection
            ->expects($this->any())
            ->method('toArray')
            ->will($this->returnValue($data))
        ;

        $resource = new ArrayCollectionResource($collection, $key);
        $this->assertSame($key, $resource->getDataKey());
        $this->assertSame($data, $resource->getData());
        $this->assertEquals($expected, $resource->getPaging());
    }

    public static function dataProvider()
    {
        return array(
            array(
                array('Foo', 'Bar', 'Baz', 'Fiz', 'Fuz', 'Faz'),
                'foo',
                new Paging(
                    6,
                    1,
                    6,
                    1,
                    6
                )
            ),
            array(
                range(0, 99),
                'range',
                new Paging(
                    100,
                    1,
                    100,
                    1,
                    100
                )
            )
        );
    }
}
