@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">About Page</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit About Page</h6>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.about_page.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Section Title</label>
                                <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $aboutPage->hero_title) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Founder Image (max 10MB, auto WebP)</label>
                                @if ($aboutPage->hero_image)
                                    <div class="mb-2"><img src="{{ asset($aboutPage->hero_image) }}" style="height:120px;" alt="founder"></div>
                                @endif
                                <input type="file" name="hero_image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Biography Content</label>
                                <textarea name="hero_paragraphs" id="tinymceBlogContent" rows="12" class="form-control">{{ old('hero_paragraphs', $aboutPage->hero_paragraphs) }}</textarea>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit">Update About Page</button>
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
            const bodyFontFamily = getComputedStyle(document.documentElement)
                .getPropertyValue('--bs-body-font-family')
                .trim() || '"Roboto", Helvetica, sans-serif';

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
                promotion: false,
                content_style: `body { font-family: ${bodyFontFamily}; font-size: 14px; color: #1e293b !important; background-color: #fff; } p, h1, h2, h3, h4, h5, h6, li, span, div { color: #1e293b !important; font-family: ${bodyFontFamily}; }`
            });
        }
    });
</script>
@endsection
