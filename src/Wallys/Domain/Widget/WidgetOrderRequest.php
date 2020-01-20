<?php

declare(strict_types=1);

namespace Widget;

class WidgetOrderRequest
{
    private int $numberOfWidgets;

    public function __construct(int $numberOfWidgets)
    {
        $this->numberOfWidgets = $numberOfWidgets;
    }

    /**
     * @return int
     */
    public function getNumberOfWidgets(): int
    {
        return $this->numberOfWidgets;
    }
}
