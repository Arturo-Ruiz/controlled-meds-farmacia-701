<?php  
  
namespace App\Helpers;  
  
class RoleHelper  
{  
    public static function translateRole(string $roleName): string  
    {  
        $translations = [  
            'Administrator' => 'Administrador',  
            'Manager' => 'Supervisor',  
            'Seller' => 'Vendedor',  
        ];  
  
        return $translations[$roleName] ?? $roleName;  
    }  
}