<form action="{{$submit_url}}" method="post">
    {{csrf_field()}}

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
               value="{{old('name')}}">
        @error('name')
        <small class="error">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
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

    <button class="btn btn-success">Save</button>
</form>
