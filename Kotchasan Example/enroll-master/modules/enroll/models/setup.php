<?php
/**
 * @filesource modules/enroll/models/setup.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Enroll\Setup;

use Gcms\Login;
use Kotchasan\Database\Sql;
use Kotchasan\File;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * โมเดลสำหรับ (setup.php).
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{
    /**
     * Query ข้อมูลสำหรับส่งให้กับ DataTable
     *
     * @param array $params
     *
     * @return \Kotchasan\Database\QueryBuilder
     */
    public static function toDataTable($params)
    {
        $where = array();
        if ($params['level'] > 0) {
            $where[] = array('E.level', $params['level']);
        }

        return static::createQuery()
            ->select('E.name', 'E.id', 'E.id_card', 'E.phone', 'E.level', 'E.create_date')
            ->from('enroll E')
            ->where($where);
    }

    /**
     * รับค่าจาก action (setup.php)
     *
     * @param Request $request
     */
    public function action(Request $request)
    {
        $ret = array();
        // session, referer, can_manage_enroll
        if ($request->initSession() && $request->isReferer() && $login = Login::isMember()) {
            if (Login::notDemoMode($login) && Login::checkPermission($login, 'can_manage_enroll')) {
                // รับค่าจากการ POST
                $action = $request->post('action')->toString();
                // id ที่ส่งมา
                if (preg_match_all('/,?([0-9]+),?/', $request->post('id')->toString(), $match)) {
                    if ($action === 'delete') {
                        // ลบ
                        $this->db()->delete($this->getTableName('enroll'), array('id', $match[1]), 0);
                        $this->db()->delete($this->getTableName('enroll_plan'), array('enroll_id', $match[1]), 0);
                        // ลบไฟล์
                        foreach ($match[1] as $id) {
                            // ลบรูปนักเรียน
                            if (is_file(ROOT_PATH.DATA_FOLDER.'enroll/'.$id.'.jpg')) {
                                unlink(ROOT_PATH.DATA_FOLDER.'enroll/'.$id.'.jpg');
                            }
                            // ลบไดเร็คทอรี่
                            File::removeDirectory(ROOT_PATH.DATA_FOLDER.'enroll/'.$id.'/');
                        }
                        // reload
                        $ret['location'] = 'reload';
                    }
                }
            }
        }
        if (empty($ret)) {
            $ret['alert'] = Language::get('Unable to complete the transaction');
        }
        // คืนค่า JSON
        echo json_encode($ret);
    }

    /**
     * ส่งออกข้อมูล
     *
     * @param array $params
     *
     * @return array
     */
    public static function export($params)
    {
        $where = array();
        if ($params['level'] > 0) {
            $where[] = array('E.level', $params['level']);
        }
        $q1 = \Kotchasan\Model::createQuery()
            ->select('enroll_id', Sql::GROUP_CONCAT('N.topic', 'plan'))
            ->from('enroll_plan D')
            ->join('enroll E', 'INNER', array('E.id', 'D.enroll_id'))
            ->join('category N', 'LEFT', array(array('N.type', 'enroll'), array('N.category_id', 'D.value'), array('N.sub_category', 'E.level')))
            ->groupBy('D.enroll_id');

        return \Kotchasan\Model::createQuery()
            ->select('E.level', 'N.plan', 'E.title', 'E.name', 'E.id_card', 'E.birthday', 'E.phone', 'E.email', 'E.nationality', 'E.religion', 'E.address', 'D.district', 'A.amphur', 'P.province', 'E.zipcode', 'E.parent', 'E.original_school', 'E.academic_results')
            ->from('enroll E')
            ->join(array($q1, 'N'), 'LEFT', array('N.enroll_id', 'E.id'))
            ->join('province P', 'LEFT', array('P.id', 'E.provinceID'))
            ->join('amphur A', 'LEFT', array(array('A.id', 'E.amphurID'), array('A.province_id', 'P.id')))
            ->join('district D', 'LEFT', array(array('D.id', 'E.districtID'), array('D.amphur_id', 'A.id')))
            ->where($where)
            ->order($params['sort'])
            ->cacheOn()
            ->execute();
    }
}
