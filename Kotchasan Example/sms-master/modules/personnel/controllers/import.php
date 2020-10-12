<?php
/**
 * @filesource modules/personnel/controllers/import.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Personnel\Import;

use Gcms\Login;
use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=personnel-import.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * นำเข้าข้อมูลบุคลากร.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // ข้อความ title bar
        $this->title = Language::trans('{LNG_Import} {LNG_Personnel list}');
        // เลือกเมนู
        $this->menu = 'settings';
        // สามารถจัดการรายชื่อบุคลากรได้
        if (Login::checkPermission(Login::isMember(), 'can_manage_personnel')) {
            // แสดงผล
            $section = Html::create('section', array(
                'class' => 'content_bg',
            ));
            // breadcrumbs
            $breadcrumbs = $section->add('div', array(
                'class' => 'breadcrumbs',
            ));
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><span class="icon-customer">{LNG_Personnel}</span></li>');
            $ul->appendChild('<li><span>{LNG_Personnel}</span></li>');
            $ul->appendChild('<li><a href="index.php?module=personnel-setup&id=0">{LNG_Personnel list}</a></li>');
            $ul->appendChild('<li><span>{LNG_Import}</span></li>');
            $section->add('header', array(
                'innerHTML' => '<h2 class="icon-import">'.$this->title.'</h2>',
            ));
            // menu
            $section->appendChild(\Index\Tabmenus\View::render($request, 'settings', 'personnel'));
            // แสดงฟอร์ม
            $section->appendChild(createClass('Personnel\Import\View')->render());

            return $section->render();
        }
        // 404

        return \Index\Error\Controller::execute($this);
    }
}
