@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Services</li>
            </ol>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Create Service</a>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Services Table</h6>
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
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $service->sort_order }}</td>
                                            <td>{{ Str::limit($service->title, 60) }}</td>
                                            <td>
                                                @if ($service->image)
                                                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="height: 45px; width: 70px; object-fit: cover;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge px-3 {{ $service->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $service->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary btn-icon" title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <form id="delete_service_{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-icon" onclick="if(confirm('Are you sure?')) document.getElementById('delete_service_{{ $service->id }}').submit();" title="Delete">
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
