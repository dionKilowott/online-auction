<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bids</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">⚖️ Auction System</a>
            <div class="d-flex">
                <span class="text-white me-3">{{ $user->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- My Bids Content -->
    <div class="container my-5">
        <h2 class="mb-4 fw-bold">📋 My Bids</h2>

        @forelse($myBids as $bid)
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $bid->auction->item_name }}</h5>
                    <p class="mb-1">My Bid: <span class="fw-semibold">${{ $bid->bid_amount }}</span></p>

                    @if($bid->is_winning)
                        <span class="badge bg-success">🏆 Winning</span>
                    @else
                        <span class="badge bg-danger">❌ Outbid</span>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">You haven’t placed any bids yet.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
