<?=$this->load->view("includes/header")?>
<?= $this->load->view('includes/advanceSearchLib') ?>
<?= $this->load->view('includes/createaccount') ?>

	<?php
		if($this->session->userdata('profileViewFailed')){
			echo '<script> bootbox.alert("<center>You must log-in to view your profile.</center>"); </script>';
			$this->session->unset_userdata('profileViewFailed');
		}
	?>
	
		<div id="left1"><!--okay-->
			<div class="carou-announ">
		<div id="this-carousel-id" class="carousel slide">
			 
	        <div class="carousel-inner">
				<?php
					$title=array('New Release: &quot;Seven Web Frameworks in Seven Weeks&quot;<br /> by Jack Moffitt, Fred Daoud',"2014&#39;s IEEE Cloud Computing Magazine");
					$content=array("The rapid evolution of web apps demands innovative solutions. Innovate, experiment and learn how to create better apps! From familiar Ruby and JavaScript to the more exotic Erlang, Haskell, and Clojure, familiarize yourself with frameworks that leverage modern programming languages, employ unique architectures, live client-side instead of server-side, and embrace type systems.","Be up-to-date on the latest in emerging technologies! Learn how to optimize and secure cloud services, for both end-users and providers. Interesting and comprehensive articles to ensure data privacy and integrity when deploying to the cloud and diagnose obstacles encountered in maintaining access to cloud services.");
				
					for($i=100;$i<102; $i++){
						if($i==100){ ?>
							<div class="item active">
						<?php }else{ ?>
							<div class="item">
			          	<?php } ?>
							<div class="pic-out"><img class="pic" src="<?=base_url("resources/img/$i.jpg")?>"/></div>
			        	
							<div class="fulldescr">
							<div class="title">
								<span class="cont"><?=$title[$i-100]?></span>
							</div>
							<div class="descr">
								<span class="cont"><?=$content[$i-100]?></span>
							</div>
						</div>
					</div>
				<?php }	?>  
				
			</div><!-- .carousel-inner -->
        <!--  next and previous controls here
              href values must reference the id for this carousel -->
			<a class="carousel-control left" href="#this-carousel-id" data-slide="prev">
			 <span class="glyphicon glyphicon-chevron-left"></span></a>
			<a class="carousel-control right" href="#this-carousel-id" data-slide="next">
			 <span class="glyphicon glyphicon-chevron-right"></span></a>
		</div><!-- .carousel -->
	    <!-- end carousel -->

    </div> 		

    	
	
			<div class="link-gr1">
				<a href="http://www.uplb.edu.ph" target="_blank" class="link-pic" id="uplb1">
					<div class="title-link">UPLB</div>
				</a>
				<a href="http://www.ics.uplb.edu.ph/" target="_blank" class="link-pic" id="ics1">
					<div class="title-link">ICS</div>
				</a>
				<a href="http://ilib.uplb.edu.ph/" target="_blank" class="link-pic" id="add1">
					<div class="title-link">UPLB MAIN LIBRARY</div>
				</a>
			</div><!-- link gr1-->
		</div><!-- left -->
	
		<div id="right1"><!-- okay-->
			<div class="container" id="signin">
				<div id="search_1">
					<h4>Welcome <?=$this->session->userdata('username')?>!</h4>
				 
				<?php if($this->session->userdata('userType') != 'L'){ ?>
				<form class="" role="search"action="http://localhost/icsonlib/index.php/search/search_rm" method="get" accept-charset="utf-8">
		        	<div class="form-group">
					<input type="text" class="header_class1" name="keyword" placeholder="Search" value="" required/>
				   	</div>
				    <input class="btn btn-default"type="submit" name="search1" value="Search"/>

			<a href="#advanceSearch" data-toggle="modal"> <input type="submit" name="aSearch" class="btn btn-primary"  value="Advanced Search"/></a>
	       		</form>
	       		<?php }  else {?>
	       		<form action = "<?= base_url('index.php/librarian/search_reference') ?>" method = 'GET'>
		        	<div class="form-group">
		        	<input type = "hidden" name = "category" value = "title">
		        	<input type = "hidden" name = "sortBy" value = "title">
		        	<input type = "hidden" name = "orderFrom" value = "ASC">
		        	<input type = "hidden" name = "perPage" value = "10">
		        	<input type = 'text' class="header_class1" name = 'searchText' pattern = '.{1,}' placeholder="search" value = '<?= htmlspecialchars($this->input->get('searchText'), ENT_QUOTES) ?>'/>
				   	</div>
				    <input class="btn btn-default"type="submit" name="submit" value="Search"/>
	       		<a href="#advanceSearchL" data-toggle="modal"> <input type="submit" name="aSearch" class="btn btn-primary"  value="Advanced Search"/></a>
	       		</form>
	       		<?php }?>
	        
	        	</div><!--search 1-->
				
	
			
			
			<div id="announ1">
				<?=$calendar?>
					
			
			</div> <!--container sign-in -->
			<br/>
			<br/>

