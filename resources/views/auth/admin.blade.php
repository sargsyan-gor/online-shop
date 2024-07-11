@include('header')
<head>
    <title>Admin Panel</title>
</head>
@if(session('success'))
    <p class="text-success text-center">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p class="text-danger text-center">{{ session('error') }}</p>
@endif
<div class="container mt-4">
    <h1 class="mb-4">Admin Panel</h1>
    <div class="container mb-5">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Tools</th>
            </tr>
            @if(!empty($posts))
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="{{ route('editPage', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('deletePost', $post) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirmDelete();">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
        @if(!empty($posts))
            <div class="paginationWrapper">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Tools</th>
            </tr>
            @if(!empty($users))
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href="{{ route('editUserPage', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('deleteUser', $user) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirmDelete();">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
        @if(!empty($users))
            <div class="paginationWrapper">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    function confirmDelete(){
        if (confirm('Are you sure?')) {
            return true;
        } else {
            return false;
        }
    }
</script>
