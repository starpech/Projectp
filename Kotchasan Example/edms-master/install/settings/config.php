<?php

/* config.php */

return array(
    'version' => '3.0.0',
    'web_title' => 'eDms',
    'web_description' => 'ระบบการจัดการเอกสารอิเล็กทรอนิกส์',
    'timezone' => 'Asia/Bangkok',
    'member_status' => array(
        0 => 'สมาชิก',
        1 => 'ผู้ดูแลระบบ',
        2 => 'เจ้าหน้าที่',
    ),
    'color_status' => array(
        0 => '#259B24',
        1 => '#FF0000',
        2 => '#0E0EDA',
    ),
    'default_icon' => 'icon-edocument',
    'dms_format_no' => 'DOC%Y%M%D-%04d',
    'dms_file_typies' => array(
        0 => 'doc',
        1 => 'ppt',
        2 => 'pptx',
        3 => 'docx',
        4 => 'rar',
        5 => 'zip',
        6 => 'jpg',
        7 => 'pdf',
    ),
    'dms_upload_size' => 2097152,
    'dms_download_action' => 0,
);
