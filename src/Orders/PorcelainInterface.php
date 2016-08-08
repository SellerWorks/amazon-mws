<?php

/**
 * Orders Api Porcelain Methods.
 */
interface PorcelainInterface
{
    public function listOrdersAfter(DateTimeInterface $after);
    public function listOrdersByStatus($status);
}