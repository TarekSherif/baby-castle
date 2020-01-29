  

<a id="back-to-top" href="#top"><i class="fa fa-angle-double-up"></i></a>
    
        <?php 
       
          if (in_array("footer",$Page["Include"])){
       ?> 

        <br />
        <br />
        <br />
        <br />
        <br />
    
    <table class="character">
        <tr>
            <td><img class="img-responsive"  src="<?php echo $img ?>dora.png" alt="dora"></td>
            <td> <img  class="img-responsive" src="<?php echo $img ?>Mduck.png" alt="duck"></td>
            <td><img  class="img-responsive" src="<?php echo $img ?>MekiMos.png" alt="MekiMos"></td>
            <td>  <img   class="img-responsive" src="<?php echo $img ?>MS.png" alt="dora"></td>
            <td> <img  class="img-responsive"  src="<?php echo $img ?>Wduck.png" alt="duck"></td>
        </tr>
    </table>
        
        <footer>
            <div class="container">
                   
                <div class="row">
    
                    <div class="col-sm-12 col-lg-4 ">
                            <iframe class="center" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.915451118319!2d31.178427385499344!3d30.01058402712757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145846812e2a8c75%3A0x9de24fc24524fa98!2z2K3Yttin2YbYqSBCYWJ5IENhc3RsZQ!5e0!3m2!1sar!2seg!4v1507913673815" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
    
                    <div class="col-sm-12 col-lg-4">
                            <img   class="center animated bounce"  src="<?php echo $img ?>spongepop.png" alt="spongepop">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                    <div  class="<?php echo lang('Clang'); ?>">
                            <ul class="center list-unstyled">
                                <li><b><i class="glyphicon glyphicon-earphone"></i> <?php echo lang('ContactUS');  ?> :  </b></li>
                                <li ng-repeat="Phone in PhoneNumbers"> {{Phone}}  </li>
                                <li>
                                    <div class="social ">
                                        <a target="_blank" class="twitter" data-toggle="tooltip" data-placement="bottom" title="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                        <a target="_blank" class="facebook" data-toggle="tooltip" data-placement="bottom" title="facebook" href="https://www.facebook.com/Baby-castle-406304709784852/"><i class="fa fa-facebook"></i></a>
                                        <a target="_blank" class="Google" data-toggle="tooltip" data-placement="bottom" title="Google +" href="https://plus.google.com/u/0/111153088548902098887"><i class="fa fa-google"></i></a>
                                        <a target="_blank" class="YouTube" data-toggle="tooltip" data-placement="bottom" title="You Tube" href="https://www.youtube.com/channel/UCElrf4dNnCim1AxPWKVEcRQ"><i class="fa fa-youtube"></i></a>
                                    </div> 
                                </li>                   
                            </ul>
                          
                        </div>
                    </div>
                </div>
                <div class="row Copyright">
                    Copyright © {{getYear()}} - {{Title}}
                </div>
            </div>
        </footer>

      
       <?php 
          }
          if (in_array("script",$Page["Include"])){
       ?> 

        <!-- Public  Script -->
        <script src="<?php echo $js ?>jquery-3.2.1.min.js"></script>
        <script src="<?php echo $js ?>bootstrap.min.js"></script>
        <script src="<?php echo $js ?>angular.min.js"></script>
        <script src="<?php echo $js ?>jquery.nicescroll.min.js"></script>
        <script  src="<?php echo $js ?>angular-nice.js"></script>
        <!-- <script src="<?php echo $js ?>angular-animate.js"></script> -->
   
        <script src="<?php echo $js ?>index-<?php echo lang('Clang'); ?>.js"></script> 



        <!--  Special Script -->
         
    <?php } ?>
      
 
    
    </body>
    </html>