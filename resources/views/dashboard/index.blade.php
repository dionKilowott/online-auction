<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Auction System</a>
            <div class="d-flex">
                <span class="text-white me-3">{{ auth()->user()->name  }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container my-5">
        <div class="row g-4">

            <!-- Auctions (redirects to auctions page) -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white fw-bold">
                        Active Auctions
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <p class="text-muted">View and participate in live auctions.</p>
                        <a href="{{ route('auctions.index') }}" class="btn btn-primary">Go to Auctions</a>
                    </div>
                </div>
            </div>

            <!-- My Bids -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white fw-bold">
                        My Bids
                    </div>
                    <div class="card-body">
                        @forelse($myBids as $bid)
                            <div class="mb-3 border-bottom pb-2">
                                <h6 class="fw-bold">{{ $bid->auction->item_name }}</h6>
                                <p class="mb-0 text-muted">My Bid: ${{ $bid->bid_amount }}</p>
                            </div>
                        @empty
                            <p class="text-muted">You haven’t placed any bids yet.</p>
                        @endforelse
                        <a href="{{ route('bids.index') }}" class="btn btn-primary">View All Bids</a>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-warning text-dark fw-bold">
                        Notifications
                    </div>
                    <div class="card-body"></div>
                        <ul id="notifications">
                            @foreach($notifications as $note)
                                <li>{{ $note['message'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
