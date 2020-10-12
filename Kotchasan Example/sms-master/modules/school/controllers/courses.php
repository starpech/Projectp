<?php
/**
 * @filesource modules/school/controllers/courses.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace School\Courses;

use Gcms\Login;
use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=school-courses
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * รายการรายวิชา.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // ข้อความ title bar
        $this->title = Language::trans('{LNG_Manage} {LNG_Courses}');
        // เลือกเมนู
        $this->menu = 'school';
        // ครู-อาจาร์ย, สามารถจัดการรายชื่อนักเรียนได้, สามารถจัดการรายวิชาได้
        if ($login = Login::checkPermission(Login::isMember(), array('can_manage_student', 'can_manage_course', 'can_teacher', 'can_rate_student'))) {
            // แสดงผล
            $section = Html::create('section', array(
                'class' => 'content_bg',
            ));
            // breadcrumbs
            $breadcrumbs = $section->add('div', array(
                'class' => 'breadcrumbs',
            ));
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><span class="icon-modules">{LNG_Module}</span></li>');
            $ul->appendChild('<li><span>{LNG_School}</span></li>');
            $ul->appendChild('<li><span>{LNG_Course}</span></li>');
            $section->add('header', array(
                'innerHTML' => '<h2 class="icon-elearning">'.$this->title.'</h2>',
            ));
            // แสดงตาราง
            $section->appendChild(createClass('School\Courses\View')->render($request, $login));
            // คืนค่า HTML

            return $section->render();
        }
        // 404

        return \Index\Error\Controller::execute($this);
    }

    /**
     * ส่งออกข้อมูล Course
     *
     * @param Request $request
     */
    public function export(Request $request)
    {
        // ค่าที่ส่งมา
        $params = array(
            'teacher' => $request->get('teacher')->toInt(),
            'year' => $request->get('year', self::$cfg->academic_year)->toInt(),
            'term' => $request->get('term', self::$cfg->term)->toInt(),
            'class' => $request->get('class')->toInt(),
        );
        // header
        $header = array(
            Language::trans('{LNG_Course Code} *, **'),
            Language::trans('{LNG_Course Name} *'),
            Language::trans('{LNG_Credit} *'),
            Language::get('Period'),
            Language::get('Type'),
            Language::get('Class'),
            Language::trans('Academic year'),
            Language::get('Term'),
            Language::get('Teacher'),
        );
        $datas = \School\Courses\Model::toDataTable($params)
            ->select('C.course_code', 'C.course_name', 'C.credit', 'C.period', 'C.type', 'C.class', 'C.year', 'C.term', 'C.teacher_id')
            ->order('year DESC,term DESC,teacher_id DESC')
            ->cacheOn()
            ->toArray()
            ->execute();
        // ส่งออกไฟล์ course.csv

        return \Kotchasan\Csv::send('course', $header, $datas, self::$cfg->csv_language);
    }
}
