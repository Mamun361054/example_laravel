<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container p-5">
        <div class="row">
            <div class="col-md-6">
                @if ($data['user-list'])
                    @foreach ($data['user-list'] as $item)
                        <ul class="list-group">


                            <li class="list-group-item">{{ $item->name }} <br>{{ $item->email }}
                                <a href="{{ url('/') }}?edit=yes&id={{ $item->id }}">edit </a>
                                <a href="{{ url('delete', $item->id) }}", style="color: red">delete
                                </a>
                            </li>

                        </ul>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6">
                @if (@$data['editUser'] != '')
                    <form action="{{ route('profile.update', @$data['editUser']->id) }}" method="POST">
                    @else
                        <form action="{{ route('profile.store') }}" method="POST">
                @endif
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ @$data['editUser']->name }}">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        value="{{ @$data['editUser']->email }}" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                @if (@$data['editUser'] != '')
                    <button type="submit" class="btn btn-primary">Update</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif
                </form>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
