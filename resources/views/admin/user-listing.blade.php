@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1>User list</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">List of users available in the system. To add new user, click <a
                            href="{{route('manage.user.add')}}">here</a></div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->format('Y-m-d')}}</td>
                                <td>
                                    <a href="{{route('manage.user.view', ['user' => $user->id])}}"
                                       title="View {{$user->name}} details" class="mr-3">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </a>
                                    <a href="#" title="Delete {{$user->name}}" class="mr-0">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{$users->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
