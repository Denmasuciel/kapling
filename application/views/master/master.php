<style>
    .datepicker {
      z-index: 1151 !important; /* has to be larger than 1050 */
    }
</style>

<script type="text/javascript">
var url;
var save_method; //for save method string
var table;

$(document).ready(function() {	
$('.date-picker').datepicker({
autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

 $(".angka").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
     return false;
    }
   });
   	
});		

function add_user()
{
	save_method = 'add';
    $('#form_user')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_user').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah data user'); // Set Title to Bootstrap modal title
	}
function add_bidang()
{
	save_method = 'add';
    $('#form_bidang')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_bidang').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title
	}	

function add_rr()
{
	save_method = 'add';
    $('#form_rr')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_rr').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title
	}	

	//FUNGSI EDIT
function edit_user(id)
{
    save_method = 'update';
    $('#form_user')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('master/ajax_edit_user/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_user"]').val(data.id_user);
            $('[name="username"]').val(data.username);
            $('[name="nama_lengkap"]').val(data.nama_lengkap);
   		    $('[name="level"]').val(data.level);
           	$('[name="id_bidang"]').val(data.id_bidang);
           	$('#modal_user').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data User'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function edit_bidang(id)
{
    save_method = 'update';
    $('#form_bidang')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('master/ajax_edit_bidang/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_bidang"]').val(data.id_bidang);
            $('[name="nama_bidang"]').val(data.bidang);
           	$('#modal_bidang').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Bidang'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function edit_rr(id)
{
    save_method = 'update';
    $('#form_rr')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('master/ajax_edit_rr/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_rr"]').val(data.id_rr);
            $('[name="nama_rr"]').val(data.nama_rr);
           	$('#modal_rr').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data R.Rapat'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//FUNGSI SAVE
function save_user()
{
var username	=$('#username').val();
		var nama_lengkap= $("#nama_lengkap").val();
		var level 	= $('#level').val();
		var id_bidang 	= $("#id_bidang").val();
		
		if(username == ''){
			alert("Maaf, Username tidak boleh kosong");
			$('#username').focus();
				return false;
		}
		if(nama_lengkap == ''){
			alert("Maaf, Nama lengkap tidak boleh kosong");
			$('#nama_lengkap').focus();
				return false;
		}
		if(level == ''){
			alert("Maaf, Level tidak boleh kosong");
			$('#level').focus();
				return false;
		}
		if(id_bidang == ''){
			alert("Maaf, Bidang tidak boleh kosong");
			$('#id_bidang').focus();
				return false;
		}
		
  
	$('#btn_user').text('saving...'); //change button text
    $('#btn_user').attr('disabled',true); //set button disable 
		  
	if(save_method == 'add') {
        url = "<?php echo site_url('master/ajax_add_user')?>";
    } else {
         url = "<?php echo site_url('master/ajax_update_user')?>";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_user').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_user').modal('hide');
				$.messager.show({
							title: 'INFO',
							msg: 'Sukses simpan data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
				reload_user();
            }
            $('#btn_user').text('save'); //change button text
            $('#btn_user').attr('disabled',false); //set button enable 
      },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error adding / update data');
           $.messager.show({
							title: 'ERROR',
							msg: 'gagal simpan data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						}); 		
			$('#btn_user').text('save'); //change button text
            $('#btn_user').attr('disabled',false); //set button enable 
            $('#modal_user').modal('hide');
			reload_user();
        }
    });
}
function save_bidang()
{
        var bid   = $("#nama_bidang").val();
        
        if(bid == ''){
            alert("Maaf, Nama Bidang tidak boleh kosong");
            $('#nama_bidang').focus();
                return false;
        }
		
		  
	$('#btn_bidang').text('saving...'); //change button text
    $('#btn_bidang').attr('disabled',true); //set button disable 
    
	if(save_method == 'add') {
        url = "<?php echo site_url('master/ajax_add_bidang')?>";
    } else {
         url = "<?php echo site_url('master/ajax_update_bidang')?>";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_bidang').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_bidang').modal('hide');
				$.messager.show({
							title: 'INFO',
							msg: 'Sukses simpan data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
				reload_bidang();
            }
            $('#btn_bidang').text('save'); //change button text
            $('#btn_bidang').attr('disabled',false); //set button enable 
      },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error adding / update data');
           $.messager.show({
							title: 'ERROR',
							msg: 'gagal simpan data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						}); 		
			$('#btn_bidang').text('save'); //change button text
            $('#btn_bidang').attr('disabled',false); //set button enable 
            $('#modal_bidang').modal('hide');
			reload_bidang();
        }
    });
}
function save_rr()
{
	var nama_rr	=$('#nama_rr').val();
		if(nama_rr == ''){
			alert("Maaf, Nama Ruang tidak boleh kosong");
			$('#nama_rr').focus();
				return false;
		}
		
  
	$('#btn_rr').text('saving...'); //change button text
    $('#btn_rr').attr('disabled',true); //set button disable 
    
	if(save_method == 'add') {
        url = "<?php echo site_url('master/ajax_add_rr')?>";
    } else {
         url = "<?php echo site_url('master/ajax_update_rr')?>";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_rr').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_rr').modal('hide');
				$.messager.show({
							title: 'INFO',
							msg: 'Sukses simpan data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
				reload_rr();
            }
            $('#btn_rr').text('save'); //change button text
            $('#btn_rr').attr('disabled',false); //set button enable 
      },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error adding / update data');
           $.messager.show({
							title: 'ERROR',
							msg: 'gagal simpan data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						}); 		
			$('#btn_rr').text('save'); //change button text
            $('#btn_rr').attr('disabled',false); //set button enable 
            $('#modal_rr').modal('hide');
			reload_rr();
        }
    });
}


