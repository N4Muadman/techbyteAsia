<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleFunctionPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('users')->where('status', 0)->orderBy('name', 'ASC')->get();

        return view('admin.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => 0,
            ]);

            $functionPermission = DB::table('function_permissions')->pluck('id');

            foreach ($functionPermission as $Id){
                RoleFunctionPermission::create([
                    'role_id' => $role->id,
                    'function_permission_id' => $Id,
                    'status' => 0
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Thêm mới thành công');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $role = Role::find($id);

            if (!$role) {
                return redirect()->back()->with('error', 'Không tồn tại vai trò');
            }

            $role->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => 0,
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra' .$e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->back()->with('error', 'Không tồn tại vai trò');
        }

        $role->update(['status' => 1]);

        return redirect()->back()->with('success', 'Xóa thành công');
    }


    public function roleFunctionPermissions(Request $request){
        $roleQuery = Role::with('functionPermissions');

        if($request->role){
            $roleQuery->where('id', $request->role);
        }

        $role = $roleQuery->first();

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        $functionPermissions = $role->functionPermissions()->with(['appFunction'])->get();

        $roles = Role::where('id','!=', 1)->OrderBy('name', 'asc')->get();

        return view('admin.role.permission', compact('functionPermissions', 'roles'));
    }

    public function assignPermissionsToRoles($id){
        $roleFunctionPermission = RoleFunctionPermission::find($id);

        if (!$roleFunctionPermission) {
            return response()->json(['message' => 'Quyền của chức năng bạn vừa chọn không tồn tại'], 404);
        }

        $roleFunctionPermission->update([
            'status' => $roleFunctionPermission->status == 0 ? 1 : 0
        ]);

        return response()->json(['message' => 'Cập nhật quyền thành công'], 200);
    }
}
