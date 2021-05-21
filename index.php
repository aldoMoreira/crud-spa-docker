<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CRUD Proficiência</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">CRUD Proficiência</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Novo</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nome</th>
							<th>Sexo</th>
							<th>Idade</th>
							<th>Hobby</th>
							<th>Data Nascto</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Novo Registro</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group" style='visibility:hidden; overflow:hidden; position:absolute;'>
			        	<label type="text">ID</label>
			        	<input type="text" name="id" id="id" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Nome</label>
			        	<input type="text" name="nome" id="nome" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Sexo</label>
			        	<input type="text" name="sexo" id="sexo" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>idade</label>
			        	<input type="text" name="idade" id="idade" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Hobby</label>
			        	<input type="text" name="hobby" id="hobby" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Data Nascimento</label>
			        	<input type="text" name="dnascto" id="dnascto" class="form-control" />
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Adicionar" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	fetch_data();
	function fetch_data()
	{
		$.ajax({
			url:"fetch.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}
	$('#add_button').click(function(){
		$('#api_crud_form')[0].reset();
		$('#action').val('insert');
		$('#dnascto').datepicker({
									changeMonth: true,
									changeYear: true
								});
		$('#dnascto').datepicker( 'option', 'dateFormat', 'dd/mm/yy' );
		$('#button_action').val('Gravar');
		$('.modal-title').text('Novo Registro');
		$('#apicrudModal').modal('show');
	});
	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#nome').val() == '')
		{
			alert("Entre com o nome");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if($('#action').val() == 'insert')
					{
						if(data.trim() == 'ok') {
							alert("Dados incluídos");
						} else {
							alert("Erro ao gravar o registro.");
						}
					}
					if($('#action').val() == 'update')
					{
						if(data.trim() == '"ok"') {
							alert("Dados alterados");
						} else {
							alert("Erro ao gravar o registro. ");
						}
					}
				}
			});
		}
	});
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = "fetch_single";
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#id').val(id);
				$('#nome').val(data.nome);
				$('#sexo').val(data.sexo);
				$('#idade').val(data.idade);
				$('#hobby').val(data.hobby);
				$('#dnascto').datepicker({
											changeMonth: true,
											changeYear: true
 										});
				$('#dnascto').datepicker( 'option', 'dateFormat', 'dd/mm/yy' );
				$('#dnascto').val(data.dnascto);
				$('#action').val('update');
				$('#button_action').val('Gravar');
				$('.modal-title').text('Editando Dados');
				$('#apicrudModal').modal('show');
			}
		})
	});
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Quer mesmo excluir o registro "+id+"?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
				}
			});
		}
	});

});
</script>
