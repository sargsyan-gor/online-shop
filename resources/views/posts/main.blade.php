@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card {
            border: none;
            transition: box-shadow 0.3s;
        }
        .card:hover {
            box-shadow: 0 0 11px rgba(33,33,33,.2);
        }
        .card-img-top {
            height: 200px;
        }
        .card-body {
            padding: 1.25rem;
        }
        .card-title {
            font-weight: bold;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }
        .card-text {
            color: #555;
        }
        .price {
            font-weight: bold;
            color: #007bff;
        }
        .search-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input{
            width: 800px!important;
        }
        .search-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333333;
            text-align: center;
        }
        .search-form form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }
        .search-form label {
            font-size: 16px;
            color: #666666;
        }
        .search-form input[type="text"],
        .search-form input[type="number"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            width: 100%;
            max-width: 300px;
        }
        .search-form button, .enable{
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .search-form button:hover {
            background-color: #0056b3;
        }
        .container {
            margin-top: 30px;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            padding: 10px;
        }
        .pagination svg{
            width: 30px;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="search-form">
    <h2>Search Posts ↓</h2>
    <form action="{{ route('index') }}" method="get" class="{{ $errors->any() || session('error') ? '' : 'd-none' }}">
        @if(session('error'))
            <p class="text-danger">{{ session('error') }}</p>
        @endif
        <div class="form-group">
            <label for="query">Filter by title</label>
            <input type="text" class="form-control" id="query" name="filter" value="{{ old('filter') }}" placeholder="Enter title">
            @error('filter')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="minimum">Minimum price</label>
            <input type="number" class="form-control @error('filterByPrice') is-invalid @enderror" id="minimum" name="filterByPrice" value="{{ old('filterByPrice') }}" placeholder="Minimum price">
            @error('filterByPrice')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="maximum">Maximum price</label>
            <input type="number" class="form-control @error('filterByPriceMax') is-invalid @enderror" id="maximum" name="filterByPriceMax" value="{{ old('filterByPriceMax') }}" placeholder="Maximum price">
            @error('filterByPriceMax')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Search</button>
            <a href="{{ route('index') }}" class="btn btn-primary enable">Enable Filters</a>
        </div>
    </form>
</div>
<div class="container">
    <div class="row">
        @if($posts->count() > 0)
            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset($post->image) }}" class="card-img-top" alt="post image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="card-text">Added by <strong>{{ $post->user->name }}</strong></p>
                            <div class="d-flex justify-content-between">
                                <p class="card-text price">Price: ${{ $post->price }}</p>
                                <a href="{{ route('about', $post) }}" class="text-decoration-none">Manage</a>
                            </div>
                            <div>
                                <form method="post" action="{{ route('storeCart', $post->id) }}">
                                    @csrf
                                    <button class="btn btn-primary btn-sm" type="submit">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No posts found.</p>
        @endif
    </div>

    <div class="pagination text-center">
        {{ $posts->links() }}
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.search-form h2').on("click", function(){
            $(this).next('form').toggleClass('d-none');
        });
    });
</script>
</body>
</html>
