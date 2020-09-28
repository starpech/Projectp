<?php
//print_invoice.php

 require_once 'pdf.php';
 $output = '';
 /*
 include('database_connection.php');
 $output = '';
 $statement = $connect->prepare("
  SELECT * FROM tbl_order 
  WHERE order_id = :order_id
  LIMIT 1
 ");
 $statement->execute(
  array(
   ':order_id'       =>  $_GET["id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '
   <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
     <td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
    </tr>
    <tr>
     <td colspan="2">
      <table width="100%" cellpadding="5">
       <tr>
        <td width="65%">
         To,<br />
         <b>RECEIVER (BILL TO)</b><br />
         Name : '.$row["order_receiver_name"].'<br /> 
         Billing Address : '.$row["order_receiver_address"].'<br />
        </td>
        <td width="35%">
         Reverse Charge<br />
         Invoice No. : '.$row["order_no"].'<br />
         Invoice Date : '.$row["order_date"].'<br />
        </td>
       </tr>
      </table>
      <br />
      <table width="100%" border="1" cellpadding="5" cellspacing="0">
       <tr>
        <th>Sr No.</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Actual Amt.</th>
        <th colspan="2">Tax1 (%)</th>
        <th colspan="2">Tax2 (%)</th>
        <th colspan="2">Tax3 (%)</th>
        <th rowspan="2">Total</th>
       </tr>
       <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Rate</th>
        <th>Amt.</th>
        <th>Rate</th>
        <th>Amt.</th>
        <th>Rate</th>
        <th>Amt.</th>
       </tr>';
  $statement = $connect->prepare(
   "SELECT * FROM tbl_order_item 
   WHERE order_id = :order_id"
  );
  $statement->execute(
   array(
    ':order_id'       =>  $_GET["id"]
   )
  );
  $item_result = $statement->fetchAll();
  $count = 0;
  foreach($item_result as $sub_row)
  {
   $count++;
   $output .= '
   <tr>
    <td>'.$count.'</td>
    <td>'.$sub_row["item_name"].'</td>
    <td>'.$sub_row["order_item_quantity"].'</td>
    <td>'.$sub_row["order_item_price"].'</td>
    <td>'.$sub_row["order_item_actual_amount"].'</td>
    <td>'.$sub_row["order_item_tax1_rate"].'</td>
    <td>'.$sub_row["order_item_tax1_amount"].'</td>
    <td>'.$sub_row["order_item_tax2_rate"].'</td>
    <td>'.$sub_row["order_item_tax2_amount"].'</td>
    <td>'.$sub_row["order_item_tax3_rate"].'</td>
    <td>'.$sub_row["order_item_tax3_amount"].'</td>
    <td>'.$sub_row["order_item_final_amount"].'</td>
   </tr>
   ';
  }
  $output .= '
  <tr>
   <td align="right" colspan="11"><b>Total</b></td>
   <td align="right"><b>'.$row["order_total_after_tax"].'</b></td>
  </tr>
  <tr>
   <td colspan="11"><b>Total Amt. Before Tax :</b></td>
   <td align="right">'.$row["order_total_before_tax"].'</td>
  </tr>
  <tr>
   <td colspan="11">Add : Tax1 :</td>
   <td align="right">'.$row["order_total_tax1"].'</td>
  </tr>
  <tr>
   <td colspan="11">Add : Tax2 :</td>
   <td align="right">'.$row["order_total_tax2"].'</td>
  </tr>
  <tr>
   <td colspan="11">Add : Tax3 :</td>
   <td align="right">'.$row["order_total_tax3"].'</td>
  </tr>
  <tr>
   <td colspan="11"><b>Total Tax Amt.  :</b></td>
   <td align="right">'.$row["order_total_tax"].'</td>
  </tr>
  <tr>
   <td colspan="11"><b>Total Amt. After Tax :</b></td>
   <td align="right">'.$row["order_total_after_tax"].'</td>
  </tr>
  
  ';
  $output .= '
      </table>
     </td>
    </tr>
   </table>
  ';
 }
 */

$output .= '
<table width="100%" border="0" cellpadding="5" cellspacing="0">
 <tr>
  <td colspan="2" align="center" style="font-size:18px">
  
     <b>บริษัท เคเอสแอล แมททีเรียล ซัพพลายส์ จำกัด</b><br>
     ใบจัดส่งสินค้า
  </td>
 </tr>
 <tr>
  <td colspan="2">
   <table width="100%" cellpadding="5">
    <tr>
     <td width="65%">
     วันที่ส่งสินค้า 00/00/000<br>
     เลขที่ใบสั่งซื้อสินค้า  0000000000 , 00000000000
     </td>
     <td width="35%">
     เลขที่สัญญา<br />
      เลที่คำสั่งขาย : xxx<br />
      เลขที D/O : xxx <br />
     </td>
    </tr>
   </table>
   <br>
   <table width="100%" cellpadding="5">
   <tr>
    <td width="20%" valign="top">
   รsัสลูกค้า 00000000000
    </td>
    <td width="40%" valign="top">
    สถานที่วางบิล<br>
    <pre>
    sdfasdfasfasdf
    asfsdafsdsafd
    asdfasdfasdfsadf
    asdfsadf
    </pre>
    </td>
    <td width="40%" valign="top">
    สถานที่ส่งสินค้า<br>
    <pre>
    sdfasdfasfasdf
    asfsdafsdsafd
    asdfasdfasdfsadf
    asdfsadf
    </pre>
    </td>
   </tr>
  </table>
  <br>
  <table width="100%" cellpadding="5">
  <tr>
   <td width="25%" valign="top">
 ประเภทการจัดส่ง : 
   </td>
   <td width="25%" valign="top">
   ค่าระหว่าง : EXW
   </td>
   <td width="25%" valign="top">
   เงื่อนไขการชำระเงิน : R030
   </td>
   <td width="25%" valign="top">
   สกุลเงิน : THB
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
     <th>ราคาต่อหน่วย</th>
     <th>จำนวนเงิน</th>
       </tr>
    ';


    $output .=  '<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
      </tr>';


$output .= '
   </table>

   <table width="100%" cellpadding="5">
   <tr>
    <td width="25%" valign="top">
  หมายเหตุ : 
    </td>
    <td width="75%" valign="top">
  6304/001<br>
  Exchange rate 1.000    </td> 
    </tr></table>



  </td>
 </tr>
</table>
';


 $pdf = new Pdf();
 $file_name = 'Invoice-0001.pdf';
 $pdf->loadHtml($output);
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));


 //echo $output;

?>