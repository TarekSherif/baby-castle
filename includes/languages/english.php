<?php

	function lang($phrase) {

		static $lang = array(

			// Header

			//=============================
			//			Navbar Links
			//=============================	
			'Serve'			=>		"Serve",
			'LangNotActive' =>       'عربي',
			'Logout'		=>		 'log out',
			"ManageTeamWork"=>		"TeamWork",
			"ManagePartners"=>		"Partners",
			"ViewParents"	=>		"Parents",
			'TimeSheet'		=>		"TimeSheet",
			
			//=============================
			'Login'			=>		'Login',
			'ChangeUserData'=>'Change User Data',
			//=============================
			"NuserName"	=> "Type your username",
			"NPassword"	=> "Type  your  Password",
			
			"CuserName"	=> "Type your new username",
			"CPassword"	=> " Type  your New Password",

			"confirmPassword"	=> "confirm Password",
			//=============================	
			'ETeamWork'		=>		"Evaluation TeamWork",
			//=============================
			'Evaluation'		=>		"Evaluation",
			
			//=============================	
			'EPartner'		=>		"Evaluation Partner",
			//=============================
 			 'ETrustiness'		 =>'Trustiness' ,
			 'ETimeness'		 => 'Timeness',
			 'EGoodness'		 => 'Goodness' ,


			//=============================	
			'Partners'		=>		"Partners",
			//=============================
			'PartnerID'			 =>	"Partner Name",
			'Title'			 =>	"Partner Name",
			//=============================	
			'TeamWork'		=>		"TeamWork",
			//=============================
			'TeacherID'		=>		"Teacher Name",
			'TName'			=>		"Teacher Name",
			'Specialization'=>'Specialization',
			//=============================
				'Parents'		=>		"Parents" ,
			//=============================	
				'SearchByFname' => 		"Search By Father Name",
				'PNO'			=>		"Parents NO.",
				'FatherName'	=>		"Father Name",
				'MotherName'	=>		'Mother Name',

				'UserName'		=>		"User Name" ,
				'Password'		=>		"Password",
				'IsActive'		=>		'Is Active',
				"Disabled"		=>		"Disabled",
				"Enabled"		=>		"Enabled",
  
			//=============================
			'Contact'	=>		"Parents Contact" ,
			//=============================	
			'CType'			=>		"Contact Type",
			'CValue'		=>		'Contact Value',
			
			//=============================
			'Children'	=>		"Children" ,
			//=============================	
			'CName'			=>		"Child s Name",
			'BDate'			=>		'Date of Birth',

			//=============================
			'ChildrenAttendance'	=>		"Children Attendance" ,
			//=============================	
			'RDate'			=>		"Report Date",
			'TAttendance'	=>		"Attendance",
			'Tleave'		=>		"leave",

		
			//=============================
			'ChildrenReport'	=>		"Children Report" ,
			//=============================	
			'NPriority'		=>		"Priority",
			'url'			=>		"URL",
			'Notes'			=>		'Notes',

			//=============================
			'Payment'	=>		"Payment" ,
			//=============================	
			'PayValue'			=>		"PayValue",
			'PDate'		  		=>		'Payment Date',
			'SDate'				=>		"Start Date",
			'EDate'		  		=>		'End Date',

			//=============================
			'ImageUploader'		=>		"Image Uploader" ,
			//=============================	
			'Addfiles'			=>		"Add files...",
			'Supload'		    =>		'Start upload',
			'Sup'				=>		"Start",
			'Cupload'			=>		"Cancel uploade",
			'Cup'				=>		"Cancel",
			'Dfile'				=>		"Delete",
			'Close'		  		=>		'Close',


			
			//=============================
			//			footer
			//=============================	
			'ContactUS'		 =>		'Contact US',
 

			//=============================
			//		CSS Classes
			//=============================	
			'Clang'			=>		"EN",

			//=============================
			//		CSS Style
			//=============================	
			'Sdirection'	=>		"direction:ltr",
			'Stext-align'	=>		"text-align:left"
			
			//=============================
			//		JS Scripts
			//=============================	
			//'lang'			=>		"EN"


			


			
		);





	  
			


		return  (array_key_exists($phrase,$lang)?$lang[$phrase]:$phrase);

	}
