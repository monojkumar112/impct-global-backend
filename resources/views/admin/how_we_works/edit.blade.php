@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.how_we_works.index') }}">How We Work</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit How We Work Item</h6>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.how_we_works.update', $howWeWork) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $howWeWork->title) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control" required>{{ old('description', $howWeWork->description) }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Image (1500 x 1000 pixels)</label>
                                        @if ($howWeWork->image)
                                            <div class="mb-2">
                                                <img src="{{ asset($howWeWork->image) }}" alt="{{ $howWeWork->title }}" style="height: 90px;">
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Display Order</label>
                                        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $howWeWork->sort_order) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', $howWeWork->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $howWeWork->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.how_we_works.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
