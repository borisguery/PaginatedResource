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
use Bgy\PaginatedResource\Paging;

class ArrayResource extends AbstractResource
{
    public function __construct(array $data, $dataKey = 'data')
    {
        parent::__construct(
            $data,
            $dataKey,
            new Paging(
                count($data),
                1,
                count($data),
                1,
                count($data)
            )
        );
    }
}
