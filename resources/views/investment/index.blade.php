@extends('layouts.custom')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 flex flex-col gap-6">
 <!-- Theme Toggle Button -->
    <div class="flex justify-end mb-4">
        <button id="themeToggleBtn"
                onclick="toggleTheme()"
                class="text-sm px-4 py-2 rounded border shadow text-white bg-gray-800 dark:bg-white dark:text-gray-800">
            🌞 Light / Dark 🌙
        </button>
    </div>



     <!-- Form Section -->
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
        <h6 class="text-md font-semibold mb-2 text-gray-700 dark:text-gray-300">Develop By Mohd Badrulhazam PG00651763</h6>
        <h2 class="text-xl font-bold mb-6">💡 Investment Comparison Input</h2>

        <form id="investmentForm" action="{{ route('investment.index') }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">Amount (RM):</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">RM</span>
                        <input type="number" name="amount" required placeholder="Contoh: 1000"
                            class="w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 pl-10 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">ASB Return (%):</label>
                    <div class="relative">
                        <input type="number" name="rate_asb" step="0.01" required placeholder="5.0"
                            class="w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 pr-10 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">%</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">Tabung Haji Return (%):</label>
                    <div class="relative">
                        <input type="number" name="rate_th" step="0.01" required placeholder="4.5"
                            class="w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 pr-10 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">%</span>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-sm font-medium">Emas Return (%):</label>
                    <div class="relative">
                        <input type="number" name="rate_emas" step="0.01" required placeholder="6.2"
                            class="w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 pr-10 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">%</span>
                    </div>
                </div>
            </div>

            <button id="submitBtn" type="submit"
                class="w-full py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-md hover:opacity-90 transition duration-200 flex items-center justify-center mt-4">
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


        <!-- Trigger Buttons -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
        <button onclick="toggleEmasModal(true)" class="py-2 px-4 bg-lime-600 text-white font-semibold rounded-md hover:bg-lime-700 transition dark:bg-lime-700 dark:hover:bg-lime-800">Kalkulator Untung Emas</button>
        <button onclick="toggleZakatModal(true)" class="py-2 px-4 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition dark:bg-green-700 dark:hover:bg-green-800">Kalkulator Zakat Emas</button>
        <button onclick="toggleTargetModal(true)" class="py-2 px-4 bg-purple-600 text-white font-semibold rounded-md hover:bg-purple-700 transition dark:bg-purple-700 dark:hover:bg-purple-800">Target Gram Emas</button>
        <button onclick="toggleHajiModal(true)" class="py-2 px-4 bg-amber-600 text-white font-semibold rounded-md hover:bg-amber-700 transition dark:bg-amber-700 dark:hover:bg-amber-800">Kalkulator Emas untuk Haji</button>
        <button onclick="toggleTargetPlanModal(true)" class="py-2 px-4 bg-fuchsia-600 text-white font-semibold rounded-md hover:bg-fuchsia-700 transition dark:bg-fuchsia-700 dark:hover:bg-fuchsia-800">Kiraan Simpanan Bulanan Capai Target Emas</button>
    </div>

    <!-- Modal Styling Update -->
    <style>
    .modal-dark {
        background-color: rgba(0,0,0,0.6);
    }
    </style>
    </div>
</div>
	
<!-- Modal -->
<div id="targetPlanModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
  <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-full max-w-md mx-auto mt-20 p-6 relative">
    <h3 class="text-xl font-semibold mb-4">Berapa Gram Emas Kena Kumpul Setiap Bulan</h3>
    <form onsubmit="kiraPlanSimpanan(event)">
      <div class="mb-3">
        <label class="block font-medium">Target Simpanan Emas (gram):</label>
        <input type="number" id="planTargetGram" step="0.01" required
               class="w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 shadow-sm">
      </div>
      <div class="mb-3">
        <label class="block font-medium">Tempoh Simpanan (bulan):</label>
        <input type="number" id="planTargetBulan"
               class="w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 shadow-sm">
      </div>
	    <div class="mb-3">
        <label class="block font-medium">Bajet Bulanan (RM):</label>
        <input type="number" id="planBajetBulanan"
               class="w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 shadow-sm">
        <p class="text-xs text-gray-600 dark:text-gray-400">*Isi sama ada tempoh bulan atau bajet, tak perlu dua-dua</p>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Semasa (RM/gram):</label>
        <input type="number" id="planHargaSemasa" step="0.01" required
               class="w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 shadow-sm">
      </div>
      <div id="outputPlanTarget" class="bg-gray-100 dark:bg-gray-700 p-3 rounded text-sm text-blue-900 dark:text-blue-300"></div>
      <div class="flex justify-end mt-4">
        <button type="button" onclick="toggleTargetPlanModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-fuchsia-600 text-white px-4 py-2 rounded hover:bg-fuchsia-700">Kira</button>
      </div>
    </form>
  </div>
