<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ValueFilter extends FilterAbstract
{
  /**
   * @var mixed|string
   */
  protected string $databaseKey = '';

  public function filter(Builder $query, $value): Builder
  {
    if ($this->databaseKey) {
      return $query->where($this->databaseKey, $value);
    }
    return $query;
  }

  /**
   * @param $databaseKey
   * @return $this
   */
  public function setDatabaseKey($databaseKey): self
  {
    $this->databaseKey = $databaseKey;

    return $this;
  }
}
