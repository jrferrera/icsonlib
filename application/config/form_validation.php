<?php

	$config = array(
            	'login' => array(
                	            array(
	                                    'field' => 'username',
	                                    'label' => 'Username',
	                                    'rules' => 'min_length[6]|max_length[30]|valid_username|required|htmlspecialchars|trim'
	                                    //^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$
	                                ),
	                            array(
	                                    'field' => 'password',
	                                    'label' => 'Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|required|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                )
	                        ),
	            'registration' => array(
	                            array(
	                                    'field' => 'first_name',
	                                    'label' => 'First name',
	                                    'rules' => 'min_length[2]|max_length[32]|valid_first_name|required|htmlspecialchars|trim'
	                                    //^([A-Za-z0-9]+[ ]{0,1}[A-Za-z0-9]+)+$
	                                ),
	                            array(
	                                    'field' => 'middle_name',
	                                    'label' => 'Middle name',
	                                    'rules' => 'min_length[0]|max_length[32]|valid_middle_name|htmlspecialchars|trim'
	                                    //^[A-Za-z ]+$
	                                ),
	                            array(
	                                    'field' => 'last_name',
	                                    'label' => 'Last name',
	                                    'rules' => 'min_length[2]|max_length[32]|valid_last_name|required|htmlspecialchars|trim'
	                                    //^([A-Za-z\s])+[-]{0,1}+([A-Za-z\s])+$
	                                ),
	                             array(
	                                    'field' => 'username',
	                                    'label' => 'Username',
	                                    'rules' => 'min_length[6]|max_length[30]|valid_username|is_unique[users.username]|required|htmlspecialchars|trim'
	                                    //^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$
	                                ),
	                             array(
	                                    'field' => 'password',
	                                    'label' => 'Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|matches[repass]|required|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                ),
	                             array(
	                                    'field' => 'repass',
	                                    'label' => 'Confirm Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|required|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                ),
	                             array(
	                                    'field' => 'contact_number',
	                                    'label' => 'Contact Number',
	                                    'rules' => 'min_length[7]|max_length[15]|valid_contact_number|required|htmlspecialchars|trim'
	                                    //[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+
	                                ),
	                             array(
	                                    'field' => 'email_address',
	                                    'label' => 'E-mail Address',
	                                    'rules' => 'min_length[2]|max_length[60]|valid_email_address|is_unique[users.email_address]|required|htmlspecialchars|trim'
	                                    //^([a-zA-Z\+]+)([\.\_\-]{0,1}[a-zA-Z0-9\+]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$
	                                ),
	                             array(
	                                    'field' => 'college_address',
	                                    'label' => 'College Address',
	                                    'rules' => 'min_length[19]|max_length[200]|valid_address|required|htmlspecialchars|trim'
	                                    //^([A-Za-z0-9\.\\,\/'#-]+[ ]{0,1})+$
	                                ),
	                             array(
	                                    'field' => 'user_type',
	                                    'label' => 'User type',
	                                    'rules' => 'min_length[1]|max_length[1]|valid_register_user_type|required|htmlspecialchars|trim'
	                                    //^[SF]{1}$     registration
	                                    //^[AL]{1}$     create user
	                                ),
	                             array(
	                                    'field' => 'student_number',
	                                    'label' => 'Student number',
	                                    'rules' => 'min_length[10]|max_length[10]|valid_student_number|is_unique[users.student_number]|required|htmlspecialchars|trim'
	                                    //^[0-9]{4}-[0-9]{5}$
	                                ),
	                             array(
	                                    'field' => 'college',
	                                    'label' => 'College',
	                                    'rules' => 'min_length[2]|max_length[6]|valid_college|required|htmlspecialchars|trim'
	                                    //(CA-CAS|CAS|CA|CDC|CEM|CEAT|CFNR|CHE|CVM|GS)
	                                ),
	                             array(
	                                    'field' => 'degree',
	                                    'label' => 'Degree',
	                                    'rules' => 'min_length[2]|max_length[12]|valid_degree|required|htmlspecialchars|trim'
	                                    //(^([A-Za-z])+$)
	                                )
	                        ),
	            'add_book' => array(
	                            array(
	                                    'field' => 'title',
	                                    'label' => 'Title',
	                                    'rules' => 'min_length[1]|max_length[500]|valid_title|required|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\" ]+$
	                                ),
	                            array(
	                                    'field' => 'author',
	                                    'label' => 'Author',
	                                    'rules' => 'min_length[2]|max_length[255]|valid_author|required|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9,&-\. ]+$
	                                ),
	                            array(
	                                    'field' => 'isbn',
	                                    'label' => 'ISBN',
	                                    'rules' => 'min_length[13]|max_length[13]|valid_isbn|htmlspecialchars|trim'
	                                    //(^[0-9]+\-[0-9]+\-[0-9]+\-[0-9]+$)
	                                ),
	                            array(
	                                    'field' => 'category',
	                                    'label' => 'Category',
	                                    'rules' => 'min_length[1]|max_length[1]|valid_category|required|htmlspecialchars|trim'
	                                    ///^[BMTSCJ]$/
	                                ),
	                            array(
	                                    'field' => 'description',
	                                    'label' => 'Description',
	                                    'rules' => 'min_length[0]|max_length[65535]|valid_description|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\" ]+$
	                                ),
	                            array(
	                                    'field' => 'publisher',
	                                    'label' => 'Publisher',
	                                    'rules' => 'min_length[0]|max_length[100]|valid_publisher|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\" ]+$
	                                ),
	                            array(
	                                    'field' => 'year',
	                                    'label' => 'Publication year',
	                                    'rules' => 'min_length[4]|max_length[4]|valid_year|htmlspecialchars|trim'
	                                    //(^[0-9]{4}$)
	                                ),
	                            array(
	                                    'field' => 'access_type',
	                                    'label' => 'Access type',
	                                    'rules' => 'min_length[1]|max_length[1]|valid_access_type|required|htmlspecialchars|trim'
	                                    //^[SF]$
	                                ),
	                            array(
	                                    'field' => 'course_code',
	                                    'label' => 'Course code',
	                                    'rules' => 'min_length[2]|max_length[8]|valid_course_code|required|htmlspecialchars|trim'
	                                    //^[A-Z]{2,4}[ ]{0,1}[0-9]{1,3}$
	                                ),
	                            array(
	                                    'field' => 'total_available',
	                                    'label' => 'Total available',
	                                    'rules' => 'min_length[0]|max_length[6]|is_natural|required|htmlspecialchars|trim'
	                                    //^[0-9]+$
	                                ),
	                            array(
	                                    'field' => 'total_stock',
	                                    'label' => 'Total stock',
	                                    'rules' => 'min_length[0]|max_length[6]|is_natural|required|htmlspecialchars|trim'
	                                    //^[0-9]+$
	                                )
	                        ),
	            'create_account' => array(
	                            array(
	                                    'field' => 'employee_no',
	                                    'label' => 'Employee number',
	                                    'rules' => 'min_length[9]|max_length[9]|is_natural|is_unique[users.employee_number]|required|htmlspecialchars|trim'
	                                    ///^[0-9]+$/
	                                ),
	                            array(
	                                    'field' => 'first_name',
	                                    'label' => 'First name',
	                                    'rules' => 'min_length[2]|max_length[32]|valid_first_name|required|htmlspecialchars|trim'
	                                    //^([A-Za-z0-9]+[ ]{0,1}[A-Za-z0-9]+)+$
	                                ),
	                            array(
	                                    'field' => 'middle_name',
	                                    'label' => 'Middle name',
	                                    'rules' => 'min_length[0]|max_length[32]|valid_middle_name|htmlspecialchars|trim'
	                                    //^[A-Za-z ]+$
	                                ),
	                            array(
	                                    'field' => 'last_name',
	                                    'label' => 'Last name',
	                                    'rules' => 'min_length[2]|max_length[32]|valid_last_name|required|htmlspecialchars|trim'
	                                    //^([A-Za-z\s])+[-]{0,1}+([A-Za-z\s])+$
	                                ),
	                            array(
	                                    'field' => 'user_type',
	                                    'label' => 'User type',
	                                    'rules' => 'min_length[1]|max_length[1]|valid_create_user_type|required|htmlspecialchars|trim'
	                                    //^[SF]{1}$     registration
	                                    //^[AL]{1}$     create user
	                                ),
	                            array(
	                                    'field' => 'username',
	                                    'label' => 'Username',
	                                    'rules' => 'min_length[6]|max_length[30]|valid_username|is_unique[users.username]|required|htmlspecialchars|trim'
	                                    //(^[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$)
	                                ),
	                            array(
	                                    'field' => 'password',
	                                    'label' => 'Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|matches[confirm_password]|required|htmlspecialchars|trim'
	                                    //(^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$)
	                                ),
	                            array(
	                                    'field' => 'confirm_password',
	                                    'label' => 'Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|required|htmlspecialchars|trim'
	                                    //(^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$)
	                                ),
	                            array(
	                                    'field' => 'college_address',
	                                    'label' => 'College Address',
	                                    'rules' => 'min_length[19]|max_length[200]|valid_address|required|htmlspecialchars|trim'
	                                    //([A-Za-z0-9\.\\,# ]+)
	                                ),
	                            array(
	                                    'field' => 'email_address',
	                                    'label' => 'E-mail Address',
	                                    'rules' => 'min_length[2]|max_length[60]|valid_email_address|is_unique[users.email_address]|required|htmlspecialchars|trim'
	                                    //^([a-zA-Z\+]+)([\.\_\-]{0,1}[a-zA-Z0-9\+]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$
	                                ),
	                            array(
	                                    'field' => 'contact',
	                                    'label' => 'Contact Number',
	                                    'rules' => 'min_length[7]|max_length[11]|valid_contact_number|required|htmlspecialchars|trim'
	                                    //[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+
	                                )
	                        ),
				'edit_account' => array(
								array(
	                                    'field' => 'last_name',
	                                    'label' => 'Last name',
	                                    'rules' => 'min_length[2]|max_length[32]|valid_last_name|htmlspecialchars|trim'
	                                    //^([A-Za-z\s])+[-]{0,1}+([A-Za-z\s])+$
	                                ),
	                            array(
	                                    'field' => 'first_name',
	                                    'label' => 'First name',
	                                    'rules' => 'min_length[2]|max_length[32]|valid_first_name|required|htmlspecialchars|trim'
	                                    //^([A-Za-z0-9]+[ ]{0,1}[A-Za-z0-9]+)+$
	                                ),
	                            array(
	                                    'field' => 'middle_name',
	                                    'label' => 'Middle name',
	                                    'rules' => 'min_length[0]|max_length[32]|valid_middle_name|htmlspecialchars|trim'
	                                    //^[A-Za-z ]+$
	                                ),
	                             array(
	                                    'field' => 'username',
	                                    'label' => 'Username',
	                                    'rules' => 'min_length[6]|max_length[30]|valid_username|is_unique[users.username]|required|htmlspecialchars|trim'
	                                    //^([A-Za-z\s])+[- ]{0,1}([A-Za-z\s])+$
	                                ),
	                             array(
	                                    'field' => 'new_password',
	                                    'label' => 'Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|matches[confirm_password]|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                ),
	                             array(
	                                    'field' => 'confirm_password',
	                                    'label' => 'Confirm Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                ),
	                             array(
	                                    'field' => 'contact',
	                                    'label' => 'Contact Number',
	                                    'rules' => 'min_length[7]|max_length[15]|valid_contact_number|required|htmlspecialchars|trim'
	                                    //[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+
	                                ),
	                             array(
	                                    'field' => 'email_address',
	                                    'label' => 'E-mail Address',
	                                    'rules' => 'min_length[2]|max_length[60]|valid_email_address|is_unique[users.email_address]|required|htmlspecialchars|trim'
	                                    //^([a-zA-Z\+]+)([\.\_\-]{0,1}[a-zA-Z0-9\+]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$
	                                ),
	                             array(
	                                    'field' => 'college_address',
	                                    'label' => 'College Address',
	                                    'rules' => 'min_length[19]|max_length[200]|valid_address|required|htmlspecialchars|trim'
	                                    //^([A-Za-z0-9\.\\,\/'#-]+[ ]{0,1})+$
	                                ),
	                 
	                             array(
	                                    'field' => 'college',
	                                    'label' => 'College',
	                                    'rules' => 'min_length[2]|max_length[6]|valid_college|required|htmlspecialchars|trim'
	                                    //(CA-CAS|CAS|CA|CDC|CEM|CEAT|CFNR|CHE|CVM|GS)
	                                ),
	                             array(
	                                    'field' => 'degree',
	                                    'label' => 'Degree',
	                                    'rules' => 'min_length[2]|max_length[12]|valid_degree|required|htmlspecialchars|trim'
	                                    //(^([A-Za-z])+$)
	                                )
	                        ),
				'edit_profile' => array(
	                             array(
	                                    'field' => 'username',
	                                    'label' => 'Username',
	                                    'rules' => 'min_length[6]|max_length[30]|valid_username|is_unique[users.username]|required|htmlspecialchars|trim'
	                                    //^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$
	                                ),
	                             array(
	                                    'field' => 'oldpassword',
	                                    'label' => 'Old password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                ),
	                             array(
	                                    'field' => 'password',
	                                    'label' => 'Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|matches[repassword]|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                ),
	                             array(
	                                    'field' => 'repassword',
	                                    'label' => 'Confirm Password',
	                                    'rules' => 'min_length[6]|max_length[32]|valid_password|htmlspecialchars|trim'
	                                    //^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$
	                                ),
	                             array(
	                                    'field' => 'contact_number',
	                                    'label' => 'Contact Number',
	                                    'rules' => 'min_length[7]|max_length[15]|valid_contact_number|required|htmlspecialchars|trim'
	                                    //[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+
	                                ),
	                             array(
	                                    'field' => 'college_address',
	                                    'label' => 'College address',
	                                    'rules' => 'min_length[19]|max_length[200]|valid_address|required|htmlspecialchars|trim'
	                                    //^([A-Za-z0-9\.\\,\/'#-]+[ ]{0,1})+$
	                                )
	                        ),
				'edit_reference' => array(
	                            array(
	                                    'field' => 'title',
	                                    'label' => 'Title',
	                                    'rules' => 'min_length[1]|max_length[500]|valid_title|required|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\" ]+$
	                                ),
	                            array(
	                                    'field' => 'author',
	                                    'label' => 'Author',
	                                    'rules' => 'min_length[2]|max_length[255]|valid_author|required|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9,&-\. ]+$
	                                ),
	                            array(
	                                    'field' => 'isbn',
	                                    'label' => 'ISBN',
	                                    'rules' => 'min_length[13]|max_length[13]|valid_isbn|htmlspecialchars|trim'
	                                    //(^[0-9]+\-[0-9]+\-[0-9]+\-[0-9]+$)
	                                ),
	                            array(
	                                    'field' => 'category',
	                                    'label' => 'Category',
	                                    'rules' => 'min_length[1]|max_length[1]|valid_category|required|htmlspecialchars|trim'
	                                    ///^[BMTSCJ]$/
	                                ),
	                            array(
	                                    'field' => 'description',
	                                    'label' => 'Description',
	                                    'rules' => 'min_length[0]|max_length[65535]|valid_description|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\" ]+$
	                                ),
	                            array(
	                                    'field' => 'publisher',
	                                    'label' => 'Publisher',
	                                    'rules' => 'min_length[0]|max_length[100]|valid_publisher|htmlspecialchars|trim'
	                                    //^[A-Za-z0-9\.\\,\+:&;'#\(\)\-\'\" ]+$
	                                ),
	                            array(
	                                    'field' => 'publication_year',
	                                    'label' => 'Publication year',
	                                    'rules' => 'min_length[4]|max_length[4]|valid_year|htmlspecialchars|trim'
	                                    //(^[0-9]{4}$)
	                                ),
	                            array(
	                                    'field' => 'access_type',
	                                    'label' => 'Access type',
	                                    'rules' => 'min_length[1]|max_length[1]|valid_access_type|required|htmlspecialchars|trim'
	                                    //^[SF]$
	                                ),
	                            array(
	                                    'field' => 'course_code',
	                                    'label' => 'Course code',
	                                    'rules' => 'min_length[2]|max_length[8]|valid_course_code|required|htmlspecialchars|trim'
	                                    //^[A-Z]{2,4}[ ]{0,1}[0-9]{1,3}$
	                                ),
	                            array(
	                                    'field' => 'total_stock',
	                                    'label' => 'Total stock',
	                                    'rules' => 'min_length[1]|max_length[6]|is_natural|required|htmlspecialchars|trim'
	                                    //^[0-9]+$
	                                )
	                        )
	            );

?>