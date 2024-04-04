<?php
use App\Models\User;
use App\Models\Role;

/**
 * Get name of user by id
 * @param  Int  $id
 * @return String
 */
function get_user_name_by_id($id) {
  return User::find($id)->name;
}

/**
 * Get name of role by id
 * @param  Int  $id
 * @return String
 */
function get_role_name_by_id($id) {
  return Role::find($id)->name;
}