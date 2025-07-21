@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <form action="{{ route('role.userList') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" class="form-control " placeholder="{{ __('messages.search') }}..."
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
                    <a href="{{ route('role.index') }}" class="btn btn-secondary mr-2">{{ __('messages.admin_list') }} <span
                            class="badge badge-light">{{ $adminCount }}</span></></a>
                    <a href="{{ route('role.userList') }}" class="btn btn-secondary">{{ __('messages.customer_list') }} <span
                            class="badge badge-light">{{ $data->total() }}</span></a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center text-white">
                                <th>{{ __('messages.name') }}</th>
                                <th>{{ __('messages.email') }}</th>
                                <th>{{ __('messages.phone') }}</th>
                                <th>{{ __('messages.address') }}</th>
                                @if (auth()->user()->role == 'superadmin')
                                    <th>{{ __('messages.actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="text-center text-white">
                                    <td class="text-info font-weight-bold">
                                        @if ($item->name != null)
                                            <a href="{{ route('accountProfile', $item->id) }}"> {{ $item->name }}</a>
                                        @endif
                                        <a href="{{ route('accountProfile', $item->id) }}"> {{ $item->nickname }}</a>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>

                                    @if (auth()->user()->role == 'superadmin')
                                        <td>
                                            <form action="{{ route('role.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                            <form action="{{ route('role.changeAdminRole', $item->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-dark text-white change-role">{{ __('messages.change_to_admin_role') }} <i class="p-1 fa-solid fa-arrow-up"></i></button>
                                            </form>
                                        </td>
                                    @endif
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

@section('js-section')
<script>
    $(document).on('click', '.change-role', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: '{{ __("messages.are_you_sure") }}',
            text: '{{ __("messages.this_user_role_will_be_changed") }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __("messages.yes_change_the_role") }}',
            cancelButtonText: '{{ __("messages.cancel") }}'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
