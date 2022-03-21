<style type="text/css">
	.products-list>.item {
		border-radius: 3px;
		-webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
		box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
		padding: 5px 0;
		background: #fff;
	}
</style>
<div class="modal fade" id="patient_info_modal">
	<div class="modal-dialog modal-lg modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-wheelchair"></i> Patient Details</h4>
				</div>
				<div class="modal-body" style="padding: 1px;">

					<div class="row">
						<div class="col-md-12">

							<div class="col-md-3">
								<label for="inputPassword3" class="control-label"><h3><b id="patient_name"></b></h3></label>
								<ul class="products-list product-list-in-box">
									<li class="item">
										<div class="col-md-4">
											<b>
												<span class="product-description">
													<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Gender" class="fa fa-venus-mars"></i> 
													<span class="gender"></span>
												</span>
											</b>
										</div>
										<div class="col-md-4">
											<b><span class="product-description">
												<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Blood Group" class="glyphicon glyphicon-tint"></i> <span class="blood_group"></span>
											</span></b>
										</div>
										<div class="col-md-4">
											<b><span class="product-description">
												<i class="fa fa-life-ring" data-toggle="tooltip" data-placement="top" title="" data-original-title="Marital Status"></i>
												<span class="marital_status"></span>
											</span></b>
										</div>

									</li>
									<li class="item">
										<div class="col-md-12">
											<b><span class="product-description">
												<i class="fa fa-child" data-toggle="tooltip" data-placement="top" title="" data-original-title="Age"></i>&nbsp;
												<span class="age"></span>
											</span></b>
										</div>
									</li>
									<li class="item">
										<div class="col-md-12">
											<b><span class="product-description">
												<i class="fa fa-phone-square" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mobile"></i>&nbsp;
												<span class="phone"></span>
											</span></b>
										</div>
									</li>
									<li class="item">
										<div class="col-md-12">
											<b><span class="product-description">
												<i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Email"></i>&nbsp;
												<span class="email"></span>
											</span></b>
										</div>
									</li>
									<li class="item">
										<div class="col-md-12">
											<b><span class="product-description">
												<i class="fa fa-map" data-toggle="tooltip" data-placement="top" title="" data-original-title="Address"></i>&nbsp;
												<span class="address"></span>
											</span></b>
										</div>
									</li>
								</ul>
							</div>

							<div class="col-md-2">

							</div>

							<div class="col-md-3">
								<label for="inputPassword3" class="control-label"><h3><b style="color: transparent;">w</b></h3></label>
								<ul class="products-list product-list-in-box">
									<li class="item">
										<div class="col-md-12">
											<span class="product-description">
												<b class="show-allergy-detail" data-toggle="tooltip" data-placement="top">Any Known Allergy &nbsp;&nbsp;</b>
												<span class="allergy"></span>
											</span>
										</div>
									</li>
									<li class="item">
										<div class="col-md-12">
											<span class="product-description">
												<b>Remarks &nbsp;&nbsp;</b>
												<span class="remarks"></span>
											</span>
										</div>
									</li>
									<li class="item">
										<div class="col-md-12">
											<span class="product-description">
												<b>TPA ID &nbsp;&nbsp;</b>
												<span class="tpa_id"></span>
											</span>
										</div>
									</li>
									<li class="item">
										<div class="col-md-12">
											<span class="product-description">
												<b>TPA Validity &nbsp;&nbsp;</b>
												<span class="tpa_validity"></span>
											</span>
										</div>
									</li>
									<li class="item">
										<div class="col-md-12">
											<span class="product-description">
												<b>National ID &nbsp;&nbsp;</b>
												<span class="nid"></span>
											</span>
										</div>
									</li>
								</ul>
							</div>

							<div class="col-md-1">

							</div>

							<div class="col-md-2">
								<label for="inputPassword3" class="control-label"><h3><b>Patient Photo</b></h3></label>
								<ul class="products-list product-list-in-box">
									<li class="item">
										<div class="col-md-10">
											<img src="{{ asset('public/assets/images/avatar.png') }}" class="profile-user-img img-responsive img-circle img-lg" alt="Patient Image" id="patient_image">
										</div>
									</li>
								</ul>
							</div>

						</div>
					</div>

					<div class="" style="height: 600px; overflow-y: auto;overflow-x: hidden;">
					<div class="row">
						<div class="col-md-12">
							<section class="content">
								<div class="col-xs-12 no-padding">
									<div class="box-header">
										<h3 class="box-title" style="color: grey;"><i class="fa fa-wheelchair"></i>&nbsp;&nbsp; 
										OPD Details</h3>
									</div>
									<div class="box-body table-responsive">
										<table id="patient_datatable" class="table table-bordered text-center" width="100%">
											<thead>
												<tr>
													<th>OPD No</th>
													<th>Case ID</th>
													<th>Date</th>
													<th>OPD Checkup ID</th>
													<th>Doctor Name</th>
													<th>Symptoms</th>
													<th>Findings</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>OPDN12</td>
													<td>15</td>
													<td>25.10.2021</td>
													<td>CHKID12</td>
													<td>Amit Singh (9009)</td>
													<td width="20%">Thirst Thirst is the feeling of needing to drink something. It occurs whenever the body is dehydrated for any reason. Any condition that can result in a loss of body water can lead to thirst or exces</td>
													<td width="20%">Damaged Hair Hair damage is more than just split ends. Extremely damaged hair develops cracks in the outside layer (cuticle). Once the cuticle lifts (opens), your hair is at risk for further damage and breakage. It may also look dull or frizzy and be difficult to manage</td>
												</tr>
												<tr>
													<td>OPDN12</td>
													<td>15</td>
													<td>25.10.2021</td>
													<td>CHKID12</td>
													<td>Amit Singh (9009)</td>
													<td width="20%">Thirst Thirst is the feeling of needing to drink something. It occurs whenever the body is dehydrated for any reason. Any condition that can result in a loss of body water can lead to thirst or exces</td>
													<td width="20%">Damaged Hair Hair damage is more than just split ends. Extremely damaged hair develops cracks in the outside layer (cuticle). Once the cuticle lifts (opens), your hair is at risk for further damage and breakage. It may also look dull or frizzy and be difficult to manage</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</section>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<section class="content">
								<div class="col-xs-12 no-padding">
									<div class="box-header">
										<h3 class="box-title" style="color: grey;"><i class="fa fa-wheelchair"></i>&nbsp;&nbsp; 
										IPD Details</h3>
									</div>
									<div class="box-body table-responsive">
										<table id="patient_datatable" class="table table-bordered text-center" width="100%">
											<thead>
												<tr>
													<th>OPD No</th>
													<th>Case ID</th>
													<th>Date</th>
													<th>OPD Checkup ID</th>
													<th>Doctor Name</th>
													<th>Symptoms</th>
													<th>Findings</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>OPDN12</td>
													<td>15</td>
													<td>25.10.2021</td>
													<td>CHKID12</td>
													<td>Amit Singh (9009)</td>
													<td width="20%">Thirst Thirst is the feeling of needing to drink something. It occurs whenever the body is dehydrated for any reason. Any condition that can result in a loss of body water can lead to thirst or exces</td>
													<td width="20%">Damaged Hair Hair damage is more than just split ends. Extremely damaged hair develops cracks in the outside layer (cuticle). Once the cuticle lifts (opens), your hair is at risk for further damage and breakage. It may also look dull or frizzy and be difficult to manage</td>
												</tr>
												<tr>
													<td>OPDN12</td>
													<td>15</td>
													<td>25.10.2021</td>
													<td>CHKID12</td>
													<td>Amit Singh (9009)</td>
													<td width="20%">Thirst Thirst is the feeling of needing to drink something. It occurs whenever the body is dehydrated for any reason. Any condition that can result in a loss of body water can lead to thirst or exces</td>
													<td width="20%">Damaged Hair Hair damage is more than just split ends. Extremely damaged hair develops cracks in the outside layer (cuticle). Once the cuticle lifts (opens), your hair is at risk for further damage and breakage. It may also look dull or frizzy and be difficult to manage</td>
												</tr>
												<tr>
													<td>OPDN12</td>
													<td>15</td>
													<td>25.10.2021</td>
													<td>CHKID12</td>
													<td>Amit Singh (9009)</td>
													<td width="20%">Thirst Thirst is the feeling of needing to drink something. It occurs whenever the body is dehydrated for any reason. Any condition that can result in a loss of body water can lead to thirst or exces</td>
													<td width="20%">Damaged Hair Hair damage is more than just split ends. Extremely damaged hair develops cracks in the outside layer (cuticle). Once the cuticle lifts (opens), your hair is at risk for further damage and breakage. It may also look dull or frizzy and be difficult to manage</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</section>
						</div>
					</div>
                 </div>
				</div>


			</div>
		</div>
	</div>