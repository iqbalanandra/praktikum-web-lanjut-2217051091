@extends('layouts.app')

@section('content')

<body class="bg-[#f4f4f9] min-h-screen flex items-center justify-center font-pixel">

  <!-- Card/Container -->
  <div class="max-w-4xl w-full bg-white border-4 border-[#333] p-6 shadow-none">

    <!-- Title -->
    <h2 class="text-2xl font-bold text-[#333] mb-4 text-center border-b-4 border-[#333] pb-2 uppercase tracking-wider">
      Data Users
    </h2>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Pengguna Baru</a>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border-4 border-[#333]">
        <thead>
          <tr class="bg-gray-800 text-left text-sm leading-normal text-white uppercase tracking-wider">
            <th class="py-3 px-6 border-r-4 border-[#333]">ID</th>
            <th class="py-3 px-6 border-r-4 border-[#333]">Nama</th>
            <th class="py-3 px-6 border-r-4 border-[#333]">Kelas</th>
            <th class="py-3 px-6 border-r-4 border-[#333]">Foto</th>
            <th class="py-3 px-6 border-r-4 border-[#333]">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-bold uppercase">
          @foreach ($users as $user)
          <tr class="border-b-4 border-[#333] hover:bg-gray-200">
            <td class="py-3 px-6 border-r-4 border-[#333]">{{ $user['id'] }}</td>
            <td class="py-3 px-6 border-r-4 border-[#333]">{{ $user['nama'] }}</td>
            <td class="py-3 px-6 border-r-4 border-[#333]">{{ $user['nama_kelas'] }}</td>
            <td>
            <img src="{{ $user->foto ? asset($user->foto) : asset('assets/img/default.png') }}" alt="Foto User" width="100"></td>
            <td>
                    <!-- View -->
                    <a href="{{ route('user.show', $user['id']) }}">View</a>

                    <!-- Edit -->
                    <a href="{{ route('user.edit', $user['id']) }}" >Edit</a>

                    <!-- Delete -->
                    <form action="{{ route('user.destroy', $user['id']) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
                    </form>
                </td>
            

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>

</body>

@endsection
