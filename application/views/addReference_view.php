<?php $this->load->view('includes/header') ?>
    
    <?php

        if($this->session->userdata('addReferenceSuccess')){
            echo '<script> bootbox.alert("<center>Reference material successfully added.</center>"); </script>';
            $this->session->unset_userdata('addReferenceSuccess');
        }
    ?>

        <h3>Add Reference</h3>
        <div id="addReferenceForm">
            
            <?= form_open('librarian/add_reference/'); ?>

            <div class="input-group input-group-md" align="right">
                <span class="input-group-addon">  Title:  </span>
                <input name="title" class="form-control1"type="text" id="inputNum" maxlength='500' title="Must be 1-500 characters containing only alphanumeric character/s, spaces, and any of the following characters: . , \ + : ; # ( ) - ' &quot; &amp;" pattern="^[A-Za-z0-9\.\\,\+:&amp;;'#\(\)\-\'\&quot; ]+$" required/>
                
            </div>
            <div class='error_message'><?=form_error('title')?></div>
            <div class="input-group input-group-md" align="right">
                <span class="input-group-addon">  Author:  </span>
               <input name="author" class="form-control1" type="text" id="inputAuthor" maxlength='255' title='Must be 2-255 characters containing only aphanumeric character/s, spaces, and any of the following characters: . , - &amp;' pattern='^[A-Za-z0-9,&amp;-\. ]+$' required/> </td>
               
            </div>
            <div class='error_message'><?=form_error('author')?></div>
            <div class="input-group input-group-md" align="right">
                <span class="input-group-addon">  ISBN:  </span>
               <input name="isbn" class="form-control1" type="text" id="inputISBN" maxlength='13' title='Must be at most 13 characters containing only 9-digits separated by a dash' pattern='^[0-9]+\-[0-9]+\-[0-9]+\-[0-9]+$' /></td>
               
            </div>
            <div class='error_message'><?=form_error('isbn')?></div>
            <div class="input-group input-group-md" align="right">
               <span class="input-group-addon">  Category:  </span>
               <select class="form-control22" name="category" id="inputCategory" required>
                        <option value="B" selected>Book</option>
                        <option value="M">Magazine</option>
                        <option value="T">Thesis</option>
                        <option value="S">Special Problem</option>
                        <option value="C">CD/DVD</option>
                        <option value="J">Journal</option>
                    </select>
                    
            </div>
            <div class='error_message'><?=form_error('category')?></div>

             <div class="input-group input-group-md" align="right">
                <span class="input-group-addon">  Description:  </span>
                <textarea name="description" class="form-control33" id="inputDesc" maxlength='65535' title="Must be at most 65536 characters containing only alphanumeric character/s, spaces, and any of the following characters: . , \ + : ; # ( ) - ' &quot; &amp;" pattern="^[A-Za-z0-9\.\\,\+:&amp;;'#\(\)\-\'\&quot; ]+$"> </textarea>
                
             </div>
             <div class='error_message'><?=form_error('description')?></div>
             <div class="input-group input-group-md" align="right">
                <span class="input-group-addon">  Publisher:  </span>
                <input name="publisher" class="form-control31"type="text" id="inputPublisher" maxlength='100' title="Must be at most 100 characters containing only alphanumeric character/s, spaces, and any of the following characters: . , \ + : ; # ( ) - ' &quot; &amp;" pattern="^[A-Za-z0-9\.\\,\+:&amp;;'#\(\)\-\'\&quot; ]+$"/>
               
             </div>
              <div class='error_message'><?=form_error('publisher')?></div>
              <div class="input-group input-group-md" align="right">
                <span class="input-group-addon">  Publication Year:  </span>
                <input name="year" class="form-control44" type="number" min="1900" max="<?php echo date('Y'); ?>" maxlength='4' id="inputYear" >
               
             </div>
              <div class='error_message'><?=form_error('year')?></div>
             <div class="input-group input-group-md" align="right">
                <span class="input-group-addon"> Access Type:  </span>
                <select name = "access_type" class = "form-control15" id = "inputAccess">
                                <option value = 'S'>Student</option>
                                <option value = 'F'>Faculty</option>
                            </select>
                           
            </div>
             <div class='error_message'><?=form_error('access_type')?></div>
                <div class="input-group input-group-md" align="right">
                    <span class="input-group-addon">  Course Code:  </span>
                    <input name="course_code" class="form-control1"type="text" id="inputCoursecode" maxlength='8' title='Must be 3-8 characters having starting with two to four uppercase characters followed by an optional space, ending with a one to three digit/s.' pattern = "^[A-Z]{2,4}[ ]{0,1}[0-9]{1,3}$" required/> 
                    
                </div>
            <div class='error_message'><?=form_error('course_code')?></div>
                <div class="input-group input-group-md" align="right">
                    <span class="input-group-addon">  Total Available:  </span>
                    <input name="total_available" class="form-control1" type="number" id="inputTotalSt" min="1" required>
                   
                </div>
                 <div class='error_message'><?=form_error('total_available')?></div>
                 <div class="input-group input-group-md" align="right">
                    <span class="input-group-addon">  Total Stock:  </span>
                   <input name="total_stock" class="form-control1" type="number" id="inputTotalSt" min="1" required> </td>
                   
                </div>
             <div class='error_message'><?=form_error('total_stock')?></div>
             <input id="button_ref" class="btn btn-success" type="submit" name="submit" value="Add Reference">              
            <?= form_close(); ?>
           <a href="<?= site_url('librarian/index') ?>"><button class="btn btn-danger" id="back_button5">Back</button></a>
           <br/>
           <br/>
        </div>

        <script>
            $(window).load(function(){
                setTimeout(function(){ $('#alertmessage').fadeOut() }, 3000);
            });
        </script>
<?php $this->load->view('includes/footer') ?>