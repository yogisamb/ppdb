<?php

function is_logged_in()
{
    $taji = get_instance();
    if (!$taji->session->userdata('user_email')) {
        redirect('auth');
    } else {
        $role_id = $taji->session->userdata('user_role_id');
        $menu = $taji->uri->segment(1);

        $queryMenu = $taji->db->get_where('user_sub_menu', ['user_sub_menu_controller' => $menu])->row_array();
        $menu_id = $queryMenu['user_menu_id'];

        $userAccess = $taji->db->get_where('user_access_menu', [
            'user_role_id' => $role_id,
            'user_menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function dashboard()
{
    $taji = get_instance();
    if ($taji->session->userdata('user_role_id') == 4) {
        redirect('auth/blocked');
    }
}

function check_access($role_id, $menu_id)
{
    $taji = get_instance();
    $taji->db->where('user_role_id', $role_id);
    $taji->db->where('user_menu_id', $menu_id);
    $result = $taji->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
    // echo '<pre>';
    // print_r($result);
    // die;
}

function check_relasimapel($userid, $mapelid)
{
    $taji = get_instance();
    $taji->db->where('user_id', $userid);
    $taji->db->where('tb_mapel_id', $mapelid);
    $result = $taji->db->get('tb_guru_mapel');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
