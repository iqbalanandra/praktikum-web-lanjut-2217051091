<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite('resources/css/app.css')
</head>

<body class=" font-pixelify flex items-center justify-center h-screen bg-blue-400 mx-4">

  <div class="border-4 border-black p-4 bg-white max-w-md grow rounded overflow-hidden shadow-md z-0">
    <!-- Foto Profil Lingkaran -->
    <div class="flex justify-center">
      <img class="w-24 h-24 bg-orange-400 rounded-full object-cover" src="{{asset("assets/img/image.png")}}" alt="Foto Profil">
    </div>
    <!-- Nama, Kelas, dan NPM -->
    <div class="text-center mt-4">
      <!-- Box Nama -->
      <div class="pixel-box font-semibold">{{$nama}}</div>
      <p class="pixel-box font-semibold">{{$kelas}}</p>
      <p class="pixel-box font-semibold">{{$npm}}</p>
    </div>
  </div>

</body>

</html>