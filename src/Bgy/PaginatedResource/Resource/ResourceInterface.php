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
interface ResourceInterface
{
    public function getData();

    public function getPaging();

    public function getDataKey();
}
