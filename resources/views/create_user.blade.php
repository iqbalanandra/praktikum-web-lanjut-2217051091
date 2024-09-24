<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minimalist Sign-Up Form</title>
  @vite('resources/css/app.css')
  <style>
    /* Importing pixelated retro font */
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

    .font-pixel {
      font-family: 'Press Start 2P', cursive;
    }
    .bg-primary {
      background-color: #f4f4f9;
    }

    .bg-secondary {
      background-color: #ffffff;
    }

    .border-primary {
      border-color: #d1d5db;
    }

    .text-primary {
      color: #333;
    }
  </style>
</head>

<body class="bg-primary min-h-screen flex items-center justify-center">

  <!-- Card/Container -->
  <div class="max-w-md w-full bg-secondary rounded-lg shadow-md border border-primary p-6">

    <form action="{{ route('user.store') }}" method="POST" class="font-pixel">
      @csrf

      <!-- Title -->
      <h2 class="text-lg font-bold text-primary mb-4 text-center">
        Sign Up Form
      </h2>

      <!-- Input Nama -->
      <div class="mb-4">
        <label for="nama" class="block text-sm text-primary mb-2">
          Nama:
        </label>
        <input type="text" name="nama" id="nama" class="w-full border border-primary py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Masukkan Nama" required>
      </div>

      <!-- Input NPM -->
      <div class="mb-4">
        <label for="npm" class="block text-sm text-primary mb-2">
          NPM:
        </label>
        <input type="text" name="npm" id="npm" class="w-full border border-primary py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Masukkan NPM" required>
      </div>

      <!-- Input Kelas -->
      <div class="mb-4">
        <label for="kelas" class="block text-sm text-primary mb-2">
          Kelas:
        </label>
        <input type="text" name="kelas" id="kelas" class="w-full border border-primary py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-red-300" placeholder="Masukkan Kelas" required>
      </div>

      <!-- Tombol Submit -->
      <div class="flex items-center justify-center">
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-300">
          Submit
        </button>
      </div>
    </form>
  </div>

</body>

</html>