</div>




   <div id="emasModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
  <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-white rounded-lg shadow-lg w-full max-w-md mx-auto mt-24 p-6 relative">
    <h3 class="text-xl font-semibold mb-4">Kalkulator Keuntungan Emas</h3>
    <form onsubmit="kiraUntungEmas(event)">
      <div class="mb-3">
        <label class="block font-medium">Modal (RM):</label>
        <input type="number" id="modalEmas" class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-800 dark:text-white" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Waktu Beli (RM/gram):</label>
        <input type="number" id="hargaBeli" step="0.01" class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-800 dark:text-white" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Hari Ini (RM/gram):</label>
        <input type="number" id="hargaSekarang" step="0.01" class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-800 dark:text-white" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Tarikh Beli:</label>
        <input type="date" id="tarikhBeli" class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-800 dark:text-white">
      </div>
      <div class="mb-3">
        <label class="block font-medium">Tarikh Jual:</label>
        <input type="date" id="tarikhJual" class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-800 dark:text-white">
      </div>

      <div id="hasilUntung" class="bg-gray-100 dark:bg-gray-800 p-4 rounded mb-3 hidden text-sm leading-relaxed">
        <p id="infoTarikh" class="text-gray-600 dark:text-gray-300 text-sm mb-2"></p>
        <div class="text-gray-800 dark:text-white mb-1" id="infoModal"></div>
        <div class="text-gray-800 dark:text-white mb-1" id="infoNilaiWaktuBeli"></div>
        <div class="text-gray-800 dark:text-white mb-1" id="infoSemasa"></div>
        <div class="text-gray-800 dark:text-white mb-1" id="infoGram"></div>
        <div class="text-green-700 font-bold" id="infoKeuntungan"></div>
        <div class="text-green-600 font-semibold" id="infoPercent"></div>
        <div class="text-green-600 text-sm mt-1" id="infoTahunan"></div>
      </div>

      <div class="flex justify-end">
        <button type="button" onclick="toggleEmasModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-lime-600 text-white px-4 py-2 rounded hover:bg-lime-700">Kira</button>
      </div>
    </form>
  </div>
</div>



    <!-- Modal Kalkulator Zakat Emas -->
<div id="zakatModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 dark:bg-white/10">
  <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-full max-w-md mx-auto mt-24 p-6 relative">
    <h3 class="text-xl font-semibold mb-4">Kalkulator Zakat Emas</h3>
    <form onsubmit="kiraZakatEmas(event)">
      <div class="mb-3">
        <label class="block font-medium">Berat Emas (gram):</label>
        <input type="number" id="beratEmas" step="0.01"
          class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Semasa (RM/gram):</label>
        <input type="number" id="hargaSemasa" step="0.01"
          class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Kategori Simpanan:</label>
        <select id="kategoriZakat" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600">
          <option value="perhiasan">Perhiasan (pakai harian)</option>
          <option value="simpanan">Simpanan sepenuhnya</option>
        </select>
      </div>
      <div id="hasilZakat" class="bg-gray-100 dark:bg-gray-800 p-3 rounded mb-3 hidden text-sm">
        <p id="statusZakat" class="mb-1 font-semibold text-blue-700 dark:text-blue-400"></p>
        <p id="jumlahZakat" class="font-semibold text-green-700 dark:text-green-400"></p>
      </div>
      <div class="flex justify-end">
        <button type="button" onclick="toggleZakatModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Kira</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Target Gram -->
