
var app = angular

        .module("profileModule", ['angular-nicescroll'])
        .controller("profileController", function ($scope, $http,$sce) {


            $scope.FrmUrl="";
            $scope.FrmTitle="";
            $scope.Showframe = function (src,Title) {
                $scope.FrmTitle=Title;

            $scope.FrmUrl = $sce.trustAsResourceUrl(src);
            }
            //   $scope.PNO="1";
            $scope.history = [];
            $scope.Posts = [];

            $http.post('includes/functions/GetProfileList.php?do=History')
                .then(function (response) {
                $scope.history = response.data;
                 console.log( response.data) ;
            });
            $http.post('includes/functions/GetProfileList.php?do=Posts')
            .then(function (response) {
                $scope.Posts = response.data;
                console.log( response.data) ;
            });


            $scope.PostSetting = {
                
                    ColumnName: true,
                    Description: true,
                    ISPrimaryKey: true,
                };

            $scope.OptionSearchMenu = "";
            $scope.DaySearchMenu = "";
            $scope.SearchText="";

            $scope.Search=function(Text)
            { 
               
                    $http({
                        url: "includes/functions/GetProfileList.php?do=Posts",
                        method: "POST",
                        params: { 'RDate':Text}
                    })
                    .then(function(response) {
                            // success
                            $scope.Posts = response.data;
                           
                    });
                    $scope.SearchText=Text;
            };
            $scope.EditFavorite=function(p)
            { 
                p.IsFavorite=( p.IsFavorite=="0")?"1":"0";
                
                    $http({
                        url: "includes/functions/GetProfileList.php?do=EditFavorite",
                        method: "POST",
                        params: { 'DRID':p.DRID}
                    })    .then(function(response) {
                        // success
                       
                });
                    
                    
                   
            };
            $scope.EnableOrRDisableSetting = function (Setting) {
                $scope.PostSetting[Setting] = !$scope.PostSetting[Setting];
            };
            
            $scope.getYear=function()
            { 
                var d = new Date();
                return d.getFullYear();
            };
              
           
    

   });


  $(document).ready(function(){

    // $("#Txt-Search").change(function(){
    //    alert($(this).val());
    // });
      $('[data-toggle="tooltip"]').tooltip(); 
     
      $("a[href='#top']").click(function() {
          $('.dropdown').removeClass('open');
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
      }); 


      $(window).scroll(function () {
          if ($(this).scrollTop() > 200) {
              $('#back-to-top').fadeIn(200);
          } else {
              $('#back-to-top').fadeOut(200);
          }
      });




  });