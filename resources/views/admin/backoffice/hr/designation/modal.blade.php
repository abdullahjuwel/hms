<style type="text/css">
	.modal-fullscreen{
		width: 50%;
		/*height: 100%;*/
		margin: auto;
		top: 30px !important;
		left: 0;
	}
	.cursor-pointer{
		cursor: pointer;
	}
	.form-control{
		margin: 2px 0px !important;
	}
	.thumbnail {
    display: block;
    height: 110px;
    border: 1px solid #ddd;
    -webkit-transition: border 0.2s ease-in-out;
    -o-transition: border 0.2s ease-in-out;
    transition: border 0.2s ease-in-out;
}
</style>

<form  method="post" id="desig_form" enctype="multipart/form-data" autocomplete="off">
	{{ csrf_field() }}
<div class="modal fade" id="desig_modal">
	<div class="modal-dialog modal-lg modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-level-up"></i> Add Or Update Designation</h4>
				</div>
				<div class="modal-body" style="padding: 1px">

						<div class="row">
							<div class="col-md-12">
									<div class="box-body" style="padding: 4px;">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Designation Name</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="desig_name" id="desig_name" placeholder="Enter designation name">
											</div>
										</div>

										<input type="hidden" name="hidden_desig_id" id="hidden_desig_id">

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Is Active</label>
											<div class="col-sm-9">
												<input id="status" checked="" style="width: 20px;height: 20px;" name="status" value="1" type="checkbox">
											</div>
										</div>
									</div>
							</div>
						</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>

			</div>
		</div>
	</div>
	</form>