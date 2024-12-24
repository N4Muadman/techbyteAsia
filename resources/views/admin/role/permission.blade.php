@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Quy trình nội bộ</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="javascript: void(0)">Quản lý phân quyền</li>
                        <li class="breadcrumb-item" aria-current="javascript: void(0)">Quyền của từng vai trò</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('roleFunctionPermissions') }}" method="get">
        <div class="row mb-3">
            <div class="col-3">
                <select name="role" class="form-select">
                    <option value="">Chọn vai trò</option>
                    @foreach ($roles as $it)
                        <option value="{{ $it->id }}" {{ request('role') == $it->id ? 'selected' : '' }}>
                            {{ $it->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-sm-3 mb-2">
                <button type="submit" class="btn btn-info  me-3">Chọn</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th style="width: 25%">Chức năng</th>
                                    <th>Thêm</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                    <th>Xem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($functionPermissions->unique('function_id') as $functions)
                                    <tr>
                                        <td>{{ $functions->appFunction ? $functions->appFunction->name : ''}}</td>
                                        @php $permission = $functionPermissions->firstWhere(fn($item) => $item->function_id === $functions->function_id && $item->permission_id == 1) @endphp
                                        <td>
                                            @if ($permission)
                                                <input type="checkbox" class="checkbox-permission form-check-input"
                                                    {{ $permission->pivot->status == 1 ? 'checked' : '' }}
                                                    value="{{ $permission->pivot->id }}">
                                            @endif
                                        </td>
                                        @php $permission = $functionPermissions->firstWhere(fn($item) => $item->function_id === $functions->function_id && $item->permission_id == 2) @endphp
                                        <td>
                                            @if ($permission)
                                                <input type="checkbox" class="checkbox-permission form-check-input"
                                                    {{ $permission->pivot->status == 1 ? 'checked' : '' }}
                                                    value="{{ $permission->pivot->id }}">
                                            @endif
                                        </td>
                                        @php $permission = $functionPermissions->firstWhere(fn($item) => $item->function_id === $functions->function_id && $item->permission_id == 3) @endphp
                                        <td>
                                            @if ($permission)
                                                <input type="checkbox" class="checkbox-permission form-check-input"
                                                    {{ $permission->pivot->status == 1 ? 'checked' : '' }}
                                                    value="{{ $permission->pivot->id }}">
                                            @endif
                                        </td>
                                        @php $permission = $functionPermissions->firstWhere(fn($item) => $item->function_id === $functions->function_id && $item->permission_id == 4) @endphp
                                        <td>
                                            @if ($permission)
                                                <input type="checkbox" class="checkbox-permission form-check-input"
                                                    {{ $permission->pivot->status == 1 ? 'checked' : '' }}
                                                    value="{{ $permission->pivot->id }}">
                                            @endif
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

    <script>
        document.querySelectorAll('.checkbox-permission').forEach(element => {
            element.addEventListener('change', async function(event) {
                const id = element.value;
                const originalChecked = element.checked;
                if (id) {
                    try {
                        const response = await fetch('{{ route('set-role-permissions', ':id') }}'
                            .replace(':id', id), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                            });

                        const data = await response.json();

                        if (!response.ok) {
                            alert('Có lỗi xảy ra');
                            console.log('Có lỗi xảy ra ' + data.message);
                            element.checked = !originalChecked;
                        }

                    } catch (error) {
                        alert('Có lỗi xảy ra');
                        console.log('Có lỗi xảy ra ' + error);
                        element.checked = !originalChecked;
                    }
                }
            })
        });
    </script>
@endsection
