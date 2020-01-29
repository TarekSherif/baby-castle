<?php



    $Page=array();
    $Page["Title"]= 'ManagePartners';
    $Page["Permission"]=array("Admin");
    $Page["Include"]=array("language","header","Nav","jtable","footer","script");



   //  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
   //  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script");
   

 
    include 'init.php';
  
?>



<div id="jtableContainer" class="<?php echo lang('Clang'); ?>" ></div>
<script type="text/javascript">

$jt(function () {


        $jt('#jtableContainer').jtable({
            title: '<i class="fa fa-handshake-o fa-2x" style="color=#333;" aria-hidden="true"></i>  <?php echo lang('Partners');  ?>',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'Title ASC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
                listAction:   '<?php echo $func ?>ActionPartners.php?action=list',
                createAction: '<?php echo $func ?>ActionPartners.php?action=create',
                updateAction: '<?php echo $func ?>ActionPartners.php?action=update',
                deleteAction: '<?php echo $func ?>ActionPartners.php?action=delete'
            },
            fields: {
      
  
                images: {

                        title: '',
                        visibility: 'fixed', 
                        width: '5%',
                        sorting: false,
                        edit: false,
                        create: false,
                        display: function ( PartnersData) {
                            //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-picture-o fa-3x" style="color: green;"  data-toggle="modal" data-target="#UpLoadModal" aria-hidden="true"></i>');
                            //Open child table when user clicks the image
                         $img.click(function () {
                        // console.log("<?php echo $FileUploader ?>FilePathSession.php?FilePath=ChildrenReport/"+PostData.record.CRID);
                        $.get("<?php echo $FileUploader ?>FilePathSession.php?FilePath=Users/"+ PartnersData.record.PartnerID)
                        document.getElementById('FrameID').contentWindow.location.reload(true);
                        });
                                //Return image to show on the person row
                                return $img;
                            }
                        },             
          PartnerEvaluation: {

                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (PartnersData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-star  fa-3x"  style="color: orange;" aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                         
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-star  fa-2x" style="color: orange;" ></i> - <?php echo lang('PartnerEvaluation');  ?>',
                                        paging: true,
                                        pageSize: 10,
                                        sorting: true,
                                        defaultSorting: 'ETrustiness ASC',
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionPartnerEvaluation.php?action=list&PartnerID='+ PartnersData.record.PartnerID ,

                                        },
                                        fields: {
                                           
                                            PartnerID: {
                                                type: 'hidden',
                                                defaultValue: PartnersData.record.PartnerID
                                                
                                            },


                                            PNO: {
                                                title: '<?php echo lang('PNO');  ?>',
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: true,
                                                options: '<?php echo $func?>GetOptionList.php?do=Parents',
                                            },
                                            
                                                
                                            ETrustiness :{
                                                title: '<?php echo lang('ETrustiness');  ?>',
                                                width: '10%',
                                                display: function (data) {
                                                    var html="";
                                                    

                                                    html+=`<span class="rating readonly" > `;
                                                    for (x=5,chk="";x>=1;x--)
                                                    {
                                                        chk= (data.record.ETrustiness==x)? ' checked="checked" ':" ";
                                                        html+=`<input type="radio" class="rating-input"     id="rating-ETrustinessP-`+data.record.PartnerID+`-`+x+`" name="rating-ETrustinessP-`+data.record.PartnerID+`" `+chk+`>
                                                            <label for="rating-ETrustinessP-`+data.record.PartnerID+`-`+x+`"  class="rating-star"></label>`;
                                                    }
                                                    html+=` </span> `;
                                                    
                                                    return html;
                                                }
                                            },
                                            EGoodness :{
                                                title: '<?php echo lang('EGoodness');  ?>',
                                                width: '10%',
                                                display: function (data) {
                                                    var html="";
                                                    
                                                    html+=`<span class="rating readonly"  > `;
                                                    for (x=5,chk="";x>=1;x--)
                                                    {
                                                        chk= (data.record.EGoodness==x)? ' checked="checked" ':" ";
                                                        html+=`<input type="radio" class="rating-input"     id="rating-EGoodnessP-`+data.record.PartnerID+`-`+x+`"  name="rating-EGoodnessP-`+data.record.PartnerID+`" `+chk+`>
                                                            <label for="rating-EGoodnessP-`+data.record.PartnerID+`-`+x+`"  class="rating-star"></label>`;
                                                    }
                                                    html+=` </span> `;
                                                    
                                                    return html;
                                                }

                                            },
                                            ETimeness :{
                                                title: '<?php echo lang('ETimeness');  ?>',
                                                width: '10%',
                                                display: function (data) {
                                                    var html="";
                                                    
                                                    html+=`<span class="rating readonly"  > `;
                                                    for (x=5,chk="";x>=1;x--)
                                                    {
                                                        chk= (data.record.ETimeness==x)? ' checked="checked" ':" ";
                                                        html+=`<input type="radio" class="rating-input"     id="rating-ETimenessP-`+data.record.PartnerID+`-`+x+`" name="rating-ETimenessP-`+data.record.PartnerID+`" `+chk+`>
                                                            <label for="rating-ETimenessP-`+data.record.PartnerID+`-`+x+`"  class="rating-star"></label>`;
                                                    }
                                                    html+=` </span> `;
                                                    
                                                    return html;
                                                }
                                            },

                    
               
                                           
                                },
                        
                            }, function (data) { //opened handler
                                data.childTable.jtable('load');
                            });
                        });
                        //Return image to show on the person row
                        return $img;
                    }
                },
                Contact: {

                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (PartnersData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-phone fa-3x"  style="color: #b90606;" aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-phone fa-2x" style="color: #b90606;"></i> - <?php echo lang('Contact');  ?>',
                                        paging: true,
                                        pageSize: 10,
                                        sorting: true,
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionContact.php?action=list&UserID='+ PartnersData.record.PartnerID ,
                                            createAction: '<?php echo $func ?>ActionContact.php?action=create',
                                            updateAction: '<?php echo $func ?>ActionContact.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionContact.php?action=delete'
                                        },
                                        fields: {
                                            UserID: {
                                                type: 'hidden',
                                                defaultValue: PartnersData.record.PartnerID
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
                                                inputClass: 'validate[required]  form-control'
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

                PartnerShipDetails: {

                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (PartnersData) {
                        //Create an image that will be used to open child table
                        var $img = $jt('<i class="fa fa-file-text-o fa-3x"  aria-hidden="true"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $jt.post( '<?php echo $func ?>ActionPartnerShipDetails.php?action=list&PartnerID='+ PartnersData.record.PartnerID,function(data){
                                console.log(data);
                            } );

                                   $jt('#jtableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title:'<i class="fa fa-file-text-o fa-2x"></i> - <?php echo lang('PartnerShipDetails');  ?>',
                                        paging: true,
                                        pageSize: 10,
                                        
                                        columnResizable: true,
                                        columnSelectable: true,
                                        saveUserPreferences: true,
                                        actions: {
                                            listAction:   '<?php echo $func ?>ActionPartnerShipDetails.php?action=list&PartnerID='+ PartnersData.record.PartnerID ,
                                            createAction: '<?php echo $func ?>ActionPartnerShipDetails.php?action=create',
                                            updateAction: '<?php echo $func ?>ActionPartnerShipDetails.php?action=update',
                                            deleteAction: '<?php echo $func ?>ActionPartnerShipDetails.php?action=delete'
                                        },
                                        fields: {
                                            PartnerID: {
                                                type: 'hidden',
                                                defaultValue: PartnersData.record.PartnerID
                                            },
                                            
                                            PSDID: {
                                                title: '<?php echo lang('PartnerID');  ?>',
                                                key: true,
                                                create: false,
                                                edit: false,
                                                list: false
                                        },
                                            
                                            Notes: {
                                                title: '<?php echo lang('Notes');  ?>',
                                                width: '30%',
                                                visibility: 'fixed',
                                                type:'textarea',
                                                inputClass: 'validate[required] form-control'
                                        
                                        },
                                                
                                        IsActive:{
                                            title: '<?php echo lang('IsActive');  ?>',
                                            width: '10%',
                                            type:"checkbox",
                                            values: { '0': '<?php echo lang('Disabled');  ?>', '1': '<?php echo lang('Enabled');  ?>' },
                                            defaultValue: '1'
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


                PartnerID: {
                    title: '<?php echo lang('PartnerID');  ?>',
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                Title: {
                    title: '<?php echo lang('Title');  ?>',
                    width: '20%',
                   
                    input: function (data) {
                        if (data.record) {
                            return '<input type="text"  class="validate[required] form-control"  autocomplete="off" placeholder="<?php echo lang('Title');  ?>" name="Title"   value="' + data.record.Title + '" />';
                        } else {
                            return '<input type="text"  class="validate[required] form-control"  autocomplete="off"  placeholder="<?php echo lang('Title');  ?>" name="Title"     />';
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
                    
            IsActive:{
                title: '<?php echo lang('IsActive');  ?>',
                width: '5%',
                type:"checkbox",
                values: { '0': '<?php echo lang('Disabled');  ?>', '1': '<?php echo lang('Enabled');  ?>' },
                defaultValue: '1'
            },

 
                UserName: {
                    title: '<?php echo lang('UserName');  ?>',
                    width: '15%',
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
                    
                ETrustiness :{
                    title: '<?php echo lang('ETrustiness');  ?>',
                    width: '10%',
                    create: false,
                    edit: false,
                    display: function (data) {
                        var html="";
                        
       
                        html+=`<span class="rating readonly"> `;
                        for (x=5,chk="";x>=1;x--)
                        {
                            chk= (data.record.ETrustiness==x)? ' checked="checked" ':" ";
                            html+=`<input type="radio" class="rating-input"     id="rating-ETrustiness-`+data.record.PartnerID+`-`+x+`" name="rating-ETrustiness-`+data.record.PartnerID+`" `+chk+`>
                                <label for="rating-ETrustiness-`+data.record.PartnerID+`-`+x+`"  class="rating-star"></label>`;
                                // ` <input type="radio" name="example`+data.record.PartnerID+`" class="rating" value="`+x+`" `+chk+` />`
                        }
                        html+=` </span> `;
                        
                        return html;
                  },
                },
                EGoodness :{
                    title: '<?php echo lang('EGoodness');  ?>',
                    width: '10%',
                    create: false,
                    edit: false,
                    display: function (data) {
                        var html="";
                        
                        html+=`<span class="rating readonly"> `;
                        for (x=5,chk="";x>=1;x--)
                        {
                            chk= (data.record.EGoodness==x)? ' checked="checked" ':" ";
                            html+=`<input type="radio" class="rating-input"     id="rating-EGoodness-`+data.record.PartnerID+`-`+x+`" name="rating-EGoodness-`+data.record.PartnerID+`" `+chk+`>
                                <label for="rating-EGoodness-`+data.record.PartnerID+`-`+x+`"  class="rating-star"></label>`;
                                // ` <input type="radio" name="example`+data.record.PartnerID+`" class="rating" value="`+x+`" `+chk+` />`
                        }
                        html+=` </span> `;
                        
                        return html;
                  },
                },
                ETimeness :{
                    title: '<?php echo lang('ETimeness');  ?>',
                    width: '10%',
                    create: false,
                    edit: false,
                    display: function (data) {
                        var html="";
                        
                        html+=`<span class="rating readonly"> `;
                        for (x=5,chk="";x>=1;x--)
                        {
                            chk= (data.record.ETimeness==x)? ' checked="checked" ':" ";
                            html+=`<input type="radio" class="rating-input"     id="rating-ETimeness-`+data.record.PartnerID+`-`+x+`" name="rating-ETimeness-`+data.record.PartnerID+`" `+chk+`>
                                <label for="rating-ETimeness-`+data.record.PartnerID+`-`+x+`"  class="rating-star"></label>`;
                                // ` <input type="radio" name="example`+data.record.PartnerID+`" class="rating" value="`+x+`" `+chk+` />`
                        }
                        html+=` </span> `;
                        
                        return html;
                  },
                },

		    //  ,
		    //  
               
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
                document.location.reload(true);
            }
            //  ,recordsLoaded: function (event, data) {
            //     console.log("Data: " +  JSON.stringify(data)  );
               
            // }

        });
 
        //Load student list from server
       $jt('#jtableContainer').jtable('load');

      
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
        <div class="modal-body" style="height:75%;">
   			<iframe  id="FrameID" src="layout/FileUploader/FileUploader.php" style="width:100%;height:100%;"></iframe>
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