<div id="targetModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 dark:bg-white/10">
  <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-full max-w-md mx-auto mt-20 p-6 relative">
    <h3 class="text-xl font-semibold mb-4">Kiraan Target Gram Emas Berdasarkan Bajet</h3>
    <form onsubmit="kiraTargetGramBajet(event)">
      <div class="mb-3">
        <label class="block font-medium">Target Simpanan Emas (gram):</label>
        <input type="number" id="targetGramBajet" step="0.01" required
               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600">
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Semasa (RM/gram):</label>
        <input type="number" id="hargaEmasBajet" step="0.01" required
               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600">
      </div>
      <div class="mb-3">
        <label class="block font-medium">Bajet Bulanan (RM):</label>
        <input type="number" id="bajetBulananGram" required
               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600">
      </div>
      <div id="outputTargetGram" class="bg-gray-100 dark:bg-gray-800 p-3 rounded text-sm text-blue-900 dark:text-blue-200"></div>
      <div class="flex justify-end mt-4">
        <button type="button" onclick="toggleTargetModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Kira</button>
      </div>
    </form>
  </div>
</div>

<!-- Simulasi Modal -->
<div id="simulasiModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 dark:bg-white/10">
  <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-full max-w-md mx-auto mt-24 p-6 relative">
    <h3 class="text-xl font-semibold mb-4">Simulasi Kenaikan Harga Emas Tahunan</h3>
    <form onsubmit="kiraSimulasiEmas(event)">
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Sekarang (RM/gram):</label>
        <input type="number" id="hargaSekarang" step="0.01"
          class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Kadar Kenaikan Tahunan (%):</label>
        <input type="number" id="kadarKenaikan" step="0.01"
          class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Tempoh (tahun):</label>
        <input type="number" id="tempohTahun" step="1"
          class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600" required>
      </div>
      <div id="hasilSimulasi" class="bg-gray-100 dark:bg-gray-800 p-3 rounded mb-3 hidden text-sm">
        <p id="simulasiOutput" class="font-semibold text-indigo-700 dark:text-indigo-300 leading-relaxed"></p>
      </div>
      <div class="flex justify-end">
        <button type="button" onclick="toggleSimulasiModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Kira</button>
      </div>
    </form>
  </div>
</div>

<!-- Haji Modal -->
<div id="hajiModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 dark:bg-white/10">
  <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-full max-w-md mx-auto mt-24 p-6 relative">
    <h3 class="text-xl font-semibold mb-4">Kalkulator Emas Untuk Haji</h3>
    <form onsubmit="kiraEmasHaji(event)">
      <div class="mb-3">
        <label class="block font-medium">Kategori Haji:</label>
        <select id="kosHaji" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600">
          <option value="15000">B40 - RM15,000</option>
          <option value="23500">M40 - RM23,500</option>
          <option value="33300">T20 - RM33,300</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="block font-medium">Harga Emas Semasa (RM/gram):</label>
        <input type="number" id="hargaHajiEmas" step="0.01"
          class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm dark:bg-gray-800 dark:border-gray-600" required>
      </div>
      <div id="hasilHaji" class="bg-gray-100 dark:bg-gray-800 p-3 rounded mb-3 hidden text-sm leading-relaxed">
        <p id="jumlahGramHaji" class="font-semibold text-amber-700 dark:text-amber-300 mb-2"></p>
        <p class="font-medium">💡 Cadangan kombinasi emas:</p>
        <ul id="senaraiCadangan" class="list-disc list-inside text-sm text-gray-700 dark:text-gray-300"></ul>
        <p id="totalCadangan" class="mt-2 font-semibold text-green-700 dark:text-green-400"></p>
      </div>
      <div class="flex justify-end">
        <button type="button" onclick="toggleHajiModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">Kira</button>
      </div>
    </form>
  </div>
</div>


   <script>
  // Set theme bila page load
  // Set theme bila page load
  document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  });

  function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  }

   function toggleTargetModal(show) {
  const modal = document.getElementById('targetModal');
  modal.classList.toggle('hidden', !show);
  modal.classList.toggle('flex', show);
}

