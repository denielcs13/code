<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size','100M');
?>
<?php include'header.php' ?>
<?php include'sidebar.php' ?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
			
			<?php 
						if($this->session->flashdata('msg') != null && $this->session->flashdata('msg') != "")
							{ 
							?>
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-danger" role="alert">
									<?php echo $this->session->flashdata('msg');?>
									</div>
								</div>
							</div>
							<?php 
							} 
						?>
					<?php if (validation_errors()) : ?>
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-danger" role="alert">
										<?= validation_errors() ?>
									</div>
								</div>
							</div>
								<?php endif; ?>
			<?php if (isset($error)) : ?>
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-danger" role="alert">
										<?= $error ?>
									</div>
								</div>
							</div>
								<?php endif; ?>
			
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Edit Location</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('listpsw');?>">Location List</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Location</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-xl-9 col-md-12">
                      	<?= form_open_multipart(); ?>
                                <div class="card-body"> 
                                    
                               
	
	
								<div class="row">
								                <div class="col-sm-12 col-lg-6">
													<div class="form-group row">
														<label for="location" class="col-sm-3 text-left control-label col-form-label">Enter Location</label>
														<div class="col-sm-9">
															<input type="text" name="location" class="form-control" id="location" placeholder="Enter Location" value="<?php echo $psw_detail->location;?>">
														</div>
													</div>
												</div>
												
												<div class="col-sm-12 col-lg-6">
													<div class="form-group row">
														<label for="fname2" class="col-sm-3 text-left control-label col-form-label">Enter Password</label>
														<div class="col-sm-9">
															<input type="text" name="password" class="form-control" id="fname2" placeholder="Enter Password" value="<?php echo  base64_decode($psw_detail->psw);?>">
														</div>
													</div>
												</div>   
												
												
											</div>
			
	
	
                                </div>
                               
                                <hr>
                                <div class="card-body">
                                    <div class="form-group m-b-0 text-right">
                                        
										
										
										<button type="submit"  name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
										
                                    </div>
                                </div>
                            </form>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- Share Modal -->
            <div class="modal fade" id="Sharemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-auto-fix m-r-10"></i> Share With</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i class="ti-user text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Name Here" aria-label="Username">
                                </div>
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <a href="#Whatsapp" class="text-success">
                                        <i class="display-6 mdi mdi-whatsapp"></i><br><span class="text-muted">Whatsapp</span>
                                    </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#Facebook" class="text-info">
                                        <i class="display-6 mdi mdi-facebook"></i><br><span class="text-muted">Facebook</span>
                                    </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#Instagram" class="text-danger">
                                        <i class="display-6 mdi mdi-instagram"></i><br><span class="text-muted">Instagram</span>
                                    </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#Skype" class="text-cyan">
                                        <i class="display-6 mdi mdi-skype"></i><br><span class="text-muted">Skype</span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Create Modal -->
            <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Create New Contact</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i class="ti-user text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Name Here" aria-label="name">
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i class="ti-more text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number Here" aria-label="no">
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i class="ti-import text-white"></i></button>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	
  <?php include'footer.php' ?>  
  
  
