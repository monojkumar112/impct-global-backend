@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Contact Page</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Contact Page</h6>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.contact_page.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <h6 class="mb-3 text-muted">Page Header</h6>
                            <div class="mb-3">
                                <label class="form-label">Badge Text</label>
                                <input type="text" name="page_badge" class="form-control" value="{{ old('page_badge', $contactPage->page_badge) }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Page Title</label>
                                <input type="text" name="page_title" class="form-control" value="{{ old('page_title', $contactPage->page_title) }}">
                            </div>

                            <h6 class="mb-3 text-muted">Info Card</h6>
                            <div class="mb-3">
                                <label class="form-label">Card Badge</label>
                                <input type="text" name="card_badge" class="form-control" value="{{ old('card_badge', $contactPage->card_badge) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Card Title</label>
                                <input type="text" name="card_title" class="form-control" value="{{ old('card_title', $contactPage->card_title) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Card Description</label>
                                <textarea name="card_description" rows="3" class="form-control">{{ old('card_description', $contactPage->card_description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Label</label>
                                    <input type="text" name="email_label" class="form-control" value="{{ old('email_label', $contactPage->email_label) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="text" name="email" class="form-control" value="{{ old('email', $contactPage->email) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Office Label</label>
                                    <input type="text" name="office_label" class="form-control" value="{{ old('office_label', $contactPage->office_label) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Office Address</label>
                                    <textarea name="office_address" rows="2" class="form-control">{{ old('office_address', $contactPage->office_address) }}</textarea>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit">Update Contact Page</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
