<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
require_once '../php/connect.php';
// Create an instance of the class:
function dbData(){
  global $conn;
  $comp_code = $_SESSION["comp_code"];
  $find_date = ($_GET['findDate'])?$_GET['findDate']:'';

  if($find_date)
     $query = "SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail{$comp_code} where input_date = '{$find_date}' order by ISNULL(approve_date) " ; //WHERE ISNULL(approve_date)
  else 
     $query = "SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail{$comp_code} order by ISNULL(approve_date) " ; //WHERE ISNULL(approve_date)

  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_assoc()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows;
}

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
    'default_font' => 'sarabun',
    'format' => 'A4'
]);
$mpdf->SetTitle(' แสดงรายการขอซื้อ ');
$mpdf->AddPage("P");
$datei = ($_GET['findDate'])?"วันที่ ".date('d / m / Y',strtotime($_GET['findDate'])):" ทั้งหมด ";
$output = "
<table width=\"100%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"font-size:16px\">
<thead>
<tr><th colspan='9' style=\"font-size:18px\"> 
  <b style=\"font-size:20px\">บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด</b><br>
แสดงรายการขอซื้อ <br>
{$datei}
<br><br><br>

</th></tr>
<tr>
  <th>วันที่</th>
  <th>เลขที่</th>
  <th>โค้วต้า</th>
  <th>ชื่อ-นามสกุล</th>
  <th>เขต</th>
  <th>สถานที่จัดส่ง</th>
  <th>ชื่อสินค้า</th>
  <th>สถานะ</th>
  <th>จำนวน</th>
  </tr>
 </thead>
 <tbody> ";

$bodyTable = '';

$dbdata = dbData();
foreach($dbdata as $k=>$v){
  $datei = date('d/m/Y',strtotime($v["input_date"]));
  $status = ($v["status"])?"<span style=\"color:red\">no app</span>":"<span style=\"color:green\">app</span>";
  $bodyTable .= "
  <tr>
    <td>{$datei}</td>
    <td>{$v['req_detail_id']}</td>
    <td>{$v['Quota_id']}</td>
    <td>{$v['Quota_name']}</td>
    <td>&nbsp;&nbsp;&nbsp;{$v['Quota_ket']}</td>
    <td>{$v['Quota_place']}</td>
    <td>{$v['Product_name']}</td>
    <td>&nbsp;{$status}</td>
    <td>&nbsp;{$v['Product_amount']}</td>
 </tr>";
}
$output = $output.$bodyTable.'</tbody><tfoot style=\"font-size:18px\">
<tr><td align="left" colspan="9"> 
<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;(_______________________________)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(_______________________________)<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้จัดทำ
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้อนุมัติ 
</td></tr></tfoot></table>';

// Write some HTML code:
$mpdf->WriteHTML($output);

// Output a PDF file directly to the browser
$mpdf->Output();
?>