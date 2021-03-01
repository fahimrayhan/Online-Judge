<?php

namespace App\Models\Traits\Problem;
use Auth;


/**
 *@
 */
trait ProblemTrait
{
  /**
   * Get all problems where problems are created or moderate(must accepted) by authenticate user
   *
   * @return collection
   */
  public function acceptedProblems()
  {
    return Auth::user()->problems()->wherePivot('is_accepted',true);
  }

  /**
   * Get all problems where problems are in pending list for moderate by authenticate user
   *
   * @return collection
   */
  public function pendingProblems()
  {
    return Auth::user()->problems()->wherePivot('is_accepted',false);
  }
}





 ?>