//DEL
function delete_user(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('master/ajax_delete_user')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
				$.messager.show({
							title: 'Info',
							msg: 'Data berhasil dihapus',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
                $('#modal_user').modal('hide');
				reload_user();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
             $.messager.show({
							title: 'ERROR',
							msg: 'gagal hapus data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
			reload_user();
            }
        });

    }
}

function delete_bidang(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('master/ajax_delete_bidang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
				$.messager.show({
							title: 'Info',
							msg: 'Data berhasil dihapus',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
                $('#modal_bidang').modal('hide');
				reload_bidang();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
             $.messager.show({
							title: 'ERROR',
							msg: 'gagal hapus data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
			reload_bidang();
            }
        });

    }
}
function delete_rr(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('master/ajax_delete_rr')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
				$.messager.show({
							title: 'Info',
							msg: 'Data berhasil dihapus',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
                $('#modal_rr').modal('hide');
				reload_rr();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
             $.messager.show({
							title: 'ERROR',
							msg: 'gagal hapus data',
							timeout:2000,
							showType:'slide',
							style:{
					left:'',
					right:0,
					bottom:''
				}
						});
			reload_rr();
            }
        });

    }
}

</script>

<!-- PAGE CONTENT BEGINS -->
<div class="row">							
		<!-- tab dalam konten periode -->
                <div class="tabbable ">
               		<ul class="nav nav-tabs padding-12  background-blue " id="tabfile">
					<li class="active">
					<a data-toggle="tab" href="#user" onclick="reload_user()">
					<i class="pink ace-icon glyphicon glyphicon-user bigger-110"></i>Master User</a></li>

					<li>
					<a data-toggle="tab" href="#bidang" onclick="reload_bidang()">
					<i class="blue ace-icon fa fa-laptop bigger-110"></i>Master Bidang</a></li>
					
                    <li>
					<a data-toggle="tab" href="#jabatan" onclick="reload_rr()">
					<i class="red ace-icon fa fa-briefcase bigger-110"></i>	Master R.Rapat</a></li>
                    
                    </ul>


					<div class="tab-content">     <!-- konten periode -->
                        <!-- user -->
						<div id="user" class="tab-pane in active">
							<div class="row">
								<div class="col-xs-12">     
 							       	<div class="form-group ">	                                    
                            		<div class=" col-xs-12 col-sm-reset inline"> 
                            		<button class="btn btn-sm btn-success" id="" onClick="add_user()"><i class="glyphicon glyphicon-plus"></i> Tambah Data </button>
   	       <button class="btn btn-sm btn-default" onClick="reload_user()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            		</div>
							    	</div>
                             	</div>
                                <div class="col-xs-12">                                
        						<div class="table-header">
								Data master User										
            					</div>
								<table id="dataTables-user" class="table table-striped table-bordered table-hover"  width="100%"  >
              					<thead>
             							<tr>
                   						<th width="20px" >No</th>
										<th class="text-center">Username</th>
                    					<th class="text-center">Password</th>
                    					<th class="text-center">Nama Lengkap</th>
                    					<th class="text-center">Level</th>
                    					<th class="text-center">Aksi</th>
                    					</tr>
 		            			</thead>
        		    			<tbody>
             					</tbody>
          						</table>
			                </div>
                            </div>
						</div><!-- akhir -->                            
                        <!-- bidang -->
						<div id="bidang" class="tab-pane">
							<div class="row">
								<div class="col-xs-12">     
 							       	<div class="form-group ">                                    
                            		<div class=" col-xs-12 col-sm-reset inline"> 
                            		<button class="btn btn-sm btn-success" id="" onClick="add_bidang()"><i class="glyphicon glyphicon-plus"></i> Tambah Data </button>
   	       <button class="btn btn-sm btn-default" onClick="reload_bidang()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            		</div>
							    	</div>
                             	</div>
                             
                             <div class="col-xs-12">                                
        						<div class="table-header">
								Master data bidang										
            					</div>
								<table id="dataTables-bidang" class="table table-striped table-bordered table-hover" width="100%"  >
              					<thead>
             							<tr>
                   						<th width="20px" >No</th>
										<th class="text-center">Nama Bidang</th>
                    					<th class="text-center">Aksi</th>
                    					</tr>
 		            			</thead>
        		    			<tbody>
             					</tbody>
          						</table>			                	
                            </div>                            
                            </div>                           
						</div><!-- akhir  -->                        
                        <!-- jabatan -->
						<div id="jabatan" class="tab-pane">
							<div class="row">
							<div class="col-xs-12">     
 							       	<div class="form-group ">	
                                    <div class=" col-xs-12 col-sm-reset inline"> 
                            		<button class="btn btn-sm btn-success" id="" onClick="add_rr()"><i class="glyphicon glyphicon-plus"></i> Tambah Data  </button>
   	      <button class="btn btn-sm btn-default" onClick="reload_rr()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            		</div>
							    	</div>
                             	</div> 
                             <div class="col-xs-12">     					                                                       
        						<div class="table-header">
								Master data R.Rapat										
            					</div>
								<table id="dataTables-rr" class="table table-striped table-bordered table-hover" width="100%"  >
              					<thead>
             							<tr>
                   						<th width="20px" >No</th>
										<th class="text-center">Nama R.Rapat</th>
                    					<th class="text-center">Aksi</th>
                    					</tr>
 		            			</thead>
        		    			<tbody>
             					</tbody>
          						</table>
			                </div>
                            </div>                           
						</div><!-- akhir AL -->                      
        </div>   
