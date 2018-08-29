@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('events') }}">Events</a>
                </div>  <br>
            <div class="card">
                <div class="card-header">Student Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <form method="POST" action="{{ route('add-status') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="posts" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <textarea id="posts" type="text" class="form-control{{ $errors->has('posts') ? ' is-invalid' : '' }}" name="posts" required autofocus>{{ old('posts') }}</textarea>
                                @if ($errors->has('posts'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('posts') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('POST') }}
                                </button>
                            </div>
                        </div>
                    </form>
<hr>
                    
                    @foreach($status as $data)
                    <form action="{{ route('delete-status', $data->statusId) }}" method="POST" name="myForm">
                        @csrf
                    <strong>{{ $data->name }}</strong>
                    <p>{{ $data->statusId }}{{ $data->posts }}{{ $data->comment }}</p>
                    <button class="btn btn-danger">x</button>
                    </form>
                    <form method="POST" action="{{ route('add-comment', $data->statusId) }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>
                            <div class="col-md-6">
                                <textarea id="comment" type="text" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" required autofocus>{{ old('comment') }}</textarea>
                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Comment') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
