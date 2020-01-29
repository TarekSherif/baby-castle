<?php

  
    $Page=array();
    $Page["Title"]= 'PartnerEvaluation';
    $Page["Permission"]=array("Parent");
    $Page["Include"]=array("language","header","jtable","script");
    
    
    include 'init.php';
    //  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
    //  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script");

    $PNO=$_SESSION["UserID"];



?>

<div class="white-Background">

    <div id="jtableContainer" class="<?php echo lang('Clang'); ?>" ></div>
    
</div>
<script type="text/javascript">

$jt(function () {

        $jt('#jtableContainer').jtable({
            title: '<i class="fa fa-star fa-2x" style="color: orange;" aria-hidden="true"></i> <?php echo lang('ETeamWork');?>',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'Evaluation DESC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
                listAction:   '<?php echo $func ?>ActionTeamWorkEvaluation.php?action=list',
                createAction: '<?php echo $func ?>ActionTeamWorkEvaluation.php?action=create',
                updateAction: '<?php echo $func ?>ActionTeamWorkEvaluation.php?action=update',
                deleteAction: '<?php echo $func ?>ActionTeamWorkEvaluation.php?action=delete'
            },
            fields: {
            
                TeacherID: {
                    key: true,
                    create: true,
                    edit: true,
                    list: true,
                    title: '<?php echo lang('TeacherID');  ?>',
                    width: '20%',
                    options: '<?php echo $func?>GetOptionList.php?do=Teacher',
                },
                PNO: {
                    type: 'hidden',
                    defaultValue: <?php echo $PNO?>
                },
                    
                Evaluation :{
                    title: '<?php echo lang('Evaluation');  ?>',
                    width: '10%',
                    display: function (data) {
                        var html="";
                        
                        html+=`<span class="rating readonly"> `;
                        for (x=5,chk="";x>=1;x--)
                        {
                            chk= (data.record.Evaluation==x)? ' checked="checked" ':" ";
                            html+=`<input type="radio" class="rating-input"     id="rating-Evaluation-`+data.record.TeacherID+`-`+x+`" name="rating-Evaluation-`+data.record.TeacherID+`" `+chk+`>
                                <label for="rating-Evaluation-`+data.record.TeacherID+`-`+x+`"  class="rating-star"></label>`;
                        }
                        html+=` </span> `;
                        
                        return html;
                    },input: function (data) {
                        var html="";
                        
                        html+=`<span class="rating"> `;
                            for (x=5,chk="";x>=1;x--)
                            {
                                chk= (data.record && data.record.Evaluation==x)? ' checked="checked" ':" ";
                                html+=`<input type="radio" class="rating-input"      id="rating-Evaluation-`+x+`" name="Evaluation" value="`+x+`" `+chk+`>
                                    <label for="rating-Evaluation-`+x+`"  class="rating-star"></label>`;
                            }
                       
                        html+=` </span> `;
                        
                        return html;
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
            },rowUpdated: function (event, data){
                window.location.reload();
            }

        });
 
        //Load student list from server
        $jt('#jtableContainer').jtable('load', {
                PNO :  <?php echo $PNO?>
                   });
 
    });
 


</script>

 
<?php
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>