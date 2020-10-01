<!-- Edit -->

<div class="modal fade" id="edit_<?php echo $row['req_detail_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">แก้ไขรายการขอซื้อสินค้า</h4>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="req_detail_edit.php">
				 <input type="hidden" class="form-control" name="comp_code" value="<?php echo $comp_code ?>">
				 <input type="hidden" class="form-control" name="req_detail_id" value="<?php echo $row['req_detail_id']; ?>" >
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">เลขที่:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control"  value="<?php echo $row['req_detail_id']; ?>" disabled>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">โควต้า:</label>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="quota_id" value="<?php echo $row['Quota_id']; ?>">
					</div>
				
					<div class="col-sm-2">
						<label class="control-label modal-label">ชื่อ-สกุล:</label>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="quota_name" value="<?php echo $row['Quota_name']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">เขต:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="quota_ket" value="<?php echo $row['Quota_ket']; ?>">
					</div>
				</div>				
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">ที่อยู่จัดส่ง:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="quota_place" value="<?php echo $row['Quota_place']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">ชื่อสินค้า:</label>
					</div>
					<div class="col-sm-10">
					<select class="form-control" name="product_code">
					<!--<input type="text" class="form-control" name="product_name" value="<?php echo $row['Product_name']; ?>">-->
				    <!-- <option value="" selected> title </option> --->
					<?php
					   $product=$row['Product_name'];
                       $sql9="select Product_code,Product_name from product";
                       $res9=mysqli_query($conn,$sql9);
                       while($rowx=mysqli_fetch_array($res9)){
                    ?>
                        <option value="<?php echo $rowx['Product_code']?>"  <?php if($rowx['Product_name']==$product){ echo " selected";}?>  >  
						  <?php echo $rowx['Product_name']?>
						</option>
                    <?php }
                    ?>
                    </select>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">จำนวน:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_amount" value="<?php echo $row['Product_amount']; ?>">
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['req_detail_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <center><h4 class="modal-title" id="myModalLabel">Delete REQ_DETAIL</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h2 class="text-center"><?php echo 'เลขที่ใบขอซ์้อ '.$row['req_detail_id'] ?></h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="req_detail_delete.php?req_detail_id=<?php echo $row['req_detail_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>