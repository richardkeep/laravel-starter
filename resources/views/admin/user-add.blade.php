@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1>User add</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        @include('forms.user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
