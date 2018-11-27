<?php $db = mysqli_connect(HOST,USER,PASS,DB); ?>
<script> function account(id) { window.location = "<?php echo base_url();?>super_admin/shoppingrequest/index/" + id; } </script>
<div class="content-wrapper">
                <nav id="toolbar" class="bg-white">
                    <div class="row no-gutters align-items-center flex-nowrap">
                        <div class="col">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <button type="button" class="toggle-aside-button btn btn-icon d-block d-lg-none" data-fuse-bar-toggle="aside">
                                    <i class="icon icon-menu"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="row no-gutters align-items-center justify-content-end">
                                <button type="button" class="quick-panel-button btn btn-icon" data-fuse-bar-toggle="quick-panel-sidebar">
                                        <div class="avatar-wrapper">
                                            <img class="avatar" src="../images/avatars/profile.jpg">
                                        </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="content custom-scrollbar">
                    <div id="e-commerce-products" class="page-layout carded full-width">
                        <div class="top-bg bg-secondary"></div>
                        <div class="page-content-wrapper">
                            <div class="page-header light-fg row no-gutters align-items-center justify-content-between">
                                <div class="col-12 col-sm">
                                    <div class="logo row no-gutters justify-content-center align-items-start justify-content-sm-start">
                                        <div class="logo-icon mr-3 mt-1">
                                            <i class="fa fa-2x fa-cubes"></i>
                                        </div>
                                        <div class="logo-text">
                                            <div class="h4">Shopping Order Request list</div>
                                            <div class="">Shopping Order Request list: <?php echo count($records); ?></div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col search-wrapper px-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-icon">
                                                    <i class="fa fa-2x fa-search"></i>
                                                </button>
                                            </span>
                                            
                                            <select class="form-control pull-left" style="width: 20%;margin: 0 2%;" onchange="account(this.value)">
                                                <option value=" " <?php if (isset($id) && $id == ' ') echo "selected";?>>Pending</option>
                                                <option value="0" <?php if (isset($id) && $id == '0') echo "selected";?>>Declined</option>
                                                <option value="1"<?php if (isset($id) && $id == '1') echo "selected"; ?>>Accepted</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="page-content-card">
                            <table id="sample-data-table" class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Id</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Referral</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Username</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Product_id</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Amount</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">GST</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Request Time</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Status</span>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($records as $r) { ?>
                                                                <tr>
                                                                <td><?php echo $r['pay_id']; ?></td>
                                                                <td><a class="btn btn-default" data-toggle="modal" onclick="referralData(<?php echo $r['user_id']; ?>)" data-target="#referral"><li class="fa fa-list"></li></a></td>
                                                                <?php $u=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM tbl_users WHERE user_id='".$r['user_id']."'"))?>
                                                                <td data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo $u['username']; ?></td>
                                                                <td data-toggle="modal" onclick="viewOrderDetails(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $r['shopping_id']; ?></td>
                                                                <td data-toggle="modal" onclick="viewOrderDetails(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $r['amount']; ?></td>
                                                                <?php $gst = $r['amount']-($r['amount']*45/100);  ?>
                                                                <td data-toggle="modal" onclick="viewOrderDetails(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $gst; ?></td>
                                                                <td data-toggle="modal" onclick="viewOrderDetails(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo date('j, M Y', strtotime($r['req_date'])); ?></td>
                                                                <td>
                                                                    <?php
                                                                    if($r['payStatus'] == '2') { ?>
                                                                        <button onclick="payReqStatus(<?php echo $r['pay_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['pay_id'];?>" class="btn btn-secondary fa fa-check"></button>
                                                                        <button onclick="payReqStatus(<?php echo $r['pay_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['pay_id'];?>" class="btn btn-danger fa fa-times"></button>
                                                                        <button class="btn btn-secondary" onclick="payReqStatus(<?php echo $r['pay_id'].','.'2'.','.$r['user_id'].','.'0';?>)" style="display:none" id="<?php echo 'accept'.$r['pay_id'];?>">Accepted</button>
                                                                        <button class="btn btn-danger" onclick="payReqStatus(<?php echo $r['pay_id'].','.'2'.','.$r['user_id'].','.$r['amount']; ?>)" style="display:none" id="<?php echo 'decline'.$r['pay_id'];?>">Declined</button>
                                                                    <?php } else if($r['payStatus'] == '1') { ?>
                                                                        <button style="display: none" onclick="payReqStatus(<?php echo $r['pay_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['pay_id'];?>" class="btn btn-secondary fa fa-check"></button>
                                                                        <button style="display: none" onclick="payReqStatus(<?php echo $r['pay_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['pay_id'];?>" class="btn btn-danger fa fa-times"></button>
                                                                        <button class="btn btn-secondary" onclick="payReqStatus(<?php echo $r['pay_id'].','.'2'.','.$r['user_id'].','.'0';?>)" id="<?php echo 'accept'.$r['pay_id'];?>">Accepted</button>
                                                                    <?php } else { ?>
                                                                        <button style="display: none" onclick="payReqStatus(<?php echo $r['pay_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['pay_id'];?>" class="btn btn-secondary fa fa-check"></button>
                                                                        <button style="display: none" onclick="payReqStatus(<?php echo $r['pay_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['pay_id'];?>" class="btn btn-danger fa fa-times"></button>
                                                                        <button class="btn btn-danger" onclick="payReqStatus(<?php echo $r['pay_id'].','.'2'.','.$r['user_id'].','.$r['amount']; ?>)" id="<?php echo 'decline'.$r['pay_id'];?>">Declined</button>
                                                                    <?php } ?>
                                                                </td>
                                                                </tr><?php } ?>
                                                               

                                                            </tbody>
                                                        </table>

                                                        <script type="text/javascript">
                                                            $('#sample-data-table').DataTable({
                                                                dom       : '<lf<t>ip>'
                                                            });
                                                        </script>
                            </div>
                        </div>
                        <!-- / CONTENT -->
                    </div>

                    <script type="text/javascript" src="<?php echo URL;?>js/apps/e-commerce/products/products.js"></script>

                </div>
