<?php

namespace App\Controllers;

use App\Models\ModelAuth;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    protected $modelAuth;
    public function __construct()
    {
        $this->modelAuth = new ModelAuth();
        date_default_timezone_set('Asia/Jakarta');
        helper('form');
    }

    public function register()
    {
        // $users  = $this->modelAuth->Register();
        $validation = \Config\Services::validation();

        $data = [
            'title'     => 'Registrasi - Alrison Interior',
            'validation' => $validation
        ];

        // $modelAuth = new \App\Models\modelAuth();
        return view('auth/register', $data);
    }

    public function simpan_register()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama Anda',
                'rules' => 'required|max_length[25]',
                'errors' => [
                    'required'   => '{field} wajib diisi',
                    'max_length' => '{field} terlalu panjang'
                ]
            ],
            'username'  => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            // 'gambar_user'  => [
            //     'label' => 'Foto',
            //     'rules' => 'uploaded[gambar_user]|max_size[gambar_user,2048]|mime_in[gambar_user,image/jpg,image/jpeg,image/png]|is_image[gambar_user]',
            //     'errors' => [
            //         'uploaded' => '{field} wajib diunggah',
            //         'max_size' => 'Ukuran file maksimal 2MB.',
            //         'mime_in'  => 'Tipe file tidak diizinkan. Hanya JPG, JPEG, dan PNG.',
            //         'is_image' => 'Anda bukan mengiput {field}'
            //     ]
            // ],
            'email'     => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => '{field} wajib diisi',
                    'valid_email' => 'Anda bukan menginput {field}',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'no_hp'     => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'password'  => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required'    => '{field} wajib diisi',
                    'min_length'  => 'Password minimal 8 karakter.'
                ]
            ],
            'repassword'  => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required'    => '{field} wajib diisi',
                    'matches'     => 'Konfirmasi password tidak sesuai.',
                ]
            ]
        ])) {
            // $username = strtolower(str_replace(' ', '', $this->request->getPost('username'))); // huruf kecil semua dengan angka
            $username = preg_replace('/[^A-Za-z]/', '', $this->request->getPost('username')); // buang selain huruf
            $username = ucfirst(strtolower($username)); // kapital di huruf pertama, sisanya kecil

            $password = $this->request->getPost('password');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $this->modelAuth->save([
                'nama_user'     => $this->request->getPost('nama_user'),
                'email'         => $this->request->getPost('email'),
                'username'      => $username,
                'no_hp'         => $this->request->getPost('no_hp'),
                'alamat'        => $this->request->getPost('alamat'),
                'password'      => $hashedPassword,
                'level'         => 2,
                'gambar_user'   => 'default.jpeg'
            ]);

            session()->setFlashdata('sukses', 'Register berhasil!');
            return redirect()->to(base_url('auth/login'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('auth/register')->withInput();
        }
    }

    public function simpan_foto()
    {
        $fileFoto = $this->request->getFile('gambar_user');
        $namaFile = 'default-profile.png';

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFile = $fileFoto->getRandomName();
            $fileFoto->move('profile', $namaFile);
        }

        // pastikan user udah login
        $id_user = session()->get('id_user');

        $this->modelAuth->update($id_user, [
            'gambar_user'   => $namaFile,
        ]);

        // update session
        session()->set('gambar_user', $namaFile);

        return redirect()->to(base_url('toko'));
    }


    public function login()
    {
        $data = [
            'title'     => 'Login - Alrison Interior',
        ];

        return view('auth/login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'email'     => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'password'  => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
        ])) {
            // berhasil
            // $post     = $this->request->getPost();
            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $cek = $this->modelAuth->where('email', $email)->first();

            if ($cek) {
                if (password_verify($password, $cek['password'])) {
                    // Update last activity setelah login sukses
                    date_default_timezone_set('Asia/Jakarta');
                    $this->modelAuth->update($cek['id_user'], [
                        'last_activity' => date('Y-m-d H:i:s')
                    ]);

                    session()->set('log', true);
                    session()->set('id_user', $cek['id_user']);
                    session()->set('nama_user', $cek['nama_user']);
                    session()->set('username', $cek['username']);
                    session()->set('email', $cek['email']);
                    session()->set('no_hp', $cek['no_hp']);
                    session()->set('alamat', $cek['alamat']);
                    session()->set('level', $cek['level']);
                    session()->set('gambar_user', $cek['gambar_user']);

                    // Cek kalau dia sudah punya foto profil
                    if ($cek['gambar_user'] && $cek['gambar_user'] != 'default.jpeg') {
                        return redirect()->to(base_url('toko'));
                    } else {
                        return redirect()->to(base_url('toko/selamat-datang'));
                    }
                } else {
                    session()->setFlashdata('gagal', 'Password salah!');
                    return redirect()->to(base_url('auth/login'));
                }
            } else {
                session()->setFlashdata('gagal', 'Email tidak ditemukan!');
                return redirect()->to(base_url('auth/login'));
            }
        }
    }

    public function logout()
    {
        $id_user = session()->get('id_user');

        // Update last_activity saat logout
        $this->modelAuth->update($id_user, [
            'last_activity' => date('Y-m-d H:i:s')
        ]);

        session()->remove('log');
        session()->remove('nama_user');
        session()->remove('level');
        session()->remove('email');
        session()->remove('username');
        session()->remove('password');
        session()->remove('gambar_user');
        // session()->destroy();

        session()->setFlashdata('sukses', 'Logout berhasil');
        return redirect()->to(base_url('auth/login'));
    }

    // lupa password
    public function forgotPassword()
    {
        $data = [
            'title' => 'Lupa Password - Alrison Interior'
        ];

        return view('auth/forgot_password', $data);
    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        $userModel = new ModelAuth();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            $token = bin2hex(random_bytes(16));
            $expired = Time::now()->addMinutes(30);

            $userModel->update($user['id_user'], [
                'reset_token' => $token,
                'reset_token_expired' => $expired
            ]);

            // Simulasi kirim link (nanti bisa diubah jadi kirim email)
            session()->setFlashdata('success', 'Copy Link reset : ' . base_url('reset-password/' . $token));
        } else {
            session()->setFlashdata('error', 'Alamat email tidak ditemukan');
        }

        return redirect()->to('forgot-password');
    }

    public function resetPassword($token)
    {
        $userModel = new ModelAuth();
        $user = $userModel->where('reset_token', $token)
            ->where('reset_token_expired >=', Time::now())
            ->first();

        if (!$user) {
            return redirect()->to('forgot-password')->with('error', 'Token tidak valid dan sudah kedaluarsa.');
        }

        $data = [
            'title' => 'Reset Password - Alrison Interior',
            'token' => $token,
        ];

        return view('auth/reset_password', $data);
    }

    public function processResetPassword($token)
    {
        $password = $this->request->getPost('password');
        $confirm = $this->request->getPost('confirm');

        if ($password != $confirm) {
            return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak cocok.');
        }

        $userModel = new ModelAuth();
        $user = $userModel->where('reset_token', $token)
            ->where('reset_token_expired >=', Time::now())
            ->first();

        if (!$user) {
            return redirect()->to('forgot-password')->with('error', 'Token tidak valid dan sudah kedaluarsa.');
        }

        $userModel->update($user['id_user'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expired' => null
        ]);

        return redirect()->to('/auth/login')->with('sukses', 'Password berhasil diubah.');
    }

    // ganti password
    public function changePassword()
    {
        return view('auth/change_password');
    }

    public function processChangePassword()
    {
        $userModel = new ModelAuth();
        $userId = session()->get('id_user');
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $user = $userModel->find($userId);

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama salah.');
        }

        if ($newPassword != $confirmPassword) {
            return redirect()->back()->with('error', 'Password baru dan konfirmasi tidak cocok.');
        }

        $userModel->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        // Cek level user
        $level = session()->get('level');

        if ($level == 1) {
            return redirect()->to(base_url('dashboard'))->with('sukses', 'Password berhasil diubah.');
        } elseif ($level == 2) {
            return redirect()->to(base_url('toko'))->with('sukses', 'Password berhasil diubah.');
        } else {
            return redirect()->to(base_url('auth/login'))->with('sukses', 'Password berhasil diubah.');
        }
    }
}
