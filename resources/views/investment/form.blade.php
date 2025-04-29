<!-- resources/views/investment/form.blade.php -->
@extends('layouts.custom')


@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow p-6 rounded">
  <h1 class="text-2xl font-bold mb-4">Investment Comparison Input</h1>
  <form action="{{ route('investment.calculate') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="amount" class="block font-medium">Amount (RM):</label>
      <input id="amount" name="amount" type="number" required
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
      <label for="rate_asb" class="block font-medium">ASB Return (%):</label>
      <input id="rate_asb" name="rate_asb" type="number" step="0.01" required
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-4">
      <label for="rate_th" class="block font-medium">Tabung Haji Return (%):</label>
      <input id="rate_th" name="rate_th" type="number" step="0.01" required
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mb-6">
      <label for="rate_emas" class="block font-medium">Emas Return (%):</label>
      <input id="rate_emas" name="rate_emas" type="number" step="0.01" required
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <button type="submit"
    class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
    Calculate
</button>

  </form>
</div>
@endsection
