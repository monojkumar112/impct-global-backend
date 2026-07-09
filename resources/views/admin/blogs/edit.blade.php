@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
            </ol>
        </nav>

        <div class="row justify-content-center align-items-center">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Blog</h6>

                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Author</label>
                                        <input type="text" name="author" class="form-control" value="{{ old('author', $blog->author) }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $blog->slug) }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Custom Frontend URL (optional)</label>
                                        <input type="text" name="custom_href" class="form-control" value="{{ old('custom_href', $blog->custom_href) }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Excerpt</label>
                                <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea name="content" id="tinymceBlogContent" rows="8" class="form-control">{{ old('content', $blog->content) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Image (max 10MB, auto WebP)</label>
                                        @if ($blog->image)
                                            <div class="mb-2"><img src="{{ asset($blog->image) }}" style="height:80px;" alt="img" /></div>
                                        @endif
                                        <input type="file" name="image" class="form-control" accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Published At</label>
                                        <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $blog->status ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$blog->status ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script>
    $(document).ready(function () {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '#tinymceBlogContent',
                height: 450,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | removeformat | code fullscreen',
                images_upload_url: '{{ route('admin.blogs.upload.image') }}',
                automatic_uploads: true,
                branding: false,
                promotion: false
            });
        }
    });
</script>
@endsection
