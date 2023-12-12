<?php
include ('../templates/cabecera.php');
include ('../secciones/vehiculos.php');
?>
  <div class="row">
    <div class="col-5">
      <h6>Control De Vehiculos</h6>
      <form action="" method="post">
        <div class="card">
          <div class="card-header">
            Datos del Vehiculo
          </div>
          <div class="card-body">

            <div class="mb-3">
              <label for="id" class="form-label small">Placa Vehiculo</label>
              <input value="<?php echo $id;?>"type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Ej: ciw-933">
              <small id="helpId" class="form-text text-muted">Placa</small>
            </div>

            <div class="mb-3">
              <label for="modelo" class="form-label small">Modelo Vehiculo</label>
              <input value="<?php echo $modelo;?>"type="text" class="form-control" name="modelo" id="modelo" aria-describedby="helpId" placeholder="Ej: 1999">
              <small id="helpId" class="form-text text-muted">Año</small>
            </div>

            <div class="mb-3">
              <label for="color_veh" class="form-label small">Selecione Color Vehiculo</label>
              
              <select class="form-select form-select-lg small" name="color_veh" id="color_veh">
                  <option value="">Seleccione Marca</option>
                  <?php foreach($listacolores as $i) { ?>
                    <option 
                      <?php
                        if (!empty($arreglo_vehi)):
                          if (in_array($i['id_color'], $arreglo_vehi)):
                            echo 'selected';
                          endif;


                        endif;
                      
                      ?>
                        value="<?php echo $i['id_color']; ?>"><?php echo $i['nom_color']; ?>
                    </option>
                  <?php } ?>
              </select>

            </div>

            <div class="mb-3">
              <label for="color_veh" class="form-label small">Selecione Marca Vehiculo</label>

              <select class="form-select form-select-lg" name="marca_veh" id="marca_veh">
                <option value="">Seleccione Marca</option>
                <?php foreach($listamarcas as $i) { ?>
                <option

                <?php
                        if (!empty($arreglo_vehi)):
                          if (in_array($i['id_marca'], $arreglo_vehi)):
                            echo 'selected';
                          endif;


                        endif;
                      
                      ?>
                  
                 value="<?php echo $i['id_marca']; ?>"><?php echo $i['nom_marca']; ?>
                </option>
                <?php } ?>
              </select>

            </div>

            <div class="mb-3">
              <label for="color_veh" class="form-label small">Selecione Tipo Vehiculo</label>

              <select class="form-select form-select-lg" name="tipo_veh" id="tipo_veh">
                <option value="">Seleccione Vehiculo</option>
                <?php foreach($listatipos as $i) { ?>
                <option
                <?php
                        if (!empty($arreglo_vehi)):
                          if (in_array($i['id_tipo_vehi'], $arreglo_vehi)):
                            echo 'selected';
                          endif;


                        endif;
                      
                      ?> 
                value="<?php echo $i['id_tipo_vehi']; ?>"><?php echo $i['nom_tipo_vehi']; ?>
              </option>
                <?php } ?>
              </select>

            </div>

            <div class="mb-3">
              <label for="color_veh" class="form-label small">Selecione Afiliado</label>

              <select class="form-select form-select-lg" name="afi_veh" id="afi_veh">
                <option value="">Seleccione Documento</option>
                <?php foreach($listaafi as $i) { ?>
                <option 
                <?php
                        if (!empty($arreglo_vehi)):
                          if (in_array($i['id_documento_afi'], $arreglo_vehi)):
                            echo 'selected';
                          endif;


                        endif;
                      
                      ?>
                  value="<?php echo $i['id_documento_afi']; ?>"><?php echo $i['id_documento_afi']; ?>
                </option>
                <?php } ?>
              </select>

            </div>

            <div class="mb-3">
              <label for="id" class="form-label small">Vencimiento SOAT vehiculo</label>
              <input value="<?php echo $date_soat;?>"type="date" class="form-control" name="date_soat" id="date_soat" aria-describedby="helpId" placeholder="Ej: ciw-933">
              <small id="helpId" class="form-text text-muted">Vencimiento Soat</small>
            </div>

            <div class="mb-3">
              <label for="id" class="form-label small">Vencimiento Tecno vehiculo</label>
              <input value="<?php echo $date_tec;?>" type="date" class="form-control" name="date_tec" id="date_tec" aria-describedby="helpId" placeholder="Ej: ciw-933">
              <small id="helpId" class="form-text text-muted">Vencimiento Tecnico Mecanica</small>
            </div>

            <div class="mb-3">
              <label for="id" class="form-label small">Vencimiento Lic Transito</label>
              <input value="<?php echo $date_lic;?>" type="date" class="form-control" name="date_lic" id="date_lic" aria-describedby="helpId" placeholder="Ej: ciw-933">
              <small id="helpId" class="form-text text-muted">Vencimiento Licenccia de Transito</small>
            </div>

            <div class="btn-group d-flex flex-wrap" role="group" aria-label="Button group name">
              <button type="submit" name="accion" value="guardar" class="btn btn-success mb-2 mx-2">Guardar</button>
              <button type="submit" name="accion" value="editar" class="btn btn-warning mb-2 mx-2">Editar</button>
              <!--<button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>-->
              <button type="reset" class="btn btn-primary mb-2 mx-2">Limpiar</button>
              <select value="<?php echo $estado;?>"name="estado" size="1" id="estado" class="btn btn-info mx-2">
                <option name="accion" value="AC" selected>ACTIVO</option>
                <option value="IN">INACTIVO</option>
              </select>
            </div>


          </div>

          <div class="card-footer text-muted">
            <h6>Nerd Ing H@MF@</h6> 
          </div>

        </div>
      </form>

    </div>

    <div class="col-7">
      <div class="table-responsive">
        <br>
        <table class="table table-primary">
          <thead>
            <tr>
              <th scope="col">Placa Vehiculo</th>
              
              <th scope="col">Modelo Año</th>
              <th scope="col">Marca Vehi</th>              
              <th scope="col">Color Vehi</th>
              <th scope="col">Tipo Vehi</th>
              <th scope="col">Docu Afiliado</th>
              <th scope="col">Vencimiento Soat</th>
              <th scope="col">Vencimiento Tecno</th>
              <th scope="col">Vencimiento Lic.Transito</th>
              
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($vehiculos as $i)
            { ?> 
              <tr class="">
                <td><?php echo $i['placa_vehi'];?></td>
                
                <td><?php echo $i['año_modelo_vehi'];?></td>
                <td><?php echo $i['Marca'];?></td>        
                <td><?php echo $i['color']; ?></td> <!-- Cambiar a $i['color'] en lugar de $i['nom_color'] que es alias del color -->
                <td><?php echo $i['Tipo']; ?></td>
                <td><?php echo $i['documento']; ?></td>
                <td><?php echo $i['fecha_ven_soat_vehi']; ?></td>
                <td><?php echo $i['fecha_ven_tecno_vehi']; ?></td>
                <td><?php echo $i['fecha_ven_litran_vehi']; ?></td>
                <td><?php echo $i['estado']; ?></td>
                <td>
                <form action="" method="post">
                  <input type="hidden" name="id" id="id" value="<?php echo $i['placa_vehi'];?>">
                  <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                </form>
                </td>
              </tr>
            <?php } ?>  
          </tbody>
        </table>
      </div>
      

    </div>
  </div>
<?php
include ('../templates/pie.php');
?>