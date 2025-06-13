<?php

namespace App\Controllers;

use App\Models\ModelAuth;

class Profile extends BaseController
{
    public function __construct()
    {
        $userModel = new ModelAuth();
    }

    public function index()
    {
        $userModel = new ModelAuth();

        $userId = session()->get('id_user');
        $user = $userModel->find($userId);


        $data = [
            'title' => 'Profile Saya - Alrison Interior',
            'user'  => $user
        ];

        return view('profile/profile', $data);
    }

    public function update()
    {
        $userModel = new ModelAuth();
        $userId = session()->get('id_user');

        // Update data dasar ke $data
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $this->request->getPost('email'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'alamat'    => $this->request->getPost('alamat')
        ];

        // Update session user langsung
        session()->set($data);

        // Cek kalau ada cropped image dari CropperJS
        $croppedImage = $this->request->getPost('cropped_image_data');
        if ($croppedImage) {
            $fileName = 'profil_' . time() . '.png';
            $path = FCPATH . 'profile/' . $fileName;

            // Simpan base64 image ke file
            $croppedImage = str_replace('data:image/png;base64,', '', $croppedImage);
            $croppedImage = str_replace(' ', '+', $croppedImage);
            file_put_contents($path, base64_decode($croppedImage));

            $data['gambar_user'] = $fileName;
            session()->set('gambar_user', $fileName);
        } else {
            // Kalau ga ada crop image, cek upload file manual
            $fileFoto = $this->request->getFile('gambar_user');
            if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
                $namaFile = $fileFoto->getRandomName();
                $fileFoto->move('profile', $namaFile);
                $data['gambar_user'] = $namaFile;
                session()->set('gambar_user', $namaFile);
            }
        }

        // Simpan ke database
        $userModel->update($userId, $data);

        return redirect()->to(base_url('profil-saya'))->with('success', 'Profil berhasil diperbarui.');
    }
}
