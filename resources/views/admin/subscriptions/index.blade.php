@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Subscriptions</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Subscribers</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Newsletter Subscribers</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Subscribed At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subscriptions as $key => $subscription)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $subscription->email }}</td>
                                            <td>
                                                @if ($subscription->status)
                                                    <span class="badge px-3 bg-success">Active</span>
                                                @else
                                                    <span class="badge px-3 bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($subscription->created_at)->format('d-M-Y H:i') }}
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-icon" title="Delete">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">No subscribers yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
