@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.page-header', ['data' => getBreadCrumbData('manage-user-view')])

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @include('forms.user-form')
                    </div>
                </div>
            </div>

            @if(config('features.admin.reset_password_admin'))
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('password.email')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="hidden" name="email" value="{{$user->email}}">
                                @error('email')
                                <small class="error">{{$message}}</small>
                                @enderror
                            </div>
                            <button class="btn btn-success">Send reset password email</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
