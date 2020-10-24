# Proyecto 1 Tecnologias Web

## Autores 👨‍💻

- **Ignacio Martínez**
- **Camilo Villalobos** [Camilovs](https://github.com/Camilovs)

## Bitacora de Bugs 📒

_Bitacora de registro de cualquier bug. Detallar origen y solución (si es que se logró resolver)._

## Corrección de funcionamiento 🛠

_Sección destinada para detallar las secciones de codigo que se corrigieron para restaurar el funcionamiento del proyecto._

- NewArea.php, NewUser.php, NewLink.php, nuevoProcedimiento.php, index.php -> Las secciones de codigo de php, incrustadas en hmtl, no contienen las etiquetas de <?php >, por lo tanto se agregaron.
- nuevoProcedimiento.php **linea 31** -> guardarNuevoProcedimientos() mal escrito, se le quita el caracter "s" del final.
- index.php **linea 184** String de path incompleto, faltaba Principal/..

## Registro de Limpieza de codigo 🧹

_Sección destinada para el registro de codigo inutizado que se ha ido borrando del proyecto. Nombrar elementos que se descartaron y justificar el motivo._

## Funcionalidades y nuevos requerimientos 🎯

_Nuevas funcionalidades especificadas:_
_1. Permitir la edición de registros._
_2. Establecer una validación respecto de los valores ingresados, que implemente el separador de miles._
_3. Permitir la eliminación de registros._
_4. Definir la búsqueda de registros por intervalo de fechas._
_Nuevo modulo requerido:_
_1. Informes: Donde el usuario Administrador podrá conocer los tiempos de conexión de cada usuario, así como también los montos finales de los ingresos y egresos por día._
