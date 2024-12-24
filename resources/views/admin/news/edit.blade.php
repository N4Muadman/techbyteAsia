<div class="modal fade" id="editNews" tabindex="-1" aria-labelledby="editNewsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editNewsLabel">Edit news</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm" action="{{ route('admin.news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter news title" value="{{ $news->title }}" required>
                    </div>
                    <div class="mb-3" >
                        <label for="chucvu" class="form-label @error('image') text-danger @enderror">Image</label>
                        <input type="file" class="form-control  @error('image') b-danger @enderror" name="image">
                        @error('image')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Category</label>
                        <input type="text" class="form-control" name="category"  value="{{ $news->category }}" placeholder="Enter category" required>
                    </div>
                    <div class="mb-3">
                        <label for="chucvu" class="form-label @error('short_content') text-danger @enderror">Short content</label>
                        <textarea name="short_content" rows="3" class="form-control @error('short_content') b-danger @enderror" required placeholder="Enter short content">{{ $news->short_content }}</textarea>
                        @error('short_content')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Show</label>
                        <select name="show" class="form-select">
                            @if ($news->show == 1)
                                <option value="0">Inactive</option>
                                <option value="1" selected>Active</option>
                            @else
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <div id="quill-editor-edit" class="mb-3" style="height: 300px;">
                            {!! $news->content !!}
                        </div>
                        <textarea rows="3" class="mb-3 d-none" name="content" id="quill-editor-area-edit"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update new</button>
                </form>
            </div>
        </div>
    </div>
</div>
