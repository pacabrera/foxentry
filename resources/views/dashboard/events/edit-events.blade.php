@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Event:') }} {{ $events->eventName }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('edit-event-post', $events->eventId) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="eventName" class="col-md-4 col-form-label text-md-right">{{ __('Event Name') }}</label>

                            <div class="col-md-6">
                                <input id="eventName" type="text" class="form-control{{ $errors->has('eventName') ? ' is-invalid' : '' }}" name="eventName" value="{{ $events->eventName }}" value="{{ old('eventName') }}" required autofocus>

                                @if ($errors->has('eventName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('eventName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eventDateFrom" class="col-md-4 col-form-label text-md-right">{{ __('Event Date From') }}</label>

                            <div class="col-md-6">
                                <input id="eventDateFrom" type="date" class="form-control{{ $errors->has('eventDateFrom') ? ' is-invalid' : '' }}" name="eventDateFrom" required autofocus>

                                @if ($errors->has('eventDateFrom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('eventDateFrom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                             <div class="form-group row">
                            <label for="eventDateTo" class="col-md-4 col-form-label text-md-right">{{ __('Event Date To') }}</label>

                            <div class="col-md-6">
                                <input id="eventDateTo" type="date" class="form-control{{ $errors->has('eventdate') ? ' is-invalid' : '' }}" name="eventDateTo" required autofocus>

                                @if ($errors->has('eventDateTo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('eventDateTo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eventVenue" class="col-md-4 col-form-label text-md-right">{{ __('Event Venue') }}</label>

                            <div class="col-md-6">
                                <input id="eventVenue" type="text" class="form-control{{ $errors->has('eventVenue') ? ' is-invalid' : '' }}" name="eventVenue" value="{{ $events->eventVenue }}" value="{{ old('eventVenue') }}" required>

                                @if ($errors->has('eventVenue'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('eventVenue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eventTime" class="col-md-4 col-form-label text-md-right">{{ __('Event Time') }}</label>

                            <div class="col-md-6">
                                <input id="eventTime" type="text" class="form-control{{ $errors->has('eventTime') ? ' is-invalid' : '' }}" name="eventTime" value="{{ $events->eventTime }}" value="{{ old('eventTime') }}" required>

                                @if ($errors->has('eventTime'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('eventTime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eventPhoto" class="col-md-4 col-form-label text-md-right">{{ __('Event Photo') }}</label>

                            <div class="col-md-6">
                                     <input type="file" name="eventPhoto">
                                      <!--Start of Error message for image-->
                                      @if ($errors->has('eventPhoto'))
                                          <span style="color:red">
                                              <strong>{{ $errors->first('eventPhoto') }}</strong>
                                          </span>
                                      @endif
                                      <!--End of Error message for image-->

                                     </div>
                                   </div>

                        <div class="form-group row">
                            <label for="eventFee" class="col-md-4 col-form-label text-md-right">{{ __('Event Fee') }}</label>

                            <div class="col-md-6">
                                <input id="eventFee" type="text" class="form-control{{ $errors->has('eventFee') ? ' is-invalid' : '' }}" name="eventFee" value="{{ $events->eventFee }}" value="{{ old('eventFee') }}" required>

                                @if ($errors->has('eventFee'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('eventFee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('manage-events')}}" class="btn btn-primary">
                                    {{ __('Back') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
