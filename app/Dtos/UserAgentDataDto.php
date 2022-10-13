<?php

declare(strict_types=1);

namespace App\Dto;

class UserAgentDataDto
{
    /**
     * @param string|null $app_name
     * @param ConnectionDto|null $connection
     * @param string|null $platform
     * @param string|null $plugin_length
     * @param string|null $vendor
     * @param string|null $user_agent
     * @param int|null $viewport_height
     * @param int|null $viewport_width
     * @param string|null $device_category
     * @param int|null $screen_height
     * @param int|null $screen_width
     */
    public function __construct
    (
        public ?string        $app_name,
        public ?ConnectionDto $connection,
        public ?string        $platform,
        public ?string        $plugin_length,
        public ?string        $vendor,
        public ?string        $user_agent,
        public ?int           $viewport_height,
        public ?int           $viewport_width,
        public ?string        $device_category,
        public ?int           $screen_height,
        public ?int           $screen_width,
    )
    {
    }
}
