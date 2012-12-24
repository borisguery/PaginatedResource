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

use Pagerfanta\Pagerfanta;
use Bgy\PaginatedResource\Paging;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class PagerfantaResource extends AbstractResource
{
    public function __construct(Pagerfanta $paginator, $dataKey = 'data')
    {
        parent::__construct(
            $paginator->getIterator(),
            $dataKey,
            new Paging(
                $paginator->getNbResults(),
                $paginator->getNbPages(),
                $paginator->getMaxPerPage(),
                $paginator->getCurrentPage(),
                count($paginator->getIterator())
            )
        );
    }
}
