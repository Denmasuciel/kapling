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
});		

function add_kapling()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Kapling Ruang Rapat'); // Set Title to Bootstrap modal title
	$(".date-picker").datepicker("setDate", new Date());
}

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('kapling/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_kapling"]').val(data.id_kapling);
            $('[name="tanggal"]').datepicker('update',data.tanggal);
            $('[name="jam"]').val(data.jam);
            $('[name="acara"]').val(data.acara);
            $('[name="id_rr"]').val(data.id_rr);
            $('[name="id_bidang"]').val(data.id_bidang);
			$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kapling RR'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
		//var tanggal	= $("#tanggal").val();
		var jam= $("#jam").val();
		var acara 	= $("#acara").val();
		/*if(tanggal.length==0){
			alert("Maaf, tanggal tidak boleh kosong");
			$('#tanggal').focus()
			return false;
		}*/
		if(jam.length==0){
			alert("Maaf, jam tidak boleh kosong");
			$('#jam').focus()
			return false;
		}
		if(acara.length==0){
			alert("Maaf, acara tidak boleh kosong");
			$('#acara').focus()
			return false;
		}

    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    
	if(save_method == 'add') {
        url = "<?php echo site_url('kapling/ajax_add')?>";
    } else {
         url = "<?php echo site_url('kapling/ajax_update')?>";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
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
				reload_table2();
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
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
			$('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            $('#modal_form').modal('hide');
			reload_table2();
        }
    });
}

function delete_person(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('kapling/ajax_delete')?>/"+id,
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
                $('#modal_form').modal('hide');
				reload_table();
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
			reload_table();
            }
        });

    }
}

</script>
<!-- PAGE CONTENT BEGINS -->
<div class="row">							
	<div class="tabbable">
		<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
			<li class="active">
			<a data-toggle="tab" href="#home4" onclick="reload_table()">Daftar Pemakaian RR</a>	
            </li>
            
            <li >
			<a data-toggle="tab" href="#profile4" onclick="reload_table2()">Kapling Ruangan</a>	
            </li>
		</ul>

		<div class="tab-content">
			<div id="home4" class="tab-pane in active">            
            <p>   
            <button class="btn btn-sm btn-default" onClick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
			</p>
 				<div class="row">
					<div class="col-xs-12">
	        			<div class="table-header ">
						Data Kapling Ruang Rapat Hingga 2 Minggu Kedepan										
            			</div>
					<div>
					<table id="dataTables-1" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0" >
             		<thead>
             		<tr>
                    <th width="20px" >No</th>
					<th class="text-center">Tanggal</th>
                    <th class="text-center">Jam</th>
                    <th class="text-center">Acara</th>
                    <th class="text-center">Ruang Rapat</th>
					<th class="span1 text-center">Bidang</th>
                    <th class="span1 text-center">Waktu Kapling</th>
                    </tr>
 		            </thead>
        		    <tbody>
             		</tbody>
          			</table>       
					</div>
    				</div>
				</div>
          </div>

			<div id="profile4" class="tab-pane">
				 <p><button class="btn btn-sm btn-success" id="tambah" onClick="add_kapling()"><i class="glyphicon glyphicon-plus"></i> Kapling RR </button>
   				<button class="btn btn-sm btn-default" onClick="reload_table2()"><i class="glyphicon glyphicon-refresh"></i> Reload</button></p>
                <div class="row">
					<div class="col-xs-12">
	        			<div class="table-header ">
						Data Kapling Ruang Rapat Hingga 2 Minggu Kedepan										
            			</div>
					<div>
					<table id="dataTables-2" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0" >
             		<thead>
             		<tr>
                    <th width="20px" >No</th>
					<th class="text-center">Tanggal</th>
                    <th class="text-center">Jam</th>
                    <th class="text-center">Acara</th>
                    <th class="text-center">Ruang Rapat</th>
					<th class="span1 text-center">Bidang</th>
					 <th class="span1 text-center">Waktu Kapling</th>
                  <th class="span1 text-center">Aksi</th>
                    </tr>
 		            </thead>
        		    <tbody>
             		</tbody>
          			</table>       
					</div>
    				</div>
				</div>
			</div>
                										
		</div>					
