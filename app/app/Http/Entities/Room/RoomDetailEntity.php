<?php

namespace App\Http\Entities\Room;

class RoomDetailEntity
{
    /**
     * @var int|null $capacity
     */
    public ?int $capacity;

    /**
     * @var int|null $floor
     */
    public ?int $floor;

    /**
     * @var string|null $more
     */
    public ?string $more;

    /**
     * @var string|null $size
     */
    public ?string $size;

    /**
     * @var string|null $apartment_type
     */
    public ?string $apartment_type;

    /**
     * @var string|null $current_condition
     */
    public ?string $current_condition;

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->capacity          = $data['capacity'] ?? null;
        $this->floor             = $data['floor'] ?? null;
        $this->more              = $data['more'] ?? null;
        $this->size              = $data['size'] ?? null;
        $this->apartment_type    = $data['apartment_type'] ?? null;
        $this->current_condition = $data['current_condition'] ?? null;
    }
}
