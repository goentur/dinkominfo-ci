<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

function alertsuccess($pesan)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata("pesan", "<script>document.onload = setTimeout(function () {Command: toastr['success']('" . $pesan . "', 'SELAMAT !!!!')
		toastr.options = {'closeButton': false,'debug': false,'newestOnTop': false,'progressBar': false,'positionClass': 'toast-bottom-right','preventDuplicates': false,'showDuration': '300','hideDuration': '1000','timeOut': '5000','extendedTimeOut': '1000','showEasing': 'easeOutBounce','hideEasing': 'easeInBack','showMethod': 'slideDown','hideMethod': 'slideUp'}}, 0);</script>");
}
function alerterror($pesan)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata("pesan", "<script>document.onload = setTimeout(function () {Command: toastr['error']('" . $pesan . "', 'MAAF !!!!')
		toastr.options = {'closeButton': false,'debug': false,'newestOnTop': false,'progressBar': false,'positionClass': 'toast-bottom-right','preventDuplicates': false,'showDuration': '300','hideDuration': '1000','timeOut': '5000','extendedTimeOut': '1000','showEasing': 'easeOutBounce','hideEasing': 'easeInBack','showMethod': 'slideDown','hideMethod': 'slideUp'}}, 0);</script>");
}

function ambil_satu_colom($table, $field, $where)
{
	$ci = &get_instance();
	return $ci->db->select($field)->where($where)->get($table);
}
function cekIdUbah()
{
	$ci = &get_instance();
	if ($ci->session->userdata('id_ubah')) {
		return true;
	} else {
		return false;
	}
}
function ceksession()
{
	$ci = &get_instance();
	if ($ci->session->userdata('id') == null || $ci->session->userdata('username') == null || $ci->session->userdata('nama') == null || $ci->session->userdata('hak_akses') == null || $ci->session->userdata('status') == null) {
		$ci->session->unset_userdata('id');
		$ci->session->unset_userdata('username');
		$ci->session->unset_userdata('nama');
		$ci->session->unset_userdata('hak_akses');
		$ci->session->unset_userdata('status');
		return FALSE;
	} else {
		if ($ci->session->userdata('status') != $ci->config->item('kode_aplikasi')) {
			$ci->session->unset_userdata('id');
			$ci->session->unset_userdata('username');
			$ci->session->unset_userdata('nama');
			$ci->session->unset_userdata('hak_akses');
			$ci->session->unset_userdata('status');
			return FALSE;
		} else if ($ci->session->userdata('hak_akses') == 1) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
function sesi()
{
	$ci = &get_instance();
	if ($ci->session->userdata('id') == null || $ci->session->userdata('username') == null || $ci->session->userdata('nama') == null || $ci->session->userdata('hak_akses') == null || $ci->session->userdata('status') == null) {
		$ci->session->unset_userdata('id');
		$ci->session->unset_userdata('username');
		$ci->session->unset_userdata('nama');
		$ci->session->unset_userdata('hak_akses');
		$ci->session->unset_userdata('status');
		return FALSE;
	} else {
		if ($ci->session->userdata('status') != $ci->config->item('kode_aplikasi')) {
			$ci->session->unset_userdata('id');
			$ci->session->unset_userdata('username');
			$ci->session->unset_userdata('nama');
			$ci->session->unset_userdata('hak_akses');
			$ci->session->unset_userdata('status');
			return FALSE;
		} else if ($ci->session->userdata('hak_akses') !== '1') {
			$ci->session->unset_userdata('id');
			$ci->session->unset_userdata('username');
			$ci->session->unset_userdata('nama');
			$ci->session->unset_userdata('hak_akses');
			$ci->session->unset_userdata('status');
		} else {
			return TRUE;
		}
	}
}
function kode_otomatis($tabel, $field, $kode_inisial)
{
	$kode_hari	= date('YmdHis');
	$ci 			= &get_instance();
	$total 		= $ci->db->select('COUNT(".$field.") AS total')
		->from($tabel)
		->like($field, $kode_inisial . '-' . $kode_hari, 'both')
		->get()->row_array();
	$totall			= ++$total['total'];
	return $kode_inisial . '-' . $kode_hari . '-' . $totall;
}
function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
function tgl_indo_to_database($string)
{
	$satu = explode('-', $string);
	return $satu[2] . '-' . $satu[1] . '-' . $satu[0];
}
function bulan_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $bulan[(int)$pecahkan[0]] . ' ' . $pecahkan[1];
}
function bulan_indo_from_database($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
function bulan_indo_to_database($string)
{
	$satu = explode('-', $string);
	return $satu[1] . '-' . $satu[0];
}
function rupiah($d)
{
	return 'Rp.' . number_format($d, 0, ',', '.');
}
function jmlKeranjang($id)
{
	$ci 			= &get_instance();
	$total 		= $ci->db->select('COUNT(id) AS total')->from('keranjang')->where('id_pengguna', $id)->get()->row();
	return $total->total;
}
function provinsi($id)
{
	$key = '903a6627382704b72f147f664ef1f491';
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=" . $id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: " . $key
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		echo $data['rajaongkir']['results']['province'];
	}
}
function city($id_p, $id_c)
{
	$key = '903a6627382704b72f147f664ef1f491';
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=" . $id_c . "&province=" . $id_p,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: " . $key
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		echo $data['rajaongkir']['results']['type'] . ' ' . $data['rajaongkir']['results']['city_name'] . ' ' . $data['rajaongkir']['results']['postal_code'];
	}
}
