@extends('layouts.custom')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
  <h1 class="text-2xl font-bold mb-6">Result for Investment: RM{{ number_format($investment,2) }}</h1>

  <div class="overflow-x-auto mb-8">
    <table class="min-w-full bg-white rounded-lg overflow-hidden">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2">Instrument</th>
          <th class="px-4 py-2">Return Rate (%)</th>
          <th class="px-4 py-2">Profit 1 Year (RM)</th>
          <th class="px-4 py-2">Profit 3 Years (RM)</th>
          <th class="px-4 py-2">Profit 5 Years (RM)</th>
        </tr>
      </thead>
      <tbody>
        @foreach($results as $r)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $r['instrument'] }}</td>
          <td class="px-4 py-2">{{ $r['return_rate'] }}%</td>
          <td class="px-4 py-2">{{ number_format($r['profit_1_year'], 2) }}</td>
          <td class="px-4 py-2">{{ number_format($r['profit_3_years'], 2) }}</td>
          <td class="px-4 py-2">{{ number_format($r['profit_5_years'], 2) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <canvas id="investmentChart" class="bg-white p-4 rounded-lg shadow" height="120"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const instruments = @json(array_column($results, 'instrument'));
  const profit1Year = @json(array_column($results, 'profit_1_year'));
  const profit3Years = @json(array_column($results, 'profit_3_years'));
  const profit5Years = @json(array_column($results, 'profit_5_years'));

  const ctx = document.getElementById('investmentChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: instruments,
      datasets: [
        {
          label: 'Profit 1 Year',
          data: profit1Year,
          backgroundColor: '#3b82f6',
        },
        {
          label: 'Profit 3 Years',
          data: profit3Years,
          backgroundColor: '#facc15',
        },
        {
          label: 'Profit 5 Years',
          data: profit5Years,
          backgroundColor: '#22d3ee',
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        tooltip: { mode: 'index', intersect: false },
        legend: { position: 'top' }
      },
      interaction: {
        mode: 'nearest',
        intersect: false
      },
      scales: {
        x: { stacked: false },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Profit (RM)'
          }
        }
      }
    }
  });
</script>
@endsection
