@extends('layouts.custom')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 flex flex-col gap-6">

    <!-- Form Section -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-6">Investment Comparison Input</h2>

        <form id="investmentForm" action="{{ route('investment.index') }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">Amount (RM):</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">RM</span>
                        <input type="number" name="amount" required
                            class="w-full pl-10 border border-gray-300 focus:border-blue-500 rounded px-3 py-2 focus:outline-none">
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">ASB Return (%):</label>
                    <div class="relative">
                        <input type="number" name="rate_asb" step="0.01" required
                            class="w-full pr-10 border border-gray-300 focus:border-blue-500 rounded px-3 py-2 focus:outline-none">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">%</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">Tabung Haji Return (%):</label>
                    <div class="relative">
                        <input type="number" name="rate_th" step="0.01" required
                            class="w-full pr-10 border border-gray-300 focus:border-blue-500 rounded px-3 py-2 focus:outline-none">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">%</span>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">Emas Return (%):</label>
                    <div class="relative">
                        <input type="number" name="rate_emas" step="0.01" required
                            class="w-full pr-10 border border-gray-300 focus:border-blue-500 rounded px-3 py-2 focus:outline-none">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">%</span>
                    </div>
                </div>
            </div>

            <button id="submitBtn" type="submit"
                class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200 flex items-center justify-center mt-4">
                <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                    </path>
                </svg>
                <span id="btnText">Calculate</span>
            </button>
        </form>
    </div>

    @if(!empty($results))
    <!-- Result Section -->
    <div id="resultReady" class="text-green-600 font-bold text-lg mb-4 mt-10">
        ✅ Result Ready!
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-6">Result for Investment: RM{{ number_format($investment, 2) }}</h2>

        <div class="overflow-x-auto mb-6">
            <table class="min-w-full text-sm text-gray-700">
                <thead>
    <tr class="bg-gray-100">
        <th class="py-2 px-4 text-left">Instrument</th>
        <th class="py-2 px-4 text-left">Return Rate (%)</th>
        <th class="py-2 px-4 text-left">Profit 1 Year (RM)</th>
        <th class="py-2 px-4 text-left">Profit 2 Years (RM)</th> <!-- tambah -->
        <th class="py-2 px-4 text-left">Profit 3 Years (RM)</th>
        <th class="py-2 px-4 text-left">Profit 4 Years (RM)</th> <!-- tambah -->
        <th class="py-2 px-4 text-left">Profit 5 Years (RM)</th>
    </tr>
</thead>

               <tbody>
    @foreach($results as $r)
        <tr class="hover:bg-gray-50 border-b">
            <td class="py-2 px-4">{{ $r['instrument'] }}</td>
            <td class="py-2 px-4">{{ $r['return_rate'] }}%</td>
            <td class="py-2 px-4">{{ number_format($r['profit_1_year'], 2) }}</td>
            <td class="py-2 px-4">{{ number_format($r['profit_2_years'], 2) }}</td> <!-- tambah -->
            <td class="py-2 px-4">{{ number_format($r['profit_3_years'], 2) }}</td>
            <td class="py-2 px-4">{{ number_format($r['profit_4_years'], 2) }}</td> <!-- tambah -->
            <td class="py-2 px-4">{{ number_format($r['profit_5_years'], 2) }}</td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>

        <canvas id="investmentChart" height="150"></canvas>
    </div>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('investmentChart').getContext('2d');

    const profit1Year = {!! json_encode(array_column($results, 'profit_1_year')) !!};
    const profit3Years = {!! json_encode(array_column($results, 'profit_3_years')) !!};
    const profit5Years = {!! json_encode(array_column($results, 'profit_5_years')) !!};
    const labels = {!! json_encode(array_column($results, 'instrument')) !!};

    const investmentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Profit 1 Year',
                    data: profit1Year,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)', // biru
                },
                {
                    label: 'Profit 3 Years',
                    data: profit3Years,
                    backgroundColor: 'rgba(255, 206, 86, 0.7)', // kuning
                },
                {
                    label: 'Profit 5 Years',
                    data: profit5Years,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)', // hijau muda
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: false,
                },
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

    @endif

</div>

<script>
    const form = document.getElementById('investmentForm');
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('spinner');
    const btnText = document.getElementById('btnText');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        spinner.classList.remove('hidden');
        btnText.innerText = 'Loading...';
    });
</script>
@endsection
