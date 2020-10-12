<?php
/**
 * @filesource modules/inventory/models/write.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Inventory\Write;

use Gcms\Login;
use Kotchasan\File;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=inventory-write
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{
    /**
     * อ่านข้อมูลรายการที่เลือก
     * ถ้า $id = 0 หมายถึงรายการใหม่
     * คืนค่าข้อมูล object ไม่พบคืนค่า null
     *
     * @param int $id ID
     *
     * @return object|null
     */
    public static function get($id)
    {
        if (empty($id)) {
            // ใหม่
            return (object) array(
                'id' => $id,
                'stock' => 1,
                'status' => 1,
            );
        } else {
            // แก้ไข อ่านรายการที่เลือก
            return static::createQuery()
                ->from('inventory')
                ->where(array('id', $id))
                ->first();
        }
    }

    /**
     * บันทึกข้อมูลที่ส่งมาจากฟอร์ม (write.php)
     *
     * @param Request $request
     */
    public function submit(Request $request)
    {
        $ret = array();
        // session, token, can_manage_inventory, ไม่ใช่สมาชิกตัวอย่าง
        if ($request->initSession() && $request->isSafe() && $login = Login::isMember()) {
            if (Login::checkPermission($login, 'can_manage_inventory') && Login::notDemoMode($login)) {
                try {
                    // รับค่าจากการ POST
                    $save = array(
                        'topic' => $request->post('topic')->topic(),
                        'product_no' => $request->post('product_no')->topic(),
                        'stock' => $request->post('stock')->toInt(),
                        'detail' => $request->post('detail')->textarea(),
                        'status' => $request->post('status')->toBoolean(),
                    );
                    // ตรวจสอบรายการที่เลือก
                    $index = self::get($request->post('id')->toInt());
                    if ($index) {
                        $categories = Language::get('INVENTORY_CATEGORIES', array()) + array('unit' => 'Units');
                        foreach ($categories as $key => $label) {
                            $save[$key] = \Gcms\Category::save($key, $request->post($key)->topic());
                        }
                        if ($save['product_no'] == '') {
                            // ไม่ได้กรอก product_no
                            $ret['ret_product_no'] = 'Please fill in';
                        } else {
                            // ค้นหา product_no ซ้ำ
                            $search = $this->db()->first($this->getTableName('inventory'), array('product_no', $save['product_no']));
                            if ($search && ($index->id == 0 || $index->id != $search->id)) {
                                $ret['ret_product_no'] = Language::replace('This :name already exist', array(':name' => Language::get('Serial/Registration number')));
                            }
                        }
                        if ($save['topic'] == '') {
                            // ไม่ได้กรอก topic
                            $ret['ret_topic'] = 'Please fill in';
                        }
                        if ($save['unit'] == 0) {
                            // ไม่ได้กรอก unit
                            $ret['ret_unit'] = 'Please fill in';
                        }
                        if (empty($ret)) {
                            // Database
                            $db = $this->db();
                            // table
                            $table = $this->getTableName('inventory');
                            if ($index->id == 0) {
                                $save['id'] = $db->getNextId($table);
                            } else {
                                $save['id'] = $index->id;
                            }
                            // อัปโหลดไฟล์
                            $dir = ROOT_PATH.DATA_FOLDER.'inventory/';
                            foreach ($request->getUploadedFiles() as $item => $file) {
                                /* @var $file \Kotchasan\Http\UploadedFile */
                                if ($item == 'picture') {
                                    if ($file->hasUploadFile()) {
                                        if (!File::makeDirectory($dir)) {
                                            // ไดเรคทอรี่ไม่สามารถสร้างได้
                                            $ret['ret_'.$item] = sprintf(Language::get('Directory %s cannot be created or is read-only.'), DATA_FOLDER.'inventory/');
                                        } else {
                                            try {
                                                $file->resizeImage(array('jpg', 'jpeg', 'png'), $dir, $save['id'].'.jpg', self::$cfg->inventory_w);
                                            } catch (\Exception $exc) {
                                                // ไม่สามารถอัปโหลดได้
                                                $ret['ret_'.$item] = Language::get($exc->getMessage());
                                            }
                                        }
                                    } elseif ($file->hasError()) {
                                        // ข้อผิดพลาดการอัปโหลด
                                        $ret['ret_'.$item] = Language::get($file->getErrorMessage());
                                    }
                                }
                            }
                        }
                        if (empty($ret)) {
                            if ($index->id == 0) {
                                // ใหม่
                                $save['create_date'] = date('Y-m-d H:i:s');
                                $db->insert($table, $save);
                            } else {
                                // แก้ไข
                                $db->update($table, $index->id, $save);
                            }
                            // คืนค่า
                            $ret['alert'] = Language::get('Saved successfully');
                            $ret['location'] = $request->getUri()->postBack('index.php', array('module' => 'inventory-setup'));
                        }
                    }
                } catch (\Kotchasan\InputItemException $e) {
                    $ret['alert'] = $e->getMessage();
                }
            }
        }
        if (empty($ret)) {
            $ret['alert'] = Language::get('Unable to complete the transaction');
        }
        // คืนค่าเป็น JSON
        echo json_encode($ret);
    }
}
