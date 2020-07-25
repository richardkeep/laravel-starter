<form action="{{$submit_url}}" method="post">
    {{csrf_field()}}

    <input type="hidden" name="id" value="{{$user->id}}">

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
               value="{{old('name', $user->name)}}">
        @error('name')
        <small class="error">{{$message}}</small>
        @enderror
    </div>

    @if($user->email === "")
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
               value="{{old('email', $user->email)}}">
        @error('email')
        <small class="error">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('email') is-invalid @enderror">
        @error('password')
        <small class="error">{{$message}}</small>
        @enderror
    </div>
    @endif

    <div class="form-group">
        <label for="role">Select role</label>
        <select class="form-control @error('email') is-invalid @enderror" name="role" id="role">
            @foreach($roles as $role)
                @if(in_array($role->name, $user->getRoleNames()->toArray()))
                    <option value="{{$role->id}}" selected>{{Str::studly($role->name)}}</option>
                @else
                    <option value="{{$role->id}}">{{Str::studly($role->name)}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Save</button>
</form>
