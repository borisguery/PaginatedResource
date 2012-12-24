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

use Bgy\PaginatedResource\Resource\NullResource;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class NullResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testNullResource()
    {
        $resource = new NullResource('datakey');
        $this->assertEmpty($resource->getData());
        $paging = $resource->getPaging();

        $emptyPaging = new Paging(0,0,0,0,0);
        $this->assertEquals($emptyPaging, $paging);
    }
}
