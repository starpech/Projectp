<?php
/**
 * @filesource modules/inventory/models/setup.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Inventory\Setup;

use Gcms\Login;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=inventory-setup
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{
    /**
     * Query ข้อมูลสำหรับส่งให้กับ DataTable
     *
     * @param array $params
     *
     * @return \Kotchasan\Database\QueryBuilder
     */
    public static function toDataTable($params)
    {
        $where = array();
        if (!empty($params['category_id'])) {
            $where[] = array('P.category_id', $params['category_id']);
        }

        return static::createQuery()
            ->select('P.product_no', 'P.topic', 'P.category_id', 'P.price', 'P.cost', 'P.id', 'P.stock', 'N.topic unit')
            ->from('inventory P')
            ->join('category N', 'LEFT', array(array('N.type', 'unit'), array('N.category_id', 'P.unit')))
            ->where($where);
    }

    /**
     * รับค่าจาก action (setup.php)
     *
     * @param Request $request
     */
    public function action(Request $request)
    {
        $ret = array();
        // session, referer, can_manage_inventory, ไม่ใช่สมาชิกตัวอย่าง
        if ($request->initSession() && $request->isReferer() && $login = Login::isMember()) {
            if (Login::notDemoMode($login) && Login::checkPermission($login, 'can_manage_inventory')) {
                // รับค่าจากการ POST
                $action = $request->post('action')->toString();
                // Database
                $db = $this->db();
                // id ที่ส่งมา
                if (preg_match_all('/,?([0-9]+),?/', $request->post('id')->toString(), $match)) {
                    if ($action === 'delete') {
                        // ลบ
                        $db->delete($this->getTableName('inventory'), array('id', $match[1]), 0);
                        $db->delete($this->getTableName('stock'), array(array('product_id', $match[1]), array('status', 'IN')), 0);
                        // ลบรูปภาพ
                        $dir = ROOT_PATH.DATA_FOLDER.'inventory/';
                        foreach ($match[1] as $id) {
                            if (is_file($dir.$id.'.jpg')) {
                                unlink($dir.$id.'.jpg');
                            }
                        }
                        // reload
                        $ret['location'] = 'reload';
                    }
                }
            }
        }
        if (empty($ret)) {
            $ret['alert'] = Language::get('Unable to complete the transaction');
        }
        // คืนค่า JSON
        echo json_encode($ret);
    }
}
