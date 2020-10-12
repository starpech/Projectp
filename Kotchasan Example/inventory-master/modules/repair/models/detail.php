<?php
/**
 * @filesource modules/repair/models/detail.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Repair\Detail;

use Gcms\Login;
use Kotchasan\Database\Sql;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=repair-detail
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{
    /**
     * อ่านรายละเอียดการทำรายการจาก $id.
     *
     * @param int $id
     *
     * @return object
     */
    public static function get($id)
    {
        $q1 = static::createQuery()
            ->select('repair_id', Sql::MAX('id', 'max_id'))
            ->from('repair_status')
            ->groupBy('repair_id');
        $sql = static::createQuery()
            ->select('R.*', 'U.name', 'U.phone', 'V.topic', 'V.product_no', 'S.status', 'S.comment', 'S.operator_id', 'S.id status_id')
            ->from('repair R')
            ->join(array($q1, 'T'), 'LEFT', array('T.repair_id', 'R.id'))
            ->join('repair_status S', 'LEFT', array('S.id', 'T.max_id'))
            ->join('inventory V', 'LEFT', array('V.id', 'R.inventory_id'))
            ->join('user U', 'LEFT', array('U.id', 'R.customer_id'))
            ->where(array('R.id', $id))
            ->order('S.id DESC');

        return static::createQuery()
            ->from(array($sql, 'Q'))
            ->groupBy('Q.id')
            ->first();
    }

    /**
     * อ่านสถานะการทำรายการทั้งหมด.
     *
     * @param int $id
     */
    public static function getAllStatus($id)
    {
        return static::createQuery()
            ->select('S.id', 'U.name', 'S.status', 'S.create_date', 'S.comment')
            ->from('repair_status S')
            ->join('user U', 'LEFT', array('U.id', 'S.operator_id'))
            ->where(array('S.repair_id', $id))
            ->order('S.id')
            ->toArray()
            ->execute();
    }

    /**
     * รับค่าจาก action
     *
     * @param Request $request
     */
    public function action(Request $request)
    {
        $ret = array();
        // session, referer, member, ไม่ใช่สมาชิกตัวอย่าง
        if ($request->initSession() && $request->isReferer() && $login = Login::isMember()) {
            if (Login::notDemoMode($login)) {
                // รับค่าจากการ POST
                $action = $request->post('action')->toString();
                // id ที่ส่งมา
                if (preg_match_all('/,?([0-9]+),?/', $request->post('id')->toString(), $match)) {
                    if ($action === 'delete' && Login::checkPermission($login, array('can_manage_repair', 'can_repair'))) {
                        // ลบรายละเอียดซ่อม
                        $this->db()->delete($this->getTableName('repair_status'), array('id', (int) $match[1][0]));
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
