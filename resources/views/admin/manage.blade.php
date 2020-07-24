@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.page-header', ['data' => getBreadCrumbData('manage')])

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="py-2 px-3">
                        <strong>Manage users</strong>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{route('manage.user')}}">View users</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('manage.user.add')}}">Add users</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{route('manage.user')}}">Manage users</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
