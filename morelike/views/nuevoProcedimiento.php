<div class="row">
	<div class="col-12">
		<h3 class="text-center">Registros Contables</h3>
	</div>

	<div class="col-12 col-lg-12">
		<div class="row">
			<div class="col-4 text-center">
				<h4>Descripción</h4>
			</div>
			<div class="col-4 text-center">
				<h4>Ingreso</h4>
			</div>
			<div class="col-4 text-center">
				<h4>Egreso</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<input class="form-control" type="text" id="adddescripcion">
			</div>
			<div class="col-4">
				<input class="form-control" type="number" id="addingreso" onchange="formato('ingreso')">
			</div>
			<div class="col-4">
				<input class="form-control" type="number" id="addegreso" onchange="formato('egreso')">
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<button class="btn btn-success" style="width: 100%; margin-top: 10px;" onclick="guardarNuevoProcedimiento()">Guardar <i class="far fa-save"></i></button>
			</div>
			<div class="col-6">
				<button class="btn btn-warning" style="width: 100%; margin-top: 10px;" onclick="verBusquedas()" id="verBusquedas">Buscar <i class="fas fa-search-plus"></i></button>
				<button class="btn btn-warning" id="ocultarBusquedas" style="display:none; width: 100%; margin-top: 10px;" onclick="ocultarBusquedas()">Buscar <i class="fas fa-search-plus"></i></button>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-6" style="display: none" id="divBusqueda">
		<fieldset>
			<legend>Búsquedas</legend>
			<label for="from">Desde</label>
			<input type="text" id="from" name="from">
			<label for="to">Hasta</label>
			<input type="text" id="to" name="to">
		</fieldset>
	</div>
	<?php if ($cant > 0) : ?>
		<div class="col-12 col-lg-12" id="ultimosRegistros">
			<table class="table table-striped table-hover table-condensed table-bordered" id="tablaRegistros">
				<th>Fecha</th>
				<th>Descripción</th>
				<th>Ingreso</th>
				<th>Egreso</th>
				<th>Saldo</th>
				<th>Editar</th>
				<th>Borrar</th>
				<?php foreach ($data as $row) : ?>

					<tr>
						<td><?= substr($row->fecha, 0, 10) ?></td>
						<td><?= $row->descripcion ?></td>
						<td><?= number_format($row->ingreso, 0, ",", ".") ?></td>
						<td><?= number_format($row->egreso, 0, ",", ".") ?></td>
						<?php if ($row->saldo > 0) : ?>
							<td class="btn-success"><?= number_format($row->saldo, 0, ",", ".") ?></td>
						<?php else : ?>
							<td class="btn-danger"><?= number_format($row->saldo, 0, ",", ".") ?></td>
						<?php endif; ?>
						<td>
							<button class="btn btn-warning fas fa-edit" data-toggle="modal" data-target="#modalEdit"
									onclick="llenarDatosModal(<?=$row->id?>,<?=$row->ingreso?>,<?=$row->egreso?>,
									<?=$row->saldo?>)"
							></button>
						</td>
						<td>
							<button class="btn btn-danger fas fa-trash-alt" onclick="borrarProcedimiento(<?=$row->id?>)" ></button>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<input type="hidden" id="idOculto" value="<?= $ultimo ?>">
			<button class="btn btn-info" onclick="addRegistros()" style="width: 100%; margin-top:5px;"><i class="fas fa-cloud-download-alt fa-2x"></i></button>
		</div>
	<?php endif; ?>

