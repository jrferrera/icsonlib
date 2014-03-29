<?php $this->load->view('includes/header') ?>

    <?php
        if($this->session->userdata('editReferenceFailed')){
            echo '<script> bootbox.alert("Failed to update reference material information!"); </script>';
            $this->session->unset_userdata('editReferenceFailed');
        }

        if($this->session->userdata('editReferenceSuccess')){
            echo '<script> bootbox.alert("Reference material information successfully updated!"); </script>';
            $this->session->unset_userdata('editReferenceSuccess');
        }

        /* Save result from database as AssocArray '$row' */
        if($number_of_reference != 1)
            redirect('librarian');

            foreach ($reference_material as $row){}
            /*Session start*/
            session_start();
            $_SESSION['id'] = $row->id;
    ?>
    <div id="content">
        <form name="edit_form" action="<?= base_url('index.php/librarian/edit_reference/' . $row->id) ?>" method="POST">
                <h3 class="editform">Edit Reference Form</h3>
                <br/>
                <div id="addReferenceForm">
                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Title:</span>
                        <input type="text"  class="form-control1" id="title" name="title" maxlength='500' title='Must be 1-500 characters.' pattern="^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\&quot; ]+$" onblur="validate_title()" value="<?php echo $row->title; ?>" required/> 
                       
                    </div>
                     <div class='error_message'><?=form_error('title')?></div>
                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Author:</span>
                        <input type="text"  class="form-control1" id="author" name="author" maxlength='255' title='Must be 2-255 characters.' pattern='^[A-Za-z0-9,&-\. ]+$' value="<?php echo $row->author;  ?>" onblur='validate_author()' required/></td>
                        
                    </div>
                    <div class='error_message'><?=form_error('author')?></div>
                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">ISBN:</span>
                        <input type="text"  class="form-control1" id="isbn" name="isbn" maxlength='13' title='Must be at most 13 characters.' value="<?php echo $row->isbn; ?>" onblur="validate_isbn()"/>
                        
                    </div>
                    <div class='error_message'><?=form_error('isbn')?></div> 
                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Category:</span>
                        <select name="category" class="form-control10" id="category">
                            <option value="M" <?php echo ($row->category == "M")? "selected":""; ?>>Magazine</option>
                            <option value="T" <?php echo ($row->category == "T")? "selected":""; ?>>Thesis</option>
                            <option value="S" <?php echo ($row->category == "S")? "selected":""; ?>>Special Problem</option>
                            <option value="B" <?php echo ($row->category == "B")? "selected":""; ?>>Book</option>
                            <option value="C" <?php echo ($row->category == "C")? "selected":""; ?>>CD/DVD</option>
                            <option value="J" <?php echo ($row->category == "J")? "selected":""; ?>>Journal</option>    
                        </select>
                        
                    </div>
                    <div class='error_message'><?=form_error('category')?></div>
                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Description:</span>
                        <textarea id="description" class="form-control16" name="description" maxlength='65535' title='Must be at most 65536 characters.' pattern="^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\&quote; ]+$" onblur="validate_description()"><?php echo $row->description; ?></textarea><br/></td>
                        
                    </div>
                    <div class='error_message'><?=form_error('description')?></div>

                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Publisher:</span>
                        <input type="text"class="form-control1"  id="publisher" name="publisher" maxlength='100' title='Must be at most 100 characters.' pattern="^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\&quote; ]+$" value="<?php echo $row->publisher; ?>" onblur="validate_publisher()"/>
                       
                    </div>
                     <div class='error_message'><?=form_error('publisher')?></div>
                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Publication Year:</span>
                        <input type="text" class="form-control1" id="publication_year" name="publication_year" pattern="^[0-9]{4}$" min="1900" max="<?php echo date('Y'); ?>" maxlength='4' value="<?php echo $row->publication_year; ?>" onblur="validate_publication_year()"/><br/></td>
                       
                    </div>
                     <div class='error_message'><?=form_error('publication_year')?></div>
                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Access Type:</span>
                        <select name="access_type"  class="form-control15" id="access_type">
                            <option value="F" <?php echo ($row->access_type == "F")? "selected":""; ?>>Faculty</option>
                            <option value="S" <?php echo ($row->access_type == "S")? "selected":""; ?>>Student</option> 
                        </select>
                       
                    </div>
                     <div class='error_message'><?=form_error('access_type')?></div>

                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Course Code:</span>
                        <input type="text" class="form-control1" id="course_code" name="course_code" maxlength='8' title='Must be 2-8 characters. Must follow the format COURSE nnn.' pattern = "^[A-Z]{2,4}[ ]{0,1}[0-9]{1,3}$" value="<?php echo $row->course_code; ?>" onblur="validate_course_code()" required/></td>
                        
                    </div>
                    <div class='error_message'><?=form_error('course_code')?></div>

                    <div class="input-group input-group-md" align="right">
                        <span class="input-group-addon">Total Stock:</span>
                        <input type="number" class="form-control1" min="1" id="total_stock" name="total_stock" pattern = "^\d+$" onchange="validate_total_stock()" value="<?php echo $row->total_stock; ?>"/>
                        <input type='hidden' id="total_available" value="<?php echo $row->total_available; ?>"/>
                        
                    </div>
                    <div class='error_message'><?=form_error('total_stock')?></div> 

                    <div id="button_ref1">
                    <input  class="btn btn-success" type="submit" name="submit" value="Edit Reference Material">
                    <a  href="<?= site_url('librarian/view_reference/'.$row->id) ?>" class = "btn btn-danger" id = "back_button">Back</a>
                </div>  
        </form>  
    </div>
        
    <?= $this->load->view("includes/footer.php") ?> 