@include('header')
<head>
    <title>Login</title>
</head>
<body>
@if(session('success'))
    <div class="alert mt-3 text-center text-success">
        {{ session('success') }}
    </div>
@endif
<div class="container  mt-5">
    <div class="row  justify-content-center align-items-center">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Login</h3>
            <form action="{{ route('authentication') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="text-center mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</div>
</body>
