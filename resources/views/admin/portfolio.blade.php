@extends('admin.layout')

@section('content')
    @php
        $function_id = 1;
    @endphp
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Portfolio management</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Portfolios list</h2>
                        @if (Auth::user()->hasPermission($function_id, '1'))
                            <button data-bs-toggle="modal" data-bs-target="#addPortfolio"
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
                                    <th>Portfolio name</th>
                                    <th>image</th>
                                    <th>content</th>
                                    <th>link</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($portfolios as $it)
                                    <tr>
                                        <td>{{ $it->name }}</td>
                                        <td><img src="{{ $it->image }}" width="90%" alt=""></td>
                                        <td>{{ $it->content }}</td>
                                        <td>{{ $it->link }}</td>
                                        <td>{{ $it->category->name }}</td>
                                        <td>
                                            @if (Auth::user()->hasPermission($function_id, '2'))
                                                <a href="#" class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                    data-id="{{ $it->id }}"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (Auth::user()->hasPermission($function_id, '3'))
                                                <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                    data-id="{{ $it->id }}"><i class="fas fa-trash"></i></a>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">There are no portfolio</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $portfolios->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dialog-edit"></div>
    <div id="dialog-delete"></div>
    <!-- Modal Thêm mới -->
    <div class="modal fade" id="addPortfolio" tabindex="-1" aria-labelledby="addPortfolioLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addPortfolioLabel">Add new portfolio</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" action="{{ route('admin.portfolios.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter portfolio name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="chucvu" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="image" placeholder="Enter portfolio logo"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="chucvu" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="categories" required>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Link</label>
                            <input type="text" class="form-control" name="link" placeholder="Enter link of portfolio"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="chucvu" class="form-label">Content</label>
                            <textarea class="form-control" rows="5" name="content" placeholder="Enter content" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add portfolio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let portfolio = {};
        const categories = <?php echo json_encode($categories); ?>;

        let emlemntCategories = '';

        categories.forEach((it) => {
            emlemntCategories += `<option value="${it.id}">${it.name}</option>`;
        });

        document.getElementById('categories').innerHTML = emlemntCategories;

        document.querySelectorAll('.avtar-edit').forEach((element) => {
            element.addEventListener('click', async function() {
                const id = element.dataset.id;
                if (id) {
                    await getPortfolio(id);
                    if (Object.keys(portfolio).length > 0) {
                        document.getElementById('dialog-edit').innerHTML = `<div class="modal fade" id="editPortfolio" tabindex="-1" aria-labelledby="editPortfolioLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="editPortfolioLabel">Edit Portfolio</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form id="addEmployeeForm" action="{{ route('admin.portfolios.update', ':id') }}" method="post" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('put')
                                                                                    <div class="row">
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label">Name</label>
                                                                                                <input type="text" class="form-control" value="${portfolio.name}" name="name" required>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="chucvu" class="form-label">Logo</label>
                                                                                                <input type="file" class="form-control" name="image" >
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="chucvu" class="form-label">Category</label>
                                                                                                <select class="form-select" name="category_id">
                                                                                                    ${categories.map((it) => {
                                                                                                        return it.id == portfolio.category_id
                                                                                                                ? `<option value="${it.id}" selected>${it.name}</option>`
                                                                                                                : `<option value="${it.id}">${it.name}</option>`;
                                                                                                    }).join('')}
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="sdt" class="form-label">Link</label>
                                                                                                <input type="text" class="form-control" name="link" value="${portfolio.link}" required>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="chucvu" class="form-label">Content</label>
                                                                                                <textarea class="form-control" rows="5" name="content">${portfolio.content}</textarea>
                                                                                            </div>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`.replace(':id', portfolio.id);
                        const modal = new bootstrap.Modal(document.getElementById('editPortfolio'));
                        modal.show();
                    }
                }
            })
        });
        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async function() {
                const id = element.dataset.id;
                if (id) {
                    await getPortfolio(id);
                    if (Object.keys(portfolio).length > 0) {
                        document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="deletePortfolio" tabindex="-1" aria-labelledby="addPortfolioLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-sx">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title" id="addPortfolioLabel">Confirm deletion of portfolio</h4>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p>Do you want to delete <strong>${portfolio.name}</strong> investment portfolio?</p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                            <form id="addEmployeeForm" action="{{ route('admin.portfolios.destroy', ':id') }}" method="post" >
                                                                                                @csrf
                                                                                                @method('delete')
                                                                                                <button type="submit" class="btn btn-primary">Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>`.replace(':id', id);
                        const modal = new bootstrap.Modal(document.getElementById('deletePortfolio'));
                        modal.show();
                    }
                }
            })
        })

        async function getPortfolio(id) {
            try {
                const response = await fetch('{{ route('admin.portfolios.show', ':id') }}'.replace(':id', id), {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (!response.ok) {
                    console.log('error', data.message);
                }
                portfolio = data.portfolio;
            } catch (error) {
                console.log('Error', error);
            }
        }
    </script>
@endsection
