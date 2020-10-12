<?php
/**
 * @filesource Gcms/Email.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Gcms;

use Kotchasan\ArrayTool;
use Kotchasan\Date;
use Kotchasan\Language;

/**
 * Email function for GCMS.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Email extends \Kotchasan\Email
{
    /**
     * ฟังก์ชั่นส่งเมล์จากแม่แบบจดหมาย.
     *
     * @param int    $id     ID ของจดหมายที่ต้องการส่ง
     * @param string $module ชื่อโมดูลของจดหมายที่ต้องการส่ง
     * @param array  $datas  ข้อมูลที่จะถูกแทนที่ลงในจดหมาย ในรูป 'ตัวแปร'=>'ข้อความ'
     * @param string $to     ที่อยู่อีเมลผู้รับ คั่นแต่ละรายชื่อด้วย ,
     *
     * @return \static
     */
    public static function send($id, $module, $datas, $to)
    {
        $model = new \Kotchasan\Model();
        $email = $model->db()->createQuery()
            ->from('emailtemplate')
            ->where(array(
                array('module', $module),
                array('email_id', (int) $id),
                array('language', array(Language::name(), '')),
            ))
            ->cacheOn()
            ->toArray()
            ->first('from_email', 'copy_to', 'subject', 'detail');
        if ($email === false) {
            $obj = new static();
            $obj->error[404] = Language::get('email template not found');

            return $obj;
        } else {
            // ผู้ส่ง
            $from = empty($email['from_email']) ? self::$cfg->noreply_email : $email['from_email'];
            // ข้อความในอีเมล
            $replace = ArrayTool::replace(array(
                '/%WEBTITLE%/' => strip_tags(self::$cfg->web_title),
                '/%WEBURL%/' => WEB_URL,
                '/%ADMINEMAIL%/' => $from,
                '/%TIME%/' => Date::format(),
                '/%IP%/' => self::$request->getClientIp(),
            ), $datas);
            ArrayTool::extract($replace, $keys, $values);
            $msg = preg_replace($keys, $values, $email['detail']);
            $subject = preg_replace($keys, $values, $email['subject']);
            $to = explode(',', $to);
            if (!empty($email['copy_to'])) {
                $to[] = $email['copy_to'];
            }
            // ส่งอีเมล

            return parent::send(implode(',', $to), $from, $subject, $msg);
        }
    }
}
