@extends('admin.layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.category_list') }}</h6>
                    </div>
                    <div class="font-weight-bold text-primary">
                        <a href="{{ route('category.create') }}" class="btn btn-primary">{{ __('messages.add_category') }}</a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center text-white">
                                <th >{{ __('messages.id') }}</th>
                                <th >{{ __('messages.name') }}</th>
                                <th >{{ __('messages.created_date') }}</th>
                                <th >{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="text-center text-white">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $item) }}" class="btn btn-warning p-2" title="{{ __('messages.edit') }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('category.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger p-2 delete" style="box-shadow:none; background: #dc3545; border:none;" title="{{ __('messages.delete') }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
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
