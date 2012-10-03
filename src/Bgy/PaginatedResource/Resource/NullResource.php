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
class NullResource extends AbstractResource
{
    public function __construct($dataKey = 'data')
    {
        parent::__construct(
            array(),
            $dataKey,
            array(
                'total_item_count'    => 0,
                'total_page_count'    => 0,
                'item_count_per_page' => 0,
                'current_page'        => 0,
                'current_item_count'  => 0,
            )
        );
    }
}
