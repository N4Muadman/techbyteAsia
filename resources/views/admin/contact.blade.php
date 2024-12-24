@extends('admin.layout')

@section('content')
    @php
        $function_id = 2;
    @endphp
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Feedback from customer</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Feedback list</h2>
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
                                    <th>Full name</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th style="width: 60%">Content feedback</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($feedbacks as $it)
                                    <tr>
                                        <td>{{ $it->full_name }}</td>
                                        <td>{{ $it->phone_number }}</td>
                                        <td>{{ $it->email }}</td>
                                        <td>{{ $it->content }}</td>
                                        <td>
                                            @if (Auth::user()->hasPermission($function_id, '4'))
                                                <a href="#" class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#showFeedback-{{ $it->id }}"><i
                                                        class="ti ti-eye f-18"></i></a>
                                            @endif
                                            @if (Auth::user()->hasPermission($function_id, '3'))
                                                <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteFeedback-{{ $it->id }}"><i
                                                        class="ti ti-trash f-18"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <p class="text-center">There are no feedbacks</p>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $feedbacks->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($feedbacks as $it)
        <div class="modal fade" id="deleteFeedback-{{ $it->id }}" tabindex="-1" aria-labelledby="addFeedbackLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sx">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addFeedbackLabel">Confirm deletion of feedback</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to delete feedback of <strong>{{ $it->full_name }}</strong> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('admin.feedback.delete', $it->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="showFeedback-{{ $it->id }}" tabindex="-1" aria-labelledby="showFeedbackLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="showFeedbackLabel">Feedback detail</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="">

                            <div class="col-12">
                                <p class="text-worker-profile">Full name: </p>
                                <span class="fw-bold">{{ $it->full_name }}</span>
                            </div>
                            <div class="col-12">
                                <p class="text-worker-profile">Phone number: </p>
                                <span class="fw-bold">{{ $it->phone_number }}</span>
                            </div>
                            <div class="col-12">
                                <p class="text-worker-profile">Email: </p>
                                <span class="fw-bold">{{ $it->email }}</span>
                            </div>
                            <div class="col-12">
                                <p class="text-worker-profile">Content: </p>
                                <span class="fw-bold">{{ $it->content }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
