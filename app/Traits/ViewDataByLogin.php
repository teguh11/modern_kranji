<?php
namespace App\Traits;

trait ViewDataByLogin{
  public function viewData($query, $user_id_field = 'users.id')
  {
    if(!auth()->user()->can('view-all')){
      return $query->where($user_id_field, '=', auth()->user()->id);
    }
  }
}
?>