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

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class ArrayResource extends AbstractResource
{
    public function __construct(array $data, $dataKey = 'data')
    {
        parent::__construct(
            $data,
            $dataKey,
            array(
                'total_item_count'    => count($data),
                'total_page_count'    => 1,
                'item_count_per_page' => count($data),
                'current_page'        => 1,
                'current_item_count'  => count($data),
            )
        );
    }
}
