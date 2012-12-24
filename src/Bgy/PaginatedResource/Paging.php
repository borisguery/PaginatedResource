<?php

namespace Bgy\PaginatedResource;

class Paging
{
    /**
     * @var int
     */
    private $totalItemCount   = 0;

    /**
     * @var int
     */
    private $totalPageCount   = 0;

    /**
     * @var int
     */
    private $itemCountPerPage = 0;

    /**
     * @var int
     */
    private $currentPage      = 0;

    /**
     * @var int
     */
    private $currentItemCount = 0;

    /**
     * @param $totalItemCount
     * @param $totalPageCount
     * @param $itemCountPerPage
     * @param $currentPage
     * @param $currentItemCount
     */
    public function __construct($totalItemCount, $totalPageCount, $itemCountPerPage, $currentPage, $currentItemCount)
    {
        $this->totalItemCount   = (int) $totalItemCount;
        $this->totalPageCount   = (int) $totalPageCount;
        $this->itemCountPerPage = (int) $itemCountPerPage;
        $this->currentPage      = (int) $currentPage;
        $this->currentItemCount = (int) $currentItemCount;
    }

    /**
     * @return int
     */
    public function getTotalItemCount()
    {
        return $this->totalItemCount;
    }

    /**
     * @return int
     */
    public function getTotalPageCount()
    {
        return $this->totalPageCount;
    }

    /**
     * @return int
     */
    public function getItemCountPerPage()
    {
        return $this->itemCountPerPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getCurrentItemCount()
    {
        return $this->currentItemCount;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return (0 === $this->currentItemCount);
    }
}
