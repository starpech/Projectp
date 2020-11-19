<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
require_once '../php/connect.php';
// Create an instance of the class:
function dbPrDetail(){
  global $conn,$prefix_inv;
  $query = "
  SELECT * FROM `{$prefix_inv}detail` WHERE {$prefix_inv}main_id in (select x.{$prefix_inv}no from {$prefix_inv}main as x where x.{$prefix_inv}id = '{$_GET['id']}')";
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
  global $conn,$prefix_inv;
  $query="
  
  SELECT 

   p.{$prefix_inv}id,
   p.{$prefix_inv}date,
   p.`{$prefix_inv}SupplierID`,
   p.`{$prefix_inv}SupplierName`,
   (select c.comp_addr from comp as c where c.comp_code= p.`{$prefix_inv}SupplierID`) as SupplierAddr,

   (select c.comp_name from comp as c where c.comp_code= p.`site_no`) as site_name,
   (select c.comp_addr from comp as c where c.comp_code= p.`site_no`) as site_addr,

   (select sum(pd.amount) from {$prefix_inv}detail as pd where pd.{$prefix_inv}main_id = p.{$prefix_inv}no) as sumall
,inv_RecieveName
,inv_RecieveID
,(select c.comp_addr from comp as c where c.comp_code= p.`inv_RecieveID`) as inv_RecieveAddr


   FROM `{$prefix_inv}main` as p
 
   where p.{$prefix_inv}id = '{$_GET['id']}' and flag_delete = 0

  ";
  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_array()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows[0];

}

$pr = dbPrMain();
$prDate = date('d/m/Y',strtotime($pr[1]));
$pd = dbPrDetail();

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
     ใบส่งสินค้า
  </td>
 </tr>
 <tr>
  <td colspan="2">
   <table width="100%" cellpadding="5">
    <tr>
     <td width="65%">
     วันที่ส่งสินค้า '.$prDate.'<br>
     เลขที่ใบส่งของ '.$pr[0].'
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
    '.$pr['inv_RecieveName'].' <br>
    '.$pr['inv_RecieveAddr'].'
    </td>
   </tr>
  </table>
  <br>
  <table width="100%" cellpadding="5">
  <tr>
   <td width="50%" valign="top">
     ประเภทการจัดส่ง : ส่งถึงสถานที่ตามรายการขอซื้อ : 
   </td>

   <td width="50%" valign="top">
  
   </td>
  </tr>
 </table>

   <br />
   <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
     <th>ลำดับ</th>
     <th>รหัสสินค้า</th>
     <th>ชื่อสินค้า</th>
     <th>จำนวนที่ส่ง</th>
     <th>หน่วย</th>


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

      </tr>';
}

$output .=  '<tr>

  </tr>';

  $output .= '
  </table>

  <table width="100%" cellpadding="5">
  <tr>
   <td width="50%" valign="top"> <br><br> <br>
 <center> ลงชื่อ  .................................................................. (ผู้ส่งสินค้า) </center> 
 <br>
 <center> วันที่ส่งสินค้า  ................/.................../.................  </center>
   </td>

   <td width="50%" valign="top"> <br><br>
   <center>  ลงชื่อ  .................................................................. (ผู้รับสินค้า)  </center>
   <br>
   <center> วันที่รับสินค้า  ................/.................../.................  </center>
   </td> 
   </tr></table>

 </td>
</tr>
</table>
';



// Write some HTML code:
$mpdf->WriteHTML($output);

// Output a PDF file directly to the browser
$mpdf->Output();
?>