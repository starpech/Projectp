<?php
/**
 * @filesource modules/personnel/controllers/initmenu.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Personnel\Initmenu;

use Gcms\Login;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * Init Menu
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Kotchasan\KBase
{
    /**
     * ฟังก์ชั่นเริ่มต้นการทำงานของโมดูลที่ติดตั้ง
     * และจัดการเมนูของโมดูล.
     *
     * @param Request                $request
     * @param \Index\Menu\Controller $menu
     * @param array                  $login
     */
    public static function execute(Request $request, $menu, $login)
    {
        $menu->addTopLvlMenu('personnel', '{LNG_Personnel}', 'index.php?module=personnel-setup', null, 'module');
        $submenus = array();
        // สามารถตั้งค่าระบบได้
        if (Login::checkPermission(Login::isMember(), 'can_config')) {
            $submenus['personnelsettings'] = array(
                'text' => '{LNG_Settings}',
                'url' => 'index.php?module=personnel-settings',
            );
            foreach (Language::get('CATEGORIES') as $type => $text) {
                $submenus['personnel'.$type] = array(
                    'text' => $text,
                    'url' => 'index.php?module=personnel-categories&amp;type='.$type,
                );
            }
        }
        // สามารถจัดการ personnel ได้
        if (Login::checkPermission($login, 'can_manage_personnel')) {
            $submenus['personnelimport'] = array(
                'text' => '{LNG_Import} {LNG_Personnel list}',
                'url' => 'index.php?module=personnel-import',
            );
            $submenus['personnelwrite'] = array(
                'text' => '{LNG_Add New} {LNG_Personnel}',
                'url' => 'index.php?module=personnel-write',
            );
        }
        if (!empty($submenus)) {
            $menu->add('settings', '{LNG_Personnel}', null, $submenus, 'personnel');
        }
    }
}
