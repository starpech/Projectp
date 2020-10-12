<?php
/**
 * @filesource modules/personnel/controllers/export.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Personnel\Export;

use Kotchasan\Date;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=personnel-export
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Kotchasan\Controller
{
    /**
     * ส่งออกไฟล์ตัวอย่าง person.csv
     *
     * @param Request $request
     */
    public function export(Request $request)
    {
        $header = array();
        $header[] = Language::trans('{LNG_Name} *');
        $header[] = Language::trans('{LNG_Identification No.} **');
        $header[] = Language::get('Birthday');
        $header[] = Language::get('Phone');
        $birthday = Date::format(time(), 'Y-m-d');
        $person = array(
            array('นายสมชาย โนนกระโทก', '', $birthday, ''),
            array('นางสมศรี รักงานดี', '', $birthday, ''),
        );
        // หมวดหมู่ของบุคลากร
        foreach (Language::get('CATEGORIES') as $key => $label) {
            $header[] = $label;
            $person[0][] = 1;
            $person[1][] = 1;
        }
        // รายละเอียดของบุคลากร
        foreach (Language::get('PERSONNEL_DETAILS', array()) as $key => $label) {
            $header[] = $label;
            $person[0][] = '';
            $person[1][] = '';
        }
        // ดาวน์โหลดไฟล์ person.csv

        return \Kotchasan\Csv::send('person', $header, $person, self::$cfg->csv_language);
    }
}
