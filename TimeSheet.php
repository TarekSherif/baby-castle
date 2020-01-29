<?php


   $Page=array();
   $Page["Title"]= 'TimeSheet';
   $Page["Permission"]=array("Admin","TeamWork");
   $Page["Include"]=array("language","header","Nav","jtable","footer","script");
   
   //  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
   //  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script"); 
   
       include 'init.php';
?>


<div id="jtableContainer" class="<?php echo lang('Clang'); ?>" >
<form   role="search">
    <div class="input-group">
        <input  type="text" class="form-control"  placeholder="Search" onblur="(this.type='text')"    onfocus="(this.type='date')"  name="Txt-Search" id="Txt-Search">
        <div class="input-group-btn">
            <button class="btn btn-default btn-lg" id="BtnSearch"   type="submit"><i class="glyphicon glyphicon-search"></i></button>
            <button class="btn btn-default btn-lg"   id="BtnNow"  type="submit"><i class="fa fa-calendar-check-o "></i></button>
            
        </div>
    </div>
 </form>
 <br>
</div>
<script type="text/javascript">

    $jt(function () {
        
        var d = new Date();
        var mm = d.getMonth() + 1;
        var dd = d.getDate();
        var yy = d.getFullYear();
        var myDateString = yy + '-' + mm + '-' + dd;
    
        $jt('#jtableContainer').jtable({
           
         
            title:'<i class="fa fa-calendar  fa-2x"></i> <?php echo lang('ChildrenAttendance');  ?>',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'RDate ASC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            actions: {
                listAction:   '<?php echo $func ?>ActionWorkDays.php?action=list' ,
                <?php 
                    if($UserType=="Admin")
                    {?>
                createAction: '<?php echo $func ?>ActionWorkDays.php?action=create',
                deleteAction: '<?php echo $func ?>ActionWorkDays.php?action=delete'
                <?php 
                   }?>
            },
            fields: {
                DayReport:{

               
                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (WorkDayData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-paper-plane -o fa-3x" aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            // console.log('<?php echo $func ?>ActionChildrenReport.php?action=list&CNO='+ ChildrenData.record.CNO +'&RDate='+ChildrenData.record.RDate)
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-paper-plane -o fa-2x"></i> <?php echo lang('ChildrenReport');  ?>',
                                        // paging: true,
                                        // pageSize: 10,
                                        // sorting: true,
                                        // defaultSorting: 'NPriority ASC',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionDayReport.php?action=list&RDate='+WorkDayData.record.RDate,
                                            createAction: '<?php echo $func ?>ActionDayReport.php?action=create',
                                            <?php 
                                            if($UserType=="Admin")
                                            {?> 
                                            updateAction: '<?php echo $func ?>ActionDayReport.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionDayReport.php?action=delete'
                                            <?php 
                                           }
                                           ?> 
                                            
                                        },
                                        fields: {
                                        
                                            DRID: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false
                                            },
                                            RDate: {
                                                type: 'hidden',
                                                defaultValue: WorkDayData.record.RDate
                                                    
                                            },
                                            ReportComment: {

           


                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (ReportData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa fa-comments-o fa-fw  fa-3x" style="color: #b90606;" aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa fa-comments-o fa-fw  fa-2x" style="color: #b90606;"></i> - <?php echo lang('ReportComment');  ?>',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionReportComment.php?action=list&DRID='+ ReportData.record.DRID ,
                                          
                                            createAction: '<?php echo $func ?>ActionReportComment.php?action=create',
                                            <?php 
                                            if($UserType=="Admin")
                                            {?> 
                                            updateAction: '<?php echo $func ?>ActionReportComment.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionReportComment.php?action=delete'
                                            <?php }?>
                                        },
                                        fields: {

//                                             CREATE TABLE `ReportComment` (
//    `RCID` INT AUTO_INCREMENT ,
//    `DRID` INT NOT NULL , 
//    `UserID` INT NOT NULL,
//    `Comment` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
//    PRIMARY KEY (`RCID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                            RCID: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false,
                                            },
                                            DRID: {
                                                type: 'hidden',
                                                defaultValue: ReportData.record.DRID
                                            },
                                          
                                            UserID: {
                                                title: '<?php echo lang('UserID');  ?>',
                                                create: false,
                                                edit: false,
                                                list: true,
                                                width: '30%',
                                                options: '<?php echo $func?>GetOptionList.php?do=UserList',
                                                visibility: 'fixed',
                                                inputClass: 'validate[required] form-control'
                                            },
                                            Comment: {
                                                title: ' <?php echo lang('Comment');  ?>',
                                                width: '30%',
                                                type:'textarea',
                                                visibility: 'fixed',
                                                inputClass: 'form-control'
                                            },
                                           
                                        },
                                        //Initialize validation logic when a form is created
                                        formCreated: function (event, data) {
                                            data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
                                        },
                                        //Validate form when it is being submitted
                                        formSubmitting: function (event, data) {
                                            return data.form.validationEngine('validate');
                                        },
                                        //Dispose validation logic when form is closed
                                        formClosed: function (event, data) {
                                            data.form.validationEngine('hide');
                                            data.form.validationEngine('detach');
                                        }
                                       }, function (data) { //opened handler
                                            data.childTable.jtable('load');
                                        });
                            });
                            //Return image to show on the person row
                            return $img;
                        }
                    },

                                            images: {
                                                title: '',
                                                visibility: 'fixed', 
                                                width: '5%',
                                                sorting: false,
                                                edit: false,
                                                create: false,
                                                display: function (PostData) {
                                                    //Create an image that will be used to open child table
                                                    var $img = $jt('<i class="fa fa-picture-o fa-3x"  data-toggle="modal" data-target="#UpLoadModal" aria-hidden="true"></i>');
                                                    //Open child table when user clicks the image
                                        $img.click(function () {
                                            var D = new Date(PostData.record.RDate);
                                            var FilePath="DayReport/"+D.getFullYear()+"/"+(D.getMonth()+1)+"/"+D.getDate()+"/"+PostData.record.DRID;
                                            var  modal_body= $(".file-UpLoad");
                                            $(modal_body).find("iframe").remove();
                                            $(modal_body).html('<iframe class="animated zoomIn" src="layout/FileUploader/FileUploader.php?FilePath='+FilePath+'" style="width:100%;height:100%;"></iframe>');
                                        });
                                        //Return image to show on the person row
                                        return $img;
                                    }
                                }, 

                                        RUrl: {
                                            title: '',
                                            width: '5%',
                                            sorting: false,
                                            visibility: 'fixed', 
                                            display: function (PostData) {
                                                var $img ;
                                                if (PostData.record.RUrl)
                                                {
                                                    $img=  $jt('<a  target="_blank" href="'+PostData.record.RUrl+'"><i class="fa fa-youtube fa-3x" style="color:red"  aria-hidden="true"></i></a>');
                                                }else{
                                                    $img=  $jt('<i class="fa fa-youtube fa-3x"  aria-hidden="true"></i>');  
                                                }

                                                                                                                            
                                                            return $img;
                                                        },
                                                                        
                                                    input: function (data) {
                                                        if (data.record) {
                                                            return '<input type="url"  placeholder=" <?php echo lang('url');  ?>"   class="validate[custom[url]] form-control"   autocomplete="off"   name="RUrl"   value="' + data.record.RUrl + '" />';
                                                        } else {
                                                            return '<input type="url"  placeholder=" <?php echo lang('url');  ?>"     class="validate[custom[url]] form-control"  autocomplete="off"   name="RUrl"     />';
                                                        }
                                                    }  
                                                },
                
                                            NPriority: {
                                                title: '<?php echo lang('NPriority');  ?>',
                                                width: '10%',
                                                options: '<?php echo $func?>GetOptionList.php?do=Priority',
                                                inputClass: 'validate[required] form-control'
                                                
                                            },
                                            Notes: {
                                                title: ' <?php echo lang('Notes');  ?>',
                                                width: '30%',
                                                type:'textarea',
                                                visibility: 'fixed',
                                                inputClass: 'validate[required] form-control'
                                            },
                                        
                                        },
                                        //Initialize validation logic when a form is created
                                        formCreated: function (event, data) {
                                            data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
                                        },
                                        //Validate form when it is being submitted
                                        formSubmitting: function (event, data) {
                                            return data.form.validationEngine('validate');
                                        },
                                        //Dispose validation logic when form is closed
                                        formClosed: function (event, data) {
                                            data.form.validationEngine('hide');
                                            data.form.validationEngine('detach');
                                        }
                                    }, function (data) { //opened handler
                                        data.childTable.jtable('load');
                                    });
                        });
                        //Return image to show on the person row
                        return $img;
                    }
                                            },
                                   









                RDate: {
                    key:true,
                    create: true,
                    edit: true,
                    list: true,
                   title: ' <?php echo lang('RDate');  ?>',
                    width: '50%',
                    visibility: 'fixed', 
                    
                    input: function (data) {
                        if (data.record) {
                            return '<input type="text"  placeholder=" <?php echo lang('RDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)" class="validate[required,custom[date]] form-control"   autocomplete="off"   name="RDate"   value="' + data.record.RDate + '" />';
                        } else {
                            return '<input type="text"   placeholder=" <?php echo lang('RDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)" class="validate[required,custom[date]] form-control"  autocomplete="off"   name="RDate"   value='+myDateString+'  />';
                        }
                    }   ,
                    display: function (WorkDayData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<div>'+WorkDayData.record.RDate+'</div>');
                        //Open child table when user clicks the image
                    
                        $img.click(function () {
                   

                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        
            title:'<i class="fa fa-calendar  fa-2x"></i> <?php echo lang('ChildrenAttendance');  ?>',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'TAttendance ASC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            actions: {
                listAction:   '<?php echo $func ?>ActionChildrenAttendance.php?action=list&RDate='+WorkDayData.record.RDate,
                createAction: '<?php echo $func ?>ActionChildrenAttendance.php?action=create',
                    <?php  if($UserType=="Admin")
                    {?> 
                   updateAction: '<?php echo $func ?>ActionChildrenAttendance.php?action=update',
                   deleteAction: '<?php echo $func ?>ActionChildrenAttendance.php?action=delete&RDate='+WorkDayData.record.RDate
                    <?php }?>
                
            },
            fields: {
                RDate: {
                    type: 'hidden',
                    defaultValue: WorkDayData.record.RDate           
                }, 
                ChildrenReport: {


                                        title: '',
                                        width: '5%',
                                        sorting: false,
                                        edit: false,
                                        create: false,
                                        display: function (ChildrenData) {
                                            //Create an image that will be used to open child table
                                            var $img = $jt('<i class="fa fa-paper-plane -o fa-3x" aria-hidden="true"></i>');
                                            //Open child table when user clicks the image
                                            $img.click(function () {
                                                // console.log('<?php echo $func ?>ActionChildrenReport.php?action=list&CNO='+ ChildrenData.record.CNO +'&RDate='+ChildrenData.record.RDate)
                                                $jt('#jtableContainer').jtable('openChildTable',
                                                        $img.closest('tr'),
                                                        {
                                                            title:'<i class="fa fa-paper-plane -o fa-2x"></i> <?php echo lang('ChildrenReport');  ?>',
                                                            // paging: true,
                                                            // pageSize: 10,
                                                            // sorting: true,
                                                            // defaultSorting: 'NPriority ASC',
                                                            columnResizable: true,
                                                            columnSelectable: true,
                                                            saveUserPreferences: true,
                                                            actions: {
                                                                listAction:   '<?php echo $func ?>ActionChildrenReport.php?action=list&CNO='+ ChildrenData.record.CNO +'&RDate='+ChildrenData.record.RDate,
                                                                createAction: '<?php echo $func ?>ActionChildrenReport.php?action=create',
                                                                <?php  if($UserType=="Admin")
                                                                {?> 
                                                            updateAction: '<?php echo $func ?>ActionChildrenReport.php?action=update',
                                                            deleteAction: '<?php echo $func ?>ActionChildrenReport.php?action=delete'
                                                                <?php }?>
                
                                                              
                                                            },
                                                            fields: {
                                                            
                                                                DRID: {
                                                                    key: true,
                                                                    create: false,
                                                                    edit: false,
                                                                    list: false
                                                                },
                                                                CNO: {
                                                                    type: 'hidden',
                                                                    defaultValue: ChildrenData.record.CNO
                                                                },
                                                        
                                                                RDate: {
                                                                    type: 'hidden',
                                                                    defaultValue: ChildrenData.record.RDate
                                                                        
                                                                },
                                                        ReportComment: {

           


                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (ReportData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa fa-comments-o fa-fw  fa-3x" style="color: #b90606;" aria-hidden="true"></i>');
                        //Open child table when user clicks the image

                     


                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa fa-comments-o fa-fw  fa-2x" style="color: #b90606;"></i> - <?php echo lang('ReportComment');  ?>',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionReportComment.php?action=list&DRID='+ ReportData.record.DRID ,
                                            createAction: '<?php echo $func ?>ActionReportComment.php?action=create',
                                            <?php 
                                            if($UserType=="Admin")
                                            {?> 
                                            updateAction: '<?php echo $func ?>ActionReportComment.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionReportComment.php?action=delete'
                                            <?php }?>
                                        },
                                        fields: {

//                                             CREATE TABLE `ReportComment` (
//    `RCID` INT AUTO_INCREMENT ,
//    `DRID` INT NOT NULL , 
//    `UserID` INT NOT NULL,
//    `Comment` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
//    PRIMARY KEY (`RCID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                            RCID: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false,
                                            },
                                            DRID: {
                                                type: 'hidden',
                                                defaultValue: ReportData.record.DRID
                                            },
                                          
                                            UserID: {
                                                title: '<?php echo lang('UserID');  ?>',
                                                create: false,
                                                edit: false,
                                                list: true,
                                                width: '30%',
                                                options: '<?php echo $func?>GetOptionList.php?do=UserList',
                                                visibility: 'fixed',
                                                inputClass: 'validate[required] form-control'
                                            },
                                            Comment: {
                                                title: ' <?php echo lang('Comment');  ?>',
                                                width: '30%',
                                                type:'textarea',
                                                visibility: 'fixed',
                                                inputClass: 'form-control'
                                            },
                                           
                                        },
                                        //Initialize validation logic when a form is created
                                        formCreated: function (event, data) {
                                            data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
                                        },
                                        //Validate form when it is being submitted
                                        formSubmitting: function (event, data) {
                                            return data.form.validationEngine('validate');
                                        },
                                        //Dispose validation logic when form is closed
                                        formClosed: function (event, data) {
                                            data.form.validationEngine('hide');
                                            data.form.validationEngine('detach');
                                        }
                                       }, function (data) { //opened handler
                                            data.childTable.jtable('load');
                                        });
                            });
                            //Return image to show on the person row
               
                            return $img;
                        }
                    },

                                                                images: {
                                                                    title: '',
                                                                    visibility: 'fixed', 
                                                                    width: '5%',
                                                                    sorting: false,
                                                                    edit: false,
                                                                    create: false,
                                                                    display: function (PostData) {
                                                                        //Create an image that will be used to open child table
                                                                        var $img = $jt('<i class="fa fa-picture-o fa-3x" style="color: green;"  data-toggle="modal" data-target="#UpLoadModal" aria-hidden="true"></i>');
                                                                        //Open child table when user clicks the image
                                                $img.click(function () {
                                                        var D = new Date(PostData.record.RDate);
                                                        var FilePath="DayReport/"+D.getFullYear()+"/"+(D.getMonth()+1)+"/"+D.getDate()+"/"+PostData.record.DRID;
                                                        var  modal_body= $(".file-UpLoad");
                                                        $(modal_body).find("iframe").remove();
                                                        $(modal_body).html('<iframe   class="animated zoomIn" src="layout/FileUploader/FileUploader.php?FilePath='+FilePath+'" style="width:100%;height:100%;"></iframe>');
                                                    });
                                                            //Return image to show on the person row
                                                            return $img;
                                                        }
                                                    },            RUrl: {
                                                                        title: '',
                                                                        width: '5%',
                                                                        sorting: false,
                                                                        visibility: 'fixed', 
                                                                        display: function (PostData) {
                                                                            var $img ;
                                                                            if (PostData.record.RUrl)
                                                                            {
                                                                             $img=  $jt('<a  target="_blank" href="'+PostData.record.RUrl+'"><i class="fa fa-youtube fa-3x" style="color:red"  aria-hidden="true"></i></a>');
                                                                            }else{
                                                                             $img=  $jt('<i class="fa fa-youtube fa-3x"  aria-hidden="true"></i>');  
                                                                            }
        
                                                                                                                                                        
                                                                                        return $img;
                                                                                    },
                                                                                                    
                                                                                input: function (data) {
                                                                                    if (data.record) {
                                                                                        return '<input type="url"  placeholder=" <?php echo lang('url');  ?>"   class="validate[custom[url]] form-control"   autocomplete="off"   name="RUrl"   value="' + data.record.RUrl + '" />';
                                                                                    } else {
                                                                                        return '<input type="url"  placeholder=" <?php echo lang('url');  ?>"     class="validate[custom[url]] form-control"  autocomplete="off"   name="RUrl"     />';
                                                                                    }
                                                                                }  
                                                                            },
                                                                    
                                  
                                                   
                                                                NPriority: {
                                                                    title: '<?php echo lang('NPriority');  ?>',
                                                                    width: '10%',
                                                                    options: '<?php echo $func?>GetOptionList.php?do=Priority',
                                                                    inputClass: 'validate[required] form-control'
                                                                },
                                                                Notes: {
                                                                    title: ' <?php echo lang('Notes');  ?>',
                                                                    width: '30%',
                                                                    type:'textarea',
                                                                    visibility: 'fixed',
                                                                    inputClass: ' form-control'
                                                                },
                                                            
                                                            },
                                                            //Initialize validation logic when a form is created
                                                            formCreated: function (event, data) {
                                                                data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
                                                            },
                                                            //Validate form when it is being submitted
                                                            formSubmitting: function (event, data) {
                                                                return data.form.validationEngine('validate');
                                                            },
                                                            //Dispose validation logic when form is closed
                                                            formClosed: function (event, data) {
                                                                data.form.validationEngine('hide');
                                                                data.form.validationEngine('detach');
                                                            }
                                                        }, function (data) { //opened handler
                                                            data.childTable.jtable('load');
                                                        });
                                            });
                                            //Return image to show on the person row
                                            return $img;
                                        }
                                    },
       
                Parents: {

           


                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    
                    display: function (FlowChartData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<span><i class="fa fa-male fa-2x" aria-hidden="true"></i> <i class="fa fa-female fa-2x" aria-hidden="true"></i> </span>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-male fa-1x" aria-hidden="true"></i> <i class="fa fa-female fa-1x" aria-hidden="true"></i>  <?php echo lang('Parents');  ?>',
                                        paging: true,
                                        pageSize: 10,
                                        sorting: true,
                                        defaultSorting: 'FatherName ASC',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionParents.php?action=list&CNO='+ FlowChartData.record.CNO ,
                                                },
                                        fields: {
                                            
                                            Contact: {

                    // CREATE TABLE `Contact` (
                    // `CID` int(11) NOT NULL,
                    // `CType` varchar(50) NOT NULL,
                    // `CValue` varchar(50) NOT NULL,
                    // `PNO` int(11) NOT NULL
                    // ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

                    // -- --------------------------------------------------------


                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (ParentsData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-phone fa-3x" style="color: #b90606;" aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-phone fa-2x" style="color: #b90606;"></i> - <?php echo lang('Contact');  ?>',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionContact.php?action=list&UserID='+ ParentsData.record.PNO ,
                                            createAction: '<?php echo $func ?>ActionContact.php?action=create',
                                            <?php 
                                            if($UserType=="Admin")
                                            {?> 
                                            updateAction: '<?php echo $func ?>ActionContact.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionContact.php?action=delete'
                                            <?php }?>
                                        },
                                        fields: {
                                            UserID: {
                                                type: 'hidden',
                                                defaultValue: ParentsData.record.PNO
                                            },
                                            CID: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false
                                            },
                                            CType: {
                                                title: '<?php echo lang('CType');  ?>',
                                                width: '30%',
                                                options: '<?php echo $func?>GetOptionList.php?do=ContactInfo',
                                                visibility: 'fixed',
                                                inputClass: 'validate[required] form-control'
                                            },
                                            CValue: {
                                                title: '<?php echo lang('CValue');  ?>',
                                                width: '30%',
                                                visibility: 'fixed',
                                                
                                                input: function (data) {
                                                    if (data.record) {
                                                        return '<input type="text"  class="validate[required] form-control"  autocomplete="off" placeholder="<?php echo lang('CValue');  ?>" name="CValue"   value="' + data.record.CValue + '" />';
                                                    } else {
                                                        return '<input type="text"  class="validate[required] form-control"  autocomplete="off"  placeholder="<?php echo lang('CValue');  ?>" name="CValue"     />';
                                                    }
                                                }             
                                                                            
                                               

                                            },
                                           
                                        },
                                        //Initialize validation logic when a form is created
                                        formCreated: function (event, data) {
                                            data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
                                        },
                                        //Validate form when it is being submitted
                                        formSubmitting: function (event, data) {
                                            return data.form.validationEngine('validate');
                                        },
                                        //Dispose validation logic when form is closed
                                        formClosed: function (event, data) {
                                            data.form.validationEngine('hide');
                                            data.form.validationEngine('detach');
                                        }
                                        }, function (data) { //opened handler
                                            data.childTable.jtable('load');
                                        });
                            });
                                                    //Return image to show on the person row
                                                    return $img;
                                                }
                                            },
                                            PNO: {
                                                title: '<?php echo lang('PNO');  ?>',
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false

                                                  },
                                            FatherName: {
                                                title: '<?php echo lang('FatherName');  ?>',
                                                width: '30%',
                                            },
                                            MotherName: {
                                                title: '<?php echo lang('MotherName');  ?>',
                                                width: '30%', 
                                            },
                                            IsActive:{
                                                title: '<?php echo lang('IsActive');  ?>',
                                                width: '10%',
                                                type:"checkbox",
                                                inputClass:"form-control",
                                                type: 'checkbox',
                                                values: { '0': '<?php echo lang('Disabled');  ?>', '1': '<?php echo lang('Enabled');  ?>' },
                                                defaultValue: 'true'
                                            },
                             
                                            UserName: {
                                                title: '<?php echo lang('UserName');  ?>',
                                                width: '30%',
                                                input: function (data) {
                                                    if (data.record) {
                                                        return '<input type="text" class="validate[required] form-control" autocomplete="off" placeholder="<?php echo lang('UserName');  ?>" name="UserName"   value="' + data.record.UserName + '" />';
                                                    } else {
                                                        return '<input type="text" class="validate[required] form-control"  autocomplete="off"  placeholder="<?php echo lang('UserName');  ?>" name="UserName"     />';
                                                    }
                                                }
                                            },
                                    
                                                                        
                                        }
                                        // ,recordsLoaded: function (event, data) {
                                        //     console.log("Data: " +  JSON.stringify(data)  );
                                        
                                        // }
                                        
                                    }, function (data) { //opened handler
                                        data.childTable.jtable('load');
                                    });
                        });
                        //Return image to show on the person row
                        return $img;
                    }
                },
              
                CNO: {
                    key:true,
                    create: true,
                    edit: true,
                    list: true,
                    title: '<?php echo lang('CName');  ?>',
                    width: '30%',
                    visibility: 'fixed',
                    inputClass:'form-control',
                    options: '<?php echo $func?>GetOptionList.php?do=CName',
                    
                },
                TAttendance: {
                    title: '<?php echo lang('TAttendance');  ?>',
                    width: '10%',
                    input: function (data) {
                        if (data.record) {
                            return '<input type="time"  class="form-control" name="TAttendance"   value="' + data.record.TAttendance + '" />';
                        } else {
                            return '<input type="time" class="form-control" name="TAttendance" value="09:00"    />';
                        }
                    }
                },
                Tleave: {
                    title: '<?php echo lang('Tleave');  ?>',
                    width: '10%'   ,
                    input: function (data) {
                        if (data.record) {
                            return '<input type="time" class="form-control" name="Tleave"   value="' + data.record.Tleave + '" />';
                        } else {
                            return '<input type="time" class="form-control" name="Tleave"  value="15:00" />';
                        }
                    }
                },
           
                Notes: {
                    title: ' <?php echo lang('Notes');  ?>',
                    width: '30%',
                    type:'textarea',
                    visibility: 'fixed',
                    inputClass: 'form-control'
                },
            
            },
                                                                       
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
                // $jt(data.form.find('input[name="RDate"]')).val(Now);

                // $jt( "#SearchByFname" ).autocomplete({
                //         source: "<?php echo $func ?>GetGetACList.php?do=Children",
                //         minLength: 2,
                //         classes: {
                //                 "ui-autocomplete" : " <?php echo lang('Clang'); ?> "
                //                     },
                    
                //         select: function( event, ui ) {
                //         //  console.log( "Selected: " +  ui.item.value );
                //         // e.preventDefault();

                //         $jt('#jtableContainer').jtable('load', {
                //             FatherName : ui.item.value
                //    });

                //   }
                // });
            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            //Dispose validation logic when form is closed
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            },     recordsLoaded: function (event, data) {
              console.log(data.serverResponse);
            }

        }
 
        //Load student list from server
 
 


                                        , function (data) { //opened handler
                                        data.childTable.jtable('load');
                                    });
                                    });
                        //Return image to show on the person row
                        return $img;
                    }
          
                        
                }, 
            
            },
                                                                       
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
                $jt(data.form.find('input[name="RDate"]')).val(Now);
            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            //Dispose validation logic when form is closed
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            },     recordsLoaded: function (event, data) {
              console.log(data.serverResponse);
            }

        });
 
        //Load student list from server
      //  $jt('#jtableContainer').jtable('load');

     
      $jt("#BtnNow").click(function(e){
        e.preventDefault();
       
       

       $jt("#Txt-Search").val(myDateString);

     
        $jt('#jtableContainer').jtable('load',{RDate:myDateString});
    });
    $jt("#BtnNow").click();
            
    $jt("#Txt-Search").change(function(){
        $jt("#BtnSearch").click();
    });
    $jt("#BtnSearch").click(function(e){
        e.preventDefault();
      
        var Search=$jt("#Txt-Search").val();
        $jt('#jtableContainer').jtable('load',{RDate:Search});
    });
});



    // var  $WorkDayData=$(".fa-calendar").parents("tr");
    //                     $WorkDayData.click(function () {
                           
    //                         $(this).find(".fa-calendar").click();
    //                     });

                        

    // });
 


</script>


<div class="container">
 

  <!-- Modal -->
  <div class="modal fade" id="UpLoadModal" role="dialog" >
   <div class="modal-dialog"  style="width: 90%;height: 90%;">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 100%;height: 100%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
                 <?php echo lang('ImageUploader');  ?>
          </h4>
        </div>
        <div class="modal-body file-UpLoad" style="height:75%;">
   			<iframe     style="width:100%;height:100%;"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo lang('Close');  ?></button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<?php
	include $tpl . 'footer.php'; 
	//ob_end_flush();
?>