@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Quy trình nội bộ</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="javascript: void(0)">Quản lý phẩn quyền</li>
                        <li class="breadcrumb-item" aria-current="javascript: void(0)">vai trò</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách vai trò</h2>
                        <button data-bs-toggle="modal" data-bs-target="#addRole"
                            class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i> Thêm
                            mới vai trò</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên vai trò</th>
                                    <th>Mô tả</th>
                                    <th>Tổng số nhân viên</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $it)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $it->name }}</td>
                                        <td>{{ $it->description }}</td>
                                        <td>{{ $it->users ? $it->users->count() : '0' }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editRole-{{ $it->id }}"
                                            class="employee-edit avtar avtar-xs btn-link-secondary"><i
                                            class="ti ti-edit f-20"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                class="avtar avtar-xs btn-link-secondary"
                                                data-bs-target="#deleteRole-{{ $it->id }}"><i
                                                    class="ti ti-trash f-20"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($roles as $it)
        <div class="modal fade" id="deleteRole-{{ $it->id }}" tabindex="-1"
            aria-labelledby="deleteRoleLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleLabel">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn vai trò <strong>{{ $it->name }}</strong> không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <form action="{{ route('roles.destroy', $it->id) }}" method="post"
                            style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editRole-{{ $it->id }}" tabindex="-1"
            aria-labelledby="editRoleLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleLabel">Chỉnh sửa vai trò</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('roles.update', $it->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="" class="form-lable">Tên vai trò</label>
                                <input type="text" name="name" placeholder="Nhập tên vai trò" class="form-control" required value="{{ $it->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-lable">Mô tả</label>
                                <textarea class="form-control" name="description" cols="10" rows="3">{{ $it->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" id="addRole" tabindex="-1"
        aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleLabel">Thêm mới vai trò</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên vai trò</label>
                            <input type="text" name="name" placeholder="Nhập tên vai trò" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-lable">Mô tả</label>
                            <textarea class="form-control" name="description" cols="10" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
