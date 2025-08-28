<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bids</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <h2 class="mb-4">My Bids</h2>

        @forelse($bids as $bid)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $bid->auction->item_name }}</h5>
                    
                    <p class="mb-1">
                        My Bid: <strong>${{ number_format($bid->bid_amount, 2) }}</strong>

                        @if($bid->bid_amount == $bid->auction->current_price)
                            <span class="badge bg-success">Highest Bid</span>   <!-- Highlight if it's the highest bid -->
                        @else
                            <span class="badge bg-danger">Outbid</span> <!-- Highlight if outbid -->
                        @endif
                    </p>

                    <p class="text-muted mb-0">
                        Placed on: {{ $bid->created_at->format('M d, Y H:i') }}
                    </p>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                You haven’t placed any bids yet.
            </div>
        @endforelse
    </div>

    <!-- Bootstrap JS (optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
