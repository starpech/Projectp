<?php
/**
 * @filesource modules/dms/views/setup.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Dms\Setup;

use Kotchasan\DataTable;
use Kotchasan\Date;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=dms-setup
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * @var object
     */
    private $category;

    /**
     * แสดงรายการเอกสารส่ง.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // หมวดหมู่
        $this->category = \Dms\Category\Model::init();
        // URL สำหรับส่งให้ตาราง
        $uri = $request->createUriWithGlobals(WEB_URL.'index.php');
        // ตาราง
        $table = new DataTable(array(
            /* Uri */
            'uri' => $uri,
            /* Model */
            'model' => \Dms\Setup\Model::toDataTable(),
            /* รายการต่อหน้า */
            'perPage' => $request->cookie('dmsSetup_perPage', 30)->toInt(),
            /* เรียงลำดับ */
            'sort' => $request->cookie('dmsSetup_sort', 'create_date DESC')->toString(),
            /* ฟังก์ชั่นจัดรูปแบบการแสดงผลแถวของตาราง */
            'onRow' => array($this, 'onRow'),
            /* คอลัมน์ที่ไม่ต้องแสดงผล */
            'hideColumns' => array('id'),
            /* ตั้งค่าการกระทำของของตัวเลือกต่างๆ ด้านล่างตาราง ซึ่งจะใช้ร่วมกับการขีดถูกเลือกแถว */
            'action' => 'index.php/dms/model/setup/action',
            'actionCallback' => 'dataTableActionCallback',
            'actions' => array(
                array(
                    'id' => 'action',
                    'class' => 'ok',
                    'text' => '{LNG_With selected}',
                    'options' => array(
                        'delete' => '{LNG_Delete}',
                    ),
                ),
            ),
            /* คอลัมน์ที่สามารถค้นหาได้ */
            'searchColumns' => array('topic', 'document_no'),
            /* ส่วนหัวของตาราง และการเรียงลำดับ (thead) */
            'headers' => array(
                'create_date' => array(
                    'text' => '{LNG_Date}',
                    'sort' => 'create_date',
                ),
                'document_no' => array(
                    'text' => '{LNG_Document No.}',
                    'sort' => 'document_no',
                ),
                'topic' => array(
                    'text' => '{LNG_Document title}',
                    'sort' => 'topic',
                ),
            ),
            /* ปุ่มแสดงในแต่ละแถว */
            'buttons' => array(
                'files' => array(
                    'class' => 'icon-documents button brown',
                    'href' => $uri->createBackUri(array('module' => 'dms-files', 'id' => ':id')),
                    'text' => '{LNG_List of} {LNG_File}',
                ),
                'edit' => array(
                    'class' => 'icon-edit button green',
                    'href' => $uri->createBackUri(array('module' => 'dms-write', 'id' => ':id')),
                    'text' => '{LNG_Edit}',
                ),
            ),
            /* ปุ่มเพิ่ม */
            'addNew' => array(
                'class' => 'float_button icon-new',
                'href' => $uri->createBackUri(array('module' => 'dms-write')),
                'title' => '{LNG_Upload} {LNG_Document}',
            ),
        ));
        foreach (Language::get('DMS_CATEGORIES') as $k => $label) {
            $table->filters[$k] = array(
                'name' => $k,
                'text' => $label,
                'options' => array(0 => '{LNG_all items}') + $this->category->toSelect($k),
                'default' => 0,
                'value' => $request->request($k)->toInt(),
            );
            $table->headers[$k] = array(
                'text' => $label,
                'class' => 'center',
            );
            $table->cols[$k] = array(
                'class' => 'center',
            );
        }
        // save cookie
        setcookie('dmsSetup_perPage', $table->perPage, time() + 2592000, '/', HOST, HTTPS, true);
        setcookie('dmsSetup_sort', $table->sort, time() + 2592000, '/', HOST, HTTPS, true);

        return $table->render();
    }

    /**
     * จัดรูปแบบการแสดงผลในแต่ละแถว.
     *
     * @param array $item
     *
     * @return array
     */
    public function onRow($item, $o, $prop)
    {
        $item['create_date'] = Date::format($item['create_date'], 'd M Y');
        foreach ($this->category->typies() as $k) {
            $item[$k] = $this->category->get($k, $item[$k]);
        }

        return $item;
    }
}
