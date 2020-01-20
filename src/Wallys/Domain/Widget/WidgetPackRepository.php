<?php

namespace Widget;

interface WidgetPackRepository
{
    /**
     * @return WidgetPack[]
     */
    public function getAll(): array;
}