function kiraTargetGramBajet(event) {
  event.preventDefault();
  const gramTarget = parseFloat(document.getElementById('targetGramBajet').value);
  const harga = parseFloat(document.getElementById('hargaEmasBajet').value);
  const bajet = parseFloat(document.getElementById('bajetBulananGram').value);

  const output = document.getElementById('outputTargetGram');
  output.innerHTML = '';

  if (isNaN(gramTarget) || isNaN(harga) || isNaN(bajet) || bajet <= 0) {
    output.innerHTML = '<p class="text-red-600">Sila isi semua medan dengan betul.</p>';
    return;
  }

  const gramPerMonth = bajet / harga;
  const tempohBulan = Math.ceil(gramTarget / gramPerMonth);

  output.innerHTML = `
    <p class="mb-1">🎯 Target: <strong>${gramTarget.toFixed(2)} gram</strong></p>
    <p class="mb-1">💰 Bajet Bulanan: RM${bajet.toFixed(2)}</p>
    <p class="mb-1">📦 Dapat simpan sekitar <strong>${gramPerMonth.toFixed(4)} gram</strong> sebulan</p>
    <p class="mb-1">📅 Anggaran tempoh capai target: <strong>${tempohBulan} bulan</strong></p>
    <p class="text-xs text-gray-500">*Harga semasa: RM${harga.toFixed(2)}/g</p>
  `;
}

  function toggleEmasModal(show) {
  const modal = document.getElementById('emasModal');
  modal.classList.toggle('hidden', !show);
  modal.classList.toggle('flex', show);
}

function kiraUntungEmas(event) {
  event.preventDefault();

  const modal = parseFloat(document.getElementById("modalEmas").value);
  const hargaBeli = parseFloat(document.getElementById("hargaBeli").value);
  const hargaSekarang = parseFloat(document.getElementById("hargaSekarang").value);
  const tarikhBeli = document.getElementById("tarikhBeli").value;
  const tarikhJual = document.getElementById("tarikhJual").value;

  if (!modal || !hargaBeli || !hargaSekarang) return;

  const gram = modal / hargaBeli;
  const nilaiSemasa = gram * hargaSekarang;
  const keuntungan = nilaiSemasa - modal;
  const percent = (keuntungan / modal) * 100;

  let tahunText = "";
  let setahun = "";

  if (tarikhBeli && tarikhJual) {
    const mula = new Date(tarikhBeli);
    const tamat = new Date(tarikhJual);
    const bezaTahun = (tamat - mula) / (1000 * 60 * 60 * 24 * 365.25);
    tahunText = ` (${bezaTahun.toFixed(1)} tahun)`;
    setahun = `= ${(percent / bezaTahun).toFixed(2)}% setahun`;
    document.getElementById("infoTarikh").textContent = `Tempoh: ${tarikhBeli} → ${tarikhJual}`;
  } else {
    document.getElementById("infoTarikh").textContent = "";
  }

  document.getElementById("infoModal").textContent = `Modal Beli: RM${modal.toFixed(2)}`;
  document.getElementById("infoNilaiWaktuBeli").textContent = `Nilai Waktu Beli: RM${(gram * hargaBeli).toFixed(2)} (ikut gram waktu beli)`;
  document.getElementById("infoSemasa").textContent = `Nilai semasa: RM${nilaiSemasa.toFixed(2)}`;
  document.getElementById("infoGram").textContent = `Gram Emas Dibeli: ${gram.toFixed(4)}g`;
  document.getElementById("infoKeuntungan").textContent = `Keuntungan Bersih: RM${keuntungan.toFixed(2)}`;
  document.getElementById("infoPercent").textContent = `Kenaikan: ${percent.toFixed(2)}%${tahunText}`;
  document.getElementById("infoTahunan").textContent = setahun;

  document.getElementById("hasilUntung").classList.remove("hidden");
}

  function toggleZakatModal(show) {
    const modal = document.getElementById('zakatModal');
    modal.classList.toggle('hidden', !show);
    modal.classList.toggle('flex', show);
  }

  function kiraZakatEmas(event) {
    event.preventDefault();
    const berat = parseFloat(document.getElementById('beratEmas').value);
    const harga = parseFloat(document.getElementById('hargaSemasa').value);
    const kategori = document.getElementById('kategoriZakat').value;
    const nisab = 85;
    const dikecualikan = kategori === 'perhiasan' ? 200 : 0;

    let wajibZakat = false;
    let jumlahZakat = 0;
    const nilaiEmas = berat * harga;

    if (kategori === 'simpanan' && berat >= nisab) {
      wajibZakat = true;
      jumlahZakat = nilaiEmas * 0.025;
    } else if (kategori === 'perhiasan' && berat > dikecualikan) {
      wajibZakat = true;
      jumlahZakat = (berat - dikecualikan) * harga * 0.025;
    }

    document.getElementById('statusZakat').innerText =
      wajibZakat ? "✅ Wajib Zakat" : "❌ Tidak Wajib Zakat";
    document.getElementById('jumlahZakat').innerText =
      wajibZakat ? `Zakat Perlu Dibayar: RM${jumlahZakat.toFixed(2)}` : "";
    document.getElementById('hasilZakat').classList.remove('hidden');
  }
  
  function toggleTargetModal(show) {
  const modal = document.getElementById('targetModal');
  modal.classList.toggle('hidden', !show);
  modal.classList.toggle('flex', show);
}

