<?php
/**
 * @filesource modules/repair/views/repair.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Repair\Repair;

use Kotchasan\Currency;
use Kotchasan\DataTable;
use Kotchasan\Date;
use Kotchasan\Language;
use Kotchasan\Province;
use Kotchasan\Template;

/**
 * module=repair-repair
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * @var mixed
     */
    private $statuses;

    /**
     * repair.php.
     *
     * @param object $index
     *
     * @return string
     */
    public function render($index)
    {
        // สถานะการซ่อม
        $this->statuses = \Repair\Status\Model::create();
        // ตาราง
        $table = new DataTable(array(
            'class' => 'border horiz-table',
            /* array datas */
            'datas' => \Repair\Detail\Model::getAllStatus($index->id),
            /* ปิดการใช้งาน Javascript */
            'enableJavascript' => false,
            /* ฟังก์ชั่นจัดรูปแบบการแสดงผลแถวของตาราง */
            'onRow' => array($this, 'onRow'),
            /* ส่วนหัวของตาราง และการเรียงลำดับ (thead) */
            'headers' => array(
                'name' => array(
                    'text' => '{LNG_Operator}',
                ),
                'status' => array(
                    'text' => '{LNG_Repair status}',
                    'class' => 'center',
                ),
                'cost' => array(
                    'text' => '{LNG_Cost}',
                    'class' => 'center',
                ),
                'create_date' => array(
                    'text' => '{LNG_Transaction date}',
                    'class' => 'center',
                ),
                'comment' => array(
                    'text' => '{LNG_Comment}',
                ),
            ),
            /* รูปแบบการแสดงผลของคอลัมน์ (tbody) */
            'cols' => array(
                'status' => array(
                    'class' => 'center',
                ),
                'cost' => array(
                    'class' => 'right',
                ),
                'create_date' => array(
                    'class' => 'center',
                ),
            ),
        ));
        // repair.html
        $template = Template::createFromFile(ROOT_PATH.'modules/repair/views/repair.html');
        $template->add(array(
            '/%COMPANY%/' => self::$cfg->company_name,
            '/%JOB_ID%/' => $index->job_id,
            '/%NAME%/' => $index->name,
            '/%PHONE%/' => $index->phone,
            '/%ADDRESS%/' => $index->address,
            '/%PROVINCE%/' => Province::get($index->provinceID),
            '/%ZIPCODE%/' => $index->zipcode,
            '/%EQUIPMENT%/' => $index->equipment,
            '/%SERIAL%/' => $index->serial,
            '/%JOB_DESCRIPTION%/' => nl2br($index->job_description),
            '/%CREATE_DATE%/' => Date::format($index->create_date, 'd M Y'),
            '/%APPOINTMENT_DATE%/' => Date::format($index->appointment_date, 'd M Y'),
            '/%APPRAISER%/' => empty($index->appraiser) ? '' : Currency::format($index->appraiser),
            '/%COMMENT%/' => $index->comment,
            '/%DETAILS%/' => $table->render(),
            '/{LANGUAGE}/' => Language::name(),
            '/{WEBURL}/' => WEB_URL,
        ));

        return Language::trans($template->render());
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
        $item['cost'] = $item['cost'] == 0 ? '' : Currency::format($item['cost']);
        $item['comment'] = nl2br($item['comment']);
        $item['create_date'] = Date::format($item['create_date'], 'd M Y H:i');
        $item['status'] = '<mark class=term style="background-color:'.$this->statuses->getColor($item['status']).'">'.$this->statuses->get($item['status']).'</mark>';

        return $item;
    }
}
