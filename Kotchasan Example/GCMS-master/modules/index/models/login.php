<?php
/**
 * @filesource modules/index/models/login.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\Login;

use Gcms\Login;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=member
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\KBase
{
    /**
     * ตรวจสอบการ login
     *
     * @param Request $request
     */
    public function chklogin(Request $request)
    {
        if ($request->initSession() && $request->isSafe()) {
            // ตรวจสอบการ login
            Login::create();
            // ตรวจสอบสมาชิก
            $login = Login::isMember();
            if ($login) {
                $ret = array(
                    'alert' => Language::replace('Welcome %s, login complete', array('%s' => empty($login['name']) ? $login['email'] : $login['name'])),
                    'content' => rawurlencode(createClass('Index\Login\View')->member($login)),
                    'action' => $request->post('login_action')->toString(),
                );
                // เคลียร์
                $request->removeToken();
            } else {
                $ret = array(
                    'alert' => Login::$login_message,
                    'input' => Login::$login_input,
                );
            }
            // คืนค่า JSON
            echo json_encode($ret);
        }
    }
}
