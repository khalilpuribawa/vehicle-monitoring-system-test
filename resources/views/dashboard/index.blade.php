@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Vehicle Usage</h5>
        <div class="flex justify-center mt-4">
            <canvas id="usageChart" height="250"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('usageChart');
    if(ctx) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Angkutan Orang', 'Angkutan Barang'],
                datasets: [{
                    label: '# of Bookings',
                    data: [{{ $orangCount }}, {{ $barangCount }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }
});
</script>
@endsection
