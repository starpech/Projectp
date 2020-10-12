<?php
/**
 * @filesource modules/index/models/category.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\Category;

use Kotchasan\Language;

/**
 * คลาสสำหรับอ่านข้อมูลหมวดหมู่
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model
{
    /**
     * @var array
     */
    private $categories = array();
    /**
     * @var array
     */
    private $datas = array();

    public function __construct()
    {
        // หมวดหมู่
        $this->categories = Language::get('CATEGORIES');
    }

    /**
     * คืนค่าหมวดหมู่ (key) ทั้งหมด
     *
     * @return array
     */
    public function typies()
    {
        return array_keys($this->categories);
    }

    /**
     * คืนค่าชื่อหมวดหมู่.
     *
     * @return array
     */
    public function label($type)
    {
        return isset($this->categories[$type]) ? $this->categories[$type] : '';
    }

    /**
     * @return static
     */
    public static function init()
    {
        $obj = new static();
        // Query ข้อมูลหมวดหมู่จากตาราง category
        $query = \Kotchasan\Model::createQuery()
            ->select('category_id', 'topic', 'type')
            ->from('category')
            ->where(array('type', $obj->typies()))
            ->order('category_id')
            ->cacheOn();
        // ภาษาที่ใช้งานอยู่
        $lng = Language::name();
        foreach ($query->execute() as $item) {
            $topic = @unserialize($item->topic);
            if (isset($topic[$lng])) {
                $obj->datas[$item->type][$item->category_id] = $topic[$lng];
            }
        }

        return $obj;
    }

    /**
     * ลิสต์รายการหมวดหมู่
     * สำหรับใส่ลงใน select
     *
     * @param string $type
     *
     * @return array
     */
    public function toSelect($type)
    {
        return empty($this->datas[$type]) ? array() : $this->datas[$type];
    }

    /**
     * คืนค่ารายการที่ต้องการ
     *
     * @param string $type
     * @param int    $category_id
     */
    public function get($type, $category_id)
    {
        return empty($this->datas[$type][$category_id]) ? '' : $this->datas[$type][$category_id];
    }
}