</div>

    <div id="profile" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User Profile</h4>
                </div>
                <div class="modal-body" id="resData" style="padding: 0px"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="referral" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Under Referral</h4>
                </div>
                <div class="modal-body" id="return_data" style="padding: 0px"></div>

            </div>
        </div>
    </div>

    <div id="barcode" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Barcode</h4>
                </div>
                <div class="modal-body" id="barcodeImg" style="padding: 0px"></div>
            </div>
        </div>
    </div>
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#shopp_request a").addClass('active');
    });

    function viewOrderDetails(pay_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/shoppingrequest/viewOrderDetails');?>',
            data: 'pay_id='+pay_id,
            success: function(data) {
                $('#barcodeImg').html(data)
            }
        });
    }

    function userData(user_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/users/userProfile');?>',
            data: 'user_id='+user_id,
            success: function(data) {
                $('#resData').html(data)
            }
        });
    }

    function updateBal(user_id,val) {
        if (confirm("Are you sure want to update ?")) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/users/updateBal');?>',
                data: {user_id: user_id, val}
            });
        }
    }

    function referralData(user_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/users/referralData');?>',
            data: 'user_id='+user_id,
            success: function(data) {
                $('#return_data').html(data)
            }
        });
    }

    function activeDe_active_dilog(user_id,val) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/users/active_deactive');?>',
            data: {user_id : user_id, val },
            success: function(data) {
                if(data == 1) {
                    document.getElementById('dcid').style.display = 'none';
                    document.getElementById('acid').style.display = '';
                }else{
                    document.getElementById('acid').style.display = 'none';
                    document.getElementById('dcid').style.display = '';
                }
            }
        });
    }


    function payReqStatus(id,val,uId,amnt) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/shoppingrequest/active_deactive');?>',
            data: {id : id, val, uId, amnt },
            success: function(data) {
                if(data == 1) {
                    document.getElementById('pa'+id).style.display = 'none';
                    document.getElementById('pd'+id).style.display = 'none';
                    document.getElementById('accept'+id).style.display = '';
                }else if(data == 0){
                    document.getElementById('pa'+id).style.display = 'none';
                    document.getElementById('pd'+id).style.display = 'none';
                    document.getElementById('decline'+id).style.display = '';
                }else{
                    if(amnt == 0){
                        document.getElementById('accept'+id).style.display = 'none';
                    }else{
                        document.getElementById('decline'+id).style.display = 'none';
                    }
                    document.getElementById('pa'+id).style.display = '';
                    document.getElementById('pd'+id).style.display = '';
                }
            }
        });
    }
</script>