function kiraTargetGram(event) {
  event.preventDefault();
  const gram = parseFloat(document.getElementById('targetGram').value);
  const harga = parseFloat(document.getElementById('hargaEmasTarget').value);
  const tempoh = parseInt(document.getElementById('tempohBulan').value);

  const jumlahRM = gram * harga;
  const bayaranBulanan = jumlahRM / tempoh;

  document.getElementById('totalRM').innerText = `Jumlah keseluruhan perlu simpan: RM${jumlahRM.toFixed(2)}`;
  document.getElementById('bulananRM').innerText = `Kadar simpanan bulanan: RM${bayaranBulanan.toFixed(2)}`;
  document.getElementById('hasilTarget').classList.remove('hidden');
}

function toggleSimulasiModal(show) {
  const modal = document.getElementById('simulasiModal');
  modal.classList.toggle('hidden', !show);
  modal.classList.toggle('flex', show);
}

function kiraSimulasiEmas(event) {
  event.preventDefault();
  const harga = parseFloat(document.getElementById('hargaSekarang').value);
  const kenaikan = parseFloat(document.getElementById('kadarKenaikan').value);
  const tahun = parseInt(document.getElementById('tempohTahun').value);

  let result = harga;
  let output = '';
  for (let i = 1; i <= tahun; i++) {
    result *= (1 + (kenaikan / 100));
    output += `Tahun ${i}: RM${result.toFixed(2)}<br>`;
  }

  document.getElementById('simulasiOutput').innerHTML = output;
  document.getElementById('hasilSimulasi').classList.remove('hidden');
}
function toggleHajiModal(show) {
  const modal = document.getElementById('hajiModal');
  modal.classList.toggle('hidden', !show);
  modal.classList.toggle('flex', show);
}

function kiraEmasHaji(event) {
  event.preventDefault();
  const kos = parseFloat(document.getElementById('kosHaji').value);
  const harga = parseFloat(document.getElementById('hargaHajiEmas').value);
  const gramTarget = kos / harga;

  const goldOptions = [
    { name: "10 dinar (42.5g)", grams: 42.5 },
    { name: "5 dinar (21.25g)", grams: 21.25 },
    { name: "Gold bar 10g", grams: 10 },
    { name: "Gold bar 5g", grams: 5 },
    { name: "1 dinar (4.25g)", grams: 4.25 }
  ];

  const summary = {};
  let total = 0;

  while (total < gramTarget) {
    const choice = goldOptions[Math.floor(Math.random() * goldOptions.length)];
    summary[choice.name] = (summary[choice.name] || 0) + 1;
    total += choice.grams;
  }

  document.getElementById('jumlahGramHaji').innerText =
    `Anda perlukan lebih kurang ${gramTarget.toFixed(2)} gram emas untuk tunaikan haji (RM${kos.toFixed(2)}).`;

  const list = document.getElementById('senaraiCadangan');
  list.innerHTML = "";
  for (const [name, count] of Object.entries(summary)) {
    list.innerHTML += `<li>${count}x ${name}</li>`;
  }

  document.getElementById('totalCadangan').innerText =
    `Jumlah kombinasi: ${(total).toFixed(2)} gram (lebih sedikit adalah lebih baik)`;

  document.getElementById('hasilHaji').classList.remove('hidden');
}
function toggleTargetPlanModal(show) {
  const modal = document.getElementById('targetPlanModal');
  modal.classList.toggle('hidden', !show);
  modal.classList.toggle('flex', show);
}

