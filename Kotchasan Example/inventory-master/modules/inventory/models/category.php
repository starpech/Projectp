<?php
/**
 * @filesource modules/inventory/models/category.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Inventory\Category;

use Kotchasan\Language;

/**
 * คลาสสำหรับอ่านข้อมูลหมวดหมู่
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Gcms\Category
{
    /**
     * init Class
     */
    public function __construct()
    {
        // ชื่อหมวดหมู่
        $this->categories = Language::get('INVENTORY_CATEGORIES') +
        array(
            'unit' => Language::get('Unit'),
        );
    }
}
