@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.page-header', ['data' => getBreadCrumbData('manage-user-add')])

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
