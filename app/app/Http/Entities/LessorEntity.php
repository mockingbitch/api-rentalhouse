<?php

namespace App\Http\Entities;

use App\Models\User;

class LessorEntity
{
    /**
     * @var int|null $id
     */
    public ?int $id;

    /**
     * @var string|null $first_name
     */
    public ?string $first_name;

    /**
     * @var string|null $last_name
     */
    public ?string $last_name;

    /**
     * @var string|null $email
     */
    public ?string $email;

    /**
     * @var string|null $phone
     */
    public ?string $phone;

    /**
     * @var string|null $avatar
     */
    public ?string $avatar;

    /**
     * Constructor
     *
     * @param User|null $lessor
     */
    public function __construct(?User $lessor)
    {
        $this->id         = $lessor->id ?? null;
        $this->first_name = $lessor->first_name ?? null;
        $this->last_name  = $lessor->last_name ?? null;
        $this->email      = $lessor->email ?? null;
        $this->phone      = $lessor->phone ?? null;
        $this->avatar     = $lessor->avatar ?? null;
    }
}
