@extends('admin.layout')

@section('content')
    @php
        $function_id = 5;
    @endphp
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Banner management</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Banner list</h2>
                        @if (Auth::user()->hasPermission($function_id, '1'))
                            <button data-bs-toggle="modal" data-bs-target="#addPortfolio"
                                class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i> Add
                                new
                                banner</button>
                        @endif
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
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banners as $it)
                                    <tr>
                                        <td><img src="{{ $it->image_path }}" width="90%" alt="banner"></td>
                                        <td>{!! $it->status_lable !!}</td>
                                        <td>
                                            @if (Auth::user()->hasPermission($function_id, '2'))
                                                <a href="#" class="avtar avtar-change avtar-xs btn-link-secondary"
                                                    title="Sửa đánh giá" data-bs-toggle="modal"
                                                    data-bs-target="#edit-banner-{{ $it->id }}">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>
                                            @endif
                                            @if (Auth::user()->hasPermission($function_id, '3'))
                                                <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                    title="Xóa đánh giá" data-bs-toggle="modal"
                                                    data-bs-target="#delete-banner-{{ $it->id }}">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <p class="text-center">There are no banner</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{-- {{ $banners->links('pagination::bootstrap-5') }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($banners as $it)
        <div class="modal fade" id="delete-banner-{{ $it->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Confirm deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to remove this banner?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('banner-managements.destroy', $it->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-info">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-banner-{{ $it->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Edit banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('banner-managements.update', $it->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="border rounded p-3 h-100 mb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0 f-18">Image</p>
                                    <label for="file-upload-edit-{{ $it->id }}" class="custom-file-upload">
                                        <i class="fas fa-upload"></i>
                                        Add image
                                    </label>
                                    <input type="file" class="file-upload" id="file-upload-edit-{{ $it->id }}"
                                        data-id="{{ $it->id }}" name="image" style="display: none" accept="image/*">
                                </div>

                                <div class="text-center mb-3">
                                    <p class="" id="file-info-{{ $it->id }}">You have not selected any photos
                                        yet!</p>

                                    @error('image_path')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <img src="{{ $it->image_path }}" alt="image" width="100%">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Show</label>
                                <select name="status" class="form-select" id="">
                                    <option value="1" {{ $it->status == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $it->status == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" id="addPortfolio" tabindex="-1" aria-labelledby="addPortfolioLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addPortfolioLabel">Add new banner</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('banner-managements.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-xl-12">
                            <div class="border rounded p-3 h-100 mb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0 f-18">Image</p>
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-upload"></i>
                                        Add Image
                                    </label>
                                    <input type="file" id="file-upload" name="image" style="display: none"
                                        accept="image/*">
                                </div>
                                <div class="text-center">
                                    <p class="" id="file-info">You have not selected any photos yet!</p>
                                    @error('banner')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Show</label>
                            <select name="status" class="form-select" required>
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info">Add new</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('file-upload').addEventListener('change', function(event) {
            var files = event.target.files;
            var fileInfo = document.getElementById('file-info');

            if (files.length > 0) {
                if (files.length === 1) {
                    fileInfo.textContent = "You have selected 1 file: " + files[0].name;
                } else {
                    fileInfo.textContent = "You have selected " + files.length + " file.";
                }
            } else {
                fileInfo.textContent = "No files have been selected yet.";
            }
        });
        document.querySelectorAll(".file-upload").forEach((element) => {
            element.addEventListener('change', function(event) {
                var files = event.target.files;
                var id = element.dataset.id;

                var fileInfo = document.getElementById('file-info-' + id);

                if (files.length > 0) {
                    if (files.length === 1) {
                        fileInfo.textContent = "Bạn đã chọn 1 tệp: " + files[0].name;
                    } else {
                        fileInfo.textContent = "Bạn đã chọn " + files.length + " tệp tin.";
                    }
                } else {
                    fileInfo.textContent = "Chưa chọn tệp nào.";
                }
            });
        })
    </script>
@endsection
