<?php
/**
 * @filesource modules/dms/controllers/init.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Dms\Init;

/**
 * Init Module
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Kotchasan\KBase
{
    /**
     * รายการ permission ของโมดูล.
     *
     * @param array $permissions
     *
     * @return array
     */
    public static function updatePermissions($permissions)
    {
        $permissions['can_manage_dms'] = '{LNG_Can set the module} ({LNG_Document management system})';
        $permissions['can_download_dms'] = '{LNG_Can view or download file}';
        $permissions['can_upload_dms'] = '{LNG_Can upload file} ({LNG_Document management system})';

        return $permissions;
    }
}