</div>
	
    

<!-- Bootstrap modal user -->
<div class="modal fade" id="modal_user" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  ">
           	<button type="button" class="close " data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            <h3 class="modal-title">Kelola User</h3>
            </div>
            <div class="modal-body ">
                <form action="#" id="form_user" class="form-horizontal"  >
                    <input type="hidden" value="" name="id_user"/>                           	                       
                         	<div class="form-group">
                            <label class="control-label col-md-3">Username</label>
                           	<div class="col-md-9">
                            <input type="text" name="username" id="username"  placeholder="" class="form-control ">
                            </div>
                        	</div>
                            
                            <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                           	<div class="col-sm-5">
                            <input type="password"  name="password" id="password"  placeholder="" class="form-control ">
                            </div>
                        	</div>
                            
                            <div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
                           	<div class="col-md-9">
                            <input type="text" name="nama_lengkap" id="nama_lengkap"  placeholder="" class="form-control ">
                            </div>
                        	</div>
                                                  	
                            
                            <div class="form-group">
                            <label class="control-label col-md-3">Level</label>
                            <div class="col-sm-5">
                          	<select class="form-control" name="level" id="level" required>
							<option value="user" selected="selected" >User Bidang</option>
							<option value="admin">Admin</option>
							</select>
                            </div>
                        	</div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Bidang</label>
                                <div class="col-md-6">
                                    <select name="id_bidang" class="form-control">
                                        <?php
                                        foreach($bidang ->result() as $t){                                            ?>
                                        <option value="<?php echo $t->id_bidang;?>"><?php echo $t->bidang;?></option>
                                        <?php } ?></select>
                                    </div>
                            </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_user" onclick="save_user()"  class="btn btn-white btn-default btn-round"><i class="ace-icon fa fa-floppy-o red"></i>Save</button>
                <button type="button" class="btn btn-white btn-default btn-round" data-dismiss="modal"><i class="ace-icon fa fa-times red2"></i>Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap modal bidang -->
