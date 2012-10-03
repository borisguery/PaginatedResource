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

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class ArrayCollectionResource extends ArrayResource
{
    public function __construct(ArrayCollection $data, $dataKey = 'data')
    {
        parent::__construct(
            $data->toArray(),
            $dataKey
        );
    }
}
