<?php
		if (isset($con))
		{
	?>
                <div class="modal fade" id="dataremove" tabindex="-1" role="dialog" aria-labelledby="dataremove" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header" style="background:#dc3545; color:#fff; border-radius:none;">
                                    <h5 class="modal-title" id="exampleModalLabel">DATA REMOVE</h5>
                                        <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-label="Close">
                                            <span style="color:#fff;" aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body" style="display:flex;">
                                        <input type="hidden" class="id" id="id" name="id">
                                       
                                        <i style="color:#fd3c3d; height:40px; width:40px;margin:auto;  margin-right:10px; " data-feather="alert-circle"></i><h4 style="font-size:15px; line-height:22px; text-align:justify; margin:auto; font-weight:500;">the selected data will be eliminated. ¿ Do you are sure to perform this delete action?</h4></li>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-danger">Delete Data</button>
                                </div>
                            <form>
                        </div>
                    </div>
                </div>
                <?php
		}
	?>