<style type="text/css">
	.modal-fullscreen{
		width: 90%;
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

<form  method="post" id="patient_form" enctype="multipart/form-data" autocomplete="off">
	{{ csrf_field() }}
<div class="modal fade" id="patient">
	<div class="modal-dialog modal-lg modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-user"></i> Patient Enrollment</h4>
				</div>
				<div class="modal-body" style="padding: 1px">

					<section class="content">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="box-body" style="padding: 4px;">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Name</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="name" id="name" placeholder="Enter patient name">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Guardian Name</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="guardian_name" id="guardian_name" placeholder="Enter guardian name">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Date oF Birth</label>
											<div class="col-sm-9">
												<input type="date" class="form-control" name="dob" id="dob" placeholder="Enter date of birth">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Age [yy-mm-dd]</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" name="year" id="year" placeholder="year" readonly="">
											</div>
											<div class="col-sm-3">
												<input type="text" class="form-control" name="month" id="month" placeholder="month" readonly="">
											</div>
											<div class="col-sm-3">
												<input type="text" class="form-control" name="day" id="day" placeholder="day" readonly="">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Phone</label>
											<div class="col-sm-9">
												<input type="number" class="form-control" name="phone" id="phone" placeholder="Enter mobile no">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Email</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Blood Group</label>
											<div class="col-sm-3">
												<select class="form-control select2" name="blood_group" id="blood_group" style="width: 100%;">
													<option value="" disabled="" selected="">- - - Select - - -</option>
													<option value="B+">B+</option>
													<option value="A+">A+</option>
													<option value="AB-">AB-</option>
													<option value="AB+">AB+</option>
													<option value="O+">O+</option>
													<option value="O-">O-</option>
													<option value="A-">A-</option>
													<option value="A+">A+</option>
												</select>
											</div>
											<label for="inputPassword3" class="col-sm-2 control-label">Gender</label>
											<div class="col-sm-4">
												<select class="form-control select2" name="gender" id="gender" style="width: 100%;">
													<option value="" disabled="" selected="">- - - Select - - -</option>
													<option value="M">Male</option>
													<option value="F">Female</option>
													<option value="O">Other</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Address</label>
											<div class="col-sm-9">
												<textarea class="form-control" rows="3" name="address" id="address" placeholder="Enter address"></textarea>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6">

									<div class="box-body" style="padding: 4px;">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Member Image</label>
											<div class="col-sm-9">
												<input type="file" onchange="readURL(this);" style="background-color: lavender;" class="form-control" name="image" id="image" placeholder="Enter patient image">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Image Preview</label>
											<div class="col-sm-9">
												<div class="">
													<img id="uploaded_image" src="{{ asset('public/assets/images/avatar.png') }}" class="profile-user-img img-responsive img-circle img-lg" alt="Patient Image">
												</div>
											</div> 
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Marital Status</label>
											<div class="col-sm-9">
												<select class="form-control select2" name="marital_status" id="marital_status" style="width: 100%;">
													<option value="" disabled="" selected="">- - - Select - - -</option>
													<option value="S">Single</option>
													<option value="M">Married</option>
													<option value="W">Widowed</option>
													<option value="SP">Separated</option>
													<option value="NS">Not Specified</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">TPA ID</label>
											<div class="col-sm-9">
												<input type="number" class="form-control" name="tpa_id" id="tpa_id" placeholder="Enter TPA id">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">TPA Validity</label>
											<div class="col-sm-9">
												<input type="date" class="form-control" name="tpa_validity" id="tpa_validity" placeholder="Enter TPA validity">
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Any Allergies</label>
											<div class="col-sm-9">
												<textarea class="form-control" rows="2" name="allergy" id="allergy" placeholder="Enter any known allergy (if any)"></textarea>
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">NID</label>
											<div class="col-sm-9">
												<input type="number" class="form-control" name="nid" id="nid" placeholder="Enter nid">
											</div>
										</div>

										<!-- <div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Is Active</label>
											<div class="col-sm-9">
												<input id="status" checked="" style="width: 20px;height: 20px;" name="status" value="1" type="checkbox">
											</div>
										</div> -->

										<br>
									</div>
								</div>
							</div>
						</div>

                        <div class="row">
							<div class="col-md-12">
									<div class="box-body" style="padding: 4px;">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-2 control-label" style="width: 13%;">Remarks</label>
											<div class="col-sm-10">
												<textarea style="width: 103.3%" class="form-control" rows="3" name="remarks" id="remarks" placeholder="Enter remarks"></textarea>
											</div>
										</div>
									</div>
							</div>
						</div>
					</section>
				</div>

				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
					<button type="submit" class="btn btn-primary">Save</button>
				</div>

			</div>
		</div>
	</div>
	</form>