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
				  <label class="block mb-1 text-sm font-medium">Amount:</label>
	<div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md overflow-hidden">
		<span class="px-3 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">RM</span>
		<input type="number" name="amount" required placeholder="1000"
			class="w-full px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-l border-gray-300 dark:border-gray-600 focus:outline-none">
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
			<button onclick="toggleEmasCiputModal(true)" class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded font-semibold">
	  Kalkulator Emas Ciput
	</button>
	  <button onclick="toggleJimatModal(true)" class="bg-red-500 text-white font-semibold py-2 rounded">💰 Kalkulator Penjimatan Emas</button>
	  <!-- Button trigger -->
	<button onclick="toggleCadanganModal(true)" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded">
	  💡 Kombinasi Emas Terbaik
	</button>
	<button onclick="toggleBandingModal(true)" class="py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition dark:bg-indigo-700 dark:hover:bg-indigo-800">
	  📊 Bandingkan RM vs Emas(Inflasi)
	</button>
	


		</div>

	   </div>

		<!-- Modal Styling Update -->
		<style>
		.modal-dark {
			background-color: rgba(0,0,0,0.6);
		}
		.modal-scroll {
	  max-height: calc(100vh - 40px);
	  overflow-y: auto;
	}
		</style>
		</div>
	</div>
		
	<!-- Modal -->
<div id="targetPlanModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center px-4 sm:px-0">
  <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6 relative">
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

      <div class="flex justify-end sticky bottom-0 pt-4 bg-white dark:bg-gray-800">
        <button type="button" onclick="toggleTargetPlanModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-fuchsia-600 text-white px-4 py-2 rounded hover:bg-fuchsia-700">Kira</button>
      </div>
    </form>
  </div>
