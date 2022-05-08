<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="icon" href="data:image/png;base64,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">
    <title>Editar cotizacion</title>
</head>
<body>
  <a class="btn btn-" onclick="history.back()" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
  </svg></a>
 <center> <h1> <strong>Editar cotizacion</strong></h1></center>
    <div class="container">
    <form class="row g-4" action="{{ url('cotizaciones/'.$cotizacion->id) }}" method="post">
      @csrf {{-- token de seguridad para el formulario  --}}

        {{ method_field('PATCH') }}

        <div class="col-md-4">
          <label for="validationServer01" class="form-label">Nombre</label>
          <input type="text" class="form-control is-valid" id="validationServer01" placeholder="Nombre" required name="nombres_cotizante"
          value="{{ isset($cotizacion->nombres_cotizante)?$cotizacion->nombres_cotizante:old('nombre_cotizante') }}">
          <div class="valid-feedback">
            Se ve bien!
          </div>
        </div>
        <div class="col-md-4">
          <label for="validationServer02" class="form-label">Apellido</label>
          <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Apellido" required name="apellidos_cotizante"
          value="{{ isset($cotizacion->apellidos_cotizante)?$cotizacion->apellidos_cotizante:old('nombre_cotizante') }}">
          <div class="valid-feedback">
            Se ve bien!
          </div>
        </div>
        <div class="col-md-4">
          <label for="validationServerUsername" class="form-label">Correo electronico</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend3" value="Email">@</span>
            <input type="email" class="form-control is-invalid" id="validationServerUsername" placeholder="Email" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required name="email_cotizante"
            value="{{ isset($cotizacion->email_cotizante)?$cotizacion->email_cotizante:old('email_cotizante') }}">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
              Por favor digita tu correo electronico
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <label for="validationServer03" class="form-label">Telefono</label>
          <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="Telefono" aria-describedby="validationServer03Feedback" required name="telefono_cotizante"
            value="{{ isset($cotizacion->telefono_cotizante)?$cotizacion->telefono_cotizante:old('telefono_cotizante') }}">
          <div id="validationServer03Feedback" class="invalid-feedback">
            Por favor digita tu numero de telefono
          </div>
        </div>
        <div class="col-md-4">
          <label for="validationServer04" class="form-label">Ciudad</label>
          <select class="form-select is-invalid" id="validationServer04" placeholder="Ciudad" aria-describedby="validationServer04Feedback" required name="ciudad_cotizante">
            <option value="{{ isset($cotizacion->ciudad_cotizante)?$cotizacion->ciudad_cotizante:old('ciudad_cotizante') }}">{{ isset($cotizacion->ciudad_cotizante)?$cotizacion->ciudad_cotizante:old('ciudad_cotizante') }}</option>
            <option value="Bogota">Bogota</option>
            <option value="Cundinamarca">Cundinamarca</option>
            <option value="Tunja">Tunja</option>
            <option value="Boyaca">Boyaca</option>
            <option value="Arauca">Arauca</option>
            <option value="Popayan">Popayan</option>
            <option value="Armenia">Armenia</option>
            <option value="Cartagena">Cartagena</option>
            <option value="Medellin">Medellin</option>
            <option value="Villavicencio">Villavicencio</option>
            <option value="Cali">Cali</option>
            <option value="Arauca">Arauca</option>
            <option>Otra</option>
          </select>
          <div id="validationServer04Feedback" class="invalid-feedback">
            Ciudad
          </div>
        </div>
        <div class="col-md-4">
          <label for="validationServer05" class="form-label">Producto</label>
          <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Producto" aria-describedby="validationServer05Feedback" required name="producto_id"
              value="{{ isset($cotizacion->producto_id)?$cotizacion->producto_id:old('producto_id') }}">
          <div id="validationServer05Feedback" class="invalid-feedback">
           Por favor digite el poducto
          </div>
        </div>
          <div class="col-md-4">
            <label for="validationServer05" class="form-label">Ubicacion</label>
            <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Ubicacion" aria-describedby="validationServer05Feedback" required name="ubicacion_cotizante"
                value="{{ isset($cotizacion->ubicacion_cotizante)?$cotizacion->ubicacion_cotizante:old('ubicacion_cotizante') }}">
            <div id="validationServer05Feedback" class="invalid-feedback">
             Por favor digite su ubicacion
            </div>
          </div>

          <div class="col-md-4">
            <label for="validationServer05" class="form-label">Fecha</label>
            <input type="date" class="form-control is-invalid" id="validationServer05" placeholder="Ubicacion" aria-describedby="validationServer05Feedback" required name="ubicacion_cotizante"
                value="{{ isset($cotizacion->fecha_cotizacion)?$cotizacion->fecha_cotizacion:old('fecha_cotizacion') }}">
            <div id="validationServer05Feedback" class="invalid-feedback">
             Por ingrese la fecha de la cotización
            </div>
          </div>

          <div class="col-md-4">
            <label for="validationServer04" class="form-label">Estado</label>
            <select class="form-select is-invalid" id="validationServer04" placeholder="Ciudad" aria-describedby="validationServer04Feedback" required name="estado_cotizacion">
              <option value="{{ isset($cotizacion->estado_cotizacion)?$cotizacion->estado_cotizacion:old('estado_cotizacion') }}">{{ isset($cotizacion->estado_cotizacion)?$cotizacion->estado_cotizacion:old('estado_cotizacion') }}</option>
              <option value="Cancelada">Cancelada</option>
              <option value="Activa">Activa</option>
            </select>
          </div>
        
          <div class="col-md-4">
           Comentarios<textarea id="comentarios" cols="148" rows="3" name="comentarios_cotizacion">{{ isset($cotizacion->comentarios_cotizacion)?$cotizacion->comentarios_cotizacion:old('comentarios_cotizacion') }}
           </textarea>
            
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="D" id="exampleModalLabel"> Eliminar la cotizacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ¿Esta seguro de que desea editar la cotizacion?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Si</button>
              </div>
            </div>
          </div>
        </div><button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
          
        </button>
        
        <div class="col-12">
          <button class="btn btn-primary" type="button" data-bs-toggle="modal"  data-bs-target="#exampleModal2" >Editar</button>
        </div>
      </form>
    </div>
</body>
</html>
         