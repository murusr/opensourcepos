<?php $this->load->view("partial/header"); ?>
<h2>Controlled item report</h2>
<div >
<span class="border border-primary">
<?php echo form_open("Stock_Reports/index/"); ?>
        
        <div class="form-group">
            <div class="col-md-6 form-group">
                <label for="cat"><strong>Choose a cat:</strong></label>
                <select name="cat" value="All" onchange="this.form.submit();">
                    <option value="All" <?PHP echo($cat=="All"? "selected='selected'":""); ?>>All</option>
                    <option value="cooking oil" <?PHP echo($cat=="cooking oil"? "selected='selected'":""); ?>>cooking oil</option>
                    <option value="Sugar" <?PHP echo($cat=="Sugar"? "selected='selected'":""); ?>>Sugar</option>
                    <option value="Gandum" <?PHP echo($cat=="Gandum"? "selected='selected'":""); ?>>Gandum</option>
                </select>
            </div>   
            <div class="col-md-6 form-group">
                <label for="si"><strong>Choose an Item:</strong></label>
                <select name="si" value="All" onchange="this.form.submit();">
                    <option value="All" <?PHP echo($si=="All"? "selected='selected'":""); ?>>All</option>
                    <?php if (! empty($ci) && is_array($ci)) : ?>
                        <?php foreach ($ci as $it): ?>
                            <option value="<?= $it->name ?>" <?PHP echo($si==$it->name ? "selected='selected'":""); ?>><?= $it->name ?></option>
                        <?php endforeach; ?>
                    <?php endif ?>
                </select>
            </div>   
            <div class="col-md-6 form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="de" name="de" value="" <?= ($dateenable? 'checked':'');?> >
                <label class="custom-control-label" for="de">DateRange</label>
            </div>
                <input id="datepickerfrom" name="datepickerfrom"  width="276" value="<?= $df; ?>"  />
                <input id="datepickerto" name="datepickerto" width="276" value="<?= $dt; ?>" disabled="<?PHP echo $dateenable?'false':'true'; ?>"/>           
            </div> 
            <button type="submit" class="btn btn-primary">Submit</button>  
        </div>
    <?php echo form_close(); ?>
    </span>
</div>
<table id="tablePreview" class="table table-striped table-sm table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item Name</th>
      <th scope="col">Transaction time</th>
      <th scope="col">Customer / Vendor</th>
      <th scope="col">licence ref</th>
      <th scope="col">Qty</th>
      <th scope="col">Bal</th>
      <th scope="col">sales</th>
      <th scope="col">purchase</th>
    </tr>
  </thead>
  <tbody>
  <?php if (! empty($transactions) && is_array($transactions)) : ?>
    <?PHP $counter = 0;?>
    <?php foreach ($transactions as $transaction): ?>
    <tr class="<?= $transaction->receiving_id>0 ? 'success':'' ?>">
        <?PHP $counter++;?>
      <th scope="row"><?= $counter ?></th>
      <td><?= $transaction->item_name; ?></td>
      <td><?= $transaction->time; ?></td>
      <td><?= $transaction->person_name; ?></td>
      <td><?= $transaction->licence; ?></td>
      <td><?= $transaction->qty; ?></td>
      <td><?= $transaction->StockBalance; ?></td>
      <td><?= $transaction->sale_id; ?></td>
      <td><?= $transaction->receiving_id; ?></td>
      
    </tr>

    <?php endforeach; ?>
    <?php endif ?>
  </tbody>
</table>
<script type="text/javascript">
     $('#datepickerfrom').datepicker({
            uiLibrary: 'bootstrap4',
            dateFormat: "yy-mm-dd",
            //"setDate": new Date(),
            showButtonPanel: true
        }).prop('disabled', <?PHP echo $dateenable?'false':'true'; ?>).datepicker("setDate",'<?PHP echo $df; ?>');
        
        $('#datepickerto').datepicker({
            uiLibrary: 'bootstrap4',
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            //"setDate": new Date()
        }).prop('disabled', <?PHP echo $dateenable?'false':'true'; ?>).datepicker("setDate",'<?PHP echo $dt; ?>');
        

        $('#de').on('change', function() {
            var checkBox = document.getElementById("de");
       if (checkBox.checked || checkBox.value=='checked') {
            $('#datepickerfrom').prop('disabled', false);
            $('#datepickerto').prop('disabled', false);
            $('#de').prop('value', 'dateincluded');
        } 
        else {
            alert('test');
            $('#datepickerfrom').prop('disabled', true);
            $('#datepickerto').prop('disabled', true);
            $('#de').prop('value', '');
        }
        });
</script>
