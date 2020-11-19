<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
require_once '../php/connect.php';
// Create an instance of the class:
function dbReqDetail(){
  global $conn;
  $query = "
  (SELECT * FROM `req_detail01` WHERE pr_id = '{$_GET['id']}') UNION
  (SELECT * FROM `req_detail02` WHERE pr_id = '{$_GET['id']}') UNION
  (SELECT * FROM `req_detail03` WHERE pr_id = '{$_GET['id']}') UNION
  (SELECT * FROM `req_detail04` WHERE pr_id = '{$_GET['id']}') UNION
  (SELECT * FROM `req_detail05` WHERE pr_id = '{$_GET['id']}') UNION
  (SELECT * FROM `req_detail06` WHERE pr_id = '{$_GET['id']}') 
   ";
  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_row()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows;
}
function dbPrDetail(){
  global $conn;
  $query = "
  SELECT * FROM `pr_detail` WHERE pr_main_id in (select x.pr_no from pr_main as x where x.pr_id = '{$_GET['id']}')";
  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_row()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows;
}
function dbPrMain(){
  global $conn;
  $query="
  
  SELECT 

   p.pr_id,
   p.pr_date,
   p.`pr_SupplierID`,
   p.`pr_SupplierName`,
   (select c.comp_addr from comp as c where c.comp_code= p.`pr_SupplierID`) as SupplierAddr,

   (select c.comp_name from comp as c where c.comp_code= p.`site_no`) as site_name,
   (select c.comp_addr from comp as c where c.comp_code= p.`site_no`) as site_addr,

   (select sum(pd.amount) from pr_detail as pd where pd.pr_main_id = p.pr_no) as sumall

   FROM `pr_main` as p
 
   where p.pr_id = '{$_GET['id']}' and flag_delete = 0

  ";
  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_row()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows[0];

}

$pr = dbPrMain();
$prDate = date('d/m/Y',strtotime($pr[1]));
$pd = dbPrDetail();
$req = dbReqDetail();

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);

$output .= '
<table width="100%" border="0" cellpadding="5" cellspacing="0">
 <tr>
  <td colspan="2" align="center" style="font-size:18px">
  
     <b>บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด</b><br>
     ใบสั่งซื้อสินค้า 
  </td>
 </tr>
 <tr>
  <td colspan="2">
   <table width="100%" cellpadding="5">
    <tr>
     <td width="65%">
     วันที่ '.$prDate.'<br>
     เลขที่ใบสั่งซื้อสินค้า  '.$pr[0].'
     </td>
     <td width="35%">
    
     </td>
    </tr>
   </table>
   <br>
   <table width="100%" cellpadding="5">
   <tr>
    <td width="20%" valign="top">
   รหัสผู้ขาย<br> '.$pr[2].':'.$pr[3].'
    </td>
    <td width="40%" valign="top">
    สถานที่วางบิล<br>
       503 อาคาร เคเอสแอล ทาวเวอร์ ชั้น 16 ถนน ศรีอยุธยา แขวงพญาไท เขตราชเทวี กรุงเทพฯ 10400
    </td>
    <td width="40%" valign="top">
    สถานที่ส่งสินค้า<br>
    '.$pr[5].' <br>
    '.$pr[6].'
    </td>
   </tr>
  </table>
  <br>
  <table width="100%" cellpadding="5">
  <tr>
   <td width="50%" valign="top">
          ประเภทการจัดส่ง : ส่งถึงสถานที่ตามรายการขอซื้อ
   </td>
   <td width="25%" valign="top">
   ค่าระวาง : EXW
   </td>
   </td>
   <td width="25%" valign="top">

   </td>
   <td width="25%" valign="top">

   </td>
  </tr>
 </table>


 
   <br />
   <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
     <th>ลำดับ</th>
     <th>รหัสสินค้า</th>
     <th>ชื่อสินค้า</th>
     <th>จำนวน</th>
     <th>หน่วย</th>
     <th>ราคาต่อหน่วย</th>
     <th>จำนวนเงิน</th>
       </tr>
    ';
if($pd)
foreach($pd as $k=>$pdRow){
    $output .=  '<tr>
    <td>'.($k+1).'</td>
    <td>'.$pdRow[3].'</td>
    <td>'.$pdRow[4].'</td>
    <td>'.$pdRow[5].'</td>
    <td>'.$pdRow[7].'</td>
    <td>'.$pdRow[6].'</td>
    <td>'.number_format($pdRow[8],2).'</td>
      </tr>';
}

$output .=  '<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align=right>รวมเงินทั้งหมด</td>
<td>'.number_format($pr[7],2).'</td>
  </tr>
  </table>';

$output .= '
   <table width="100%" cellpadding="5">
   <tr>
    <td width="25%" valign="top">

    </td>
 
    </tr></table>

  </td>
 </tr>
</table>';

$output .= '
<table width="100%" border="0" cellpadding="5" cellspacing="0">
 <tr>
  <td colspan="2" align="center" style="font-size:18px">
    <b>รายละเอียดรายการขอซื้อ</b>
  </td>
 </tr>
</table>';

$output .= '
<table width="100%" border="1" cellpadding="5" cellspacing="0">
 <tr>
  <th>ลำดับ</th>
  <th>เลขรายการขอซื้อ</th>
  <th>โควต้า</th>
  <th>ชื่อ-นามสกุล</th>
  <th>เขต</th>
  <th>สถานที่</th>
  <th>ชื่อสินค้า</th>
  <th>จำนวน</th>
 </tr>';
if($req)
foreach($req as $a=>$reqRow){
 $output .=  '<tr>
 <td>'.($a+1).'</td>
 <td>'.$reqRow[1].'</td>
 <td>'.$reqRow[9].'</td>
 <td>'.$reqRow[10].'</td>
 <td>'.$reqRow[11].'</td>
 <td>'.$reqRow[12].'</td>
 <td>'.$reqRow[15].'</td>
 <td>'.number_format($reqRow[16],2).'</td>
 </tr>';
}
$output .= '</table>';

$output .= '<br><br><br>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
 <tr>
  <td colspan="2" align="center" style="font-size:18px">
    ลงชื่อ............................................(ผู้รับใบสั่งซื้อ) ลงชื่อ............................................(ผู้จัดเตรียม) ลงชื่อ............................................(ผู้อนุมัติ)<br>

  </td>
 </tr>
</table>';




// Write some HTML code:
$mpdf->WriteHTML($output);

// Output a PDF file directly to the browser
$mpdf->Output();
?>