@extends('layouts.custom')


@section('content')
<div class="max-w-4xl mx-auto mt-10">
  <h1 class="text-2xl font-bold mb-6">Result for Investment: RM{{ number_format($investment,2) }}</h1>
  <!-- Table sama macam sebelum ni, tapi augment dengan class Tailwind -->
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
          <td class="px-4 py-2">{{ number_format($r['profit_1_year'],2) }}</td>
          <td class="px-4 py-2">{{ number_format($r['profit_3_years'],2) }}</td>
          <td class="px-4 py-2">{{ number_format($r['profit_5_years'],2) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <canvas id="investmentChart" class="bg-white p-4 rounded-lg shadow"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    /* ChartJS init sama macam sebelum ni */
  </script>
</div>
@endsection
