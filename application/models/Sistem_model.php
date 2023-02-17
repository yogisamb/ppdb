<?php

class sistem_model extends CI_Model
{

  public function getSidebar()
  {
    $role_id = $this->session->userdata('user_role_id');
    $queryMenu = "SELECT user_menu.user_menu_id, user_menu_title
            FROM user_menu JOIN user_access_menu
            ON user_menu.user_menu_id = user_access_menu.user_menu_id
            WHERE user_access_menu.user_role_id = $role_id
            ORDER BY user_access_menu.user_menu_id ASC
            ";
    return $this->db->query($queryMenu)->result_array();
  }

  public function getSidebarsubmenu($menuId)
  {
    $querySubMenu = "SELECT * FROM user_sub_menu
      WHERE user_menu_id = $menuId
      AND is_active = 1
      ";
    return $this->db->query($querySubMenu)->result_array();
  }

  public function getSupersidebarsubmenu($submenuId)
  {
    $querySubMenu = "SELECT * FROM user_super_sub_menu
      WHERE user_sub_menu_id = $submenuId
      ";
    return $this->db->query($querySubMenu)->result_array();
  }

  public function getEmailconfig()
  {
    return $this->db->get_where('tb_config_email', ['tb_config_email_id' => 1])->row_array();
  }

  public function saveConfig($dataisi)
  {
    $this->db->insert('tb_config_email', $dataisi);
  }

  public function editConfig($dataisi)
  {
    $this->db->where('tb_config_email_id', 1);
    $this->db->update('tb_config_email', $dataisi);
  }

  public function getRole($roleid = false)
  {
    if ($roleid) {
      return $this->db->get_where('user_role', ['user_role_id' => $roleid])->row_array();
    } else {
      return $this->db->get('user_role')->result_array();
    }
  }

  public function getMenuuser($menuid = false)
  {
    if ($menuid) {
      return $this->db->get_where('user_menu', ['user_menu_id' => $menuid])->row_array();
    } else {
      $this->db->where('user_menu_id !=', 2);
      return $this->db->get('user_menu')->result_array();
    }
  }

  public function editHakakses($dataisi)
  {
    $result = $this->db->get_where('user_access_menu', $dataisi);

    if ($result->num_rows() < 1) {
      $this->db->insert('user_access_menu', $dataisi);
    } else {
      $this->db->delete('user_access_menu', $dataisi);
    }
  }

  public function editRole($input, $roleid)
  {
    $data = [
      'user_role_title' => $input
    ];
    $this->db->where('user_role_id', $roleid);
    $this->db->update('user_role', $data);
  }

  public function saveRole($input)
  {
    $data = [
      'user_role_title' => $input
    ];
    $this->db->insert('user_role', $data);
  }

  public function getMenu($menuid = false)
  {
    if ($menuid) {
      return $this->db->get_where('user_menu', ['user_menu_id' => $menuid])->row_array();
    } else {
      return $this->db->get('user_menu')->result_array();
    }
  }

  public function editmenu($input, $menuid)
  {
    $data = [
      'user_menu_title' => $input
    ];
    $this->db->where('user_menu_id', $menuid);
    $this->db->update('user_menu', $data);
  }

  public function getSubmenubymenuid($menuid)
  {
    return $this->db->get_where('user_sub_menu', ['user_menu_id' => $menuid])->result_array();
  }

  public function getSubmenu($submenuid = false)
  {
    if ($submenuid) {
      return $this->db->get_where('user_sub_menu', ['user_sub_menu_id' => $submenuid])->row_array();
    } else {
      return $this->db->get('user_sub_menu')->result_array();
    }
  }

  public function editSubmenu($submenuid, $dataisi)
  {
    $this->db->where('user_sub_menu_id', $submenuid);
    $this->db->update('user_sub_menu', $dataisi);
  }

  public function getNotif($userid)
  {
    $accesid = $this->db->get_where('user_access_menu', ['user_role_id' => $userid])->result_array();
    $nomor = 1;
    $submenuarray = [];
    foreach ($accesid as $ai) {
      $submenu[$nomor] = $this->db->get_where('user_sub_menu', ['user_menu_id' => $ai['user_menu_id']])->result_array();
      foreach ($submenu[$nomor] as $sb[$nomor]) {
        array_push($submenuarray, $sb[$nomor]['user_sub_menu_id']);
      }
      $nomor++;
    };
    $nomora = 1;
    $notif = [];
    foreach ($submenuarray as $sma) {
      $notifikasi = $this->db->get_where('tb_notifikasi', ['user_sub_menu_id' => $sma])->result_array();
      foreach ($notifikasi as $not) {
        array_push($notif, $not);
      }
    }
    return $notif;
  }

  public function getNotifnumrows($userid)
  {
    $accesid = $this->db->get_where('user_access_menu', ['user_role_id' => $userid])->result_array();
    $nomor = 1;
    $submenuarray = [];
    foreach ($accesid as $ai) {
      $submenu[$nomor] = $this->db->get_where('user_sub_menu', ['user_menu_id' => $ai['user_menu_id']])->result_array();
      foreach ($submenu[$nomor] as $sb[$nomor]) {
        array_push($submenuarray, $sb[$nomor]['user_sub_menu_id']);
      }
      $nomor++;
    };
    $nomora = 1;
    $notif = [];
    foreach ($submenuarray as $sma) {
      $notifikasi = $this->db->get_where('tb_notifikasi', ['user_sub_menu_id' => $sma])->result_array();
      foreach ($notifikasi as $not) {
        array_push($notif, $not);
      }
    }
    return count($notif);
  }

  public function getNotifikasi($notifikasiid = false)
  {
    if ($notifikasiid) {
      return $this->db->get_where('tb_notifikasi', ['tb_notifikasi_id' => $notifikasiid])->row_array();
    } else {
      return $this->db->get('tb_notifikasi')->result_array();
    }
  }

  public function deleteNotifikasi($notifikasiid)
  {
    $this->db->where('tb_notifikasi_id', $notifikasiid);
    $this->db->delete('tb_notifikasi');
  }
}
