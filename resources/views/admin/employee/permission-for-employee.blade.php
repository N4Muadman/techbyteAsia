@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Quy trình nội bộ</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Phân vai trò nhân viên</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách nhân viên</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('employees.index') }}" method="get">
        <div class="row mt-3">
            <div class="col-6 col-sm-2 mb-2">
                <input type="text" class="form-control" placeholder="Tìm kiếm theo tên" value="{{ request('name') }}"
                    name="name" id="">
            </div>
            <div class="col-6 col-sm-2 mb-2">
                <input type="text" class="form-control" placeholder="Tìm kiếm theo chức vụ"
                    value="{{ request('position') }}" name="position" id="">
            </div>
            <div class="col-6 col-sm-2 mb-2">
                <input type="text" class="form-control" placeholder="Tìm kiếm theo phòng ban"
                    value="{{ request('departments') }}" name="departments" id="">
            </div>

            <div class="col-6 col-sm-2 mb-2">
                <select name="role" id="" class="form-select">
                    <option value="">Tìm kiếm theo vai trò</option>
                    @foreach ($roles as $it)
                        <option value="{{ $it->id }}" {{ $it->id == request('role') ? 'selected' : '' }}>
                            {{ $it->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 d-flex d-sm-block col-sm-3 justify-content-between">
                <button type="submit" class="btn btn-info me-3">Tìm kiếm</button>
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
                                    <th>Chức vụ</th>
                                    <th>Vai trò</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $it)
                                    <tr>
                                        <td>{{ $it->name }}</td>
                                        <td>{{ $it->position }}</td>
                                        <td>{{ $it->user->role ? $it->user->role->name : 'Chưa có vai trò' }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                class="avtar avtar-xs btn-link-secondary"
                                                data-bs-target="#permission-employee-{{ $it->id }}"><i
                                                    class="fas fa-users-cog f-18"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Không có nhân viên</td>
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
        <div class="modal fade" id="permission-employee-{{ $it->id }}" tabindex="-1"
            aria-labelledby="permission-employeeLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permission-employeeLabel">Phân vai trò cho nhân viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nhân viên: <strong>{{ $it->name }}</strong></p>
                        <form action="{{ route('permissionsForEmployee', $it->user_id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Chọn vai trò</label>
                                <select name="role_id" id="" class="form-select">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id == $it->user->role_id ? 'selected' : '' }}>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
