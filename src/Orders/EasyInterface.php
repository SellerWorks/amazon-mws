<?php

interface Easy
{
    public function listOrdersAfter(DateTimeInterface $after);
    public function listOrdersByStatus($status);
}