</div>





	   <div id="emasModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center overflow-auto">
	  <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-white rounded-lg shadow-lg w-full max-w-md mx-auto my-10 p-6 relative modal-scroll">
		
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
<div id="zakatModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center px-4 sm:px-0">
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6 relative text-gray-900 dark:text-white">
    <h3 class="text-xl font-semibold mb-4">Kalkulator Zakat Emas</h3>
    <form onsubmit="kiraZakatEmas(event)">
      <div class="mb-4">
        <label for="beratEmas" class="block text-sm font-medium">Berat Emas (gram):</label>
        <input type="number" id="beratEmas" step="0.01"
          class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-500"
          required>
      </div>

      <div class="mb-4">
        <label for="hargaSemasa" class="block text-sm font-medium">Harga Semasa (RM/gram):</label>
        <input type="number" id="hargaSemasa" step="0.01"
          class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-500"
          required>
      </div>

      <div class="mb-4">
        <label for="kategoriZakat" class="block text-sm font-medium">Kategori Simpanan:</label>
        <select id="kategoriZakat"
          class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-500">
          <option value="perhiasan">Perhiasan (pakai harian)</option>
          <option value="simpanan">Simpanan sepenuhnya</option>
        </select>
      </div>

      <div class="mb-1">
        <label for="haulBulan" class="block text-sm font-medium">Tempoh Simpanan (bulan):</label>
        <input type="number" id="haulBulan"
          class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-500"
          required>
      </div>
      <p class="text-xs text-gray-500 dark:text-gray-300 mb-4">*Wajib zakat jika simpanan ≥ 12 bulan</p>

      <div id="hasilZakat"
        class="bg-gray-100 dark:bg-gray-700 p-3 rounded mb-4 hidden text-sm text-green-700 dark:text-green-400">
        <p id="statusZakat" class="mb-1 font-semibold text-blue-700 dark:text-blue-300"></p>
        <p id="jumlahZakat" class="font-semibold"></p>
      </div>

      <div class="flex justify-end sticky bottom-0 bg-white dark:bg-gray-800 pt-4">
        <button type="button" onclick="toggleZakatModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Kira</button>
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

	<!-- Modal Kalkulator Emas Ciput -->
	<div id="emasCiputModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
	  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md mx-auto mt-24 p-6 relative text-gray-900 dark:text-white">
		<h3 class="text-xl font-semibold mb-4">Kalkulator Emas Ciput</h3>
		<form onsubmit="kiraEmasCiput(event)">
		  <div class="mb-4">
			<label class="block text-sm font-medium">Berat Emas (gram):</label>
			<input type="number" id="ciputGram" step="0.0001" class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-700 dark:text-white" value="0.001" required>
		  </div>
		  <div class="mb-4">
			<label class="block text-sm font-medium">Harga (RM) untuk Berat Tersebut:</label>
			<input type="number" id="ciputHarga" step="0.01" class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-700 dark:text-white" value="10" required>
		  </div>
		  <div id="hasilEmasCiput" class="bg-gray-100 dark:bg-gray-700 text-sm p-4 rounded hidden mt-3"></div>
		  <div class="flex justify-end">
			<button type="button" onclick="toggleEmasCiputModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
			<button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Kira</button>
		  </div>
		</form>
	  </div>
	</div>

	<div id="jimatModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
	  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md mx-auto mt-24 p-6 text-gray-900 dark:text-white relative">
		<h3 class="text-xl font-semibold text-red-600 mb-4">💰 Kalkulator Penjimatan Emas</h3>
		<form onsubmit="kiraJimatEmas(event)">
		  <div class="mb-4">
			<label class="block text-sm font-medium">Harga Tertinggi (RM/gram):</label>
			<input type="number" id="hargaTertinggi" step="0.01"
				   class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
		  </div>
		  <div class="mb-4">
			<label class="block text-sm font-medium">Harga Semasa (RM/gram):</label>
			<input type="number" id="hargaSemasaJimat" step="0.01"
				   class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
		  </div>
		  <div class="mb-4">
			<label class="block text-sm font-medium">Berat Emas (gram):</label>
			<input type="number" id="beratJimat" step="0.01"
				   class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
		  </div>

		  <div id="hasilJimat" class="bg-green-100 dark:bg-green-900 p-4 rounded mb-3 hidden text-green-800 dark:text-green-300 text-sm font-medium">
			✅ Penjimatan: <span id="nilaiJimat">RM0.00</span>
		  </div>

		  <div class="flex justify-end">
			<button type="button" onclick="toggleJimatModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
			<button type="reset" onclick="resetJimatForm()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Reset</button>
			<button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Kira</button>
		  </div>
		</form>
	  </div>
	</div>

	<!-- Modal Cadangan Kombinasi Emas -->
	<div id="cadanganModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
	  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md mx-auto mt-20 p-6 relative text-gray-900 dark:text-white">
		<h3 class="text-xl font-semibold mb-4">Cadangan Kombinasi Emas</h3>
		<form onsubmit="kiraCadanganEmas(event)">
		  <div class="mb-4">
			<label class="block text-sm font-medium">Bajet Anda (RM):</label>
			<input type="number" id="bajetCadangan" step="0.01" required class="w-full rounded border-gray-300 px-3 py-2 dark:bg-gray-700 dark:text-white">
		  </div>

		  <div id="hasilCadanganEmas" class="bg-gray-100 dark:bg-gray-700 text-sm p-4 rounded hidden mt-3">
			<p class="font-medium text-green-700 dark:text-green-300 mb-2">Cadangan pembelian emas:</p>
			<ul id="senaraiCadanganEmas" class="list-disc list-inside text-gray-800 dark:text-gray-200"></ul>
		  </div>

		  <div class="flex justify-end mt-4">
			<button type="button" onclick="toggleCadanganModal(false)" class="mr-3 text-gray-500 dark:text-gray-300">Tutup</button>
			<button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded">Kira</button>
		  </div>
		</form>
	  </div>
	</div>

	<!-- Modal Banding RM vs Emas -->
