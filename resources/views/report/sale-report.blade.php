@extends('layouts.app')

@section('content')
<h4 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center mb-10">Sale Report</h4>

<canvas id="salesChart"></canvas>
@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() { // Wait for the DOM to fully load
        const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = {!! json_encode($labels) !!}; // Use Blade directive to output data
        const data = {!! json_encode($data) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Daily Sales',
                    data: data,
                    borderColor: 'blue',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
      });
</script>
