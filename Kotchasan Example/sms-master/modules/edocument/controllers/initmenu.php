<?php
/**
 * @filesource modules/edocument/controllers/initmenu.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Edocument\Initmenu;

use Gcms\Login;
use Kotchasan\Http\Request;

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
        // รายการเมนูย่อย
        $submenus = array(
            array(
                'text' => '{LNG_List of} {LNG_received document}',
                'url' => 'index.php?module=edocument-received',
            ),
        );
        if (Login::checkPermission($login, 'can_upload_edocument')) {
            $submenus[] = array(
                'text' => '{LNG_List of} {LNG_sent document}',
                'url' => 'index.php?module=edocument-sent',
            );
        }
        $menu->addTopLvlMenu('edocument', '{LNG_E-Document}', null, $submenus, 'module');
        // เมนูตั้งค่า
        if (Login::checkPermission(Login::isMember(), 'can_config')) {
            $menu->add('settings', '{LNG_E-Document settings}', 'index.php?module=edocument-settings', null, 'edocument');
        }
    }
}
