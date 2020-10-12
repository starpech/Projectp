<?php
/**
 * @filesource modules/repair/controllers/receive.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Repair\Receive;

use Gcms\Login;
use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * เพิ่ม-แก้ไข ใบรับงาน.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * module=repair-receive.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // อ่านข้อมูลรายการที่ต้องการ
        $index = \Repair\Receive\Model::get($request->request('id')->toInt());
        // ข้อความ title bar
        $this->title = Language::get($index->id == 0 ? 'Get a repair' : 'Repair job description');
        // เลือกเมนู
        $this->menu = 'repair';
        // สามารถรับเครื่องซ่อมได้
        if (Login::checkPermission(Login::isMember(), 'can_received_repair')) {
            // แสดงผล
            $section = Html::create('section', array(
                'class' => 'content_bg',
            ));
            // breadcrumbs
            $breadcrumbs = $section->add('div', array(
                'class' => 'breadcrumbs',
            ));
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><span class="icon-tools">{LNG_Repair system}</span></li>');
            $ul->appendChild('<li><a href="{BACKURL?module=repair-setup&id=0}">{LNG_Repair list}</a></li>');
            $ul->appendChild('<li><span>{LNG_'.($index->id == 0 ? 'Add New' : 'Edit').'}</span></li>');
            $section->add('header', array(
                'innerHTML' => '<h2 class="icon-write">'.$this->title.'</h2>',
            ));
            // แสดงฟอร์ม
            $section->appendChild(createClass('Repair\Receive\View')->render($index));
            // คืนค่า HTML

            return $section->render();
        }
        // 404

        return \Index\Error\Controller::execute($this);
    }
}
