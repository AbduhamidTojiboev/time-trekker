<?php

namespace App\Data;

use Illuminate\Support\Carbon;

class EmployeeData extends AbstractData
{
    public function __construct(public ?int $id,
                                public string $first_name,
                                public ?string $last_name,
                                public ?string $middle_name,
                                public ?Carbon $birthdate)
    {

    }


}
