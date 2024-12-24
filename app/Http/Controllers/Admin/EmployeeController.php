<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employeeQuery = Employee::with('user.role');
        if ($request->name){
            $employeeQuery->where('name', 'like', '%' .$request->name .'%');
        }
        if ($request->position){
            $employeeQuery->where('position', 'like', '%' .$request->position .'%');
        }
        if ($request->role){
            $employeeQuery->whereHas('user.role', function ($query) use ($request){
                $query->where('id', $request->role);
            });
        }

        $employees = $employeeQuery->orderBy('created_at', 'DESC')->paginate(10);

        $roles = Role::OrderBy('name', 'asc')->get();
        return view('admin.employee.index', compact('employees', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 0
            ]);

            Employee::create([
                'name' => $request->name,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'position' => $request->position,
                'user_id' => $user->id
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Thêm mới nhân viên thành công');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if(!$employee){
            return redirect()->back()->with('error', 'Nhân viên không tồn tại');
        }
        $request->validate([
            'name' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:users,email,' .$employee->user_id,
            'password' => 'nullable|min:6',
        ]);

        try{
            DB::beginTransaction();

            $user = User::find($id);

            if(!$user){
                return redirect()->back()->with('error', 'Tài khoản nhân không tồn tại');
            }

            if ($request->password){
                $password = Hash::make($request->password);
            }else{
                $password = $user->password;
            }

            $user->update([
                'email' => $request->email,
                'password' => $password
            ]);

            $employee->update([
                'name' => $request->name,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'position' => $request->position,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Cập nhật nhân viên thành công');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Có lỗi  xảy ra, vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $employee = Employee::find($id);

         if (!$employee) {
            return redirect()->back()->with('error', 'Nhân viên không tồn tại');
         }

         $employee->delete();

         $user = User::find($employee->user_id);

         $user->delete();

         return redirect()->back()->with('success', 'Xóa nhân viên thành công');
    }

    public function employeeListForPermission(Request $request){
        $employeeQuery = Employee::with('user.role');
        if ($request->name){
            $employeeQuery->where('name', 'like', '%' .$request->name .'%');
        }
        if ($request->departments){
            $employeeQuery->where('department', 'like', '%' .$request->departments .'%');
        }
        if ($request->position){
            $employeeQuery->where('position', 'like', '%' .$request->position .'%');
        }
        if ($request->role){
            $employeeQuery->whereHas('user.role', function ($query) use ($request){
                $query->where('id', $request->role);
            });
        }

        $employees = $employeeQuery->orderBy('created_at', 'DESC')->paginate(10);

        $roles = Role::OrderBy('name', 'asc')->get();
        return view('admin.employee.permission-for-employee', compact('employees', 'roles'));
    }

    public function permissionsForEmployee(Request $request, $user_id){
        $user = User::find($user_id);

        if (!$user){
            return redirect()->back()->with('error', 'Tài khoản nhân viên không tồn tại');
        }

        $user->update([
            'role_id' => $request->role_id,
        ]);

        return redirect()->back()->with('success', 'Phân quyền tài khoản thành công');
    }
}
