<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class  AdminService {

    //     public function createAdmin($data)
    //     {
    // //        if ($data['name'] && $data['name'] != null) {
    // //            $data['name'] = customizeSingleName($data['name']);
    // //        }
    //         $new_admin = DB::table('users')->insertGetId([
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //             'password' => Hash::make($data['password']),
    //             'is_admin' => 1,
    //         ]);
    //         dd($new_admin);
    //         $admin = User::find();
    //         $role = Role::findById($data['role_id']);
    //         $admin->assignRole($role);
    //     }

    //     public function updateAdmin($admin , $data){

    //         $admin->update([
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //         ]);
    //         if (array_key_exists('password', $data) && $data['password'] != '') {
    //             $admin->update([
    //                 'password' => $data['password'],
    //             ]);
    //         }
    //         $role = Role::findById($data['role_id']);

    //         $admin->syncRoles($role->name);

    //     }
    // public function createAdmin($data)
    // {
    //     // إذا كان الاسم موجودًا وغير فارغ، يمكنك تخصيصه
    //     if (!empty($data['name'])) {
    //         $data['name'] = customizeSingleName($data['name']);
    //     }

    //     // dd($data);

    //     $new_admin = DB::table('users')->insertGetId([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'is_admin' => 1,
    //         // 'phone' => $data['phone'] ?? null, 
    //     ]);

    //     // dd($new_admin);

    //     $admin = User::find($new_admin);
    //     $role = Role::findById($data['role_id'], 'admin');
    //     $admin->assignRole($role);
    // }

    public function createAdmin($data)
    {
        // dd($data); 
        if (!empty($data['name'])) {
            $data['name'] = customizeSingleName($data['name']);
        }
        $new_admin = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'branche_id' => $data['branche_id'],
            'password' => Hash::make($data['password']),
            'is_admin' => 1,
        ]);

        $role = Role::findById($data['role_id'], 'admin');
        $new_admin->assignRole($role);
    }




    // public function updateAdmin(User $user, array $data)
    // {
    //      $updatedData = [
    //         'name' => $data['name'] ?? $user->name,
    //         'branche_id' => $data['branche_id'] ?? $user->branche_id,
    //         'email'    => $data['email'] ?? $user->email,
    //         'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
    //         'username' => $data['username'] ?? $user->username,
    //     ];
    //     $user->update($updatedData);
    // }

    public function updateAdmin(User $user, array $data)
{
    // تحضير البيانات المحدثة
    $updatedData = [
        'name' => $data['name'] ?? $user->name,
        'branche_id' => $data['branche_id'] ?? $user->branche_id,
        'email'    => $data['email'] ?? $user->email,
        'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
        'username' => $data['username'] ?? $user->username,
    ];

    // تحديث البيانات في الجدول
    $user->update($updatedData);

    // التحقق من وجود الدور (Role) في البيانات المُرسلة
    if (!empty($data['role_id'])) {
        $role = Role::findById($data['role_id'], 'admin'); // البحث عن الدور في الحرس "admin"
        $user->syncRoles([$role]); // مزامنة الأدوار (إزالة الأدوار القديمة وإضافة الجديدة)
    }
}






    public function deleteAdmin($admin){
        $admin->delete();
    }


}
