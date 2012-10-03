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
            array(
                'total_item_count'    => $paginator->getNbResults(),
                'total_page_count'    => $paginator->getNbPages(),
                'item_count_per_page' => $paginator->getMaxPerPage(),
                'current_page'        => $paginator->getCurrentPage(),
                'current_item_count'  => count($paginator->getIterator()),
            )
        );
    }
}
