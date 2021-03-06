<?php

	function lang($phrase) {

		static $lang = array(

			// Header

			//=============================
			//			Navbar Links
			//=============================	
			'Serve'			=>		"خدماتنا",
			'LangNotActive' =>       'English',
			
			'Logout'		=>		 'تسجيل خروج',
			"ManageTeamWork"=>		"فريق العمل",
			"ManagePartners"=>		"اولياء الامور",
			"ViewParents"	=>		"شركائنا",
	
			//=============================	
			'MUsers'		=>		"ادارة المستخدمين",
			//=============================	

			'TimeSheet'		=>		"ادراة الوقت",
			//=============================
			'Login'			=>		'تسجيل دخول',
			'ChangeUserData'=>'تعديل بيانات المستخدم',
			//=============================
			"NuserName"	=> "ادخل اسم المستخدم ",
			"NPassword"	=> "  ادخل كلمة المرور ",

			"CuserName"	=> "ادخل الاسم الجديد للمستخدم",
			"CPassword"	=> "  ادخل كلمة المرور الجديدة",

			"confirmPassword"	=> "ادخل كلمة تاكيد المرور",
			
			//=============================	
			'ETeamWork'		=>		"تقيم فريق العمل",
			//=============================
			'Evaluation'		=>		"تقيم",
			
			//=============================	
			'EPartner'		=>		"تقيم الشريك",
			//=============================
 			 'ETrustiness'		 =>'المصدقية' ,
			 'ETimeness'		 => 'التزام بالمواعيد',
			 'EGoodness'		 => 'الجوده' ,


			//=============================	
			'Partners'		=>		"شركائنا",
			//=============================
			'PartnerID'			 =>	"اسم الشريك",
			'Title'			 =>	"اسم الشريك",
			//=============================	
			'TeamWork'		=>		"فريق العمل",
			//=============================
			'TeacherID'		=>		"اسم المدرس",
			'TName'			=>		"اسم المدرس",
			'Specialization'=>'التخصص',
			//=============================
				'Parents'		=>		"ولى الامر" ,
			//=============================	
				'SearchByFname' =>		"بحث من خلال اسم الاب" ,
				'PNO'			=>		"رقم الملف",
				'FatherName'	=>		"اسم الاب",
				'MotherName'	=>		'اسم الام',

				'UserName'		=>		"اسم المستخدم" ,
				'Password'		=>		"كلمة المرور",
				'IsActive'		=>		'فعال',
				"Disabled"		=>		"معطل",
				"Enabled"		=>		"مفعل",
  
			//=============================
			'Contact'	=>		"للتواصل" ,
			//=============================	
			'CType'			=>		"وسيلة التواصل",
			'CValue'		=>		' معلومات التواصل',
			
			//=============================
			'Children'	=>		"الاولاد" ,
			//=============================	
			'CName'			=>		"اسم الطفل",
			'BDate'			=>		'تاريخ الميلاد',


			//=============================
			'ChildrenAttendance'	=>		"متابعة المواعيد" ,
			//=============================	
			'RDate'			=>		"التاريخ",
			'TAttendance'	=>		"الحضور",
			'Tleave'		=>		"الانصراف",
					
					
						

			//=============================
			'ChildrenReport'	=>		"متابعة الطفل" ,
			//=============================	
			'NPriority'		=>		"الاهمية",
			'url'			=>		"عنوان الموقع",
			'Notes'			=>		'ملاحظات',

			//=============================
			'Payment'	=>		"الدفع" ,
			//=============================	
			'PayValue'			=>		"قيمة الدفع",
			'PDate'		  		=>		'تاريخ الدفع',
			'SDate'				=>		"البداء",
			'EDate'		  		=>		'الانتهاء ',
		//=============================
		'ImageUploader'		=>		"رافع الصور" ,
		//=============================	
		'Addfiles'			=>		"اضاقة ملف...",
		'Supload'		    =>		'بداء التحميل',
		'Cupload'			=>		"الغاء التحميل",
		'Sup'		    =>		'بداء ',
		'Cup'			=>		"الغاء ",
		'Dfile'			=>		"مسح",
		'Close'		  		=>		'اغلاق',
			//=============================
			//			footer
			//=============================	
			'ContactUS'		 =>		'للتواصل معنا',
 

			//=============================
			//		CSS Classes
			//=============================	
			'Clang'			=>		"AR",
			//=============================
			//		CSS Style
			//=============================	
			'Sdirection'	=>		"direction:rtl",
			'Stext-align'	=>		"text-align:right"
			
			//=============================
			//		JS Scripts
			//=============================	
			//'lang'			=>		"EN"


			

			
		);





	  
			


		return (array_key_exists($phrase,$lang)?$lang[$phrase]:$phrase);

	}
