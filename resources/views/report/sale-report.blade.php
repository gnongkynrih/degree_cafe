@extends('layouts.app')

@section('content')
<h4 class="text-2xl font-bold tracking-tight text-gray-900 text-center mb-10">Sale Report</h4>
    <div class="grid grid-cols-2 gap-4">
        <canvas class="max-w-md max-h-[40em]" id="salesChart"></canvas>
        <canvas class="max-w-md max-h-[40em]" id="CategoryChart"></canvas>
    </div>
    
@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function generateSaleReport(){
        const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = {!! json_encode($labels) !!}; // Use Blade directive to output data
        const data = {!! json_encode($data) !!};
        console.log(labels, data);
        //generate the chart
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Daily Sales',
                    data: data,
                    backgroundColor: ['#1878F8','#FF0000','#00FF00','#FFFF00','#43233F'],
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
    }
    function generateCategoryReport(){
        const ctx = document.getElementById('CategoryChart').getContext('2d');
        const labels = {!! json_encode($lblCategory) !!}; // Use Blade directive to output data
        const data = {!! json_encode($dataCategory) !!};
        console.log(labels, data);
        //generate the chart
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Category Sales',
                    data: data,
                    backgroundColor: ['#1878F8','#FF0000','#00FF00','#FFFF00','#43233F'],
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Doughnut Chart'
                }
                }
            },
            
        });
    }
  document.addEventListener('DOMContentLoaded', function() { // Wait for the DOM to fully load
        generateSaleReport();
        generateCategoryReport();
      });
</script>
