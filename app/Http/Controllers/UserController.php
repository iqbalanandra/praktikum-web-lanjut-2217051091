<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;



class UserController extends Controller
{
    public $userModel;
    public $kelas;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelas = new Kelas();
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

        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);
    }

    public function store(Request $request)
    {
        // Validate request inputs including the image
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Initialize $fotoPath
        $fotoPath = null;

        // Handle file upload if a file is present
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = time() . '_' . $foto->getClientOriginalName();  // Generate unique file name
            $fotoPath = $foto->move(public_path('upload/img'), $fileName); // Move file to the 'upload/img' folder
        }

        // Store the user data including the path to the uploaded photo
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'foto' => $fotoPath ? 'upload/img/' . $fileName : null, // Save the relative path to the database
        ]);

        // Redirect with success message
        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = $this->userModel->getUser($id);

        $data = [
            'title' => 'Profile',
            'user'  => $user,
        ];

        return view('profile', $data);  // Fixed: Correctly pass view name and data
    }

    public function edit($id){
        $user = UserModel::findOrFail($id);
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $title = 'Edit User';
        return view('edit_user', compact('user', 'kelas', 'title'));
    }

    public function update(Request $request, $id){
        $user = UserModel::findOrFail($id);
    
        // Update data user lainnya
        $user->nama = $request->nama;
        $user->npm = $request->npm;
        $user->kelas_id = $request->kelas_id;
    
        // Cek apakah ada file foto yang di-upload
        if ($request->hasFile('foto')) {
            // Ambil nama file foto lama dari database
            $oldFilename = $user->foto;
    
            // Hapus foto lama jika ada
            if ($oldFilename) {
                $oldFilePath = public_path('storage/uploads/' . $oldFilename);
                // Cek apakah file lama ada dan hapus
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Hapus foto lama dari folder
                }
            }
    
            // Simpan file baru dengan storeAs
            $file = $request->file('foto');
            $newFilename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $newFilename, 'public'); // Menyimpan file ke folder uploads dalam storage/public
    
            // Update nama file di database
            $user->foto = $newFilename;
        }
    
        // Simpan perubahan pada user
        $user->save();
    
        return redirect()->route('user.list')->with('success', 'User Berhasil di Update');
    }

    public function destroy($id){
        $user = UserModel::findOrFail($id);
        $user->delete();
    
        return redirect()->to('/')->with('success', 'User Berhasil di Hapus');
    }
}
