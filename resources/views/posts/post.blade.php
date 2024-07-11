@include('header')
<!DOCTYPE html>
<head>
    <title>About {{ $post->title }} post</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Arial', sans-serif;
        }
        .post-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .post-image {
            max-width: 100%;
            border-radius: 8px;
        }
        .post-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-top: 15px;
            text-align: center;
        }
        .post-author {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
            text-align: center;
        }
        .post-content {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
            margin-top: 20px;
            text-align: center;
        }
        .post-price {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="post-container mb-5">
    <div class="text-center">
        <img src="{{ asset($post->image) }}" alt="Post image" class="post-image w-25 p-3">
    </div>
    <div class="post-title">
        {{ $post->title }}
    </div>
    <div class="post-author">
        Created by: {{ $post->user->name }}
    </div>
    <div class="post-content">
        {{ $post->content }}
    </div>
    <div class="post-price mb-3">
        Price: {{ $post->price }}$
    </div>
</div>
<div  class="text-center">
    <a href="{{ route('index')}}" class="text-center text-decoration-none text-lg">Back</a>
</div>
</body>
</html>
