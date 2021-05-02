<?php

namespace App\Models\Traits\Problem;

trait HasLanguage
{
  /**
   * Get all problems where problems are created or moderate(must accepted) by authenticate user
   *
   * @return boolean
   */
  public function hasLanguage($language_id)
  {
    $language = $this->languages()->where('language_id',$language_id)->first();
    // dd($language->name);
    if($language)
    {
        return true;
    }
    else
    {
        return false;
    }
  }

  
}
