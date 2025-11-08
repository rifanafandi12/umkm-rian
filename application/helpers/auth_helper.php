<?php

function check_login()
{
    $CI = &get_instance();

    if (!$CI->session->userdata('logged_in')) {
        redirect('auth');
    }
}

function check_sudahlogin()
{
    $CI = &get_instance();

    if ($CI->session->userdata('logged_in')) {
        if ($CI->session->userdata('role') === 'admin') {
            redirect('admin');
        } else {
            redirect('home');
        }
    }
}

function check_role($allowed_roles = [])
{
    $CI = &get_instance();
    $user_role = $CI->session->userdata('role');

    if (!in_array($user_role, $allowed_roles)) {
        show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses Ditolak');
        exit;
    }
}
