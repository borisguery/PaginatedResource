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

use Bgy\PaginatedResource\ResourceFactory;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class ResourceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider resourceProvider
     * @param mixed  $data
     * @param string $key
     */
    public function testResourceFactory($data, $key, $expected)
    {
        $resource = ResourceFactory::create($data, $key);
        $this->assertInstanceOf($expected, $resource);
    }

    public function testResourceFactoryThrowExceptionWhenAnUnknownTypeIsGiven()
    {
        $this->setExpectedException('\Bgy\PaginatedResource\UnknownResourceException', 'Unknown resource provided.');
        ResourceFactory::create(new \stdClass(), 'useless');
    }

    public function testResourceAddition()
    {
        ResourceFactory::addResource('\stdClass', new StubResource());

        $availableResources = ResourceFactory::getAvailableResources();

        $this->assertTrue(array_key_exists('\stdClass', $availableResources));
        $this->assertSame($availableResources['\stdClass'], 'Bgy\PaginatedResource\StubResource');
    }

    /**
     * @depends testResourceAddition
     */
    public function testCustomResource()
    {
        ResourceFactory::addResource('\stdClass', new StubResource(), true);
        ResourceFactory::create(new \stdClass(), 'anything');
    }

    public function resourceProvider()
    {
        return array(
            array(null, 'datakey', 'Bgy\PaginatedResource\Resource\NullResource'),
            array(range(1, 20), 'datakey', 'Bgy\PaginatedResource\Resource\ArrayResource'),
            array(new \Doctrine\Common\Collections\ArrayCollection(range(1, 20)), 'datakey', 'Bgy\PaginatedResource\Resource\ArrayResource'),
            array(new \Pagerfanta\Pagerfanta(new \Pagerfanta\Adapter\NullAdapter()), 'datakey', 'Bgy\PaginatedResource\Resource\PagerfantaResource'),
        );
    }
}

class StubResource implements \Bgy\PaginatedResource\Resource\ResourceInterface
{
    public function getData()
    {
        return array();
    }
}
