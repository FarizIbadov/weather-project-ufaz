<form method="POST" novalidate='' action="addData.php" class="modal fade needs-validation" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <div class="form-row">
                <div class="col-md-6">
                     <label for="date" class="col-form-label">Date:</label>
                    <input required type="date" class="form-control" id="date">
                    <input type="hidden" name="date" id="hidden-date">
                </div>
                <div class="col-md-6">
                     <label for="overall" class="col-form-label">Overall:</label>
                    <select required name="overallId" id="overall" class="custom-select">
                        <option value="">-----</option>
                        <?php
                          foreach($overallList as $key => $value){
                            echo "
                              <option value='$key'>$value</option>
                            ";
                          }
                        ?>
                    </select>
                </div>
            </div>
          <div class="form-row mt-4">
              <div class="col-md-4">
                <label for="temp" class="col-form-label">Temperature: (℃)</label>
                <input required step="0.01" name="temperature" class="form-control" type="number" id="temp"/>
              </div>
              <div class="col-md-4">
                <label for="wind" class="col-form-label">Wind speed: (km/h)</label>
                <input required step="0.01" name="wind-speed" class="form-control" type="number" id="wind"/>
              </div>
              <div class="col-md-4">
                <label  for="pressure" class="col-form-label">Pressure: (mmHg)</label>
                <input required name="pressure" class="form-control" type="number" step="0.01" id="pressure"/>
              </div>
          </div>
          <div class="form-row mt-4">
              <div class="col-md-6">
                <label for="humid" class="col-form-label">Humidity: (%)</label>
                <input required step="0.01" name="humidity" class="form-control" type="number" id="humid"/>
              </div>
              <div class="col-md-6">
                <label for="visibility" class="col-form-label">Visibility: (km)</label>
                <input required name="visibility" class="form-control" type="number" step="0.01" id="visibility"/>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="city" value="<?php echo $_GET['city'] ?>">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button id="modal-btn" type="submit" class="btn btn-primary">Add data</button>
      </div>
    </div>
  </div>
</form>