</div>
<script type="text/javascript" src="js/rut.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '< Ant',
			nextText: 'Sig >',
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
			weekHeader: 'Sm',
			dateFormat: 'yy-mm-dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);
		from = $("#from")
			.datepicker({
				//defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on("change", function() {
				to.datepicker("option", "minDate", getDate(this));
			}),
			to = $("#to").datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 2
			})
			.on("change", function() {
				from.datepicker("option", "maxDate", getDate(this));
			});

		function getDate(element) {
			var date;
			try {
				date = $.datepicker.parseDate(dateFormat, element.value);
			} catch (error) {
				date = null;
			}

			return date;
		}
	});

	function showResponse(responseText, statusText, xhr, $form) {
		var res = JSON.parse(responseText);
		$("#nombreOrden").val(res.nombre);
		if (res.estado == "ok") {
			$("#imagenMsj").html("<p>Orden Almacenada</p>");
			$("#imagenMsj").addClass("btn-success");
			$("#imagenMsj").removeClass("btn-danger");
		} else {
			$("#imagenMsj").html(res.error);
			$("#imagenMsj").addClass("btn-danger");
			$("#imagenMsj").removeClass("btn-success");
		}
		$("#imagenMsj").show();
	}

	function buscarPacienteRut() {
		var rut = $("#rutPacienteBusqueda").val();
		$.post(base_url + "Principal/buscarPacienteRut", {
				rut: rut
			},
			function(data) {
				$("#nombrePaciente").val(data[0].nombre);
				$("#apellidosPaciente").val(data[0].apellido);
				$("#fNacimiento").val(data[0].fNac);
				$("#edadPaciente").val(data[0].edad);
				$("#telefonoPaciente").val(data[0].telefono);
				$("#emailPaciente").val(data[0].correo);
				$("#direccionPaciente").val(data[0].domicilio);
			}, 'json')
	}

	function calcularEdad() {
		var fNac = $("#fNacimiento").val();
		var birthday_arr = fNac.split("-");
		var birthday_date = new Date(birthday_arr[0], birthday_arr[1] - 1, birthday_arr[2]);
		var ageDifMs = Date.now() - birthday_date.getTime();
		//alert(ageDifMs);
		var ageDate = new Date(ageDifMs);
		var edad = Math.abs(ageDate.getUTCFullYear() - 1970);
		$("#edadPaciente").val(edad);
	}

	function guardarNuevoProcedimiento() {

		var descripcion = $("#adddescripcion").val();
		var ingreso = ($("#addingreso").val().split(".")).join("");
		var egreso = ($("#addegreso").val().split(".")).join("");

		var validation = {
			isEmailAddress: function(str) {
				var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				return pattern.test(str); // returns a boolean
			},
			isNotEmpty: function(str) {
				var pattern = /\S+/;
				return pattern.test(str); // returns a boolean
			},
			isNumber: function(str) {
				var pattern = /^\d+$/;
				return pattern.test(str); // returns a boolean
			},
			isText: function(str) {
				var pattern = /^[a-zA-Z ]*$/;
				return pattern.test(str); // returns a boolean
			},
			isTelefono: function(str) {
				var pattern = /^[0-9+]+$/;
				return pattern.test(str);
			},
			isSame: function(str1, str2) {
				return str1 === str2;
			}
		};
		var fail = 0;
		if (descripcion.length == 0 && (ingreso.length == 0 || egreso.length == 0)) {
			alert("Debes regstrar Descripción e Ingreso o Egreso");
			fail = 1;
		}
		if (descripcion.length > 0 && ingreso.length == 0 && egreso.length == 0) {
			alert("Falta registrar Ingreso o Egreso");
			fail = 1;
		}
		if (ingreso.length > 0 && egreso.length > 0) {
			alert("Solo puede ser Ingreso o Egreso!");
			fail = 1;
		}

		if (fail == 0) {
			$.post(base_url + "Principal/saveProcedimiento", {
				descripcion: descripcion,
				ingreso: ingreso,
				egreso: egreso
			}, function() {
				$("#contenedor").hide('fast');
				nuevoProcedimiento();
			});
		}
	}

	function verBusquedas() {
		$("#divBusqueda").show("fast");
		$("#verBusquedas").hide();
		$("#ocultarBusquedas").show();
	}

	function ocultarBusquedas() {
		$("#divBusqueda").hide("fast");
		$("#verBusquedas").show();
		$("#ocultarBusquedas").hide();
	}

	function formato(campo) {
		var cadena = $("#" + campo).val();
		$("#" + campo).val(cadena);
	}

	function addRegistros() {
		$.post(
			base_url + "Principal/traeMasRegistros", {
				desde: $("#idOculto").val()
			},
			function(data) {
				if (data.cant > 0) {
					var cadena = "";
					for (var i = 0; i < data.cant; i++) {
						if (data.data[i].saldo > 0) {
							cadena += "<tr><td>" + (data.data[i].fecha).substring(0, 10) + "</td><td>" + data.data[i].descripcion + "</td><td>" + data.data[i].ingreso + "</td><td>" + data.data[i].egreso + "</td><td class='btn-success'>" + data.data[i].saldo + "</td></tr>";
						} else {
							cadena += "<tr><td>" + (data.data[i].fecha).substring(0, 10) + "</td><td>" + data.data[i].descripcion + "</td><td>" + data.data[i].ingreso + "</td><td>" + data.data[i].egreso + "</td><td class='btn-danger'>" + data.data[i].saldo + "</td></tr>";
						}
					}
					$("#idOculto").val(data.ultimo);
					$("#tablaRegistros").append(cadena);
				}
			}, 'json'
		);
	}

	function saveImagen(id, archivo, nombre) {
		$.ajax({
			url: base_url + "Principal/saveImagen",
			type: "post",
			data: {
				file: archivo,
				id: id,
				nombre: nombre
			},
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function(data) {
				alert("Upload Image Successful.");
			}
		});
		/*$.post(
	  		base_url+"Principal/saveImagen",
	  		{
	  			id:id, archivo:archivo, nombre:nombre
	  		}
  		);*/
	}
	function llenarDatosModal(id,ingreso,egreso,saldo){
		console.log(id);
		$('#idRegistro').val(id);
		//$('#descripcion').val(descripcion);
		$('#ingreso').val(ingreso);
		$('#egreso').val(egreso);
		$('#saldo').val(saldo);

	}
	function editarProcedimiento()
	{
		var ingreso = $("#ingreso").val();
		var egreso = $("#egreso").val();
		var	id = $("#idRegistro").val();
		var descripcion = $("#descripcion").val();
		var saldo = $("#saldo").val();
		$.post(base_url + "Principal/editarProcedimiento", {
			id:id,
			descripcion: descripcion,
			ingreso: ingreso,
			egreso: egreso,
			saldo:saldo
		}, function() {
			$("#contenedor").hide('fast');
			nuevoProcedimiento();
		});
	}
	function borrarProcedimiento(id){
		var	id = id;
		$.post(base_url + "Principal/borrarProcedimiento", {
			id:id,
		}, function() {
			$("#contenedor").hide('fast');
			nuevoProcedimiento();
		});
	}
</script>
