<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">Online Shop</span>
        </a>
        <ul class="nav nav-pills">

            @if(auth()->user())

                <li class="nav-item"><a href="{{ route('index') }}" class="nav-link active" aria-current="page">Welcome</a></li>
                <li class="nav-item"><a href="{{ route('postPage') }}" class="nav-link">Add post</a></li>
                @if(Gate::allows('isAdmin'))
                    <li class="nav-item"><a href="{{ route('adminPanel') }}" class="nav-link">Admin Panel</a></li>
                @endif

            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-transparent text-primary" onclick="return confirmRequest()">Logout</button>
                </form>
            </li>
            @else
                <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Welcome</a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Log in</a></li>
                <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">Sign up</a></li>
            @endif

        </ul>
    </header>
</div>
<script>
    function confirmRequest(){
        if (confirm('Are you sure?')) {
            return true;
        } else {
            return false;
        }
    }
</script>