<br/>

		</div><!-- righ1-->
	</div>


	<div id="advanceSearch" class="modal fade in" role="dialog">  
<div class="modal-dialog">  
          <div class="modal-content">
            <div class="modal-header">  
              <a class="close" data-dismiss="modal">&times;</a>
           <center><h4><b> Advanced Search</b></h4></center>
            </div><!--modal header-->
            <div class="modal-body">
            	<div id="advancedSearchBody">
                <form action="<?php echo base_url('index.php/search/advanced_search_reference'); ?>" method="get" accept-charset="utf-8">
    
   
	          	<div class="input-group input-group-md" align="right">
	  			        <span class="input-group-addon"><input value="title" type="checkbox" name="projection[]" checked="true">Title:</span>
	  		         	<input type="text" class="form-control" name="title" size = "30" value="<?php if(isset($temparray) && in_array('title',$temparray)) echo $temparrayvalues[array_search('title', $temparray)]?>">
				
				      </div>
			       </br>
        
    
          
          	<div class="input-group input-group-md" align="right">
	  			      <span class="input-group-addon"><input value="author" type="checkbox" name="projection[]">Author:</span>
	  			      <input type="text" name="author" size = "30" class="form-control"value="<?php if(isset($temparray) && in_array('author',$temparray)) echo $temparrayvalues[array_search('author', $temparray)]?>">
			     </div>
			     <br/>

			     <div class="input-group input-group-md" align="right">
	  		      	<span class="input-group-addon"><input value="year_published" type="checkbox" name="projection[]">Year Published:</span>
	  		       	<input type="text" name="year_published" class="form-control"size = "30" value="<?php if(isset($temparray) && in_array('year_published',$temparray)) echo $temparrayvalues[array_search('year_published', $temparray)]?>">
          </div>
            <br/>

			   <div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon"><input value="publisher" type="checkbox" name="projection[]">Publisher:</span>
  			   	<input type="text" name="publisher" class="form-control"size = "30" value="<?php if(isset($temparray) && in_array('publisher',$temparray)) echo $temparrayvalues[array_search('publisher', $temparray)]?>">
 			  </div>
            <br/>

          <div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon"><input value="course_code" type="checkbox" name="projection[]" >Subject:</span>
  				  <input type="text" name="course_code"class="form-control" size = "30" value="<?php if(isset($temparray) && in_array('course_code',$temparray)) echo $temparrayvalues[array_search('course_code', $temparray)]?>">
  		  	</div>
            <br/>
           <div class="input-group input-group-md" align="right">
	  			  <span class="input-group-addon">Category:</span>
  				  <select name="refType"  class="form-control8" >
                <option value="B">Book</option>
                <option value="J">Journal</option>
                <option value="T">Thesis</option>
                <option value="D">CD</option>
                <option value="C">Catalog</option>
              </select>
            </div>
            <br/>
          	
             </div><!--advancedSearchbody-->
            &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="sort" value="sortalpha"checked="true" />Sort from A to Z
            <input type="radio" name="sort" value="sortbeta" />Sort from Z to A
       		<input type="radio" name="sort" value="sortyear" />Sort by year
            <input type="radio" name="sort" value="sortauthor" />Sort by author(A-Z)
      
   
     
       

              <div class="modal-footer">
                <input  class="btn btn-primary"type="submit" value="Advanced Search" />
                 </form> 
              </div> <!-- modal footer -->

            </div> <!--modalbody-->
          </div>
        </div>
    </div> 
	<!--footer-->
<?=$this->load->view("includes/footer")?>	

 

  