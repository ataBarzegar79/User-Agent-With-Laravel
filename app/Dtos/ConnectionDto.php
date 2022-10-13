<?php

declare(strict_types=1);

namespace App\Dto;

class ConnectionDto
{
    /**
     * @param int|null $down_link
     * @param string|null $effective_type
     * @param int|null $rtt
     */
    public function __construct
    (
        public ?int    $down_link,
        public ?string $effective_type,
        public ?int    $rtt
    )
    {
    }
}
