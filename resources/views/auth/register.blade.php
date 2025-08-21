<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Register</h1>
    </div>
    <section class="container">
<form class="form-group" action="{{ route('register.submit') }}" method="POST">
    @csrf

    <input 
    class = "form-control mb-3"
    type="text" 
    name="name" 
    placeholder="Name" 
    value="{{ old('name') }}" required>
    
    <input 
    class = "form-control mb-3"
    type="email" 
    name="email" 
    placeholder="Email" 
    value="{{ old('email') }}" required>
    
    <input 
    class = "form-control mb-3"
    type="password" 
    name="password" 
    placeholder="Password" 
    required>
    
    <input 
    class = "form-control mb-3"
    type="password" 
    name="password_confirmation" 
    placeholder="Confirm Password" 
    required>

    <button class="btn btn-primary" type="submit">Register</button>

    <!-- validation errors -->
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif



</form>
<a  href="{{ route('login') }}">Already have an account? Login</a>
    </section>
</body>
</html>