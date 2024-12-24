@extends('admin.layout')

@section('style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
    @php
        $function_id = 3;
    @endphp
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">News management</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">News list</h2>
                        @if (Auth::user()->hasPermission($function_id, '1'))
                            <button data-bs-toggle="modal" data-bs-target="#addNews"
                                class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i> Add
                                new
                                item</button>
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
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Short content</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($news as $it)
                                    <tr>
                                        <td>{{ $it->id }}</td>
                                        <td>{{ $it->title }}</td>
                                        <td><img src="{{ $it->image }}" width="99%" alt=""></td>
                                        <td>{{ $it->short_content }}</td>
                                        <td>{{ $it->category }}</td>
                                        <td>{{ $it->user->name }}</td>
                                        <td>{!! $it->show == 1
                                            ? '<span class="text-success"><i class="fas fa-circle f-10 m-r-10"></i> Active</span>'
                                            : '<span class="text-secondary"><i class="fas fa-circle f-10 m-r-10"></i> Inactive</span>' !!}</td>
                                        <td>

                                            @if (Auth::user()->hasPermission($function_id, '4'))
                                                <a href="{{ route('newsDetail', $it->id) }}"
                                                    class="avtar avtar-xs btn-link-secondary"><i class="ti ti-eye f-20"></i>
                                                </a>
                                            @endif
                                            @if (Auth::user()->hasPermission($function_id, '2'))
                                                <a href="#" class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                    data-id="{{ $it->id }}"><i class="ti ti-edit f-20"></i> </a>
                                            @endif
                                            @if (Auth::user()->hasPermission($function_id, '3'))
                                                <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                    data-id="{{ $it->id }}" data-title="{{ $it->title }}"><i
                                                        class="ti ti-trash f-20"></i></a>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <p class="text-center">There are no news</p>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $news->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dialog-edit"></div>
    <div class="modal fade" id="deleteNews" tabindex="-1" aria-labelledby="deleteNewsLabel" aria-hidden="true">
        <div class="modal-dialog modal-sx">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteNewsLabel">Confirm deletion of news</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete <strong id="title-delete"></strong> investment news?</p>
                </div>
                <div class="modal-footer" id="form-delete">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Thêm mới -->
    <div class="modal fade" id="addNews" tabindex="-1" aria-labelledby="addNewsLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewsLabel">Add new news</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" action="{{ route('admin.news.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter news title"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="chucvu" class="form-label @error('image') text-danger @enderror">Image</label>
                            <input type="file" class="form-control  @error('image') b-danger @enderror" name="image"
                                required>
                            @error('image')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" placeholder="Enter category"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="chucvu" class="form-label @error('short_content') text-danger @enderror">Short
                                content</label>
                            <textarea name="short_content" rows="3" class="form-control @error('short_content') b-danger @enderror"
                                required placeholder="Enter short content"></textarea>
                            @error('short_content')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Show</label>
                            <select name="show" class="form-select">
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="chucvu" class="form-label">Content</label>
                            <div id="quill-editor" class="mb-3" style="height: 300px;">
                            </div>
                            <textarea rows="3" class="mb-3 d-none" name="content" id="quill-editor-area"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add new</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            quill('quill-editor-area', '#quill-editor')
        });
        function quill(idEditorErea, idEditor){
            if (document.getElementById(idEditorErea)) {
                var editor = new Quill(idEditor, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            
                            [{
                                'font': []
                            }],
                            [{
                                'size': ['small', false, 'large', 'huge']
                            }],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            [{
                                'header': [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['link', 'image', 'video'],
                            ['clean']
                        ]
                    }
                });
                editor.getModule('toolbar').addHandler('image', function() {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = function() {
                        var file = input.files[0];
                        if (file) {
                            var formData = new FormData();
                            formData.append('image', file);

                            fetch('{{ route('upload.image') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(result => {
                                    const url = result.url;
                                    const range = editor.getSelection();
                                    editor.insertEmbed(range.index, 'image',
                                    url);
                                })
                                .catch(error => console.error('Error uploading image:', error));
                        }
                    };
                });
                var quillEditor = document.getElementById(idEditorErea);
                editor.on('text-change', function() {
                    quillEditor.value = editor.root.innerHTML;
                });
                quillEditor.addEventListener('input', function() {
                    editor.root.innerHTML = quillEditor.value;
                });
            }
        }

        document.querySelectorAll('.avtar-edit').forEach((element) => {
            element.addEventListener('click', async function() {
                const id = element.dataset.id;
                if (id) {
                    const response = await fetch('{{ route('admin.news.edit', ':id') }}'.replace(':id',
                        id), {
                        method: "GET",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    const data = await response.text();
                    if (!response.ok) {
                        console.log('Error');
                        return;
                    }
                    document.getElementById('dialog-edit').innerHTML = data;

                    await quill('quill-editor-area-edit', '#quill-editor-edit')
                    const modal = new bootstrap.Modal(document.getElementById('editNews'));
                    modal.show();
                }
            });
        });
        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async function() {
                const id = element.dataset.id;
                const title = element.dataset.title;
                if (id) {
                    document.getElementById('form-delete').innerHTML = `
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="addEmployeeForm" action="{{ route('admin.news.destroy', ':id') }}" method="post" >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>`.replace(':id', id);
                    document.getElementById('title-delete').innerText = title;

                    const modal = new bootstrap.Modal(document.getElementById('deleteNews'));
                    modal.show();
                }
            });
        });

    </script>
@endsection
