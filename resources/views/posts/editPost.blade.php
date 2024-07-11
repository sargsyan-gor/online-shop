@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
            <h3>Update Post</h3>

            <form action="{{ route('editPost', $post->id)  }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                           placeholder="{{ $post->title }}" value="{{ $post->title }}">
                    @error('title')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" class="form-control @error('post_content') is-invalid @enderror" id="content" name="post_content"
                           placeholder="{{ $post->content }}" value="{{$post->content }}">
                    @error('content')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                           placeholder="{{ $post->price }}" value="{{ $post->price }}">
                    @error('content')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="btn mt-3 btn-primary">Update Post</button>
                @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
</body>
</html>
