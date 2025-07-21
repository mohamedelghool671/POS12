@extends('user2.layouts.master')

@section('content')
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.contact') }}</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card p-4">
            <form method="post" action="{{route('sendMessage')}}">
              @csrf
              <div class="mb-3">
                <label for="subject">{{ __('messages.subject') }}</label>
                <input type="text" name="subject" id="subject" value="{{old('subject')}}" class="form-control" placeholder="{{ __('messages.enter_subject') }}" required>
              </div>
              <div class="mb-3">
                <label for="message">{{ __('messages.message') }}</label>
                <textarea name="message" id="message" rows="5" class="form-control" placeholder="{{ __('messages.write_your_message') }}" required>{{old('message')}}</textarea>
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-warning w-100">{{ __('messages.send_message') }}</button>
                @if (session('success'))
                  <div class="alert alert-success mt-3">
                    {{ session('success') }}
                  </div>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
