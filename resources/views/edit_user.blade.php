@extends('layouts.app')

@section('content')

<body class="bg-[#f4f4f9] min-h-screen flex items-center justify-center">

  <!-- Card/Container -->
  <div class="max-w-md w-full bg-white rounded-lg shadow-md border border-[#d1d5db] p-6">

    <form action="{{ route('user.update', $user->id) }}" method="POST" class="font-pixel" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Title -->
      <h2 class="text-lg font-bold text-[#333] mb-4 text-center">
        Edit User Form
      </h2>

      <!-- Input Nama -->
      <div class="mb-4">
        <label for="nama" class="block text-sm text-[#333] mb-2">
          Nama:
        </label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Masukkan Nama" required>
        @error('nama')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Input Kelas -->
      <div class="mb-4">
        <label for="kelas_id" class="block text-sm text-[#333] mb-2">
          Kelas:
        </label>
        <select name="kelas_id" id="kelas_id" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-red-300" required>
          @foreach ($kelas as $kelasItem)
          <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $user->kelas_id) == $kelasItem->id ? 'selected' : '' }}>
            {{ $kelasItem->nama_kelas }}
          </option>
          @endforeach
        </select>
        @error('kelas_id')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Input Semester -->
      <div class="mb-4">
        <label for="semester" class="block text-sm text-[#333] mb-2">
          Semester:
        </label>
        <input type="number" name="semester" id="semester" value="{{ old('semester', $user->semester) }}" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-purple-300" min="1" max="14" placeholder="Masukkan Semester" required>
        @error('semester')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Input Jurusan -->
      <div class="mb-4">
        <label for="jurusan" class="block text-sm text-[#333] mb-2">
          Jurusan:
        </label>
        <select name="jurusan" id="jurusan" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
          <option value="fisika" {{ old('jurusan', $user->jurusan) == 'fisika' ? 'selected' : '' }}>Fisika</option>
          <option value="kimia" {{ old('jurusan', $user->jurusan) == 'kimia' ? 'selected' : '' }}>Kimia</option>
          <option value="biologi" {{ old('jurusan', $user->jurusan) == 'biologi' ? 'selected' : '' }}>Biologi</option>
          <option value="matematika" {{ old('jurusan', $user->jurusan) == 'matematika' ? 'selected' : '' }}>Matematika</option>
          <option value="ilmu komputer" {{ old('jurusan', $user->jurusan) == 'ilmu komputer' ? 'selected' : '' }}>Ilmu Komputer</option>
        </select>
        @error('jurusan')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Input Fakultas -->
      <div class="mb-4">
        <label for="fakultas_id" class="block text-sm text-[#333] mb-2">
          Fakultas:
        </label>
        <select name="fakultas_id" id="fakultas_id" class="w-full border border-[#d1d5db] py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-red-300" required>
          @foreach ($fakultas as $fakultasItem)
          <option value="{{ $fakultasItem->id }}" {{ old('fakultas_id', $user->fakultas_id) == $fakultasItem->id ? 'selected' : '' }}>
            {{ $fakultasItem->nama_fakultas }}
          </option>
          @endforeach
        </select>
        @error('fakultas_id')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Input Foto -->
      <div class="mb-4">
        <label for="foto" class="block text-sm text-[#333] mb-2">
          Foto Profil:
        </label>
        <input type="file" id="foto" name="foto" class="w-full py-2 px-3">
        @if($user->foto)
        <div class="mt-2">
          <img src="{{ asset($user->foto) }}" alt="Current Foto" class="w-24 h-24 rounded-full object-cover">
        </div>
        @endif
        @error('foto')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tombol Submit -->
      <div class="flex items-center justify-center">
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-300">
          Update
        </button>
      </div>
    </form>
  </div>

</body>
@endsection
