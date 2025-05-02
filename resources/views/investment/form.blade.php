
@extends('layouts.custom')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow p-6 rounded">
  <h1 class="text-2xl font-bold mb-4">Investment Comparison Input</h1>
  <form action="{{ route('investment.calculate') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="amount" class="block font-medium">Amount (RM):</label>
      <input id="amount" name="amount" type="number" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
      <label for="rate_asb" class="block font-medium">ASB Return (%):</label>
      <input id="rate_asb" name="rate_asb" type="number" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
      <label for="rate_th" class="block font-medium">Tabung Haji Return (%):</label>
      <input id="rate_th" name="rate_th" type="number" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-6">
      <label for="rate_emas" class="block font-medium">Emas Return (%):</label>
      <input id="rate_emas" name="rate_emas" type="number" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
      Calculate
    </button>
  </form>

  <!-- Trigger Button -->
  <button onclick="toggleModal(true)" class="w-full mt-4 py-2 px-4 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-600 transition">
    Kalkulator Keuntungan Emas
  </button>
</div>

<!-- Modal -->
<div id="goldModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto mt-24 p-6 relative">
    <h3 class="text-xl font-semibold mb-4">Kalkulator Keuntungan Emas</h3>
    <form onsubmit="kiraKeuntunganEmas(event)">
      <div class="mb-3">
        <label class="block font-medium">Modal (RM):</label>
        <input type="number" id="modalEmas" class="form-input w-full rounded border-gray-300" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Semalam (RM/gram):</label>
        <input type="number" id="hargaSemalam" step="0.01" class="form-input w-full rounded border-gray-300" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Hari Ini (RM/gram):</label>
        <input type="number" id="hargaHariIni" step="0.01" class="form-input w-full rounded border-gray-300" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Gram Emas Dibeli:</label>
        <input type="number" id="gram" step="0.01" class="form-input w-full rounded border-gray-300" required>
      </div>
      <div id="hasilEmas" class="bg-gray-100 p-3 rounded mb-3 hidden">
        <p id="gramText" class="mb-1"></p>
        <strong id="keuntunganText"></strong>
      </div>
      <div class="flex justify-end">
        <button type="button" onclick="toggleModal(false)" class="mr-3 text-gray-500">Tutup</button>
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Kira</button>
      </div>
    </form>
  </div>
</div>

<script>
  function toggleModal(show) {
    const modal = document.getElementById('goldModal');
    if (show) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    } else {
      modal.classList.remove('flex');
      modal.classList.add('hidden');
    }
  }

  function kiraKeuntunganEmas(event) {
    event.preventDefault();
    const modal = parseFloat(document.getElementById('modalEmas').value);
    const semalam = parseFloat(document.getElementById('hargaSemalam').value);
    const hariIni = parseFloat(document.getElementById('hargaHariIni').value);
    const gram = parseFloat(document.getElementById('gram').value);
    const nilaiHariIni = gram * hariIni;
    const keuntungan = nilaiHariIni - modal;

    document.getElementById('gramText').innerText = `Nilai semasa: RM${nilaiHariIni.toFixed(2)}`;
    document.getElementById('keuntunganText').innerText = `Keuntungan Bersih: RM${keuntungan.toFixed(2)}`;
    document.getElementById('hasilEmas').classList.remove('hidden');
  }
</script>
@endsection
