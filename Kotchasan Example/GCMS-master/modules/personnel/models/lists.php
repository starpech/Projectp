<?php
/**
 * @filesource modules/personnel/models/lists.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Personnel\Lists;

/**
 * อ่านข้อมูลโมดูล.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{
    /**
     * อ่านข้อมูลโมดูล.
     *
     * @param int $module_id
     * @param int $category_id
     *
     * @return object
     */
    public static function getItems($module_id, $category_id)
    {
        $where = array(
            array('module_id', $module_id),
        );
        if ($category_id > 0) {
            $where[] = array('category_id', $category_id);
        }
        // Model
        $model = new static();

        return $model->db()->createQuery()
            ->select()
            ->from('personnel')
            ->where($where)
            ->order('category_id', 'order', 'id')
            ->cacheOn()
            ->execute();
    }
}
