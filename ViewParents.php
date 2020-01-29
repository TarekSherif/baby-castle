<?php
	

    $Page=array();
    $Page["Title"]= 'ViewParents';
    $Page["Permission"]=array("Admin");
    $Page["Include"]=array("language","header","Nav","jtable","footer","script");
    
    //  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
    //  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script"); 
    
        include 'init.php';
?>
<div class="container  <?php echo lang('Clang'); ?>">
	<div class="row">
	
           <div id="custom-search-input">
           <h4><?php echo lang("SearchByFname") ?></h4>
                            <div class="input-group col-md-12">
                            <div class="ui-widget">
                                     <input id="SearchByFname"  type="text" class="search-query form-control" placeholder="<?php echo lang("SearchByFname") ?>">
                             </div>
                            
                                
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            
                            </div>
                        </div>
	        </div>
</div>



<div id="jtableContainer" class="<?php echo lang('Clang'); ?>" ></div>
<script type="text/javascript">

$jt(function () {
    // $(".CHKIsActive").click(function() {
    //     // alert($jt(this).parent().parent().data("record-key"));
    //     // $('#textbox1').val($(this).is(':checked'));
    // alert("");
    // });

    $jt( "#SearchByFname" ).autocomplete({
      source: "<?php echo $func ?>GetACList.php?do=Parents",
      minLength: 2,
      classes: {
            "ui-autocomplete" : " <?php echo lang('Clang'); ?> "
                },
 
      select: function( event, ui ) {
      //  console.log( "Selected: " +  ui.item.value );
       // e.preventDefault();

            $jt('#jtableContainer').jtable('load', {
                FatherName : ui.item.value
                   });

      }
    });

        $jt('#jtableContainer').jtable({
            title: ' <i class="fa fa-female fa-2x" aria-hidden="true"></i><i class="fa fa-male fa-2x" style="color:#333;" aria-hidden="true"></i>   <?php echo lang('Parents');  ?>',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'FatherName ASC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
                listAction:   '<?php echo $func ?>ActionParents.php?action=list',
                createAction: '<?php echo $func ?>ActionParents.php?action=create',
                updateAction: '<?php echo $func ?>ActionParents.php?action=update',
                deleteAction: '<?php echo $func ?>ActionParents.php?action=delete'
            },
            fields: {
                // CREATE TABLE `Parents` (
                // 	`PNO` int(11) NOT NULL,
                // 	`FatherName` varchar(50) NOT NULL,
                // 	`MotherName` varchar(50) NOT NULL
                
                //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  

              
                //CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
                Contact: {

                    // CREATE TABLE `Contact` (
                    // 	`CID` INT NOT NULL AUTO_INCREMENT , 
                    // 	`CType` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL ,
                    // 	`CValue` varchar(50)   CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL ,
                    // 	`UserID` INT  NOT NULL  , 
                    // 	PRIMARY KEY (`CID`)
                    //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
                                            updateAction: '<?php echo $func ?>ActionContact.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionContact.php?action=delete'
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
                Children: {

                    // CREATE TABLE `Children` (
                    //     `CNO` int(11) NOT NULL,
                    //     `CName` varchar(50) NOT NULL,
                    //     `BDate` date NOT NULL,
                    //     `Notes` varchar(100) DEFAULT NULL,
                    //     `PNO` int(11) NOT NULL
                    //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                      
                    // -- --------------------------------------------------------



                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (ParentsData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-child fa-3x"  style="color: brown;" aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-child fa-2x" style="color: brown;"></i> - <?php echo lang('Children');  ?>',
                                        sorting: true,
                                        defaultSorting: 'BDate ASC',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionChildren.php?action=list&PNO='+ ParentsData.record.PNO ,
                                            createAction: '<?php echo $func ?>ActionChildren.php?action=create',
                                            updateAction: '<?php echo $func ?>ActionChildren.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionChildren.php?action=delete'
                                        },
                                        fields: {
                                            PNO: {
                                                type: 'hidden',
                                                defaultValue: ParentsData.record.PNO
                                            },
                                            
                                        // CREATE TABLE  `babycastle`.`ChildrenReport` (
                                        //     `CRID` INT NOT NULL AUTO_INCREMENT , 
                                        //     `RDate` DATE NOT NULL ,
                                        //     `Notes` VARCHAR(250)  CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                                        //     `CNO` int(11) NOT NULL, 
                                        //     PRIMARY KEY (`CRID`))  ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                        //--------------------------------------------


                                ChildrenAttendance: {


                                            title: '',
                                            width: '5%',
                                            sorting: false,
                                            edit: false,
                                            create: false,
                                            display: function (ChildrenData) {
                                                //Create an image that will be used to open child table
                                                var $img = $jt('<i class="fa fa-address-card-o fa-3x" aria-hidden="true"></i>');
                                                //Open child table when user clicks the image
                                                $img.click(function () {
                                            //   $.post("includes/functions/ActionChildrenAttendance.php?action=list&CNO=1",function(data, status){
                                            //             console.log("Data: " + data + "\nStatus: " + status);
                                            //     });
                                                 // console.log('<?php echo $func ?>ActionChildrenAttendance.php?action=list&CNO='+ ChildrenData.record.CNO )
                                                    $jt('#jtableContainer').jtable('openChildTable',
                                                            $img.closest('tr'),
                                                            {
                                                                title:'<i class="fa fa-address-card-o fa-2x"></i> <?php echo lang('ChildrenReport');  ?>',
                                                                paging: true,
                                                                pageSize: 10,
                                                                sorting: true,
                                                                defaultSorting: 'RDate ASC',
                                                                columnResizable: true,
                                                                columnSelectable: true,
                                                                saveUserPreferences: true,
                                                                actions: {
                                                                    listAction:   '<?php echo $func ?>ActionChildrenAttendance.php?action=list&CNO='+ ChildrenData.record.CNO ,
                                                                    createAction: '<?php echo $func ?>ActionChildrenAttendance.php?action=create',
                                                                    updateAction: '<?php echo $func ?>ActionChildrenAttendance.php?action=update',
                                                                    deleteAction: '<?php echo $func ?>ActionChildrenAttendance.php?action=delete&CNO='+ ChildrenData.record.CNO ,
                                                                },
                                                                fields: {
                                                                    CNO: {
                                                                       
                                                                        type: 'hidden',
                                                                        defaultValue: ChildrenData.record.CNO
                                                                    },
                            ChildrenReport: {


                                        title: '',
                                        width: '5%',
                                        sorting: false,
                                        edit: false,
                                        create: false,
                                        display: function (ChildrenAttendance) {
                                            //Create an image that will be used to open child table
                                            var $img = $jt('<i class="fa fa-address-card-o fa-3x" aria-hidden="true"></i>');
                                            //Open child table when user clicks the image
                                            $img.click(function () {
                                                // console.log('<?php echo $func ?>ActionChildrenReport.php?action=list&CNO='+ ChildrenData.record.CNO +'&RDate='+ChildrenData.record.RDate)
                                                $jt('#jtableContainer').jtable('openChildTable',
                                                        $img.closest('tr'),
                                                        {
                                                            title:'<i class="fa fa-address-card-o fa-2x"></i> <?php echo lang('ChildrenReport');  ?>',
                                                            // paging: true,
                                                            // pageSize: 10,
                                                            // sorting: true,
                                                            // defaultSorting: 'NPriority ASC',
                                                            columnResizable: true,
                                                            columnSelectable: true,
                                                            saveUserPreferences: true,
                                                            actions: {
                                                                listAction:   '<?php echo $func ?>ActionChildrenReport.php?action=list&CNO='+ ChildrenAttendance.record.CNO +'&RDate='+ChildrenAttendance.record.RDate,
                                                                createAction: '<?php echo $func ?>ActionChildrenReport.php?action=create',
                                                                updateAction: '<?php echo $func ?>ActionChildrenReport.php?action=update',
                                                                deleteAction: '<?php echo $func ?>ActionChildrenReport.php?action=delete'
                                                            },
                                                            fields: {
                                                            
                                                                DRID: {
                                                                    key: true,
                                                                    create: false,
                                                                    edit: false,
                                                                    list: false
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
                                                                var $img = $jt('<i class="fa fa-picture-o fa-3x" style="color: green;" data-toggle="modal" data-target="#UpLoadModal" aria-hidden="true"></i>');
                                                                //Open child table when user clicks the image
                                        $img.click(function () {
                                            var D = new Date(PostData.record.RDate);
                                            var FilePath="DayReport/"+D.getFullYear()+"/"+D.getMonth()+1+"/"+D.getDate()+"/"+PostData.record.DRID;
                                            var  modal_body= $(".file-UpLoad");
                                            $(modal_body).find("iframe").remove();
                                            $(modal_body).html('<iframe class="animated zoomIn" src="layout/FileUploader/FileUploader.php?FilePath='+FilePath+'" style="width:100%;height:100%;"></iframe>');
                                        });
                                                    //Return image to show on the person row
                                                    return $img;
                                                }
                                            },              RUrl: {
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
                                                                    $img=  $jt('<i class="fa fa-youtube fa-3x"   aria-hidden="true"></i>');  
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
                                                            
                                                                
                                                                CNO: {
                                                                    type: 'hidden',
                                                                    defaultValue: ChildrenAttendance.record.CNO
                                                                },
                                                        
                                                                RDate: {
                                                                    type: 'hidden',
                                                                    defaultValue: ChildrenAttendance.record.RDate
                                                                        
                                                                },
                                                                NPriority: {
                                                                    title: '<?php echo lang('NPriority');  ?>',
                                                                    width: '10%',
                                                                    options: '<?php echo $func?>GetOptionList.php?do=Priority',
                                                                    inputClass: 'validate[required] form-control'
                                                                }, 
                                                
                                                                
                                                                Notes: {
                                                                    title: '<?php echo lang('Notes');  ?>',
                                                                    width: '30%',
                                                                    visibility: 'fixed',
                                                                    type:'textarea',
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
                                                                        type:"date",
                                                                        width: '20%',
                                                                        visibility: 'fixed',                   
                                                                        input: function (data) {
                                                                            if (data.record) {
                                                                                return '<input type="text"  placeholder=" <?php echo lang('RDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"  class="validate[required,custom[date]] form-control"   autocomplete="off"   name="RDate"   value="' + data.record.RDate + '" />';
                                                                            } else {
                                                                                return '<input type="text"  placeholder=" <?php echo lang('RDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[required,custom[date]] form-control"  autocomplete="off"   name="RDate"     />';
                                                                            }
                                                                        }             
                                                                            
                                                                    }, 
                                                                    TAttendance: {
                                                                        title: '<?php echo lang('TAttendance');  ?>',
                                                                        width: '10%',
                                                                        input: function (data) {
                                                                            if (data.record) {
                                                                                return '<input type="time"  class="form-control" name="TAttendance"   value="' + data.record.TAttendance + '" />';
                                                                            } else {
                                                                                return '<input type="time" class="form-control" name="TAttendance"  value="09:00"   />';
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
                                                                                return '<input type="time" class="form-control" name="Tleave"   value="15:00"  />';
                                                                            }
                                                                        }
                                                                    },
                                                            
                                                                    Notes: {
                                                                        title: '<?php echo lang('Notes');  ?>',
                                                                        width: '30%',
                                                                        visibility: 'fixed',
                                                                        type:'textarea',
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
                                            CNO: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false
                                            },
                                            CName: {
                                                title: '<?php echo lang('CName');  ?>',
                                                width: '30%',
                                                visibility: 'fixed',
                   
                                                input: function (data) {
                                                    if (data.record) {
                                                        return '<input type="text"  class="validate[required] form-control"  autocomplete="off" placeholder="<?php echo lang('CName');  ?>" name="CName"   value="' + data.record.CName + '" />';
                                                    } else {
                                                        return '<input type="text"  class="validate[required] form-control"  autocomplete="off"  placeholder="<?php echo lang('CName');  ?>" name="CName"     />';
                                                    }
                                                }             
                                               
                                            },
                                            BDate: {
                                                title: ' <?php echo lang('BDate');  ?>',
                                                width: '30%',
                   
                                                input: function (data) {
                                                    if (data.record) {
                                                        return '<input type="text"  placeholder=" <?php echo lang('BDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[required,custom[date]] form-control"   autocomplete="off"   name="BDate"   value="' + data.record.BDate + '" />';
                                                    } else {
                                                        return '<input type="text"  placeholder=" <?php echo lang('BDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[required,custom[date]] form-control"  autocomplete="off"   name="BDate"     />';
                                                    }
                                                }             
                                                
                                               
                                            },
                                            Notes: {
                                                title: '<?php echo lang('Notes');  ?>',
                                                width: '30%',
                                                visibility: 'fixed',
                                                type:'textarea',
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
              
                Payment: {

                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (ParentsData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-usd fa-3x" style="color: darkgreen;"  aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-usd fa-2x" style="color: darkgreen;"></i> - <?php echo lang('Payment');  ?>',
                                        paging: true,
                                        pageSize: 10,
                                        sorting: true,
                                        defaultSorting: 'PDate DSC',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionPayment.php?action=list&PNO='+ ParentsData.record.PNO ,
                                            createAction: '<?php echo $func ?>ActionPayment.php?action=create',
                                            updateAction: '<?php echo $func ?>ActionPayment.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionPayment.php?action=delete'
                                        },


                                        fields: {
                                            PNO: {
                                                type: 'hidden',
                                                defaultValue: ParentsData.record.PNO
                                            },
                                            PID: {
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false
                                            },
                                            PayValue: {
                                                title: '<?php echo lang('PayValue');  ?>',
                                                width: '10%',
                                                visibility: 'fixed',
                                                input: function (data) {
                                                    if (data.record) {
                                                        return '<input type="number"  class="validate[required] form-control"   autocomplete="off" placeholder="<?php echo lang('PayValue');  ?>" name="PayValue"   value="' + data.record.PayValue + '" />';
                                                    } else {
                                                        return '<input type="number"  class="validate[required] form-control"  autocomplete="off"  placeholder="<?php echo lang('PayValue');  ?>" name="PayValue"     />';
                                                    }
                                                }             
                                              
                                            },
                                            PDate: {
                                                title: '<?php echo lang('PDate');  ?>',
                                                width: '20%',
                                                input: function (data) {
                                                      if (data.record) {
                                                          return '<input type="text"  placeholder=" <?php echo lang('PDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[custom[date]] form-control"  autocomplete="off"   name="PDate"   value="' + data.record.PDate + '" />';
                                                      } else {
                                                          return '<input type="text"  placeholder=" <?php echo lang('PDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[custom[date]] form-control"  autocomplete="off"   name="PDate"     />';
                                                      }
                                                  }             
                                            },
                                            SDate: {
                                                title: '<?php echo lang('SDate');  ?>',
                                                width: '20%',
                                               input: function (data) {
                                                     if (data.record) {
                                                         return '<input type="text"  placeholder=" <?php echo lang('SDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[custom[date]] form-control"  autocomplete="off"  name="SDate"   value="' + data.record.SDate + '" />';
                                                     } else {
                                                         return '<input type="text"  placeholder=" <?php echo lang('SDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[custom[date]] form-control"  autocomplete="off"  name="SDate"     />';
                                                     }
                                                 }             
                                               
                                            },
                                            EDate: {
                                                title: '<?php echo lang('EDate');  ?>',
                                                width: '20%',
                                                input: function (data) {
                                                     if (data.record) {
                                                         return '<input type="text"  placeholder=" <?php echo lang('EDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[custom[date]] form-control"  autocomplete="off"  name="EDate"   value="' + data.record.EDate + '" />';
                                                     } else {
                                                         return '<input type="text"  placeholder=" <?php echo lang('EDate');  ?>" onblur="(this.type=`text`)"    onfocus="(this.type=`date`)"    class="validate[custom[date]] form-control"  autocomplete="off"   name="EDate"     />';
                                                     }
                                                 }             
                                               
                                            },
                                            Notes: {
                                                title: '<?php echo lang('Notes');  ?>',
                                                width: '30%',
                                                visibility: 'fixed',
                                                type:'textarea',
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
                PNO: {
                    title: '<?php echo lang('PNO');  ?>',
                    key: true,
                    create: false,
                    edit: false,
                    list: true
                },
                FatherName: {
                    title: '<?php echo lang('FatherName');  ?>',
                    width: '30%',
                   
                    input: function (data) {
                        if (data.record) {
                            return '<input type="text"  class="validate[required] form-control"  autocomplete="off" placeholder="<?php echo lang('FatherName');  ?>" name="FatherName"   value="' + data.record.FatherName + '" />';
                        } else {
                            return '<input type="text"  class="validate[required] form-control"  autocomplete="off"  placeholder="<?php echo lang('FatherName');  ?>" name="FatherName"     />';
                        }
                    }             
                },
                MotherName: {
                    title: '<?php echo lang('MotherName');  ?>',
                    width: '30%', 
                   
                    input: function (data) {
                        if (data.record) {
                            return '<input type="text"  class="validate[required] form-control"  autocomplete="off" placeholder="<?php echo lang('MotherName');  ?>" name="MotherName"   value="' + data.record.MotherName + '" />';
                        } else {
                            return '<input type="text"  class="validate[required] form-control"  autocomplete="off"  placeholder="<?php echo lang('MotherName');  ?>" name="MotherName"     />';
                        }
                    }
              
                    
                },

                IsActive:{
                    title: '<?php echo lang('IsActive');  ?>',
                    width: '10%',
                    type:"checkbox",
                    values: { '0': '<?php echo lang('Disabled');  ?>', '1': '<?php echo lang('Enabled');  ?>' },
                    defaultValue: '1'
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
                Password: {
                    title: '<?php echo lang('Password');  ?>',
                    inputClass: 'validate[required]',
                    visibility: 'hidden',
                    input: function (data) {
                        if (data.record) {
                            return '<input type="password"  class="validate[required] form-control"  autocomplete="new-password"  placeholder="<?php echo lang('Password');  ?>"  name="Password"   value="' + data.record.Password + '" />';
                        } else {
                            return '<input type="password"  class="validate[required] form-control"  autocomplete="new-password"  placeholder="<?php echo lang('Password');  ?>"  name="Password"     />';
                        }
                    }

                },
                    
            
               
            },
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                //
                data.form.validationEngine('attach'<?php echo (lang("Clang")=='AR'?',{promptPosition: "topLeft"}':"" ); ?>);
              //  data.form.validationEngine();
            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) { 
                return data.form.validationEngine('validate');
                
            },
           
            //Dispose validation logic when form is closed
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            },
           
            // },recordsLoaded: function (event, data) {
            //     console.log("Data: " +  JSON.stringify(data)  );
               
            // }

        });
 
        //Load student list from server
    //    $jt('#jtableContainer').jtable('load');
 
    });
 


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
   			<iframe    style="width:100%;height:100%;"></iframe>
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
	ob_end_flush();
?>