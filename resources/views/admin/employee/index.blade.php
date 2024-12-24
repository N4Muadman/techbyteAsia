@extends('admin.layout')

@section('content')
    @php
        $function_id = 4;
    @endphp
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Personnel management</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">List employees</h2>
                        @if (Auth::user()->hasPermission($function_id, '1'))
                            <button data-bs-toggle="modal" data-bs-target="#addEmployeeModal"
                                class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i>Add employee </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('employees.index') }}" method="get">
        <div class="row mt-3">
            <div class="col-6 col-sm-3 mb-2">
                <input type="text" class="form-control" placeholder="Search by name" value="{{ request('name') }}"
                    name="name" id="">
            </div>
            <div class="col-6 col-sm-3 mb-2">
                <input type="text" class="form-control" placeholder="Search by position"
                    value="{{ request('position') }}" name="position" id="">
            </div>

            <div class="col-6 col-sm-3 mb-2">
                <select name="role" id="" class="form-select">
                    <option value="">Search by role</option>
                    @foreach ($roles as $it)
                        <option value="{{ $it->id }}" {{ $it->id == request('role') ? 'selected' : '' }}>
                            {{ $it->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 d-flex d-sm-block col-sm-3 justify-content-between">
                <button type="submit" class="btn btn-info me-3">Search</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Địa chỉ</th>
                                    <th>SDT</th>
                                    <th>Chức vụ</th>
                                    <th>Vai trò</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $it)
                                    <tr>
                                        <td>{{ $it->name }}</td>
                                        <td>{{ $it->birth_date }}</td>
                                        <td>{{ $it->gender }}</td>
                                        <td>{{ $it->address }}</td>
                                        <td>{{ $it->phone_number }}</td>
                                        <td>{{ $it->position }}</td>
                                        <td>{{ $it->user->role ? $it->user->role->name : 'Chưa có vai trò' }}</td>
                                        <td style="margin-bottom: -5px">
                                            @if (Auth::user()->hasPermission($function_id, '2'))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editEmployeeModal-{{ $it->id }}"
                                                    class="employee-edit avtar avtar-xs btn-link-secondary"><i
                                                        class="fas fa-user-edit"></i></a>
                                            @endif

                                            @if (Auth::user()->hasPermission($function_id, '3'))
                                                <a href="#" data-bs-toggle="modal"
                                                    class="avtar avtar-xs btn-link-secondary"
                                                    data-bs-target="#deleteEmployeeModal-{{ $it->id }}"><i
                                                        class="ti ti-trash f-18"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Không có nhân viên</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $employees->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($employees as $it)
        <!-- Modal Xóa -->
        <div class="modal fade" id="deleteEmployeeModal-{{ $it->id }}" tabindex="-1"
            aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteEmployeeModalLabel">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa nhân viên <strong>{{ $it->name }}</strong> không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <form action="{{ route('employees.destroy', $it->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Xoá</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Thêm mới -->
        <div class="modal fade" id="editEmployeeModal-{{ $it->id }}" tabindex="-1" aria-labelledby="editEmployeeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editEmployeeModalLabel">Chỉnh sửa nhân viên</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employees.update', $it->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label @error('email') text-danger @enderror">Email</label>
                                        <input type="email" class="form-control @error('email') border-danger @enderror"
                                            name="email" required value="{{ $it->user->email }}">
                                        @error('email')
                                            <p class="text-danger">Email không đúng hoặc đã có người sử dụng</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label @error('password') text-danger @enderror">Mật khẩu</label>
                                        <input type="password"
                                            class="form-control @error('password') border-danger @enderror"
                                            name="password" >
                                        @error('password')
                                            <p class="text-danger">Mật khẩu phải lớn hơn 6 ký tự</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Họ và tên</label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ $it->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ngày sinh</label>
                                        <input type="date" class="form-control" name="birth_date" required
                                            value="{{ $it->birth_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Giới tính</label>
                                        <select class="form-select" name="gender" required>
                                            <option value="Nam" {{ $it->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                                            <option value="Nữ" {{ $it->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                            <option value="Khác" {{ $it->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone_number" required
                                            value="{{ $it->phone_number }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" required
                                            value="{{ $it->address }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Chức vụ</label>
                                        <input type="text" class="form-control" name="position" required
                                            value="{{ $it->position }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal Thêm mới -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addEmployeeModalLabel">Thêm mới nhân viên</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" action="{{ route('employees.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label @error('email') text-danger @enderror">Email</label>
                                    <input type="email" class="form-control @error('email') border-danger @enderror"
                                        name="email" required value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger">Email không đúng hoặc đã có người sử dụng</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label @error('password') text-danger @enderror">Mật khẩu</label>
                                    <input type="password" class="form-control @error('password') border-danger @enderror"
                                        name="password" required>
                                    @error('password')
                                        <p class="text-danger">Mật khẩu phải lớn hơn 6 ký tự</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" name="name" required
                                        value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày sinh</label>
                                    <input type="date" class="form-control" name="birth_date" required
                                        value="{{ old('birth_date') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giới tính</label>
                                    <select class="form-select" name="gender" required>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="Khác">Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number" required
                                        value="{{ old('phone_number') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" required
                                        value="{{ old('address') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Chức vụ</label>
                                    <input type="text" class="form-control" name="position" required
                                        value="{{ old('position') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
