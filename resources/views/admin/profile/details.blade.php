@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-dark">
                            {{ __('messages.admin_profile') }}
                        </h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('adminProfileUpdate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="">
                            <input type="hidden" name="oldImage" value="{{ auth()->user()->profile }}">

                            <div class="mb-3 text-center">

                                @if (auth()->user()->profile == null)
                                    <img class="img-profile img-thumbnail" id="output"
                                        src="{{ asset('admin/img/undraw_profile.svg') }}" style="max-width: 300px; height:300px;">
                                @else
                                    <img class="img-profile img-thumbnail" id="output"
                                        src="{{ asset('adminProfile/' . auth()->user()->profile) }}" style="max-width: 300px; height:300px;">
                                @endif
                                <input type="file" name="image" style="max-width: 300px; display: none;"
                                    class="form-control mt-1 @error('image') is-invalid @enderror"
                                    onchange="loadFile(event)" id="profileImageInput">
                                    <br>
                                    <br>
                                <label for="profileImageInput" class="btn btn-primary" style="cursor: pointer; padding: 8px 16px; border-radius: 4px; background: #007bff; color: white; display: inline-block;">
                                    {{ __('messages.choose_file') }}
                                </label>
                                <span id="profileFileName" style="margin-left: 10px; color: #6c757d; display: none;">{{ __('messages.no_file_chosen') }}</span>
                            </div>
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">{{ __('messages.name') }}</label>
                                        <input type="text" name="name"
                                            @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="{{ __('messages.name') }}..."
                                            value="{{ old('name', auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name) }}">
                                        @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">{{ __('messages.email') }}</label>
                                        <input type="text" name="email"
                                            @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="{{ __('messages.email') }}..."
                                            value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">{{ __('messages.phone') }}</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="09xxxxxxxx"
                                            value="{{ old('phone', auth()->user()->phone) }}">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">{{ __('messages.address') }}</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="{{ __('messages.address') }}..."
                                            value="{{ old('address', auth()->user()->address) }}">
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                    @if (auth()->user()->provider == 'simple')
                                        <a href="{{ route('passwordChange') }}">{{ __('messages.change_password') }}</a><br><br>
                                    @endif
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" value="{{ __('messages.update') }}" class="btn btn-primary mt-2 w-100">
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('adminDashboard') }}" class="btn btn-secondary mt-2 w-100 text-center"
                                    >{{ __('messages.back') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

<script>
    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }

        // تحديث اسم الملف
        var fileName = event.target.files[0] ? event.target.files[0].name : '{{ __("messages.no_file_chosen") }}';
        document.getElementById('profileFileName').textContent = fileName;

        // إخفاء النص إذا تم اختيار ملف
        if (event.target.files[0]) {
            document.getElementById('profileFileName').style.display = 'none';
        } else {
            document.getElementById('profileFileName').style.display = 'inline';
        }
    }
</script>


