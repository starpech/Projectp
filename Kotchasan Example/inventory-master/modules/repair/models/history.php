<?php
/**
 * @filesource modules/repair/models/history.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Repair\History;

use Kotchasan\Database\Sql;

/**
 * module=repair-history
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
        $where = array(
            array('R.customer_id', $params['customer_id']),
        );
        if ($params['status'] > -1) {
            $where[] = array('S.status', $params['status']);
        }
        $q1 = static::createQuery()
            ->select('repair_id', Sql::MAX('id', 'max_id'))
            ->from('repair_status')
            ->groupBy('repair_id');

        return static::createQuery()
            ->select('R.id', 'V.topic', 'R.create_date', 'S.operator_id', 'S.status')
            ->from('repair R')
            ->join(array($q1, 'T'), 'LEFT', array('T.repair_id', 'R.id'))
            ->join('repair_status S', 'LEFT', array('S.id', 'T.max_id'))
            ->join('inventory V', 'LEFT', array('V.id', 'R.inventory_id'))
            ->where($where);
    }
}
