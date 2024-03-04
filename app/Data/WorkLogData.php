<?php

namespace App\Data;

use App\Models\Employee;

class WorkLogData extends AbstractData
{
    public function __construct(public int|null $id = null,
                                public int $employee_id,
                                public ?\DateTime $date = null,
                                public ?\DateTime $start_time = null,
                                public ?\DateTime $end_time = null,
                                public ?Employee $employee = null)
    {

    }
}
