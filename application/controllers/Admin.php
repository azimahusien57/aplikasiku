<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // mengkoneksikan secara langsung antara model dan controller
    function __construct()
    {

        parent::__construct();
        $this->load->model('admin_model');
        // sesion login
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        } else {
            // jk behasil
            $nama_lengkap = $this->session->userdata('nama_lengkap');
        }
    }
    public function index()
    {
        $judul['title'] = "halaman utama admin";
        $judul['menutitle'] = "beranda";
        // database drngan simbol masing2 method atau class
        $data['s'] = $this->db->get('siswa')->num_rows();
        $data['g'] = $this->db->get('guru')->num_rows();
        $data['k'] = $this->db->get('kelas')->num_rows();

        $this->load->view('template/header', $judul);
        $this->load->view('beranda', $data);
        $this->load->view('template/footer');
    }
    // siswa
    public function siswa()
    {
        $judul['title'] = "halaman siswa";
        $judul['menutitle'] = "Siswa";
        $data['sis'] = $this->admin_model->joinsiswa();
        $this->load->view('template/header', $judul);
        $this->load->view('siswa', $data);
        $this->load->view('template/footer');
    }
    // halamn tamabh_kelas
    public function tambah_siswa()
    {
        $judul['title'] = "halaman  tambah siswa";
        $judul['menutitle'] = " form siswa";
        $data['combo'] = $this->admin_model->comboxdinamis();
        $this->load->view('template/header', $judul);
        $data['error'] = "";
        $this->load->view('form_siswa', $data);
        $this->load->view('template/footer');
    }
    // halaman simpan siswa
    public function simpan_siswa()
    {
        // required @ mencegah data kosong dan didlnm kurung isi yg ada di form guru
        $this->form_validation->set_rules('nisn', '', 'required', array('required' => 'nisn siswa wajid di isi'));
        $this->form_validation->set_rules('nama_siswa', '', 'required', array('required' => 'nama siswa wajid di isi'));
        $this->form_validation->set_rules('jk', '', 'required', array('required' => 'jenis kelamin wajid di isi'));
        $this->form_validation->set_rules('th', '', 'required', array('required' => 'tahun pelajaran siswa wajid di isi'));
        $this->form_validation->set_rules('alamat_siswa', '', 'required', array('required' => 'alamat siswa wajid di isi'));
        if ($this->form_validation->run() == FALSE) {

            // validasi gagal
            $judul['title'] = "halaman  tambah siswa";
            $judul['menutitle'] = " form siswa";
            $data['combo'] = $this->admin_model->comboxdinamis();
            $this->load->view('template/header', $judul);
            $data['error'] = "";
            $this->load->view('form_siswa', $data);
            $this->load->view('template/footer');
        } else {
            // validasi berhasil
            // alamat asset gambar harus benar
            if ($_FILES['foto']['name']) {
                $config['upload_path'] = './assets/images/siswa/';
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg';
                $config['max_size'] = 1024;
                // $config['max_width'] = 600;
                // $config['max_height'] = 400;
                // enskripsi digunakan untuk memecahkan nama/tdk terliht
                $config['encrypt_name'] = true;

                // 'uplod',$config fungsinya dibawa ini untuk membca config diatas
                $this->load->library('upload', $config);
                # kalau ada data yg diambil
                if (!$this->upload->do_upload('foto')) {
                    # gagal
                    // $error = array('error' => $this->upload->display_errors(''));
                    $judul['title'] = "halaman  tambah siswa";
                    $judul['menutitle'] = " form siswa";
                    $data['combo'] = $this->admin_model->comboxdinamis();
                    $this->load->view('template/header', $judul);
                    $data['error'] = $this->upload->display_errors('');
                    $this->load->view('form_siswa', $data);
                    $this->load->view('template/footer');
                } else {
                    // data yg dipanggil
                    $gbr = $this->upload->data();

                    //cara  crop gambar
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/images/siswa/' . $gbr['file_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['quality'] = '50%';
                    $config['width'] = 97;
                    $config['height'] = 149;
                    // $config['width'] = 400;
                    // $config['height'] = 600;
                    $config['new_image'] = './assets/images/siswa/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // crop gambar
                    $foto = $gbr['file_name'];

                    // simpan gambar dan semuanya
                    $data = array(
                        'id_tahun_pelajaran_siswa' => $this->input->post('th'),
                        //  ambil nama karakter/fild yg ada didatabase atau phpadmin di  guru dan postnya tergantung form_guru
                        'nisn' => $this->input->post('nisn'),
                        'nama_siswa' => $this->input->post('nama_siswa'),
                        'jk_siswa' => $this->input->post('jk'),
                        'alamat_siswa' => $this->input->post('alamat_siswa'),
                        'foto' => $foto
                    );
                    $query = $this->admin_model->simpandata('siswa', $data);
                    if ($query) {
                        # jika berhasil
                        $this->session->set_flashdata('info', 'Data siswa Tersimpan');
                        redirect('Admin/siswa');
                    } else {
                        # jk gagal
                        $this->session->set_flashdata('info', 'Data siswa gagal Tersimpan');
                        redirect('Admin/siswa');
                    }
                    // simpan
                }
            } else {
                // simpan yg digunakan tanpa gambar
                $data = array(
                    //  ambil nama karakter/fild yg ada didatabase atau phpadmin di guru dan postnya tergantung form_guru
                    'id_tahun_pelajaran_siswa' => $this->input->post('th'),
                    //  ambil nama karakter/fild yg ada didatabase atau phpadmin di  guru dan postnya tergantung form_guru
                    'nisn' => $this->input->post('nisn'),
                    'nama_siswa' => $this->input->post('nama_siswa'),
                    'jk_siswa' => $this->input->post('jk'),
                    'alamat_siswa' => $this->input->post('alamat_siswa')
                );

                $query = $this->admin_model->simpandata('siswa', $data);
                if ($query) {
                    # jika berhasil
                    $this->session->set_flashdata('info', 'Data siswa Tersimpan');
                    redirect('Admin/siswa');
                } else {
                    # jk gagal
                    $this->session->set_flashdata('info', 'Data  siswa gagal Tersimpan');
                    redirect('Admin/siswa');
                }
            }
        }
    }
    // halaman formedit_siswa 
    public function formedit_siswa($id)
    {
        $judul['title'] = "halaman form edit siswa";
        $judul['menutitle'] = " form  edit siswa";
        $data['combo'] = $this->admin_model->comboxdinamis();
        $data['fs'] = $this->admin_model->formedit('siswa', 'id_siswa', $id);
        $this->load->view('template/header', $judul);
        $data['error'] = "";
        $this->load->view('formedit_siswa', $data);
        $this->load->view('template/footer');
    }
    // edit siswa
    public function edit_siswa()
    {
        // ambil di simpan_siswa dan modifikasi
        // required @ mencegah data kosong dan didlnm kurung isi yg ada di form guru
        $this->form_validation->set_rules('nisn', '', 'required', array('required' => 'nisn siswa wajid di isi'));
        $this->form_validation->set_rules('nama_siswa', '', 'required', array('required' => 'nama siswa wajid di isi'));
        $this->form_validation->set_rules('jk', '', 'required', array('required' => 'jenis kelamin wajid di isi'));
        $this->form_validation->set_rules('th', '', 'required', array('required' => 'tahun pelajaran siswa wajid di isi'));
        $this->form_validation->set_rules('alamat_siswa', '', 'required', array('required' => 'alamat siswa wajid di isi'));
        $id = $this->input->post('id_siswa');
        $foto = $this->input->post('foto');
        if ($this->form_validation->run() == FALSE) {

            // validasi gagal
            $judul['title'] = "halaman form edit siswa";
            $judul['menutitle'] = " form  edit siswa";
            $data['combo'] = $this->admin_model->comboxdinamis();
            $data['fs'] = $this->admin_model->formedit('siswa', 'id_siswa', $id);
            $this->load->view('template/header', $judul);
            $data['error'] = "";
            $this->load->view('formedit_siswa', $data);
            $this->load->view('template/footer');
        } else {
            // validasi berhasil
            // alamat asset gambar harus benar
            if ($_FILES['foto']['name']) {
                $config['upload_path'] = './assets/images/siswa/';
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg';
                $config['max_size'] = 1024;
                // $config['max_width'] = 600;
                // $config['max_height'] = 400;
                // enskripsi digunakan untuk memecahkan nama/tdk terliht
                $config['encrypt_name'] = true;

                // 'uplod',$config fungsinya dibawa ini untuk membca config diatas
                $this->load->library('upload', $config);
                # kalau ada data yg diambil
                if (!$this->upload->do_upload('foto')) {
                    # gagal
                    // $error = array('error' => $this->upload->display_errors(''));
                    $judul['title'] = "halaman  tambah siswa";
                    $judul['menutitle'] = " form siswa";
                    $data['fs'] = $this->admin_model->formedit('siswa', 'id_siswa', $id);
                    $data['combo'] = $this->admin_model->comboxdinamis();
                    $this->load->view('template/header', $judul);
                    $data['error'] = $this->upload->display_errors('');
                    $this->load->view('form_siswa', $data);
                    $this->load->view('template/footer');
                } else {
                    // data yg dipanggil
                    $gbr = $this->upload->data();

                    //cara  crop gambar
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/images/siswa/' . $gbr['file_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['quality'] = '50%';
                    $config['width'] = 97;
                    $config['height'] = 149;
                    // $config['width'] = 400;
                    // $config['height'] = 600;
                    $config['new_image'] = './assets/images/siswa/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // crop gambar
                    $foto = $gbr['file_name'];

                    // simpan gambar dan semuanya
                    $data = array(
                        'id_tahun_pelajaran_siswa' => $this->input->post('th'),
                        //  ambil nama karakter/fild yg ada didatabase atau phpadmin di  guru dan postnya tergantung form_guru
                        'nisn' => $this->input->post('nisn'),
                        'nama_siswa' => $this->input->post('nama_siswa'),
                        'jk_siswa' => $this->input->post('jk'),
                        'alamat_siswa' => $this->input->post('alamat_siswa'),
                        'foto' => $foto
                    );
                    $query = $this->admin_model->editdata('siswa', 'id_siswa', $id, $data);
                    //$query = $this->admin_model->simpandata('siswa', $data);
                    if ($query) {
                        # jika berhasil
                        $this->session->set_flashdata('info', 'Data siswa Tersimpan');
                        redirect('Admin/siswa');
                    } else {
                        # jk gagal
                        $this->session->set_flashdata('info', 'Data siswa gagal Tersimpan');
                        redirect('Admin/siswa');
                    }
                    // simpan
                }
            } else {
                // simpan yg digunakan tanpa gambar
                $data = array(
                    //  ambil nama karakter/fild yg ada didatabase atau phpadmin di guru dan postnya tergantung form_guru
                    'id_tahun_pelajaran_siswa' => $this->input->post('th'),
                    //  ambil nama karakter/fild yg ada didatabase atau phpadmin di  guru dan postnya tergantung form_guru
                    'nisn' => $this->input->post('nisn'),
                    'nama_siswa' => $this->input->post('nama_siswa'),
                    'jk_siswa' => $this->input->post('jk'),
                    'alamat_siswa' => $this->input->post('alamat_siswa')
                );
                $query = $this->admin_model->editdata('siswa', 'id_siswa', $id, $data);
                // $query = $this->admin_model->simpandata('siswa', $data);
                if ($query) {
                    # jika berhasil
                    $this->session->set_flashdata('info', 'Data siswa Tersimpan');
                    redirect('Admin/siswa');
                } else {
                    # jk gagal
                    $this->session->set_flashdata('info', 'Data  siswa gagal Tersimpan');
                    redirect('Admin/siswa');
                }
            }
        }
    }

    // halaman hapus siswa
    public function hapus_siswa($id)
    {
        // untuk foto yg dihapus
        $data = $this->admin_model->formedit('siswa', 'id_siswa', $id);
        // melihat gambar ter ekripsi
        // echo $data->foto_guru;

        $this->admin_model->hapusdata('siswa', $id, 'id_siswa');
        if ($this->db->affected_rows()) {
            // link ke gambar
            unlink("./assets/images/siswa/" . $data->foto);
            # jika berhasil
            $this->session->set_flashdata('info', 'Data siswa berhasil terhapus');
            redirect('Admin/siswa');
        } else {
            # jika gagal
            $this->session->set_flashdata('info', 'Data siswa gagal terhapus');
            redirect('Admin/siswa');
        }
    }



    // guru
    public function guru()
    {
        $judul['title'] = "halaman guru";
        $judul['menutitle'] = "Guru";
        $data['gr'] = $this->admin_model->tampildata('guru', 'id_guru');
        $this->load->view('template/header', $judul);
        $this->load->view('guru', $data);
        $this->load->view('template/footer');
    }
    // halamn tamabh_guru
    public function tambah_guru()
    {
        $judul['title'] = "halaman  tambah guru";
        $judul['menutitle'] = " form guru";
        // $data['k'] = $this->admin_model->tampildata('tambah_kelas', 'id_tahun_pelajaran');
        $this->load->view('template/header', $judul);
        $this->load->view('form_guru', array('error' => ''));
        $this->load->view('template/footer');
    }
    // halaman simpan guru
    public function simpan_guru()
    {
        // required @ mencegah data kosong dan didlnm kurung isi yg ada di form guru
        $this->form_validation->set_rules('nama_guru', '', 'required', array('required' => 'nama guru wajid di isi'));
        $this->form_validation->set_rules('jk', '', 'required', array('required' => 'jenis kelamin wajid di isi'));
        $this->form_validation->set_rules('telp_guru', '', 'required', array('required' => 'telpon guru wajid di isi'));
        $this->form_validation->set_rules('alamat_guru', '', 'required', array('required' => 'alamat guru wajid di isi'));
        if ($this->form_validation->run() == FALSE) {

            // validasi gagal
            $judul['title'] = "halaman form guru";
            $judul['menutitle'] = " form Guru";
            $data['gr'] = $this->admin_model->tampildata('guru', 'id_guru');
            $this->load->view('template/header', $judul);
            $this->load->view('form_guru', array('error' => ''));
            $this->load->view('template/footer');
        } else {
            // validasi berhasil
            // alamat asset gambar harus benar
            if ($_FILES['foto']['name']) {
                $config['upload_path'] = './assets/images/guru/';
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg';
                $config['max_size'] = 1024;
                // $config['max_width'] = 600;
                // $config['max_height'] = 400;
                // enskripsi digunakan untuk memecahkan nama/tdk terliht
                $config['encrypt_name'] = true;

                // 'uplod',$config fungsinya dibawa ini untuk membca config diatas
                $this->load->library('upload', $config);
                # kalau ada data yg diambil
                if (!$this->upload->do_upload('foto')) {
                    # gagal
                    $error = array('error' => $this->upload->display_errors(''));
                    $judul['title'] = "halaman  tambah siswa";
                    $judul['menutitle'] = " form siswa";
                    // $data['k'] = $this->admin_model->tampildata('tambah_kelas', 'id_tahun_pelajaran');
                    $this->load->view('template/header', $judul);
                    $this->load->view('form_guru', $error);
                    $this->load->view('template/footer');
                } else {
                    // data yg dipanggil
                    $gbr = $this->upload->data();

                    //cara  crop gambar
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/images/siswa/' . $gbr['file_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['quality'] = '50%';
                    $config['width'] = 97;
                    $config['height'] = 149;
                    // $config['width'] = 400;
                    // $config['height'] = 600;
                    $config['new_image'] = './assets/images/siswa/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // crop gambar
                    $foto = $gbr['file_name'];

                    // simpan gambar dan semuanya
                    $data = array(
                        //  ambil nama karakter/fild yg ada didatabase atau phpadmin di  guru dan postnya tergantung form_guru
                        'nip' => $this->input->post('nip'),
                        'nama_guru' => $this->input->post('nama_guru'),
                        'jk_guru' => $this->input->post('jk'),
                        'alamat_guru' => $this->input->post('alamat_guru'),
                        'tlp_guru' => $this->input->post('telp_guru'),
                        'foto_guru' => $foto
                    );
                    $query = $this->admin_model->simpandata('guru', $data);
                    if ($query) {
                        # jika berhasil
                        $this->session->set_flashdata('info', 'Data guruTersimpan');
                        redirect('Admin/guru');
                    } else {
                        # jk gagal
                        $this->session->set_flashdata('info', 'Data guru gagal Tersimpan');
                        redirect('Admin/guru');
                    }
                    // simpan
                }
            } else {
                // simpan yg digunakan tanpa gambar
                $data = array(
                    //  ambil nama karakter/fild yg ada didatabase atau phpadmin di guru dan postnya tergantung form_guru
                    'nip' => $this->input->post('nip'),
                    'nama_guru' => $this->input->post('nama_guru'),
                    'jk_guru' => $this->input->post('jk'),
                    'alamat_guru' => $this->input->post('alamat_guru'),
                    'tlp_guru' => $this->input->post('telp_guru'),

                );
                $query = $this->admin_model->simpandata('guru', $data);
                if ($query) {
                    # jika berhasil
                    $this->session->set_flashdata('info', 'Data guru Tersimpan');
                    redirect('Admin/guru');
                } else {
                    # jk gagal
                    $this->session->set_flashdata('info', 'Data guru gagal Tersimpan');
                    redirect('Admin/guru');
                }
            }
        }
    }
    // halaman formedit_guru 
    public function formedit_guru($id)
    {
        $judul['title'] = "halaman  edit guru";
        $judul['menutitle'] = " form  edit guru";
        // lanjut ke class view
        $data['fg'] = $this->admin_model->formedit('guru', 'id_guru', $id);
        // data error
        $data['error'] = "";
        $this->load->view('template/header', $judul);
        $this->load->view('formedit_guru', $data);
        $this->load->view('template/footer');
    }
    // EDIT GURU
    public function edit_guru()
    {
        //isi kan copy simpan guru
        // required @ mencegah data kosong dan didlnm kurung isi yg ada di form guru
        $this->form_validation->set_rules('nama_guru', '', 'required', array('required' => 'nama guru wajid di isi'));
        $this->form_validation->set_rules('jk', '', 'required', array('required' => 'jenis kelamin wajid di isi'));
        $this->form_validation->set_rules('telp_guru', '', 'required', array('required' => 'telpon guru wajid di isi'));
        $this->form_validation->set_rules('alamat_guru', '', 'required', array('required' => 'alamat guru wajid di isi'));
        // dalam kurung diambil di formedit_guru yg di view dan juga dibawa hidden
        $id = $this->input->post('id_guru');
        $foto = $this->input->post('foto');
        if ($this->form_validation->run() == FALSE) {

            // validasi gagal
            $judul['title'] = "halaman form guru";
            $judul['menutitle'] = " form Guru";
            $data['gr'] = $this->admin_model->tampildata('guru', 'id_guru');
            $this->load->view('template/header', $judul);
            $this->load->view('form_guru', array('error' => ''));
            $this->load->view('template/footer');
        } else {
            // validasi berhasil
            // alamat asset gambar harus benar
            if ($_FILES['foto']['name']) {
                $config['upload_path'] = './assets/images/guru/';
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg';
                $config['max_size'] = 1024;
                // $config['max_width'] = 600;
                // $config['max_height'] = 400;
                // enskripsi digunakan untuk memecahkan nama/tdk terliht
                $config['encrypt_name'] = true;

                // 'uplod',$config fungsinya dibawa ini untuk membca config diatas
                $this->load->library('upload', $config);
                # kalau ada data yg diambil
                if (!$this->upload->do_upload('foto')) {
                    # gagal
                    $error = array('error' => $this->upload->display_errors(''));
                    $judul['title'] = "halaman  tambah guru";
                    $judul['menutitle'] = " form guru";
                    // $data['k'] = $this->admin_model->tampildata('tambah_kelas', 'id_tahun_pelajaran');
                    $this->load->view('template/header', $judul);
                    $this->load->view('form_guru', $error);
                    $this->load->view('template/footer');
                } else {
                    // data yg dipanggil
                    $gbr = $this->upload->data();
                    unlink("./assets/images/guru/" . $foto);
                    //cara  crop gambar
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/images/guru/' . $gbr['file_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['quality'] = '50%';
                    $config['width'] = 97;
                    $config['height'] = 149;
                    // $config['width'] = 400;
                    // $config['height'] = 600;
                    $config['new_image'] = './assets/images/guru/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // crop gambar
                    $foto = $gbr['file_name'];

                    // simpan gambar dan semuanya
                    $data = array(
                        //  ambil nama karakter/fild yg ada didatabase atau phpadmin di  guru dan postnya tergantung form_guru
                        'nip' => $this->input->post('nip'),
                        'nama_guru' => $this->input->post('nama_guru'),
                        'jk_guru' => $this->input->post('jk'),
                        'alamat_guru' => $this->input->post('alamat_guru'),
                        'tlp_guru' => $this->input->post('telp_guru'),
                        'foto_guru' => $foto
                    );
                    $query = $this->admin_model->editdata('guru', 'id_guru', $id, $data);
                    if ($query) {
                        # jika berhasil
                        $this->session->set_flashdata('info', 'Data guru Tersimpan');
                        redirect('Admin/guru');
                    } else {
                        # jk gagal
                        $this->session->set_flashdata('info', 'Data guru gagal Tersimpan');
                        redirect('Admin/guru');
                    }
                    // simpan
                }
            } else {
                // simpan yg digunakan tanpa gambar
                $data = array(
                    //  ambil nama karakter/fild yg ada didatabase atau phpadmin di guru dan postnya tergantung form_guru
                    'nip' => $this->input->post('nip'),
                    'nama_guru' => $this->input->post('nama_guru'),
                    'jk_guru' => $this->input->post('jk'),
                    'alamat_guru' => $this->input->post('alamat_guru'),
                    'tlp_guru' => $this->input->post('telp_guru'),

                );
                $query = $this->admin_model->editdata('guru', 'id_guru', $id, $data);
                if ($query) {
                    # jika berhasil
                    $this->session->set_flashdata('info', 'Data guru Tersimpan');
                    redirect('Admin/guru');
                } else {
                    # jk gagal
                    $this->session->set_flashdata('info', 'Data guru gagal Tersimpan');
                    redirect('Admin/guru');
                }
            }
        }
    }
    // halaman hapus guru
    public function hapus_guru($id)
    {
        // untuk foto yg dihapus
        $data = $this->admin_model->formedit('guru', 'id_guru', $id);
        // melihat gambar ter ekripsi
        // echo $data->foto_guru;

        $this->admin_model->hapusdata('guru', $id, 'id_guru');
        if ($this->db->affected_rows()) {
            // link ke gambar
            unlink("./assets/images/guru/" . $data->foto_guru);
            # jika berhasil
            $this->session->set_flashdata('info', 'Data guru berhasil terhapus');
            redirect('Admin/guru');
        } else {
            # jika gagal
            $this->session->set_flashdata('info', 'Data guru gagal terhapus');
            redirect('Admin/guru');
        }
    }


    // kelas
    public function kelas()
    {
        $judul['title'] = "halaman kelas";
        $judul['menutitle'] = "Kelas";
        $data['k'] = $this->admin_model->tampildata('kelas', 'id_kelas');
        $this->load->view('template/header', $judul);
        $this->load->view('kelas', $data);
        $this->load->view('template/footer');
    }
    // tambah kelas
    public function tambah_kelas()
    {
        $judul['title'] = "halaman  tambah kelas";
        $judul['menutitle'] = " form kelas";
        // $data['k'] = $this->admin_model->tampildata('tambah_kelas', 'id_tahun_pelajaran');
        $this->load->view('template/header', $judul);
        $this->load->view('form_kelas');
        $this->load->view('template/footer');
    }
    //simpan kelas
    public function simpan_kelas()
    {
        // required @ mencegah data kosong
        $this->form_validation->set_rules('kode_kelas', 'Kode Kelas', 'required', array('required' => 'Kode Kelas wajid di isi'));
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required', array('required' => 'Nama Kelas wajid di isi'));
        if ($this->form_validation->run() == FALSE) {
            # jika memang gagal
            $judul['title'] = "halaman  tambah kelas";
            $judul['menutitle'] = " form Kelas";
            $data['th'] = $this->admin_model->tampildata('tahun_pelajaran', 'id_tahun_pelajaran');
            $this->load->view('template/header', $judul);
            $this->load->view('form_kelas', $data);
            $this->load->view('template/footer');
        } else {
            # cjika berhasil
            $data = array(
                //  ambil fild karakter yg didatabase atau phpadmin ditahun ajaran
                'kode_kelas' => $this->input->post('kode_kelas'),
                'nama_kelas' => $this->input->post('nama_kelas')
            );
            $query = $this->admin_model->simpandata('kelas', $data);
            if ($query) {
                # jika berhasil
                $this->session->set_flashdata('info', 'Data Kelas Tersimpan');
                redirect('Admin/kelas');
            } else {
                # jk gagal
                $this->session->set_flashdata('info', 'Data kelas gagal Tersimpan');
                redirect('Admin/kelas');
            }
        }
    }
    // hapus kelas
    public function hapus_kelas($id)
    {
        $this->admin_model->hapusdata('kelas', $id, 'id_kelas');
        if ($this->db->affected_rows()) {
            # jika berhasil
            $this->session->set_flashdata('info', 'Data kelas berhasil terhapus');
            redirect('Admin/kelas');
        } else {
            # jika gagal
            $this->session->set_flashdata('info', 'Data kelas gagal terhapus');
            redirect('Admin/kelas');
        }
    }
    // formedit kelas ke(kelas edit)
    public function formedit_kelas($id)
    {
        $judul['title'] = "halaman  edit kelas";
        $judul['menutitle'] = " form  edit kelas";
        // lanjut ke class view
        $data['ke'] = $this->admin_model->formedit('kelas', 'id_kelas', $id);
        $this->load->view('template/header', $judul);
        $this->load->view('formedit_kelas', $data);
        $this->load->view('template/footer');
    }
    // edit_kelas
    public function edit_kelas()
    {
        $id = $this->input->post('id');
        # cjika berhasil
        $data = array(
            //  ambil fild karakter yg didatabase atau phpadmin ditahun ajaran
            'kode_kelas' => $this->input->post('kode_kelas'),
            'nama_kelas' => $this->input->post('nama_kelas')
        );
        $query = $this->admin_model->editdata('kelas', 'id_kelas', $id, $data);
        if ($query) {
            # jika berhasil
            $this->session->set_flashdata('info', 'Data Tahun Pelajaran Berhasil Teredit');
            redirect('Admin/kelas');
        } else {
            # jk gagal
            $this->session->set_flashdata('info', 'Data Tahun Pelajaran gagal Tersimpan');
            redirect('Admin/kelas');
        }
    }



    // tahun ajaran
    public function tahun_ajaran()
    {
        $judul['title'] = "halaman tahun ajaran";
        $judul['menutitle'] = "Tahun ajaran";
        $data['th'] = $this->admin_model->tampildata('tahun_pelajaran', 'id_tahun_pelajaran');
        $this->load->view('template/header', $judul);
        $this->load->view('tahun_ajaran', $data);
        $this->load->view('template/footer');
    }

    // tambah th
    public function tambah_th()
    {
        $judul['title'] = "halaman  tambah tahun ajaran";
        $judul['menutitle'] = " form Tahun ajaran";
        $data['th'] = $this->admin_model->tampildata('tahun_pelajaran', 'id_tahun_pelajaran');
        $this->load->view('template/header', $judul);
        $this->load->view('form_th', $data);
        $this->load->view('template/footer');
    }
    // simpan th
    public function simpan_th()
    {
        $this->form_validation->set_rules('th', 'Tahun Ajaran', 'required');
        if ($this->form_validation->run() == FALSE) {
            # jika memang gagal
            $judul['title'] = "halaman  tambah tahun ajaran";
            $judul['menutitle'] = " form Tahun ajaran";
            $data['th'] = $this->admin_model->tampildata('tahun_pelajaran', 'id_tahun_pelajaran');
            $this->load->view('template/header', $judul);
            $this->load->view('form_th', $data);
            $this->load->view('template/footer');
        } else {
            # cjika berhasil
            $data = array(
                //  ambil fild karakter yg didatabase atau phpadmin ditahun ajaran
                'tahun_pelajaran' => $this->input->post('th')
            );
            $query = $this->admin_model->simpandata('tahun_pelajaran', $data);
            if ($query) {
                # jika berhasil
                $this->session->set_flashdata('info', 'Data Tahun Pelajaran Berhasil Tersimpan');
                redirect('Admin/tahun_ajaran');
            } else {
                # jk gagal
                $this->session->set_flashdata('info', 'Data Tahun Pelajaran gagal Tersimpan');
                redirect('Admin/tahun_ajaran');
            }
        }
    }

    // halaman hapus_th
    public function hapus_th($id)
    {
        $this->admin_model->hapusdata('tahun_pelajaran', $id, 'id_tahun_pelajaran');
        if ($this->db->affected_rows()) {
            # jika berhasil
            $this->session->set_flashdata('info', 'Data tahun pelajaran berhasil terhapus');
            redirect('Admin/tahun_ajaran');
        } else {
            # jika gagal
            $this->session->set_flashdata('info', 'Data tahun pelajaran gagal terhapus');
            redirect('Admin/tahun_ajaran');
        }
    }
    // halaman formedit_th
    public function formedit_th($id)
    {
        $judul['title'] = "halaman  edit tahun ajaran";
        $judul['menutitle'] = " form  edit Tahun ajaran";
        // lanjut ke class view
        $data['tp'] = $this->admin_model->formedit('tahun_pelajaran', 'id_tahun_pelajaran', $id);
        $this->load->view('template/header', $judul);
        $this->load->view('formedit_th', $data);
        $this->load->view('template/footer');
    }
    // halaman edit_th
    public function edit_th()
    {
        $id = $this->input->post('id');
        # cjika berhasil
        $data = array(
            //  ambil fild karakter yg didatabase atau phpadmin ditahun ajaran
            'tahun_pelajaran' => $this->input->post('th')
        );
        $query = $this->admin_model->editdata('tahun_pelajaran', 'id_tahun_pelajaran', $id, $data);
        if ($query) {
            # jika berhasil
            $this->session->set_flashdata('info', 'Data Tahun Pelajaran Berhasil Teredit');
            redirect('Admin/tahun_ajaran');
        } else {
            # jk gagal
            $this->session->set_flashdata('info', 'Data Tahun Pelajaran gagal Tersimpan');
            redirect('Admin/tahun_ajaran');
        }
    }
    // untuk halaman users
    public function users()
    {
        # code...
        $judul['title'] = "halaman users";
        $judul['menutitle'] = "Admin ";
        $data['us'] = $this->admin_model->tampildata('users', 'id_users');
        $this->load->view('template/header', $judul);
        $this->load->view('users', $data);
        $this->load->view('template/footer');
    }
    public function tambah_users()
    {
        $judul['title'] = "halaman  tambah users";
        $judul['menutitle'] = " form users";
        // $data['k'] = $this->admin_model->tampildata('tambah_kelas', 'id_tahun_pelajaran');
        $this->load->view('template/header', $judul);
        $this->load->view('form_users');
        $this->load->view('template/footer');
    }
    public function simpan_users()
    {
        // // required @ mencegah data kosong
        //  $this->form_validation->set_rules('kode_kelas', 'Kode Kelas', 'required', array('required' => 'Kode Kelas wajid di isi'));
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required', array('required' => 'Nama lengkap wajib  di isi'));
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|max_length[12]', array('required' =>
        'username di isi', 'trim' => '', 'min_length' => 'minimal 5 huruf saja', 'max_length' => ' maksimal 12 huruf saja'));

        $this->form_validation->set_rules('password', '', 'trim|required|min_length[5]|max_length[12]', array('required' =>
        'password di isi', 'trim' => '', 'min_length' => 'minimal 5 huruf saja', 'max_length' => ' maksimal 12 huruf saja'));

        $this->form_validation->set_rules('compassword', '', 'required|matches[password]', array('required' => 'comfirmasi wajib di isi', 'matches' => 'password dan confirmasi tdk sama'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('level', '', 'required', array('required' => 'Level|wajib di isi'));
        if ($this->form_validation->run() == FALSE) {
            # jika memang gagal
            $judul['title'] = "halaman  tambah users";
            $judul['menutitle'] = " form users";
            // $data['k'] = $this->admin_model->tampildata('tambah_kelas', 'id_tahun_pelajaran');
            $this->load->view('template/header', $judul);
            $this->load->view('form_users');
            $this->load->view('template/footer');
        } else {
            # cjika berhasil
            $data = array(
                //  ambil fild karakter yg didatabase atau phpadmin ditahun ajaran
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'email' => $this->input->post('email'),
                'level' => $this->input->post('level')
            );
            $query = $this->admin_model->simpandata('users', $data);
            if ($query) {
                # jika berhasil
                $this->session->set_flashdata('info', 'Data users Tersimpan');
                redirect('Admin/users');
            } else {
                # jk gagal
                $this->session->set_flashdata('info', 'Data users gagal Tersimpan');
                redirect('Admin/users');
            }
        }
    }
    // halaman hapus_user
    public function hapus_users($id)
    {
        $this->admin_model->hapusdata('users', $id, 'id_users');
        if ($this->db->affected_rows()) {
            # jika berhasil
            $this->session->set_flashdata('info', 'Data user berhasil terhapus');
            redirect('Admin/users');
        } else {
            # jika gagal
            $this->session->set_flashdata('info', 'Data user gagal terhapus');
            redirect('Admin/users');
        }
    }
    // halaman formedit_user
    public function formedit_users($id)
    {
        $judul['title'] = "halaman  edit users";
        $judul['menutitle'] = " form  edit users";
        // lanjut ke class view
        $data['us'] = $this->admin_model->formedit('users', 'id_users', $id);
        $this->load->view('template/header', $judul);
        $this->load->view('formedit_users', $data);
        $this->load->view('template/footer');
    }
    // halaman edit_th
    public function edit_users()
    {
        $id = $this->input->post('id');
        // validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required', array('required' => 'Nama lengkap di isi'));
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|max_length[12]', array('required' =>
        'username di isi', 'trim' => '', 'min_length' => 'minimal 5 huruf saja', 'max_length' => ' maksimal 12 huruf saja'));

        $this->form_validation->set_rules('password', '', 'trim|min_length[5]|max_length[12]', array('trim' => '', 'min_length' => 'minimal 5 huruf saja', 'max_length' => ' maksimal 12 huruf saja'));

        $this->form_validation->set_rules('compassword', '', 'matches[password]', array('matches' => 'password dan confirmasi tdk sama'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('level', '', 'required', array('required' => 'Level|wajib di isi'));
        if ($this->form_validation->run() == FALSE) {
            # jika memang gagal
            $judul['title'] = "halaman  edit users";
            $judul['menutitle'] = " form  edit users";

            // lanjut ke class view
            $data['us'] = $this->admin_model->formedit('users', 'id_users', $id); //CEK MODEL INI, ID_USERS GK NEMU OBJEK, BUKA MODEL (admin_model), Function formedit???
            $this->load->view('template/header', $judul);
            $this->load->view('formedit_users', $data);
            $this->load->view('template/footer');
        } else {
            if ($this->input->post('password')) {
                # code..
                $data = array(
                    //  ambil fild karakter yg didatabase atau phpadmin ditahun ajaran
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'email' => $this->input->post('email'),
                    'level' => $this->input->post('level')
                );

                $query = $this->admin_model->editdata('users', 'id_users', $id, $data);
                if ($query) {
                    # jika berhasil
                    $this->session->set_flashdata('info', 'Data user Berhasil Teredit');
                    redirect('Admin/users');
                } else {
                    # jk gagal
                    $this->session->set_flashdata('info', 'Data user gagal Tersimpan');
                }
                redirect('Admin/users');
            } else {
                $data = array(
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'level' => $this->input->post('level')
                );
                $query = $this->admin_model->editdata('users', 'id_users', $id, $data); {
                    if ($query) {
                        # jika berhasil
                        $this->session->set_flashdata('info', 'Data user Berhasil Teredit');
                        redirect('Admin/users');
                    } else {
                        # jk gagal
                    };
                    $this->session->set_flashdata('info', 'Data user gagal Tersimpan');
                    redirect('Admin/users');
                }
            }
        }
    }
}
