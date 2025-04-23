@extends('layout')

@section('title')
<title>Recruitment detail</title>
@endsection
@section('content')
    <div id="particles-js"></div>
    <div class="recruitment">
        <div class="page-header">
            <div class="title">Recruitment detail</div>
            <div class="title-link"><a href="{{ route('recruitment') }}">Recruitment /</a> <span>Recruitment detail</span></div>
        </div>
        <div class="recruitment-detail-content">
            <h2>{{$recruitment->position_job}}</h2>
            <div class="row mt-5">
                <div class="col-12 col-md-8 pe-md-5">
                    <p class="number-of-recruits"><b>Number of recruits: {{ $recruitment->quantity }}</b></p>
                    <p class="number-of-recruits"><b>Expiration date: {{ $recruitment->expiration_date }}</b></p>
                    <p class="number-of-recruits"><b>{{ $recruitment->application->count() }} applicants have applied</b></p>
                    <div class="description text-white">
                        {!! $recruitment->content !!}
                    </div>
                    <p class="mt-5 fs-5 text-white"><em><strong>Apply by filling out the application form below or sending an email to: <a href="mailto:ai@idai.vn">ai@idai.vn</a></strong></em></p>
                </div>
                <div class="col-12 col-md-4 mb-5 mb-md-0">
                    <div class="form-recruit">
                        <h2>Application Form</h2>
                        <form action="{{ route('applyRecruitment', $recruitment->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Full name <span>(*)</span></label>
                                <input type="text" class="form-control" name="full_name" placeholder="Enter full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Phone number <span>(*)</span></label>
                                <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email <span>(*)</span></label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Cover letter</label>
                                <textarea name="cover_letter" id=""  rows="4" class="form-control" placeholder="Enter cover letter"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">CV <span>(*)</span></label>
                                <label for="upload-file" class="form-label upload-label">
                                    Select file
                                    <span id="file-name" class="form-text">No files selected</span>
                                </label>
                                <input type="file" name="cv" id="upload-file" class="form-control d-none" required>
                                @error('cv')
                                    <p class="text-danger mt-1">Only send CVs in pdf, docx, png, jpg, jpeg</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-contact">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.getElementById('upload-file').addEventListener('change', function() {
    var fileName = this.files.length > 0 ? this.files[0].name : 'Không có file nào được chọn';
    document.getElementById('file-name').textContent = fileName;
});
</script>
@endsection
