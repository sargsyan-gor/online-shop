@include('header')
<head>
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="row  justify-content-center align-items-center">
        <div class="col-md-6">
            <h3 class="text-center">Register</h3>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
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
                <div class="mb-3">
                    <label for="cPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cPassword" name="cPassword">
                    @error('cPassword')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ route('login') }}">Already have account?</a>
                <button type="submit" class="btn btn-primary w-100 mt-3">Sign up</button>
            </form>
        </div>
    </div>
</div>
</body>
