# Proyecto 1 Tecnologias Web

## Autores

- **Ignacio Martínez**
- **Camilo Villalobos**

## Corrección de funcionamiento
- NewArea.php, NewUser.php, NewLink.php, nuevoProcedimiento.php, index.php -> Las secciones de codigo de php, incrustadas en hmtl, no contienen las etiquetas de <?php >, por lo tanto se agregaron.
- nuevoProcedimiento.php -> en button guardarNuevoProcedimientos() mal escrito, se le quita el caracter "s" del final. En button verVusquedas() mal escrito, es verBusquedas().
- index.php **linea 184** String de path incompleto, faltaba Principal/..
- routes.php **linea 67** -> Ruta de Salida mal escrita, es Principal/log_out
- Principal.php **function log_out** -> Mal argumento de redirect, es UsoIntranet no Intranet.

## Registro de Limpieza de codigo
Todos los siguientes ficheros y carpetas se eliminaron debido a que no son usados en el proyecto.

- morelike/controllers/Upload_Controller.php
- Varios ficheros dentro de las carpetas "js" y "css" que no se usan dentro de bootstrap/
- morelike/src/
- morelike/views/	--->  errors/	, footer.php	, header.php	, listadoFicheros.php	, resumenFichas.php
- bootstrap/ 		--->  assets/	, fonts/ 

## Funcionalidades y nuevos requerimientos 
Nuevas funcionalidades especificadas:

1. Permitir la edición de registros.
2. Permitir la eliminación de registros.

