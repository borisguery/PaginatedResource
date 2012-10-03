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

use Bgy\PaginatedResource\Resource\ResourceInterface;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class ResourceFactory implements ResourceFactoryInterface
{
    protected static $availableResources = array(
        'NULL'                                         => '\Bgy\PaginatedResource\Resource\NullResource',
        'array'                                        => '\Bgy\PaginatedResource\Resource\ArrayResource',
        '\Doctrine\Common\Collections\ArrayCollection' => '\Bgy\PaginatedResource\Resource\ArrayCollectionResource',
        '\Pagerfanta\Pagerfanta'                       => '\Bgy\PaginatedResource\Resource\PagerfantaResource',
    );

    public static function addResource($type, ResourceInterface $resource, $override = false)
    {
        if (isset(self::$availableResources[$type]) && !$override) {
            throw new \RuntimeException('Override exception');
        }

        self::$availableResources[$type] = get_class($resource);
    }

    public static function getAvailableResources()
    {
        return self::$availableResources;
    }

    public static function create($data, $dataKey)
    {
        $resource = null;
        $dataType = gettype($data);

        if ('NULL' === $dataType) {
            $resourceClassName = self::$availableResources['NULL'];
            $resource = new $resourceClassName($dataKey);
        } elseif ('array' === $dataType) {
            $resourceClassName = self::$availableResources['array'];
            $resource = new $resourceClassName($data, $dataKey);
        } else {
            foreach (self::$availableResources as $dataType => $resourceClassName) {
                if ($data instanceof $dataType) {
                    $resource = new $resourceClassName($data, $dataKey);
                }
            }
        }

        if (null === $resource) {
            throw new UnknownResourceException('Unknown resource provided.');
        }

        return $resource;
    }
}
