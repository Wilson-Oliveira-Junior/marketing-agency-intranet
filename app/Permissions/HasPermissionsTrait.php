<?php
namespace App\Permissions;

use App\Permissao;
use App\TiposUsuario;

trait HasPermissionsTrait {

   public function roles() {
      return $this->belongsToMany(TiposUsuario::class,'tb_relacionamento_usuarios_tipos');
   }

   public function permissions() {
      return $this->belongsToMany(Permissao::class,'tb_relacionamento_usuario_permissoes');
   }
   
   public function hasRole( ... $roles ) {
      foreach ($roles as $role) {
         if ($this->roles->contains('nome', $role)) {
            return true;
         }
      }
      return false;
   }
   
   public function hasPermissionTo($permission) {
      return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
   }

   public function hasPermission($permission) {
      return (bool) $this->permissions->where('nome', $permission->nome)->count();
   }
   
   public function hasPermissionThroughRole($permission) {
      foreach ($permission->roles as $role){
         if($this->roles->contains($role)) {
            return true;
         }
      }
      return false;
   }
   
   public function givePermissionsTo(... $permissions) {
      $permissions = $this->getAllPermissions($permissions);
      dd($permissions);
      if($permissions === null) {
         return $this;
      }
      $this->permissions()->saveMany($permissions);
      return $this;
   }
   
   public function deletePermissions( ... $permissions ) {
      $permissions = $this->getAllPermissions($permissions);
      $this->permissions()->detach($permissions);
      return $this;
   }
   
   protected function getAllPermissions(array $permissions)
   {
   	return Permissao::whereIn('nome', $permissions)->get();
   }
}