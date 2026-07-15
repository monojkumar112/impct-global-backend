@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home Page</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Home Page</h6>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.home_page.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <ul class="nav nav-tabs mb-4" id="homePageTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero-pane" type="button" role="tab">Hero</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="who-tab" data-bs-toggle="tab" data-bs-target="#who-pane" type="button" role="tab">Who We Are</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="story-tab" data-bs-toggle="tab" data-bs-target="#story-pane" type="button" role="tab">Our Story</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="why-tab" data-bs-toggle="tab" data-bs-target="#why-pane" type="button" role="tab">Why Choose</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="join-tab" data-bs-toggle="tab" data-bs-target="#join-pane" type="button" role="tab">Join Us</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="homePageTabContent">
                                {{-- Hero --}}
                                <div class="tab-pane fade show active" id="hero-pane" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Badge Text</label>
                                        <input type="text" name="hero_badge" class="form-control" value="{{ old('hero_badge', $homePage->hero_badge) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $homePage->hero_title) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="hero_description" rows="4" class="form-control">{{ old('hero_description', $homePage->hero_description) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tagline</label>
                                        <input type="text" name="hero_tagline" class="form-control" value="{{ old('hero_tagline', $homePage->hero_tagline) }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Primary Button Text</label>
                                            <input type="text" name="hero_primary_btn_text" class="form-control" value="{{ old('hero_primary_btn_text', $homePage->hero_primary_btn_text) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Primary Button Link</label>
                                            <input type="text" name="hero_primary_btn_link" class="form-control" value="{{ old('hero_primary_btn_link', $homePage->hero_primary_btn_link) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Secondary Button Text</label>
                                            <input type="text" name="hero_secondary_btn_text" class="form-control" value="{{ old('hero_secondary_btn_text', $homePage->hero_secondary_btn_text) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Secondary Button Link</label>
                                            <input type="text" name="hero_secondary_btn_link" class="form-control" value="{{ old('hero_secondary_btn_link', $homePage->hero_secondary_btn_link) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Map Card Label</label>
                                        <input type="text" name="hero_map_label" class="form-control" value="{{ old('hero_map_label', $homePage->hero_map_label) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Map Image (max 10MB, auto WebP)</label>
                                        @if ($homePage->hero_image)
                                            <div class="mb-2"><img src="{{ asset($homePage->hero_image) }}" style="height:80px;" alt="hero map"></div>
                                        @endif
                                        <input type="file" name="hero_image" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label d-block">Engagement Priorities</label>
                                        <div id="hero-priorities-list">
                                            @php $priorities = old('hero_priorities', $homePage->hero_priorities ?? []); @endphp
                                            @forelse ($priorities as $index => $priority)
                                                <div class="row g-2 mb-2 repeatable-row">
                                                    <div class="col-md-5">
                                                        <input type="text" name="hero_priorities[{{ $index }}][label]" class="form-control" placeholder="Label" value="{{ $priority['label'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="hero_priorities[{{ $index }}][value]" class="form-control" placeholder="Value" value="{{ $priority['value'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-outline-danger w-100 remove-row">Remove</button>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="row g-2 mb-2 repeatable-row">
                                                    <div class="col-md-5">
                                                        <input type="text" name="hero_priorities[0][label]" class="form-control" placeholder="Label">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="hero_priorities[0][value]" class="form-control" placeholder="Value">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-outline-danger w-100 remove-row">Remove</button>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-hero-priority">Add Priority</button>
                                    </div>
                                </div>

                                {{-- Who We Are --}}
                                <div class="tab-pane fade" id="who-pane" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="who_title" class="form-control" value="{{ old('who_title', $homePage->who_title) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="who_description" rows="6" class="form-control">{{ old('who_description', $homePage->who_description) }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Button Text</label>
                                            <input type="text" name="who_btn_text" class="form-control" value="{{ old('who_btn_text', $homePage->who_btn_text) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Button Link</label>
                                            <input type="text" name="who_btn_link" class="form-control" value="{{ old('who_btn_link', $homePage->who_btn_link) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image (max 10MB, auto WebP)</label>
                                        @if ($homePage->who_image)
                                            <div class="mb-2"><img src="{{ asset($homePage->who_image) }}" style="height:80px;" alt="who"></div>
                                        @endif
                                        <input type="file" name="who_image" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                {{-- Our Story --}}
                                <div class="tab-pane fade" id="story-pane" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Section Label</label>
                                        <input type="text" name="story_label" class="form-control" value="{{ old('story_label', $homePage->story_label) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title (use new line for line break)</label>
                                        <textarea name="story_title" rows="2" class="form-control">{{ old('story_title', $homePage->story_title) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="story_description" rows="4" class="form-control">{{ old('story_description', $homePage->story_description) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label d-block">Features</label>
                                        <div id="story-features-list">
                                            @php $features = old('story_features', $homePage->story_features ?? []); @endphp
                                            @forelse ($features as $index => $feature)
                                                <div class="border rounded p-3 mb-3 repeatable-row">
                                                    <div class="row g-2">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Icon</label>
                                                            <select name="story_features[{{ $index }}][icon]" class="form-control">
                                                                @foreach (['users' => 'Users', 'chart-bar' => 'Chart', 'globe' => 'Globe'] as $iconValue => $iconLabel)
                                                                    <option value="{{ $iconValue }}" {{ ($feature['icon'] ?? '') === $iconValue ? 'selected' : '' }}>{{ $iconLabel }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="story_features[{{ $index }}][title]" class="form-control" value="{{ $feature['title'] ?? '' }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="story_features[{{ $index }}][description]" rows="2" class="form-control">{{ $feature['description'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <button type="button" class="btn btn-sm btn-outline-danger remove-row">Remove Feature</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="border rounded p-3 mb-3 repeatable-row">
                                                    <div class="row g-2">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Icon</label>
                                                            <select name="story_features[0][icon]" class="form-control">
                                                                <option value="users">Users</option>
                                                                <option value="chart-bar">Chart</option>
                                                                <option value="globe">Globe</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="story_features[0][title]" class="form-control">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="story_features[0][description]" rows="2" class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <button type="button" class="btn btn-sm btn-outline-danger remove-row">Remove Feature</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-story-feature">Add Feature</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Button Text</label>
                                            <input type="text" name="story_btn_text" class="form-control" value="{{ old('story_btn_text', $homePage->story_btn_text) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Button Link</label>
                                            <input type="text" name="story_btn_link" class="form-control" value="{{ old('story_btn_link', $homePage->story_btn_link) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image (max 10MB, auto WebP)</label>
                                        @if ($homePage->story_image)
                                            <div class="mb-2"><img src="{{ asset($homePage->story_image) }}" style="height:80px;" alt="story"></div>
                                        @endif
                                        <input type="file" name="story_image" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Quote</label>
                                        <textarea name="story_quote" rows="3" class="form-control">{{ old('story_quote', $homePage->story_quote) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Quote Author</label>
                                        <input type="text" name="story_quote_author" class="form-control" value="{{ old('story_quote_author', $homePage->story_quote_author) }}">
                                    </div>
                                </div>

                                {{-- Why Choose --}}
                                <div class="tab-pane fade" id="why-pane" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="why_title" class="form-control" value="{{ old('why_title', $homePage->why_title) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="why_description" rows="4" class="form-control">{{ old('why_description', $homePage->why_description) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label d-block">Items</label>
                                        <div id="why-items-list">
                                            @php $whyItems = old('why_items', $homePage->why_items ?? []); @endphp
                                            @forelse ($whyItems as $index => $item)
                                                <div class="border rounded p-3 mb-3 repeatable-row">
                                                    <div class="row g-2">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Num</label>
                                                            <input type="text" name="why_items[{{ $index }}][num]" class="form-control" value="{{ $item['num'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="why_items[{{ $index }}][title]" class="form-control" value="{{ $item['title'] ?? '' }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="why_items[{{ $index }}][description]" rows="2" class="form-control">{{ $item['description'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <button type="button" class="btn btn-sm btn-outline-danger remove-row">Remove Item</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="border rounded p-3 mb-3 repeatable-row">
                                                    <div class="row g-2">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Num</label>
                                                            <input type="text" name="why_items[0][num]" class="form-control">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="why_items[0][title]" class="form-control">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="why_items[0][description]" rows="2" class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <button type="button" class="btn btn-sm btn-outline-danger remove-row">Remove Item</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-why-item">Add Item</button>
                                    </div>
                                </div>

                                {{-- Join Us --}}
                                <div class="tab-pane fade" id="join-pane" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label">Badge Text</label>
                                        <input type="text" name="join_badge" class="form-control" value="{{ old('join_badge', $homePage->join_badge) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <textarea name="join_title" rows="2" class="form-control">{{ old('join_title', $homePage->join_title) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="join_description" rows="4" class="form-control">{{ old('join_description', $homePage->join_description) }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Primary Button Text</label>
                                            <input type="text" name="join_primary_btn_text" class="form-control" value="{{ old('join_primary_btn_text', $homePage->join_primary_btn_text) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Primary Button Link</label>
                                            <input type="text" name="join_primary_btn_link" class="form-control" value="{{ old('join_primary_btn_link', $homePage->join_primary_btn_link) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Secondary Button Text</label>
                                            <input type="text" name="join_secondary_btn_text" class="form-control" value="{{ old('join_secondary_btn_text', $homePage->join_secondary_btn_text) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Secondary Button Link</label>
                                            <input type="text" name="join_secondary_btn_link" class="form-control" value="{{ old('join_secondary_btn_link', $homePage->join_secondary_btn_link) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit">Update Home Page</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    (function () {
        function reindexRows(container, namePrefix) {
            container.querySelectorAll('.repeatable-row').forEach(function (row, index) {
                row.querySelectorAll('[name]').forEach(function (input) {
                    input.name = input.name.replace(/\[\d+\]/, '[' + index + ']');
                });
            });
        }

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-row')) {
                const row = event.target.closest('.repeatable-row');
                const list = row.parentElement;
                if (list.querySelectorAll('.repeatable-row').length > 1) {
                    row.remove();
                    reindexRows(list, '');
                }
            }
        });

        document.getElementById('add-hero-priority').addEventListener('click', function () {
            const list = document.getElementById('hero-priorities-list');
            const index = list.querySelectorAll('.repeatable-row').length;
            const html = `
                <div class="row g-2 mb-2 repeatable-row">
                    <div class="col-md-5">
                        <input type="text" name="hero_priorities[${index}][label]" class="form-control" placeholder="Label">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="hero_priorities[${index}][value]" class="form-control" placeholder="Value">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-danger w-100 remove-row">Remove</button>
                    </div>
                </div>`;
            list.insertAdjacentHTML('beforeend', html);
        });

        document.getElementById('add-story-feature').addEventListener('click', function () {
            const list = document.getElementById('story-features-list');
            const index = list.querySelectorAll('.repeatable-row').length;
            const html = `
                <div class="border rounded p-3 mb-3 repeatable-row">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label">Icon</label>
                            <select name="story_features[${index}][icon]" class="form-control">
                                <option value="users">Users</option>
                                <option value="chart-bar">Chart</option>
                                <option value="globe">Globe</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label">Title</label>
                            <input type="text" name="story_features[${index}][title]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="story_features[${index}][description]" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row">Remove Feature</button>
                        </div>
                    </div>
                </div>`;
            list.insertAdjacentHTML('beforeend', html);
        });

        document.getElementById('add-why-item').addEventListener('click', function () {
            const list = document.getElementById('why-items-list');
            const index = list.querySelectorAll('.repeatable-row').length;
            const html = `
                <div class="border rounded p-3 mb-3 repeatable-row">
                    <div class="row g-2">
                        <div class="col-md-2">
                            <label class="form-label">Num</label>
                            <input type="text" name="why_items[${index}][num]" class="form-control">
                        </div>
                        <div class="col-md-10">
                            <label class="form-label">Title</label>
                            <input type="text" name="why_items[${index}][title]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="why_items[${index}][description]" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row">Remove Item</button>
                        </div>
                    </div>
                </div>`;
            list.insertAdjacentHTML('beforeend', html);
        });
    })();
</script>
@endsection
