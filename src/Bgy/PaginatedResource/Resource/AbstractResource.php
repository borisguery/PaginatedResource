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
abstract class AbstractResource implements ResourceInterface
{
    protected $paging = array(
        'total_item_count'    => null,
        'total_page_count'    => null,
        'item_count_per_page' => null,
        'current_page'        => null,
        'current_item_count'  => null,
    );

    protected $dataKey;

    protected $wrapper;

    public function __construct($data, $dataKey = 'data', $paginationData = array())
    {
        $this->dataKey = $dataKey;

        foreach ($paginationData as $key => $value) {
            if (!in_array($key, array_keys($this->paging))) {
                unset($paginationData[$key]);
            }
        }

        $this->paging = array_merge($this->paging, $paginationData);

        $this->wrapper = array(
            $dataKey => $data,
            'paging' => $this->paging,
        );
    }

    public function getData()
    {
        $key = $this->dataKey;

        return $this->wrapper[$key];
    }

    public function getPaging()
    {
        return $this->wrapper['paging'];
    }

    public function getDataKey()
    {
        return $this->dataKey;
    }
}