<div class="modal fade" id="modal_bidang" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  ">
           	<button type="button" class="close " data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            <h3 class="modal-title">Kelola Bidang</h3>
            </div>
            <div class="modal-body ">
                <form action="#" id="form_bidang" class="form-horizontal"  >
                    <input type="hidden" value="" name="id_bidang"/>                           	                       
                         	<div class="form-group">
                            <label class="control-label col-md-3">Bidang</label>
                           	<div class="col-md-9">
                            <input type="text" name="nama_bidang" id="nama_bidang"  placeholder="" class="form-control ">
                            </div>
                        	</div>                                                           
                      </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_bidang" onclick="save_bidang()"  class="btn btn-white btn-default btn-round"><i class="ace-icon fa fa-floppy-o red"></i>Save</button>
                <button type="button" class="btn btn-white btn-default btn-round" data-dismiss="modal"><i class="ace-icon fa fa-times red2"></i>Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<!-- Bootstrap modal rr -->
<div class="modal fade" id="modal_rr" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  ">
           	<button type="button" class="close " data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            <h3 class="modal-title">Kelola R.Rapat</h3>
            </div>
            <div class="modal-body ">
                <form action="#" id="form_rr" class="form-horizontal"  >
                    <input type="hidden" value="" name="id_rr"/>                           	                       
                         	<div class="form-group">
                            <label class="control-label col-md-3">Nama R.Rapat</label>
                           	<div class="col-md-9">
                            <input type="text" name="nama_rr" id="nama_rr"  placeholder="" class="form-control ">
                            </div>
                        	</div>                                                           
                      </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_rr" onclick="save_rr()"  class="btn btn-white btn-default btn-round"><i class="ace-icon fa fa-floppy-o red"></i>Save</button>
                <button type="button" class="btn btn-white btn-default btn-round" data-dismiss="modal"><i class="ace-icon fa fa-times red2"></i>Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

          
<script type="text/javascript">
function reload_user()
{
$('#dataTables-user').dataTable().fnDestroy();
tabel_user();
}

function reload_bidang()
{
$('#dataTables-bidang').dataTable().fnDestroy();
tabel_bidang();
}


function reload_rr()
{
$('#dataTables-rr').dataTable().fnDestroy();
tabel_rr();
}

	function tabel_user(){
  	$('#dataTables-user').DataTable( {
                        "bProcessing"   : true,
						"scrollY"       :  350,
        				"scrollCollapse": true,
						"sAjaxSource"   : "<?php echo site_url('master/view_user');?>",
                        "aoColumns": [
							{ "mData": "no" },
                           	{ "mData": "username" },
                            { "mData": "password" },
                           	{ "mData": "nama_lengkap" },
                     	 	{ "mData": "level" },
                          		{ "mData": "hapus" }
                        			]
								});
						};
	
	function tabel_bidang(){
  	$('#dataTables-bidang').DataTable( {
                        "bProcessing"   : true,
						"scrollY"       :  350,
        				"scrollCollapse": true,
						"sAjaxSource"   : "<?php echo site_url('master/view_bidang');?>",
                        "aoColumns": [
							{ "mData": "no" },
                           { "mData": "bidang" },
                          		{ "mData": "hapus" }
                        			]
								});
						};
	
	function tabel_rr(){
  	$('#dataTables-rr').DataTable( {
                        "bProcessing"   : true,
						"scrollY"       :  350,
        				"scrollCollapse": true,
						"sAjaxSource"   : "<?php echo site_url('master/view_rr');?>",
                        "aoColumns": [
							{ "mData": "no" },
                           	{ "mData": "nama_rr" },
                          	{ "mData": "hapus" }
                        			]
								});
						};
	

$(document).ready(function() {
tabel_user();
 //$('#dataTables-user').DataTable();
 $('#dataTables-bidang').DataTable();
 $('#dataTables-rr').DataTable();
 
 $('INPUT[type="file"]').change(function () {//Fungsi untuk membatasi type file jpg|png|gif|pdf
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'sql':
            //$('#uploadButton').attr('disabled', false);
            break;
        default:
            alert('Type file tidak diperbolehkan.');
            this.value = '';
    }
});


});
</script>



