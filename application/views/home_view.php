<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "UTF-8">
	<title>Selamat Datang di Database</title>
	<link rel = "stylesheet" href="<?php echo base_url('aset/bootstrap/css/bootstrap.min.css');?>">
	<link rel = "stylesheet" href="<?php echo base_url('aset/datatables/css/datatables.bootstrap.css');?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container">
	<h1>Selamat Datang di Database</h1>
	<h3>Penghuni Kilo 11</h3>
	<button class="btn btn-success" onclick="add_penghuni()"><i class="fa fa-plus"></i>Tambahkan Penghuni</button>
	<br>
	<br>
	<table id="tableid" class="table table-stripped table-bordered">
	<thead>
	<tr>
		<th>ID Penghuni</th>
		<th>Nama Penghuni</th>
		<th>Asal Penghuni</th>
		<th>Tempat tanggal Lahir</th>
		<th>Umur</th>
		<th>No. HP</th>
		<th>Editor</th>
	</tr>
		
	</thead>
	<tbody>
	<?php 
	foreach($penghunis as $penghuni){

		
	?>
	<tr>
		<td><?php echo $penghuni->Id_penghuni ;?></td>
		<td><?php echo $penghuni->Nama_penghuni ;?></td>
		<td><?php echo $penghuni->Asal_penghuni ;?></td>
		<td><?php echo $penghuni->ttl ;?></td>
		<td><?php echo $penghuni->umur ;?></td>
		<td><?php echo $penghuni->no_hp ;?></td>
		<td>
			<button class="btn btn-warning" onclick="edit_penghuni(<?php echo $penghuni->Id_penghuni; ?>)"><i class="fa fa-pencil"></i></button>
			<button class="btn btn-danger" onclick="delete_penghuni(<?php echo $penghuni->Id_penghuni; ?>)"><i class="fa fa-remove"></i></button>
		</td>
	</tr>
		
		<?php
	}
	?>
	</tbody>
	</table>
</div>


<!-- link to js -->
<script src="<?php echo base_url('aset/jquery/jquery.js') ;?>"></script>
<script src="<?php echo base_url('aset/bootstrap/js/bootstrap.min.js') ;?>"></script>
<script src="<?php echo base_url('aset/datatables/js/jquery.dataTables.min.js') ;?>"></script>
<script src="<?php echo base_url('aset/datatables/js/dataTables.bootstrap.js') ;?>"></script>

<!-- js -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#tableid').DataTable();
	});
	var save_method;
	var table;
	function add_penghuni(){
		save_method = 'add';
		$('#form')[0].reset();
		$('#modalform').modal('show');
	}
	function save(){
		var url;
		if(save_method == 'add'){
			url = '<?php echo site_url('index.php/home/penghuni_add');?>';
		 }else{
			url = '<?php echo site_url('index.php/home/penghuni_update');?>';
		}
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modalform').modal('hide');
				location.reload();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error adding / Update data');
			}
		});
	}

	function edit_penghuni(id){
		save_method = 'update';
		$('#form')[0].reset();

		//load data dari ajax
		$.ajax({
			url: "<?php echo site_url('index.php/home/ajax_edit/') ;?>/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name= "idpenghuni"]').val(data.Id_penghuni);
				$('[name=  "namapenghuni"]').val(data.Nama_penghuni);
				$('[name= "asalpenghuni"]').val(data.Asal_penghuni);
				$('[name= "ttl"]').val(data.ttl);
				$('[name= "umur"]').val(data.umur);
				$('[name= "nohp"]').val(data.no_hp);

				$('#modalform').modal('show');
				$('.modal_title').text('Edit Penghuni');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}

	function delete_penghuni(id){
		if(confirm('Are You Sure Delete This Data?!')){
			//ajax delete database
			$.ajax({
				url: "<?php echo site_url('index.php/home/penghuni_delete') ?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data){
					location.reload();
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('Error Deleting Data');
				}

			});
		}
	}

</script>

<div class="modal" id="modalform" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">

      <form action="#" id="form" class="form-horizontal">
     	<input type="hidden" value ="" name="idpenghuni">

      	<div class ="form-body">
      		<div class = "form-group">
      			<label class="control-label col-md-3">Id Penghuni</label>
      			<div class="col-md-9">
      				<input type="text" name="idpenghuni" placeholder="Id Penghuni" class = "form-control">
      			</div>
      		</div>
      	</div>

      	<div class ="form-body">
      		<div class = "form-group">
      			<label class="control-label col-md-10">Nama Penghuni</label>
      			<div class="col-md-9">
      				<input type="text" name="namapenghuni" placeholder="Nama Penghuni" class = "form-control">
      			</div>
      		</div>
      	</div>

      	<div class ="form-body">
      		<div class = "form-group">
      			<label class="control-label col-md-10">Asal Penghuni</label>
      			<div class="col-md-9">
      				<input type="text" name="asalpenghuni" placeholder="Asal Penghuni" class = "form-control">
      			</div>
      		</div>
      	</div>

      	<div class ="form-body">
      		<div class = "form-group">
      			<label class="control-label col-md-10">Tempat Tanggal Lahir</label>
      			<div class="col-md-9">
      				<input type="text" name="ttl" placeholder="Tempat tanggal lahir" class = "form-control">
      			</div>
      		</div>
      	</div>

      	<div class ="form-body">
      		<div class = "form-group">
      			<label class="control-label col-md-3">Umur</label>
      			<div class="col-md-9">
      				<input type="text" name="umur" placeholder="umur" class = "form-control">
      			</div>
      		</div>
      	</div>

      	<div class ="form-body">
      		<div class = "form-group">
      			<label class="control-label col-md-3">No. Hp</label>
      			<div class="col-md-9">
      				<input type="text" name="nohp" placeholder="No. Hp" class = "form-control">
      			</div>
      		</div>
      	</div>

      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="save()" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>