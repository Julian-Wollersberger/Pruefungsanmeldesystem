        <div class="py-5 text-center">
			
			<h2>Daten direkt bearbeiten</h2>
	    
			<form  novalidate="" action="saveChanges.php" method="post">

				<hr class="mb-4">

				<div class="row">
					<div class="col-md-12 mb-3">
						<textarea rows="12" class="form-control" id="textarea" name="textarea"  value="" type="" required=""><?php

						/*#############################################*/
                        //require("pfade.php"); // wird schon in admin.php reqiered.
						$handle = fopen(anmeldungenFilePath, "r");

						if ($handle){
							while (($line = fgets($handle)) !== false) {
								echo $line;
							}
							fclose($handle);
						}

						/*#############################################*/

						?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mb-3">
						<button class="btn btn-primary btn-lg btn-block" type="submit" href="#">Speichern</button>
					</div>
				</div>

			</form>	
        </div>
		
