<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctions</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ url('/dashboard') }}">Auction System</a>
            <div class="d-flex">
                <span class="text-white me-3">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <!-- Create Auction -->
        <div class="card mb-5 shadow">
            <div class="card-header bg-primary text-white fw-bold">Create New Auction</div>
            <div class="card-body">
                <form action="{{ route('auctions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="item_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Starting Price ($)</label>
                        <input type="number" step="0.01" name="starting_price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="datetime-local" name="start_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Time</label>
                        <input type="datetime-local" name="end_time" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Create Auction</button>
                </form>
            </div>
        </div>

        <!-- Active Auctions -->
        <h2 class="mb-4 fw-bold">Active Auctions</h2>
        <div class="row g-4">
            @forelse($auctions as $auction)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $auction->item_name }}</h5>
                            <p class="card-text text-muted">{{ $auction->description }}</p>
                            <p><strong>Current Price:</strong> ${{ $auction->current_price ?? $auction->starting_price }}</p>
                            <p class="text-muted">Ends at: {{ \Carbon\Carbon::parse($auction->end_time)->format('M d, Y H:i') }}</p>

                            <!-- Bid Form -->
                            <form method="POST" action="{{ route('auctions.bid', $auction->id) }}">
                                @csrf
                                <div class="input-group">
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        name="bid_amount" 
                                        class="form-control" 
                                        placeholder="Enter your bid"
                                    >

                                    <button 
                                        type="submit" 
                                        class="btn btn-primary">
                                        Place Bid
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>No active auctions yet. Be the first to create one!</p>
            @endforelse
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