<div id="bandingModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4 sm:p-0 overflow-y-auto">
  <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg mx-auto overflow-y-auto max-h-screen">

    <h3 class="text-lg font-semibold mb-4 text-indigo-700 dark:text-indigo-300">📊 Bandingkan Simpan RM vs Emas</h3>
    <form onsubmit="kiraBandingSimpanan(event)">
      <!-- Input Fields -->
      <div class="mb-3">
        <label class="block font-medium text-gray-800 dark:text-white">Simpanan Bulanan (RM):</label>
        <input type="number" id="bandingBulanan" class="w-full rounded border border-gray-300 dark:border-gray-600 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium text-gray-800 dark:text-white">Tempoh Simpanan (tahun):</label>
        <input type="number" id="bandingTahun" class="w-full rounded border border-gray-300 dark:border-gray-600 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
      </div>
      <div class="mb-3">
        <label class="block font-medium text-gray-800 dark:text-white">Kadar Inflasi (% setahun):</label>
        <input type="number" step="0.1" id="bandingInflasi" value="3" class="w-full rounded border border-gray-300 dark:border-gray-600 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
      </div>
      <div class="mb-3">
        <label class="block font-medium text-gray-800 dark:text-white">Kenaikan Harga Emas (% setahun):</label>
        <input type="number" step="0.1" id="bandingKenaikanEmas" value="6" class="w-full rounded border border-gray-300 dark:border-gray-600 px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
      </div>

      <!-- Hasil -->
      <div id="bandingHasil" class="hidden mt-4">
        <div class="bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded p-4 text-sm space-y-3">
          <div class="flex items-center justify-between">
            <span class="flex items-center gap-2">
              <span class="text-lg">📉</span>
              <span class="font-medium text-gray-800 dark:text-white">Jika simpan sebagai tunai (RM):</span>
            </span>
            <span id="hasilRM" class="font-bold text-red-600 dark:text-red-400">RM0.00</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="flex items-center gap-2">
              <span class="text-lg">📈</span>
              <span class="font-medium text-gray-800 dark:text-white">Jika simpan dalam emas:</span>
            </span>
            <span id="hasilEmas" class="font-bold text-green-600 dark:text-green-400">RM0.00</span>
          </div>
          <p class="text-xs text-gray-600 dark:text-gray-300 mt-2">
            *Kiraan berdasarkan inflasi <span id="inflasiVal">3.0</span>% dan kenaikan emas <span id="kenaikanVal">6.0</span>% setahun
          </p>
        </div>
      </div>

      <!-- Butang -->
      <div class="flex justify-end mt-4">
        <button type="button" onclick="toggleBandingModal(false)" class="text-gray-500 dark:text-gray-300 mr-2">Tutup</button>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Kira</button>
      </div>
    </form>

    <!-- Chart -->
    <canvas id="bandingChart" class="mt-6" height="120"></canvas>
  </div>