function kiraPlanSimpanan(event) {
  event.preventDefault();
  const gram = parseFloat(document.getElementById('planTargetGram').value);
  const bulanInput = document.getElementById('planTargetBulan').value;
  const bajetInput = document.getElementById('planBajetBulanan').value;
  const harga = parseFloat(document.getElementById('planHargaSemasa').value);
  const output = document.getElementById('outputPlanTarget');
  output.innerHTML = '';

  const bulan = bulanInput ? parseInt(bulanInput) : null;
  const bajet = bajetInput ? parseFloat(bajetInput) : null;

  if (isNaN(gram) || isNaN(harga) || (!bulan && !bajet)) {
    output.innerHTML = '<p class="text-red-600">Sila isi semua medan dengan betul.</p>';
    return;
  }

  if (bulan && !isNaN(bulan)) {
    const gramSebulan = gram / bulan;
    const nilaiSebulan = gramSebulan * harga;
    output.innerHTML = `
      <p class="mb-1">📈 Target anda: <strong>${gram.toFixed(2)} gram</strong> dalam ${bulan} bulan</p>
      <p class="mb-1">🎯 Anda perlu simpan <strong>${gramSebulan.toFixed(4)} gram</strong> setiap bulan</p>
      <p class="mb-1">💰 Anggaran nilai bulanan: <strong>RM${nilaiSebulan.toFixed(2)}</strong></p>
      <p class="text-xs text-gray-500">*Harga semasa: RM${harga.toFixed(2)}/g</p>
    `;
  } else if (bajet && !isNaN(bajet)) {
    const gramSebulan = bajet / harga;
    const bulanJangkaan = Math.ceil(gram / gramSebulan);
    output.innerHTML = `
      <p class="mb-1">🎯 Anda bajet RM${bajet.toFixed(2)} sebulan</p>
      <p class="mb-1">📦 Dapat simpan sekitar <strong>${gramSebulan.toFixed(4)} gram</strong> sebulan</p>
      <p class="mb-1">📅 Anda akan capai <strong>${gram.toFixed(2)} gram</strong> dalam <strong>${bulanJangkaan} bulan</strong></p>
      <p class="text-xs text-gray-500">*Harga semasa: RM${harga.toFixed(2)}/g</p>
    `;
  }
}
</script>


    @if (!empty($results))
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700 mt-10">
        <h2 class="text-lg font-bold mb-6">📊 Result for Investment: RM{{ number_format($investment, 2) }}</h2>
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full text-sm text-gray-800 dark:text-gray-100">
                <thead class="bg-gray-100 dark:bg-gray-800 text-sm">
                    <tr>
                        <th class="py-2 px-4 text-left">Instrument</th>
                        <th class="py-2 px-4 text-left">Return Rate (%)</th>
                        <th class="py-2 px-4 text-left">Profit 1 Year (RM)</th>
                        <th class="py-2 px-4 text-left">Profit 2 Years (RM)</th>
                        <th class="py-2 px-4 text-left">Profit 3 Years (RM)</th>
                        <th class="py-2 px-4 text-left">Profit 4 Years (RM)</th>
                        <th class="py-2 px-4 text-left">Profit 5 Years (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $r)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4">{{ $r['instrument'] }}</td>
                        <td class="py-2 px-4">{{ $r['return_rate'] }}%</td>
                        <td class="py-2 px-4">{{ number_format($r['profit_1_year'], 2) }}</td>
                        <td class="py-2 px-4">{{ number_format($r['profit_2_years'], 2) }}</td>
                        <td class="py-2 px-4">{{ number_format($r['profit_3_years'], 2) }}</td>
                        <td class="py-2 px-4">{{ number_format($r['profit_4_years'], 2) }}</td>
                        <td class="py-2 px-4">{{ number_format($r['profit_5_years'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <canvas id="investmentChart" height="150" class="mb-6"></canvas>
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
              backgroundColor: 'rgba(59, 130, 246, 0.7)',
              borderRadius: 8,
              barThickness: 24
            },
            {
              label: 'Profit 3 Years',
              data: profit3Years,
              backgroundColor: 'rgba(253, 224, 71, 0.7)',
              borderRadius: 8,
              barThickness: 24
            },
            {
              label: 'Profit 5 Years',
              data: profit5Years,
              backgroundColor: 'rgba(34, 197, 94, 0.7)',
              borderRadius: 8,
              barThickness: 24
            }
          ]
        },
        options: {
          responsive: true,
          animation: {
            duration: 1200,
            easing: 'easeOutBounce'
          },
          scales: {
            x: { grid: { display: false } },
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Profit (RM)',
                color: '#4B5563',
                font: { size: 14 }
              },
              grid: { color: '#E5E7EB' }
            }
          },
          plugins: {
            legend: {
              labels: {
                color: '#111827',
                font: { size: 13, weight: 'bold' }
              }
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return 'RM ' + context.raw.toFixed(2);
                }
              }
            }
          }
        }
      });
    </script>
    @endif
</div>


@endsection
