<?php
/**
 * @filesource modules/dms/views/view.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Dms\View;

use Kotchasan\Date;

/**
 * แสดงรายละเอียดของเอกสาร (modal).
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * แสดงฟอร์ม Modal สำหรับแสดงรายละเอียดของเอกสาร.
     *
     * @param object $index
     * @param array  $login
     *
     * @return string
     */
    public function render($index, $login)
    {
        $content = '';
        $content .= '<article class=modal_detail>';
        $content .= '<header><h1 class=icon-file>{LNG_Details of} {LNG_Document}</h1></header>';
        $content .= '<div class="table fullwidth">';
        $content .= '<p class=tr><span class="td item icon-number">{LNG_Document No.}</span><span class="td item">:</span><span class="td item">'.$index->document_no.'</span></p>';
        $content .= '<p class=tr><span class="td item icon-file">{LNG_Document title}</span><span class="td item">:</span><span class="td item">'.$index->topic.'</span></p>';
        $content .= '<p class=tr><span class="td item icon-calendar">{LNG_Date}</span><span class="td item">:</span><span class="td item">'.Date::format($index->create_date, 'd M Y').'</span></p>';
        $content .= '<p class=tr><span class="td item icon-edit">{LNG_Detail}</span><span class="td item">:</span><span class="td item">'.nl2br($index->detail).'</span></p>';
        $content .= '</div>';
        foreach (\Dms\View\Model::files($index->id, $login) as $item) {
            $img = '<img src="'.(is_file(ROOT_PATH.'skin/ext/'.$item->ext.'.png') ? WEB_URL.'skin/ext/'.$item->ext.'.png' : WEB_URL.'skin/ext/file.png').'" alt="'.$item->ext.'">';
            $c = empty($item->downloads) ? 'silver' : 'green';
            $content .= '<p class="item"><span class="icon-valid color-'.$c.' notext"></span>'.$img.' '.$item->topic.'.'.$item->ext.'</p>';
        }
        $content .= '</article>';

        return $content;
    }
}
