<?php
/**
 * @filesource modules/enroll/controllers/setup.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Enroll\Setup;

use Gcms\Login;
use Kotchasan\Date;
use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=enroll-setup
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * ตารางรายการ สินค้า.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // ข้อความ title bar
        $this->title = Language::trans('{LNG_List of} {LNG_Enroll}');
        // เลือกเมนู
        $this->menu = 'enrollsetup';
        // สมาชิก
        $login = Login::isMember();
        // สามารถจัดการการลงทะเบียนได้
        if (Login::checkPermission($login, 'can_manage_enroll')) {
            // แสดงผล
            $section = Html::create('section', array(
                'class' => 'content_bg',
            ));
            // breadcrumbs
            $breadcrumbs = $section->add('div', array(
                'class' => 'breadcrumbs',
            ));
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><span class="icon-register">{LNG_Home}</span></li>');
            $ul->appendChild('<li><span>{LNG_Enroll}</span></li>');
            $ul->appendChild('<li><span>{LNG_List of}</span></li>');
            $section->add('header', array(
                'innerHTML' => '<h2 class="icon-list">'.$this->title.'</h2>',
            ));
            // แสดงตาราง
            $section->appendChild(createClass('Enroll\Setup\View')->render($request, $login));
            // คืนค่า HTML

            return $section->render();
        }
        // 404

        return \Index\Error\Controller::execute($this);
    }

    /**
     * export
     *
     * @param Request $request
     */
    public function export(Request $request)
    {
        // สามารถจัดการรายการลงทะเบียนได้
        if (Login::checkPermission(Login::isMember(), 'can_manage_enroll')) {
            $params = array(
                'level' => $request->get('level')->toInt(),
                'sort' => array(),
            );
            if (preg_match_all('/(name|create_date)((\s(asc|desc))|)/', $request->get('sort')->toString(), $match, PREG_SET_ORDER)) {
                foreach ($match as $item) {
                    $params['sort'][] = $item[0];
                }
            }
            if (empty($params['sort'])) {
                $params['sort'][] = 'create_date asc';
            }
            $lng = Language::getItems(array(
                'Education level',
                'Study plan',
                'Title',
                'Name',
                'Identification No.',
                'Birthday',
                'Phone',
                'Email',
                'Nationality',
                'Religion',
                'Address',
                'District',
                'Amphur',
                'Province',
                'Zipcode',
                'Original school',
                'TITLES',
                'ACADEMIC_RESULTS',
                'PARENT_LIST',
            ));
            $header = array(
                $lng['Education level'],
            );
            for ($i = 0; $i < self::$cfg->enroll_study_plan_count; $i++) {
                $header[] = $lng['Study plan'].' '.($i + 1);
            }
            $header[] = $lng['Title'];
            $header[] = $lng['Name'];
            $header[] = $lng['Identification No.'];
            $header[] = $lng['Birthday'];
            $header[] = $lng['Phone'];
            $header[] = $lng['Email'];
            $header[] = $lng['Nationality'];
            $header[] = $lng['Religion'];
            $header[] = $lng['Address'];
            $header[] = $lng['District'];
            $header[] = $lng['Amphur'];
            $header[] = $lng['Province'];
            $header[] = $lng['Zipcode'];
            if (is_array($lng['PARENT_LIST'])) {
                foreach ($lng['PARENT_LIST'] as $key => $label) {
                    $header[] = $lng['Name'].' '.$label;
                    $header[] = $lng['Phone'];
                }
            }
            $header[] = $lng['Original school'];
            if (is_array($lng['ACADEMIC_RESULTS'])) {
                foreach ($lng['ACADEMIC_RESULTS'] as $key => $label) {
                    $header[] = $label;
                }
            }
            // Education level
            $level = \Enroll\Level\Model::toSelect();
            $datas = array();
            foreach (\Enroll\Setup\Model::export($params) as $item) {
                $result = array(
                    isset($level[$item->level]) ? $level[$item->level] : '',
                );
                $plan = explode(',', $item->plan);
                for ($i = 0; $i < self::$cfg->enroll_study_plan_count; $i++) {
                    $result[] = isset($plan[$i]) ? $plan[$i] : '';
                }
                $result[] = $lng['TITLES'][$item->title];
                $result[] = $item->name;
                $result[] = $item->id_card;
                $result[] = Date::format($item->birthday, 'd M Y');
                $result[] = $item->phone;
                $result[] = $item->email;
                $result[] = $item->nationality;
                $result[] = $item->religion;
                $result[] = $item->address;
                $result[] = $item->district;
                $result[] = $item->amphur;
                $result[] = $item->province;
                $result[] = $item->zipcode;
                if (is_array($lng['PARENT_LIST'])) {
                    $parent = json_decode($item->parent, true);
                    foreach ($lng['PARENT_LIST'] as $k => $v) {
                        $result[] = empty($parent[$k]['name']) ? '' : $parent[$k]['name'];
                        $result[] = empty($parent[$k]['phone']) ? '' : $parent[$k]['phone'];
                    }
                }
                $result[] = $item->original_school;
                if (is_array($lng['ACADEMIC_RESULTS'])) {
                    $academic_results = json_decode($item->academic_results, true);
                    foreach ($lng['ACADEMIC_RESULTS'] as $k => $v) {
                        if (isset($academic_results[$k])) {
                            $result[] = $academic_results[$k];
                        } else {
                            $result[] = '';
                        }
                    }
                }
                $datas[] = $result;
            }
            // export to CSV

            return \Kotchasan\Csv::send('enroll', $header, $datas, self::$cfg->enroll_csv_language);
        }

        return false;
    }
}
