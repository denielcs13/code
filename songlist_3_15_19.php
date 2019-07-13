<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors','0');
?>

<?php include'header.php' ?>
<?php include'sidebar.php' ?>
        <!-- Page wrapper  -->
 <script> 
 function cnfdel(id){
		var url="<?php echo base_url().'delete-song/';?>";
	   if (confirm("Are you sure want to delete this song?")) {
       window.location.href = url+"/"+id;
		}
    return false;
 }
 </script>							
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
			<?php 
						if($this->session->flashdata('msg') != null && $this->session->flashdata('msg') != "")
							{ 
							?>
							<div class="row">
								<div class="col-md-12">
									<div class="alert" role="alert">
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
            <div class="page-breadcrumb">
                <div class="row">
                   
					<div class="col-5 align-self-center">
                        <h4 class="page-title">Songs</h4>
                        <div class="d-flex align-items-center">
						</div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                         <a href="<?php echo base_url();?>">Home</a>
                                    </li>
                                    <!--<li class="breadcrumb-item active" aria-current="page">Library</li>-->
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
                        <div class="card">
                            <div class="card-body">
								
								<div class="d-flex no-block align-items-center m-b-30 width-100">
                                  <!--<button class="dt-button buttons-copy buttons-html5 btn btn-primary mr-1" data-toggle="modal" data-target="#responsive-modal" tabindex="0" aria-controls="file_export"><span>Import</span></button>-->
								<div class="">
									<div class="btn-group">
							  <form method="get" action="<?php echo base_url('songlist');?>">
								<div class="row">
                                <div class="col-lg-6">
                                   
                                    <input type="text" class="form-control form-control-lg" placeholder="Song title" name="sname" value="<?php if($_GET['sname']!=""){ echo $_GET['sname'];} ?>">
								</div>
                                <div class="col-lg-3">
                                  <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="decade" style="height: 44px;">
													<option value="" selected>Decade</option>
                                                      	<option <?php if($_GET['decade']==50){ echo 'selected';} ?> value="50">50's</option>
														<option <?php if($_GET['decade']==60){ echo 'selected';} ?> value="60">60's</option>
														<option <?php if($_GET['decade']==70){ echo 'selected';} ?> value="70">70's</option>
														<option  <?php if($_GET['decade']==80){ echo 'selected';} ?> value="80">80's</option>
														<option <?php if($_GET['decade']==90){ echo 'selected';} ?> value="90">90's</option>
	
                                                    </select>
                                </div>
                              
                             
                                <div class="col-lg-3">
                                   
                                        <button class="btn btn-block btn-lg btn-info" type="submit" >Search</button>
										
										<input class="btn btn-block btn-lg btn-info" type="reset" value="Reset">
                                        
                                </div>
								
								  </div>
								</form>
								
									</div>
								</div> 
									
									<div class="ml-auto">
                                        <div class="btn-group">
                                      <a href="<?php echo base_url('add-song');?>"><button type="button" class="btn btn-dark">
                                               Add Song
                                            </button></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="file_export" class="table table-bordered nowrap display">
                                        <thead>
                                            <tr>
												<th>#</th>
											   <th>Decade</th>
                                                <th>Song Title / Voice</th>
                                                <th>Artist</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php 
										$i = $page_no +1;
										if($songlists){
										foreach($songlists as $songlist){
											?>


										
                                            <tr>
												<td><?php echo $i;?></td>
                                                <td><?php echo $songlist->category;?>'s</td>
                                                <td>
												<div style="float:left;vertical-align: middle;">
												<?php echo $songlist->song_name;?>
												</div>
												<div  style="float:right;">
												<div id="source1_<?= $songlist->id;?>" ></div>
												
												<!--audio controls style="width:100px;height: 35px;vertical-align: middle;"> 
												  <source id="source_<//?= $songlist->id;?>"  src="" type="audio/ogg">
												  <!--source src="horse.mp3" type="audio/mpeg"-->
											     <!--/audio-->
												 <button type="button" name="play" id="playid_<?= $songlist->id;?>" class="btn btn-info play">Play</button>
												 <!--a href="" class="play" " >play</a-->
												 </div>
												</td> 
                                                <td><?php echo $songlist->artist;?></td>                                           
                                               <td>
                                                    <a href="javascript:void(0)" onclick="cnfdel(<?php echo $songlist->id;?>)"><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn redColor" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></a>
													<a href="<?php echo base_url().'edit-song/'.$songlist->id;?>"><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn royal-blue" data-toggle="tooltip" data-original-title="Edit"><i class="icon-Marker" aria-hidden="true"></i></button></a>
                                                </td>
                                            </tr>
										<?php $i++;}}else{?>
											
											  <tr>
												<td colspan="5">No record found</td>
                                              
                                            </tr>
											
										<?php } ?>
												
										</tbody>
                                    </table>
									   <div class="modal-footer">
										<?php echo $links;?>
									</div>
									
                                </div>
                            </div>
                        </div>
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
         
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
	 <script type="text/javascript">
	 $(document).on('click', ".play", function () {
		      var id = this.id;
			  var splitid = id.split('_');
			  var index = splitid[1];          
	         
        $.ajax({
			type: 'post',
            url: '<?php echo base_url().'get-song-by-id';?>',            
			data:{id:index},
            success: function( data ) {
                console.log(data);
				var parsedData = JSON.parse(data);			
				var aud = parsedData.song_info[0]['song_audio'];
				console.log(aud);                
				$('div #source1_'+index).append('<audio controls style="width:100px;height: 35px;vertical-align: middle;"><source  src="'+aud+'" type="audio/ogg"></audio>');
				$('audio').get(0).play();
				$('#playid_'+index).hide();
				
            }
        });
	   });
    </script>
 <?php include'footer.php' ?> 
 

 



