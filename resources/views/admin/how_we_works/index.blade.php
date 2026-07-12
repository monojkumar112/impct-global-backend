@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">How We Work</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Items</li>
            </ol>
            <a href="{{ route('admin.how_we_works.create') }}" class="btn btn-primary">Create Item</a>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">How We Work Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->sort_order }}</td>
                                            <td>{{ Str::limit($item->title, 60) }}</td>
                                            <td>
                                                @if ($item->image)
                                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" style="height: 45px; width: 70px; object-fit: cover;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge px-3 {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.how_we_works.edit', $item) }}" class="btn btn-primary btn-icon" title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <form id="delete_hww_{{ $item->id }}" action="{{ route('admin.how_we_works.destroy', $item) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-icon" onclick="if(confirm('Are you sure?')) document.getElementById('delete_hww_{{ $item->id }}').submit();" title="Delete">
                                                        <i data-feather="trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