</div>


	


	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
	  const modal = document.getElementById("emasModal");
	  if (show) {
		modal.classList.remove("hidden");
	  } else {
		modal.classList.add("hidden");
		document.getElementById("modalEmas").value = "";
		document.getElementById("hargaBeli").value = "";
		document.getElementById("hargaSekarang").value = "";
		document.getElementById("tarikhBeli").value = "";
		document.getElementById("tarikhJual").value = "";
		document.getElementById("hasilUntung").classList.add("hidden");
		document.getElementById("infoTarikh").innerHTML = "";
		document.getElementById("infoModal").innerHTML = "";
		document.getElementById("infoSemasa").innerHTML = "";
		document.getElementById("infoGram").innerHTML = "";
		document.getElementById("infoKeuntungan").innerHTML = "";
		document.getElementById("infoPercent").innerHTML = "";
		document.getElementById("infoTahunan").innerHTML = "";
	  }
	}

	 function kiraUntungEmas(event) {
	  event.preventDefault();

	  const modal = parseFloat(document.getElementById("modalEmas").value);
	  const hargaBeli = parseFloat(document.getElementById("hargaBeli").value);
	  const hargaSekarang = parseFloat(document.getElementById("hargaSekarang").value);
	  const tarikhBeli = new Date(document.getElementById("tarikhBeli").value);
	  const tarikhJual = new Date(document.getElementById("tarikhJual").value);

	  if (isNaN(modal) || isNaN(hargaBeli) || isNaN(hargaSekarang) || !tarikhBeli || !tarikhJual) {
		alert("Sila isi semua ruangan dengan betul.");
		return;
	  }

	  // Format tarikh kepada dd-mm-yyyy
	  function formatTarikh(date) {
		const d = new Date(date);
		const day = String(d.getDate()).padStart(2, '0');
		const month = String(d.getMonth() + 1).padStart(2, '0');
		const year = d.getFullYear();
		return `${day}-${month}-${year}`;
	  }

	  const tarikhMula = formatTarikh(tarikhBeli);
	  const tarikhAkhir = formatTarikh(tarikhJual);

	  const gramDibeli = modal / hargaBeli;
	  const nilaiSemasa = gramDibeli * hargaSekarang;
	  const keuntungan = nilaiSemasa - modal;
	  const nilaiBeliEmas = gramDibeli * hargaBeli;

	  const tempohTahun = (tarikhJual - tarikhBeli) / (1000 * 60 * 60 * 24 * 365.25);
	  const peratusKeuntungan = (keuntungan / modal) * 100;
	  const peratusSetahun = peratusKeuntungan / tempohTahun;

	  document.getElementById("infoTarikh").innerText = `Tempoh: ${tarikhMula} → ${tarikhAkhir}`;
	  document.getElementById("infoModal").innerText = `Modal Beli: RM${modal.toFixed(2)}`;
	  document.getElementById("infoSemasa").innerText =
		`Nilai Waktu Beli: RM${nilaiBeliEmas.toFixed(2)} (ikut gram waktu beli)\nNilai semasa: RM${nilaiSemasa.toFixed(2)}`;
	  document.getElementById("infoGram").innerText = `Gram Emas Dibeli: ${gramDibeli.toFixed(4)}g`;
	  document.getElementById("infoKeuntungan").innerText = `Keuntungan Bersih: RM${keuntungan.toFixed(2)}`;
	  document.getElementById("infoPercent").innerText =
		`Kenaikan: ${peratusKeuntungan.toFixed(2)}% (${tempohTahun.toFixed(1)} tahun)`;
	  document.getElementById("infoTahunan").innerText =
		`= ${peratusSetahun.toFixed(2)}% setahun`;

	  document.getElementById("hasilUntung").classList.remove("hidden");
	}
	  


	  function toggleZakatModal(show) {
	  const modal = document.getElementById("zakatModal");
	  modal.classList.toggle("hidden", !show);

	  if (!show) {
		document.getElementById("beratEmas").value = "";
		document.getElementById("hargaSemasa").value = "";
		document.getElementById("kategoriZakat").value = "perhiasan";
		document.getElementById("tempohSimpanan").value = "";
		document.getElementById("statusZakat").innerHTML = "";
		document.getElementById("jumlahZakat").innerHTML = "";
		document.getElementById("hasilZakat").classList.add("hidden");
	  }
	}

	  function kiraZakatEmas(event) {
	  event.preventDefault();
	  const berat = parseFloat(document.getElementById("beratEmas").value);
	  const harga = parseFloat(document.getElementById("hargaSemasa").value);
	  const kategori = document.getElementById("kategoriZakat").value;
	  const haul = parseInt(document.getElementById("haulBulan").value);
	  const hasil = document.getElementById("hasilZakat");

	  let nisab = kategori === "simpanan" ? 85 : 200;
	  let wajib = berat >= nisab && haul >= 12;

	  if (wajib) {
		const nilai = berat * harga;
		const zakat = nilai * 0.025;
		document.getElementById("statusZakat").innerHTML = "✅ Wajib Zakat";
		document.getElementById("jumlahZakat").innerHTML = "Zakat Perlu Dibayar: RM" + zakat.toFixed(2);
	  } else {
		document.getElementById("statusZakat").innerHTML = "❌ Belum Wajib Zakat";
		document.getElementById("jumlahZakat").innerHTML = "Emas tidak mencapai nisab atau belum cukup haul.";
	  }
	  hasil.classList.remove("hidden");
	}
	  
	  function toggleTargetModal(show) {
	  const modal = document.getElementById("targetModal");
	  if (show) {
		modal.classList.remove("hidden");
	  } else {
		modal.classList.add("hidden");
		document.getElementById("targetGramBajet").value = "";
		document.getElementById("hargaEmasBajet").value = "";
		document.getElementById("bajetBulananGram").value = "";
		document.getElementById("outputTargetGram").innerHTML = "";
	  }
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
	  const modal = document.getElementById("simulasiModal");
	  if (show) {
		modal.classList.remove("hidden");
	  } else {
		modal.classList.add("hidden");
		document.getElementById("hargaSekarang").value = "";
		document.getElementById("kadarKenaikan").value = "";
		document.getElementById("tempohTahun").value = "";
		document.getElementById("hasilSimulasi").classList.add("hidden");
		document.getElementById("simulasiOutput").innerHTML = "";
	  }
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
	  const modal = document.getElementById("hajiModal");
	  if (show) {
		modal.classList.remove("hidden");
	  } else {
		modal.classList.add("hidden");
		document.getElementById("kosHaji").selectedIndex = 0;
		document.getElementById("hargaHajiEmas").value = "";
		document.getElementById("hasilHaji").classList.add("hidden");
		document.getElementById("jumlahGramHaji").innerHTML = "";
		document.getElementById("senaraiCadangan").innerHTML = "";
		document.getElementById("totalCadangan").innerHTML = "";
	  }
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
	  const modal = document.getElementById("targetPlanModal");
	  if (show) {
		modal.classList.remove("hidden");
	  } else {
		modal.classList.add("hidden");
		document.getElementById("planTargetGram").value = "";
		document.getElementById("planTargetBulan").value = "";
		document.getElementById("planBajetBulanan").value = "";
		document.getElementById("planHargaSemasa").value = "";
		document.getElementById("outputPlanTarget").innerHTML = "";
	  }
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

	function toggleEmasCiputModal(show) {
	  const modal = document.getElementById('emasCiputModal');
	  modal.classList.toggle('hidden', !show);

	  if (!show) {
		// Reset input & hasil bila tutup
		document.getElementById("ciputGram").value = "";
		document.getElementById("ciputHarga").value = "";
		const hasilBox = document.getElementById("hasilEmasCiput");
		hasilBox.innerHTML = "";
		hasilBox.classList.add("hidden");
	  }
	}

	function kiraEmasCiput(e) {
	  e.preventDefault();
	  const gram = parseFloat(document.getElementById("ciputGram").value);
	  const harga = parseFloat(document.getElementById("ciputHarga").value);

	  if (gram <= 0 || harga <= 0) {
		alert("Masukkan nilai yang sah.");
		return;
	  }

	  const hargaPerGram = harga / gram;
	  const totalBayar = hargaPerGram * 1;

	  const hasilBox = document.getElementById("hasilEmasCiput");
	  hasilBox.innerHTML = `
		<p>💰 Anda sedang beli emas pada harga: <strong>RM${hargaPerGram.toFixed(2)}</strong> per gram.</p>
		<p>Untuk cukupkan <strong>1 gram</strong>, anda perlu bayar: <span class="font-bold text-red-600">RM${totalBayar.toFixed(2)}</span></p>
		<p class="mt-2 text-yellow-700">📌 Bandingkan dengan harga GAP yang biasanya sekitar RM400–RM500/g.</p>
	  `;
	  hasilBox.classList.remove("hidden");
	}
	function toggleJimatModal(show) {
	  const modal = document.getElementById("jimatModal");
	  modal.classList.toggle("hidden", !show);

	  if (!show) {
		resetJimatForm();
	  }
	}

	function resetJimatForm() {
	  document.getElementById("hargaTertinggi").value = "";
	  document.getElementById("hargaSemasaJimat").value = "";
	  document.getElementById("beratJimat").value = "";
	  document.getElementById("nilaiJimat").innerText = "RM0.00";
	  document.getElementById("hasilJimat").classList.add("hidden");
	}

	function kiraJimatEmas(e) {
	  e.preventDefault();
	  const tinggi = parseFloat(document.getElementById("hargaTertinggi").value);
	  const semasa = parseFloat(document.getElementById("hargaSemasaJimat").value);
	  const berat = parseFloat(document.getElementById("beratJimat").value);

	  if (tinggi > 0 && semasa > 0 && berat > 0) {
		const jimat = (tinggi - semasa) * berat;
		document.getElementById("nilaiJimat").innerText = `RM${jimat.toFixed(2)}`;
		document.getElementById("hasilJimat").classList.remove("hidden");
	  } else {
		alert("Sila isi semua medan dengan nilai yang sah.");
	  }
	}

	function toggleCadanganModal(show) {
	  const modal = document.getElementById("cadanganModal");
	  modal.classList.toggle("hidden", !show);
	}

	function kiraCadanganEmas(event) {
	  event.preventDefault();

	  const bajet = parseFloat(document.getElementById("bajetCadangan").value);
	  const hasil = document.getElementById("hasilCadanganEmas");
	  const senarai = document.getElementById("senaraiCadanganEmas");

	  hasil.classList.remove("hidden");
	  senarai.innerHTML = "";

	  let cadangan = [];

	  if (bajet >= 150000) {
		cadangan.push("Gold Bar 250g");
	  } else if (bajet >= 100000) {
		cadangan.push("Gold Bar 250g", "Coin 10 Dinar", "Gold Bar 50g", "Gold Bar 100g");
	  } else if (bajet >= 20000) {
		cadangan.push("Coin 10 Dinar", "Coin 5 Dinar", "Gold Bar 50g");
	  } else if (bajet >= 10000) {
		cadangan.push("Coin 10 Dinar", "Coin 5 Dinar", "Gold Bar 20g");
	  } else if (bajet >= 1000) {
		cadangan.push("Coin 1 Dinar", "Coin 1/2 Dinar", "Gold Bar 5g", "Gold Bar 10g");
	  } else if (bajet >= 800) {
		cadangan.push("Coin 1 Dinar", "Coin 1/2 Dinar", "Gold Bar 5g", "Gold Bar 10g");
	  }
	  else {
		cadangan.push("Coin 1/4 Dinar", "Gold Bar 1g");
	  }

	  cadangan.forEach(item => {
		const li = document.createElement("li");
		li.textContent = item;
		senarai.appendChild(li);
	  });
	}

	function toggleBandingModal(show) {
	  const modal = document.getElementById("bandingModal");
	  modal.classList.toggle("hidden", !show);
	  if (!show) {
		document.getElementById("bandingHasil").classList.add("hidden");
		document.getElementById("bandingHasil").innerHTML = "";
	  }
	}

	let bandingChartObj = null;

	function kiraBandingSimpanan(event) {
	    event.preventDefault();

  const bulanan = parseFloat(document.getElementById("bandingBulanan").value);
  const tahun = parseFloat(document.getElementById("bandingTahun").value);
  const inflasi = parseFloat(document.getElementById("bandingInflasi").value) / 100;
  const emas = parseFloat(document.getElementById("bandingKenaikanEmas").value) / 100;
  const bulan = tahun * 12;

  const simpanRM = bulanan * bulan * Math.pow((1 - inflasi), tahun);
  const simpanEmas = bulanan * bulan * Math.pow((1 + emas), tahun);

  const hasil = document.getElementById("bandingHasil");

  hasil.innerHTML = `
    <div class="bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded p-4 text-sm space-y-3">
      <div class="flex items-center justify-between">
        <span class="flex items-center gap-2">
          <span class="text-lg">📉</span>
          <span class="font-medium text-gray-800 dark:text-white">Jika simpan sebagai tunai (RM):</span>
        </span>
        <span class="font-semibold text-red-600 dark:text-red-400">RM${simpanRM.toFixed(2)}</span>
      </div>
      <div class="flex items-center justify-between">
        <span class="flex items-center gap-2">
          <span class="text-lg">📈</span>
          <span class="font-medium text-gray-800 dark:text-white">Jika simpan dalam emas:</span>
        </span>
        <span class="font-semibold text-green-600 dark:text-green-400">RM${simpanEmas.toFixed(2)}</span>
      </div>
      <p class="text-xs text-gray-600 dark:text-gray-300 mt-2">
        *Kiraan berdasarkan inflasi ${(inflasi * 100).toFixed(1)}% dan kenaikan emas ${(emas * 100).toFixed(1)}% setahun
      </p>
    </div>
  `;

  hasil.classList.remove("hidden");

	  // Render Chart
	  const ctx = document.getElementById("bandingChart").getContext("2d");
	  if (bandingChartObj) bandingChartObj.destroy(); // Reset chart jika sudah ada

	  bandingChartObj = new Chart(ctx, {
		type: 'bar',
		data: {
		  labels: ['Simpan Tunai', 'Simpan Emas'],
		  datasets: [{
			label: 'Nilai Selepas Simpanan',
			data: [simpanRM.toFixed(2), simpanEmas.toFixed(2)],
			backgroundColor: ['#f87171', '#34d399'], // merah & hijau
			borderRadius: 8,
			barThickness: 40
		  }]
		},
		options: {
		  responsive: true,
		  plugins: {
			legend: { display: false },
			tooltip: {
			  callbacks: {
				label: function(context) {
				  return `RM ${parseFloat(context.raw).toFixed(2)}`;
				}
			  }
			}
		  },
		  scales: {
			y: {
			  beginAtZero: true,
			  title: {
				display: true,
				text: 'Nilai Akhir (RM)',
				font: { size: 13 }
			  },
			  ticks: {
				callback: value => 'RM' + value.toLocaleString()
			  }
			}
		  }
		}
	  });
	}
	
	let roiChartObj = null;

function toggleRoiModal(show) {
  const modal = document.getElementById("roiModalWrapper");
  modal.classList.toggle("hidden", !show);

  if (!show) {
    document.getElementById("roiModal").value = "";
    document.getElementById("roiTahun").value = "";
    document.getElementById("roiEmas").value = "6.5";
    document.getElementById("roiASB").value = "5.0";
    document.getElementById("roiTH").value = "4.3";
    document.getElementById("roiHasil").classList.add("hidden");
    document.getElementById("roiResultTable").innerHTML = "";
    if (roiChartObj) roiChartObj.destroy();
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
