<?php
/*
 * This file is part of the BgyPaginatedResource package.
 *
 * (c) Boris Guéry <http://borisguery.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bgy\PaginatedResource\Resource;

use Doctrine\Common\Collections\ArrayCollection;
use Pagerfanta\Pagerfanta;
use Bgy\PaginatedResource\Paging;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class PagerfantaResource extends AbstractResource
{
    public function __construct(Pagerfanta $paginator, $dataKey = 'data')
    {
        // Dirty hack to make serializer works (as expected?, at least like it used to)
        // @see https://github.com/schmittjoh/JMSSerializerBundle/commit/b8d0072bac712df31f6ada43b3ab0d44909a6a95
        $collection = new ArrayCollection();
        foreach ($paginator->getIterator() as $item) {
            $collection->add($item);
        }
        parent::__construct(
            $collection,
            $dataKey,
            new Paging(
                $paginator->getNbResults(),
                $paginator->getNbPages(),
                $paginator->getMaxPerPage(),
                $paginator->getCurrentPage(),
                count($collection)
            )
        );
    }
}
