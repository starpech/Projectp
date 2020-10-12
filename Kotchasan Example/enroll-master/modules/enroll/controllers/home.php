<?php
/**
 * @filesource modules/enroll/controllers/home.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Enroll\Home;

use Kotchasan\Http\Request;

/**
 * module=enroll-home.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * ฟังก์ชั่นสร้าง card.
     *
     * @param Request         $request
     * @param \Kotchasan\Html $card
     * @param array           $login
     */
    public static function addCard(Request $request, $card, $login)
    {
        $level = \Enroll\Level\Model::toSelect();
        $datas = \Enroll\Home\Model::datas();
        foreach ($datas as $item) {
            \Index\Home\Controller::renderCard($card, 'icon-register', $level[$item->level], number_format($item->count), '{LNG_Number of registrants}');
        }
    }

    /**
     * ฟังก์ชั่นสร้าง block.
     *
     * @param Request         $request
     * @param \Kotchasan\Html $block
     * @param array           $login
     */
    public static function addBlock(Request $request, $block, $login)
    {
        $content = createClass('Enroll\Home\View')->render($request, $login);
        $block->set('Enroll calendar', $content);
    }
}