</div></div>
	

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Kapling Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    	<input type="hidden" value="" name="id_kapling"/>
                        <div class="form-group">
                            <label class="control-label col-sm-3 ">Tanggal</label>
                           <div class="col-sm-9">
                          <input name="tanggal" id="tanggal" placeholder="yyyy-mm-dd"  style="text-align:right" class=" col-xs-4 date-picker" type="text">
                            </div>
                        </div>
                                                                            
                         <div class="form-group">
                            <label class="control-label col-md-3">Jam</label>
                                <div class="col-sm-9">
                           <input type="text" name="jam" id="jam" placeholder="Jam penggunaan RR" class="form-control">
                              </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="control-label col-md-3">Acara</label>
                           <div class="col-md-9">
                                <input type="text" name="acara" id="acara" placeholder="Acara" class="form-control">
                            </div>
                        </div>
                         
                         <div class="form-group">
                            <label class="control-label col-md-3">Ruang Rapat</label>
                           <div class="col-md-6">
                               <select name="id_rr" class="form-control">
    							<?php
								foreach($rr->result() as $t){
								?>
    							<option value="<?php echo $t->id_rr;?>"><?php echo $t->nama_rr;?></option>
    							<?php } ?>
    							</select>
							</div>
                        </div>
                        
                         <div class="form-group">
                            <label class="control-label col-md-3">Bidang</label>
                            <div class="col-md-6">
                                <select name="id_bidang" class="form-control">
                                <!--     <option value="">--Pilih Bidang--</option> -->
                                 <?php
	foreach($bidang->result() as $t){
	?>
    <option value="<?php echo $t->id_bidang;?>"><?php echo $t->bidang;?></option>
    <?php } ?></select>
                            </div>
                        </div>
              
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onClick="save()" class="btn btn-white btn-default btn-round"><i class="ace-icon fa fa-floppy-o red"></i>Save</button>
                <button type="button" class="btn btn-white btn-default btn-round" data-dismiss="modal"><i class="ace-icon fa fa-times red2"></i>Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">
 /* $(document).ready(function(){              
    var t = $('#no_mesin');
	t.textbox('textbox').bind('keyup', function(e){
	var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		});
	
	var t = $('#no_plat');
	t.textbox('textbox').bind('keyup', function(e){
	var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		});
	var t = $('#no_rangka');
	t.textbox('textbox').bind('keyup', function(e){
	var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		});
		
	var t = $('#no_bpkb');
	t.textbox('textbox').bind('keyup', function(e){
	var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		});
		
		
	}); */
</script>
            
            
<script type="text/javascript">
function cetak(id){
			window.open('<?php echo site_url('kapling/cetak_bon'); ?>/' +id);
			}

function reload_table()
{
$('#dataTables-1').dataTable().fnDestroy();
tes();
}

function reload_table2()
{
$('#dataTables-2').dataTable().fnDestroy();
tabel_user();
}

 function tes(){
  $('#dataTables-1').DataTable( {
                        "bProcessing"   : true,
						"scrollY"       :  350,
        				"scrollCollapse": true,
						"sAjaxSource"   : "<?php echo site_url('kapling/view_data');?>",
                        "aoColumns": [
							{ "mData": "no" },
                           	{ "mData": "tgl" },
                            { "mData": "jam" },
                            { "mData": "acara" },
                            { "mData": "nama_rr" },
							{ "mData": "bidang" },
                            { "mData": "waktu_kapling" }
                        			]
								});
						};
	function tabel_user(){
  						$('#dataTables-2').DataTable( {
                        "bProcessing"   : true,
						"scrollY"       :  350,
        				"scrollCollapse": true,
						"sAjaxSource"   : "<?php echo site_url('kapling/view_data_user');?>",
                        "aoColumns": [
							{ "mData": "no" },
                           	{ "mData": "tgl" },
                            { "mData": "jam" },
                            { "mData": "acara" },
                            { "mData": "nama_rr" },
							{ "mData": "bidang" },
                            { "mData": "waktu_kapling" },
							{ "mData": "hapus" }
                        			]
								});
						};

$(document).ready(function() {
tabel_user();
  tes();
});
</script>