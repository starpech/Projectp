<?php
/**
 * @filesource modules/school/views/grade.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace School\Grade;

use Kotchasan\DataTable;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=school-grades.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * ข้อมูลโมดูล.
     */
    private $typies;
    /**
     * @var int
     */
    private $credit = 0;
    /**
     * @var int
     */
    private $total = 0;

    /**
     * ตารางผลการเรียน.
     *
     * @param Request $request
     * @param object  $student
     *
     * @return string
     */
    public function render(Request $request, $student)
    {
        // ค่าที่ส่งมา
        $student->year = $request->request('year', self::$cfg->academic_year)->toInt();
        $student->term = $request->request('term', self::$cfg->term)->toInt();
        $this->typies = Language::get('COURSE_TYPIES');
        // URL สำหรับส่งให้ตาราง
        $uri = $request->createUriWithGlobals(WEB_URL.'index.php');
        // ตาราง
        $table = new DataTable(array(
            /* Uri */
            'uri' => $uri,
            /* Model */
            'model' => \School\Grade\Model::toDataTable($student),
            /* เรียงลำดับ */
            'sort' => 'course_code',
            /* ฟังก์ชั่นจัดรูปแบบการแสดงผลแถวของตาราง */
            'onRow' => array($this, 'onRow'),
            /* สร้าง footer */
            'onCreateFooter' => array($this, 'onCreateFooter'),
            /* คอลัมน์ที่ไม่ต้องแสดงผล */
            'hideColumns' => array('id'),
            /* ไม่แสดง checkbox */
            'hideCheckbox' => true,
            /* ตั้งค่าการกระทำของของตัวเลือกต่างๆ ด้านล่างตาราง */
            'actions' => array(
                array(
                    'class' => 'button orange icon-excel',
                    'href' => WEB_URL.'export.php?module=school-export&amp;type=mygrade&amp;export=csv&amp;id='.$student->id.'&amp;year='.$student->year.'&amp;term='.$student->term,
                    'target' => 'download',
                    'text' => '{LNG_Download}',
                ),
                array(
                    'class' => 'button print icon-print',
                    'href' => WEB_URL.'export.php?module=school-export&amp;type=mygrade&amp;export=print&amp;id='.$student->id.'&amp;year='.$student->year.'&amp;term='.$student->term,
                    'target' => 'download',
                    'text' => '{LNG_Print}',
                ),
            ),
            /* ตัวเลือกด้านบนของตาราง ใช้จำกัดผลลัพท์การ query */
            'filters' => array(
                array(
                    'name' => 'year',
                    'text' => '{LNG_Academic year}',
                    'options' => \School\Academicyear\Model::fromStudent($student->id),
                    'value' => $student->year,
                ),
                array(
                    'name' => 'term',
                    'text' => '{LNG_Term}',
                    'options' => \School\Category\Model::init()->toSelect('term'),
                    'value' => $student->term,
                ),
            ),
            /* ส่วนหัวของตาราง และการเรียงลำดับ (thead) */
            'headers' => array(
                'course_code' => array(
                    'text' => '{LNG_Course Code}',
                ),
                'course_name' => array(
                    'text' => '{LNG_Course Name}',
                ),
                'type' => array(
                    'text' => '{LNG_Type}',
                    'class' => 'center',
                ),
                'credit' => array(
                    'text' => '{LNG_Credit}',
                    'class' => 'center',
                ),
                'grade' => array(
                    'text' => '{LNG_Grade}',
                    'class' => 'center',
                ),
            ),
            /* รูปแบบการแสดงผลของคอลัมน์ (tbody) */
            'cols' => array(
                'credit' => array(
                    'class' => 'center',
                ),
                'type' => array(
                    'class' => 'center',
                ),
                'grade' => array(
                    'class' => 'center',
                ),
            ),
        ));
        // คืนค่า HTML

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
        if ($item['credit'] == 0.0) {
            $item['credit'] = '';
        } else {
            $this->credit += $item['credit'];
            $this->total += ($item['grade'] * $item['credit']);
        }
        $item['type'] = isset($this->typies[$item['type']]) ? $this->typies[$item['type']] : '';

        return $item;
    }

    /**
     * ฟังก์ชั่นสร้างแถวของ footer.
     *
     * @return string
     */
    public function onCreateFooter()
    {
        return '<tr><td colspan=2></td><td class=center>{LNG_Academic results}</td><td class=center>'.number_format($this->credit, 1, '.', '').'</td><td class=center>'.number_format(self::div($this->total, $this->credit), 2, '.', '').'</td></tr>';
    }
}
