@extends('layouts.app') 
 
@section('content') 

<body class="bg-[#f4f4f9] min-h-screen flex items-center justify-center">

  <!-- Card/Container -->
  <div class="max-w-md w-full bg-white rounded-lg shadow-md border border-[#d1d5db] p-6">

    <form action="{{ route('user.store') }}" method="POST" class="font-pixel"  enctype="multipart/form-data">
      @csrf

      <!-- Title -->
      <h2 class="text-lg font-bold text-[#333] mb-4 text-center">
        Sign Up Form
      </h2>

      <!-- Input Nama -->
      <div class="mb-4">
        <label for="nama" class="block text-sm text-[#333] mb-2">
          Nama:
        </label>
        <input type="text" name="nama" id="nama" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Masukkan Nama" required>
      </div>

      <!-- Input NPM -->
      <div class="mb-4">
        <label for="npm" class="block text-sm text-[#333] mb-2">
          NPM:
        </label>
        <input type="text" name="npm" id="npm" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Masukkan NPM" required>
      </div>

      <!-- Input Kelas -->
      <div class="mb-4">
        <label for="id_kelas" class="block text-sm text-[#333] mb-2">
          Kelas:
        </label>
        <select name="kelas_id" id="kelas_id" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-red-300" required>>
          @foreach ($kelas as $kelasItem)
          <option value="{{$kelasItem->id}}">{{$kelasItem->nama_kelas}}</option>
            
          @endforeach
        </select>
      </div>

      <input type="file" id="foto" name="foto"> <br> <br>
      <label for="foto">Foto: <br></label>

      <!-- Tombol Submit -->
      <div class="flex items-center justify-center">
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-300">
          Submit
        </button>
      </div>
    </form>
  </div>

</body>
@endsection