<?php
/**
 * Template Name: Build Your Tank

 *
 */
get_header();
?>
<?php

        if($_REQUEST['shape'] !='' )
{
	$shap=$_REQUEST['shape'];
	
if($shap !='')
{
	?>
	
	<script type="text/javascript">
    
	 var shape = '<?php echo $shap ;?>';
    jQuery(document).ready(function () {
        showcntr1(shape);
    });
    
</script>
	  
<?php
}
}
?>               
<section class="elementor-element elementor-element-bbb318a elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <table width="100%" border="0" cellpadding="4" cellspacing="0">
                <tbody><tr>
                        <td valign="top"><p align="center" class="center-text"><strong><font size="5">RequestA Quote from Sptanks.com </font></strong></p>							
                            <p align="center">
                                <strong><font size="4" face="Calibri">Customize Your Fuel Tank!</font>
                                    <font face="Calibri"><br>Choose your tank shape.<br>
                                    <a href="#"></a>
                                    </font>
                                </strong>
                            </p>
                            <table width="500" border="0" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF">
                                <tbody>
                                    <tr>
                                        <td width="125"><div align="center"><a  onclick="showcntr('1', 'Port-Starboard Tank')"><img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/images/tank1_sm.gif" alt="Port-Starboard Tank " border="0" title="Port-Starboard Tank "></a></div></td>
                                        <td width="125"><div align="center"><a  onclick="showcntr('2', 'Rectangular Tank')"><img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/images/tank2_sm.gif" alt="Rectangular Tank" border="0" title="Rectangular Tank"></a></div></td> 
                                        <td width="125"><div align="center"><a  onclick="showcntr('3', 'Belly Tank')"><img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/images/tank3_sm.gif" alt="Belly Tank" border="0" title="Belly Tank"></a></div></td>
                                    </tr>
                                    <tr>
                                        <td><div align="center"><a href="javas" onclick="showcntr('1', 'Port-Starboard Tank')">Port-Starboard Tank </a></div></td>
                                        <td><div align="center"><a href="#!" onclick="showcntr('2', 'Rectangular Tank')">Rectangular Tank</a></div></td>
                                        <td><div align="center"><a href="#!" onclick="showcntr('3', 'Belly Tank')">Belly Tank</a></div></td>
                                    </tr>
                                    <tr>
                                        <td><div align="center"><a onclick="showcntr('4', 'V-Hull Tank')"><img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/images/tank4_sm.gif" alt="V-Hull Tank" border="0" title="V-Hull Tank"></a></div></td>
                                        <td><div align="center"><a onclick="showcntr('5', 'Tapered Tank')"><img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/images/tank5_sm.gif" alt="Tapered Tank" border="0" title="Tapered Tank"></a></div></td>
                                        <td><div align="center"><a onclick="showcntr('6', 'Cylindrical Tank')"><img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/images/tank6_sm.gif" alt="Cylindrical Tank" border="0" title="Cylindrical Tank"></a></div></td>
                                    </tr>
                                    <tr>
                                        <td><div align="center"><a href="#!" onclick="showcntr('4', 'V-Hull Tank')">V-Hull Tank</a></div></td>
                                        <td><div align="center"><a href="#!" onclick="showcntr('5', 'Tapered Tank')">Tapered Tank</a></div></td>
                                        <td><div align="center"><a href="#!" onclick="showcntr('6', 'Cylindrical Tank')">Cylindrical Tank</a></div></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                </tbody>
                            </table>
                            <br>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="sec cntr" style="display:none">


                <table cellpadding="0" cellspacing="0" border="0" width="90%" align="center">
                    <tbody>
                        <tr valign="top">
                            <td>
                                <form name="frmCustomer" method="post" action="" onsubmit="return validate_form(this)">
                                    <p align="center"><span class="textbold"><strong> Fill in all the fields then click "Calculate Gallonage" to get the tank volume in gallons.</strong></span> </p>
                               
                                    <table cellpadding="0" cellspacing="0" border="0" align="center">								
                                        <tbody>
                                            <tr class="shape1 shapecntr starboard"  style="display:none">
                                                <td style="width:100%">
                                                    <div style="position:relative; margin-left: 25%;">
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/img/starboard.jpg" width="543" height="224" border="0" alt="">
                                                        <div style="position: absolute; top: 30px; left: 179px;"><input type="text" name="totalLenth1" id="totalLenth1" size="4" style="padding:0;width:auto" value=""> 
                                                         <span class="smalltext">in</span></div>	
                                                        <div style="position:absolute; float: right;margin:-119px 10px 0px -15px;"><input type="text" name="widthTotal1" id="widthTotal1" size="4" value="" style="padding:0;width:auto"><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-32px  10px 0px 54px;"><input type="text" name="length1" id="length1" size="4" value="" style="padding:0;width:auto"><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-168px 10px 0px 95px;"><input type="text" name="heightTotal1" id="heightTotal1" size="4" value="" style="padding:0;width:auto"><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-291px  10px 0px 440px;"><input type="text" style="padding:0;width:auto" name="widthSmall1" id="widthSmall1" size="4" value=""><span class="smalltext">in</span></div>
                                                    </div>

                                                </td>
                                                <td style="width:100%" align="center">
                                                    <input type="text"  id="txtArea2" value="" />
                                                    <input type="button" border="0" alt="Submit Tank Design" name="submit" value="Calculate Gallonage" onclick="areaStarboard()">
                                                </td>
                                            </tr>

                                            <tr class="shape2 shapecntr rectangular" style="display:none"><td style="width:100%">
                                                    <div style="position:relative; margin-left: 25%;">
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/img/rectangular.jpg" width="544" height="214" border="0" alt="">
                                                        <div style="position:absolute; float: right;margin:-203px 10px 0px 360px;"><input type="text" name="widthTotal2" id="widthTotal2" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-183px 10px 0px 150px;"><input type="text" name="length2" id="length2" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-130px 10px 0px 460px;"><input type="text" name="heightTotal2" id="heightTotal2" size="4" value=""><span class="smalltext">in</span></div>
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <input type="text"  id="txtArea1" value="" />
                                                    <input type="button" border="0" alt="Submit Tank Design" name="submit" value="Calculate Gallonage" onclick="areaRectangle()">
                                                </td>
                                            </tr>


                                            <tr class="shape3 shapecntr belly" style="display:none"><td style="width:100%">
                                                    <div style="position:relative; margin-left: 25%;">
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/img/belly.jpg" width="544" height="214" border="0" alt="">
                                                        <div style="position:absolute; float: right;margin:-185px 10px 0px 150px;"><input type="text" name="totalLenth3" id="totalLenth3" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-205px 10px 0px 370px;"><input type="text" name="length3" id="length3" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-160px 10px 0px 505px;"><input type="text" name="heightSmall3" id="heightSmall3" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-85px 10px 0px 0px;"><input type="text" name="heightTotal3" id="heightTotal3" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-25px 10px 0px 125px;"><input type="text" name="widthSmall3" id="widthSmall3" size="4" value=""><span class="smalltext">in</span></div>
                                                    </div>	
                                                </td>
                                                <td align="center"><input type="text"  id="txtArea3" value="" />
                                                    <input type="button" border="0" alt="Submit Tank Design" name="submit" value="Calculate Gallonage" onclick="areaBelly()">
                                                </td>
                                            </tr>

                                            <tr class="shape4 shapecntr vhull" style="display:none"><td style="width:100%">
                                                    <div style="position:relative; margin-left: 25%;">
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/img/v-hull.jpg" width="544" height="214" border="0" alt="">
                                                        <div style="position:absolute; float: right;margin:-170px 10px 0px 130px;"><input type="text" name="widthTotal4" id="widthTotal4" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-195px 10px 0px 340px;"><input type="text" name="length4" id="length4" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-160px 10px 0px 497px;"><input type="text" name="heightSmall4" id="heightSmall4" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-70px 10px 0px 0px;"><input type="text" name="heightTotal4" id="heightTotal4" size="4" value=""><span class="smalltext">in</span></div>
                                                    </div>
                                                </td>
                                                <td align="center"><input type="text"  id="txtArea4" value="" />
                                                    <input type="button" border="0" alt="Submit Tank Design" name="submit" value="Calculate Gallonage" onclick="areaVhull()">
                                                </td>
                                            </tr>

                                            <tr class="shape5 shapecntr tapered" style="display:none"><td style="width:100%">
                                                    <div style="position:relative; margin-left: 25%;">
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/img/tapered.jpg" width="543" height="224" border="0" alt="">
                                                        <div style="position:absolute; float: right;margin:-180px 10px 0px 140px;"><input type="text" name="widthTotal5" id="widthTotal5" size="3" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-220px 10px 0px 367px;"><input type="text" name="length5" id="length5" size="3" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-195px 10px 0px 510px;"><input type="text" name="heightSmall5" id="heightSmall5" size="3" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-58px 10px 0px -5px;"><input type="text" name="heightTotal5" id="heightTotal5" size="3" value=""><span class="smalltext">in</span></div>
                                                    </div>
                                                </td>
                                                <td align="center"><input type="text"  id="txtArea5" value="" />
                                                    <input type="button" border="0" alt="Submit Tank Design" name="submit" value="Calculate Gallonage" onclick="areaTaperad()">
                                                </td>
                                            </tr>	
                                            <tr class="shape6 shapecntr cylindrical"  style="display:none"><td style="width:100%">
                                                    <div style="position:relative; margin-left: 25%;">
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/Atlantic-Coastal/img/cylindrical.jpg" width="544" height="214" border="0" alt="">
                                                        <div style="position:absolute; float: right;margin:-190px 10px 0px 250px;"><input type="text" name="length6" id="length6" size="4" value=""><span class="smalltext">in</span></div>
                                                        <div style="position:absolute; float: right;margin:-90px 10px 0px -17px;"><input type="text" name="heightTotal6" id="heightTotal6" size="4" value=""><span class="smalltext">in</span></div>
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <input type="text"  id="txtArea6" value="" />
                                                    <input type="button" border="0" alt="Submit Tank Design" name="submit" value="Calculate Gallonage" onclick="areaCylindrical()">
                                                </td>
                                            </tr>                         

                                        <input type="hidden" name="txt_shape" id="txt_shape" value="" />			 
                                        
                                        </tbody>
                                    </table>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            
           <script>
                function showcntr(id, shape) {
                    jQuery('#shape').text(shape);
                    jQuery('#txt_shape').val(id);
                    jQuery('.shapecntr').hide();
                    jQuery('.shapecntr').hide();
                    jQuery('.shape' + id).show(); 
                    jQuery('.sec').show();
					jQuery(window).scrollTop(jQuery('.sec').offset().top); 				
					
                }


            </script>
			
			<script>
                function showcntr1(shape) {
                    jQuery('#shape1').text(shape);                    
                    jQuery('.shapecntr').hide();
                    jQuery('.shapecntr').hide();
                    jQuery('.' + shape).show(); 
                    jQuery('.sec').show();
					jQuery(window).scrollTop(jQuery('.sec').offset().top); 				
					
                }


            </script>
			
            <script type="text/javascript">
                function areaRectangle()
                {   //correct
                    var txtWidth = document.getElementById("widthTotal2").value;
                    var txtLength = document.getElementById("length2").value;
                    var txtHeight = document.getElementById("heightTotal2").value;
                    var txtArea = txtWidth * txtLength * txtHeight / 231;
                    //alert(txtArea);
                    document.getElementById('txtArea1').value = txtArea;


                }
                function areaStarboard()
                {      //correct

                    var W1 = document.getElementById("widthSmall1").value;
                    var H2 = document.getElementById("widthTotal1").value;
                    var H1 = document.getElementById("heightTotal1").value;
                    var W2 = document.getElementById("length1").value;
                    var L = document.getElementById("totalLenth1").value;
                    var txtAreaStarboard = ((L * W1 * H1) - (L * (W1 - W2) * (H1 - H2)) / 2) / 231;
                    //alert(txtArea);
                    document.getElementById('txtArea2').value = txtAreaStarboard;


                }

                function areaBelly()
                {       //correct
                    var W1 = document.getElementById("length3").value;
                    var H2 = document.getElementById("heightTotal3").value;
                    var H1 = document.getElementById("heightSmall3").value;
                    var W2 = document.getElementById("widthSmall3").value;
                    var L = document.getElementById("totalLenth3").value;
                    //[ (w1 * L * H2 ) - (W1-W2)/2 * L * (H2-H1) ] / 231
                    var txtAreaBelly = ((W1 * L * H2) - (W1 - W2) / 2 * L * (H2 - H1)) / 231;
                    //alert(txtArea);
                    document.getElementById('txtArea3').value = txtAreaBelly;


                }

                function areaVhull()
                {       //correct
                    var W = document.getElementById("length4").value;
                    var H2 = document.getElementById("heightTotal4").value;
                    var H1 = document.getElementById("heightSmall4").value;
                    //var W2 = document.getElementById("widthSmall3").value;
                    var L = document.getElementById("widthTotal4").value;
                    //[( L * W * H1 ) + (L * W * (H2 - H1))/ 2 ] / 231
                    var txtAreaVhull = ((L * W * H1) + (L * W * (H2 - H1)) / 2) / 231;
                    //alert(txtArea);
                    document.getElementById('txtArea4').value = txtAreaVhull;


                }
                function areaTaperad()
                {       //correct
                    var W = document.getElementById("length5").value;
                    var H2 = document.getElementById("heightSmall5").value;
                    var H1 = document.getElementById("heightTotal5").value;
                    //var W2 = document.getElementById("widthSmall3").value;
                    var L = document.getElementById("widthTotal5").value;
                    //((L * W * H2) + ((L * W * H1-H2) / 2 )) / 231
                    var txtAreaTaperad = ((L * W * H2) + ((L * W * ((H1 - H2) / 2)))) / 231;
                    //alert(txtArea);
                    document.getElementById('txtArea5').value = txtAreaTaperad;


                }

                function areaCylindrical()
                {       //correct
                    var D = document.getElementById("heightTotal6").value;
                    var H = document.getElementById("length6").value;

                    //(D/2)*(D/2)*3.1416*H/231
                    var txtAreaCylindrical = ((D / 2) * (D / 2) * 3.1416 * H) / 231;
                    //alert(txtArea);
                    document.getElementById('txtArea6').value = txtAreaCylindrical;


                }
            </script>
        </div>
    </div>
	<div class="elementor-container elementor-column-gap-default" style="background-color: #123b80;">
				<div class="elementor-row">
				<div data-id="1985ef0" class="elementor-element elementor-element-1985ef0 elementor-column elementor-col-100 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
				<div data-id="a572950" class="elementor-element elementor-element-a572950 elementor-widget elementor-widget-text-editor" data-element_type="text-editor.default">
				<div class="elementor-widget-container">
					<div class="elementor-text-editor elementor-clearfix"><p style="text-align: center;color: #fff;"><br><img class="alignnone size-full wp-image-1803" src="http://speedytanks.mytesting.review/wp-content/uploads/2019/01/CreditCardLogos2.png" alt="" width="170" height="34"><br>Fedex &amp; Freight Shipping Daily <br>Cash &amp; Check</p></div>
				</div>
				</div>
				<div data-id="166cb0b" class="elementor-element elementor-element-166cb0b elementor-widget elementor-widget-divider" data-element_type="divider.default">
				<div class="elementor-widget-container">
					<div class="elementor-divider">
			<span class="elementor-divider-separator"></span>
		</div>
				</div>
				</div>
				<div data-id="1303626" class="elementor-element elementor-element-1303626 elementor-widget elementor-widget-text-editor" data-element_type="text-editor.default">
				<div class="elementor-widget-container">
					<div class="elementor-text-editor elementor-clearfix"><p style="text-align: center;color: #fff;"><strong>Atlantic Coastal Welding</strong> 16 Butler Blvd Bayville, NJ 08721 | 732-269-1088​ | <a href="mailto:info@speedytanks.com">Contact </a><strong>| <a href="http://google.com" target="_blank" rel="noopener"></a></strong></p></div>
				</div>
				</div>
						</div>
			</div>
		</div>
						</div>
			</div>
</section>
<style>
    #txtArea2,#txtArea3,#txtArea4,#txtArea5,#txtArea6,#txtArea1 {    
    position: relative;    
    bottom: 3px;
    width: 172px;
}
</style>
</div>
			</div>
		</div>
		</main>
		</div>
<?php
get_footer();
?>
