<?php

namespace App\Http\Entities\Room;

use App\Http\Entities\HouseEntity;
use App\Models\Room;

class RoomEntity
{
    /**
     * @var string|null
     */
    public ?string $id;

    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var int|null $house_id
     */
    public ?int $house_id;

    /**
     * @var string|null $description
     */
    public ?string $description;

    /**
     * @var RoomDetailEntity|null $detail
     */
    public ?RoomDetailEntity $detail;

    /**
     * @var array|null $images
     */
    public ?array $images;

    /**
     * @var array|null $tags
     */
    public ?array $tags;

    /**
     * @var float|null $price
     */
    public ?float $price;

    /**
     * @var string|null  $status
     */
    public ?string $status;

    /**
     * @var string|null $created_by
     */
    public ?string $created_by;

    /**
     * @var string|null $updated_by
     */
    public ?string $updated_by;

    /**
     * @var string|null $deleted_by
     */
    public ?string $deleted_by;

    /**
     * @var string|null $created_at
     */
    public ?string $created_at;

    /**
     * @var string|null $updated_at
     */
    public ?string $updated_at;

    /**
     * @var string|null $deleted_at
     */
    public ?string $deleted_at;

    /**
     * Constructor
     *
     * @param Room $room
     * @param bool $hasPermission
     */
    public function __construct(Room $room, bool $hasPermission = false)
    {
        $this->id           = $room->id ?? null;
        $this->name         = $room->name ?? null;
        $this->house_id     = $room->house_id ?? null;
        $this->description  = $room->description ?? null;
        $this->detail       = new RoomDetailEntity($room->detail ?? null);
        $this->images       = $room->images ?? null;
        $this->tags         = $room->tags ?? null;
        $this->price        = $room->price ?? null;
        $this->status       = $room->status ?? null;
        if ($hasPermission) :
            $this->created_by   = $room->created_by ?? null;
            $this->updated_by   = $room->updated_by ?? null;
            $this->deleted_by   = $room->deleted_by ?? null;
            $this->created_at   = $room->created_at ?? null;
            $this->updated_at   = $room->updated_at ?? null;
            $this->deleted_at   = $room->deleted_at ?? null;
        endif;
    }
}
