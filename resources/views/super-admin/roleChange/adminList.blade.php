@extends('layouts.partials')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <form action="{{ route('adminList') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" class="form-control " placeholder="Search..."
                                        value="{{ request('searchKey') }}">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="d-flex mb-3">
                    <a href="{{ route('adminList') }}" class="btn btn-warning mr-2">Admin List <span
                            class="badge badge-light">{{ $data->total() }}</span></a>
                    <a href="{{ route('userList') }}" class="btn btn-warning">Chaplains List <span
                            class="badge badge-light">{{ $userCount }}</span></a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center text-white">
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Grade</th>
                                <th>Country</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="text-center text-white">
                                    <td class="text-info font-weight-bold">
                                        @if ($item->last_name != null)
                                            <a href="{{ route('accountProfile', $item->id) }}"> {{ $item->last_name }}</a>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('accountProfile', $item->id) }}"> {{ $item->first_name }}</a></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->grade }}</td>
                                    <td>{{ $item->country }}</td>

                                   <!-- @if (auth()->user()->role === 'superadmin')
                                        <td>
                                            @if (auth()->user()->id != $item->id)
                                                <a href="{{ route('deleteAdminAccount', $item->id) }}">
                                                    <button class="btn btn-sm btn btn-danger"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </a>
                                                <a href="{{ route('changeUserRole', $item->id) }}">
                                                    <button class="btn btn-sm bg-dark text-white">Change to User role <i
                                                            class="p-1 fa-solid fa-arrow-down"></i></button>
                                                </a>
                                                <a href="{{ route('editAdmin', $item->id) }}">
                                                    <button class="btn btn-sm btn-primary"><i
                                                            class="fa-solid fa-pen-to-square"></i></button>
                                                </a>
                                            @endif
                                        </td>
                                    @endif -->

                                    <td>
                                        <a href="{{ route('editAdmin', $item->id) }}" class="btn btn-sm btn-primary"> update </a>
                                        <a href="{{ route('changeUserRole', $item->id) }}" class="btn btn-sm btn-primary"> Change to User role
                                            <i class="p-1 fa-solid fa-arrow-down"></i>
                                        </a>
                                        <form action="{{ route('deleteAdminAccount', $item->id) }}" methode="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button tye="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Administrator?')">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">{{ $data->links() }}</span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
