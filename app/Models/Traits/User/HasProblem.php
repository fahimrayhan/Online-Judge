<?php

namespace App\Models\Traits\User;

trait HasProblem
{
  /**
   * Get all problems where problems are created or moderate(must accepted) by authenticate user
   *
   * @return collection
   */
  public function acceptedProblems()
  {
    return $this->problems()->wherePivot('is_accepted',true);
  }

  /**
   * Get all problems where problems are in pending list for moderate by authenticate user
   *
   * @return collection
   */
  public function pendingProblems()
  {
    return $this->problems()->wherePivot('is_accepted',false);
  }
}


?>
