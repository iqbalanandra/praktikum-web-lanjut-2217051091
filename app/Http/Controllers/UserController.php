<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use App\Models\Fakultas; // Tambahkan Fakultas Model
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userModel;
    public $kelas;
    public $fakultas; // Tambahkan properti fakultas

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelas = new Kelas();
        $this->fakultas = new Fakultas(); // Inisialisasi fakultas
    }

    public function index()
    {
        $data = [
            'title' => 'Create User',
            'users' => $this->userModel->getUser(),
        ];

        return view('list_user', $data);
    }

    public function create()
    {
        $kelas = $this->kelas->getKelas();
        $fakultas = $this->fakultas->all(); // Ambil semua data fakultas

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
            'fakultas' => $fakultas, // Kirim fakultas ke view
        ];

        return view('create_user', $data);
    }

    public function store(Request $request)
    {
        // Validasi input termasuk semester, jurusan, fakultas_id dan gambar
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'semester' => 'required|integer|min:1|max:14', // Validasi semester
            'jurusan' => 'required|in:fisika,kimia,biologi,matematika,ilmu komputer', // Validasi jurusan
            'fakultas_id' => 'required|integer|exists:fakultas,id', // Validasi fakultas_id dengan tabel fakultas
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Inisialisasi $fotoPath
        $fotoPath = null;

        // Handle file upload jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = time() . '_' . $foto->getClientOriginalName();  // Generate nama file unik
            $fotoPath = $foto->move(public_path('upload/img'), $fileName); // Pindahkan file ke folder 'upload/img'
        }

        // Simpan data user
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'semester' => $request->input('semester'),
            'jurusan' => $request->input('jurusan'),
            'fakultas_id' => $request->input('fakultas_id'),
            'foto' => $fotoPath ? 'upload/img/' . $fileName : null, // Simpan jalur foto ke database
        ]);

        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = $this->userModel->getUser($id);

        $data = [
            'title' => 'Profile',
            'user'  => $user,
        ];

        return view('profile', $data);
    }

    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = $this->kelas->getKelas();
        $fakultas = $this->fakultas->all(); // Ambil semua fakultas

        $data = [
            'title' => 'Edit User',
            'user' => $user,
            'kelas' => $kelas,
            'fakultas' => $fakultas, // Kirim fakultas ke view
        ];

        return view('edit_user', $data);
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        // Validasi input termasuk semester, jurusan, fakultas_id dan gambar
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'semester' => 'required|integer|min:1|max:14', // Validasi semester
            'jurusan' => 'required|in:fisika,kimia,biologi,matematika,ilmu komputer', // Validasi jurusan
            'fakultas_id' => 'required|integer|exists:fakultas,id', // Validasi fakultas_id
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data user
        $user->nama = $request->input('nama');
        $user->kelas_id = $request->input('kelas_id');
        $user->semester = $request->input('semester');
        $user->jurusan = $request->input('jurusan');
        $user->fakultas_id = $request->input('fakultas_id');

        // Cek jika ada file foto yang di-upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                $oldFilePath = public_path('upload/img/' . $user->foto);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Simpan file baru
            $file = $request->file('foto');
            $newFilename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/img'), $newFilename); // Pindahkan file baru ke folder 'upload/img'

            // Update nama file di database
            $user->foto = 'upload/img/' . $newFilename;
        }

        // Simpan perubahan pada user
        $user->save();

        return redirect()->route('user.list')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);

        // Hapus file foto jika ada
        if ($user->foto) {
            $filePath = public_path('upload/img/' . $user->foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $user->delete();

        return redirect()->to('/')->with('success', 'User berhasil dihapus');
    }
}
