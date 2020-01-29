
var app = angular
                                .module("SchoolModule",['angular-nicescroll'])
                                .controller("SchoolController", function ($scope, $http,$sce) {
                                    
                                      $scope.Partners = [];
                                      $scope.PartnersUrl="";
                                      $scope.ShowPartners = function (src) {
                                        $scope.PartnersUrl = $sce.trustAsResourceUrl(src);
                                      }
                                  
                                      $http.post('includes/functions/ActionPartners.php?action=PartnerList')
                                          .then(function (response) {
                                          $scope.Partners = response.data;
                                        
                                      });
                                   
                                    var MenuItems = [
                                    {
                                         orderid: 1,
                                         MName: "languages",
                                         Micon: "language.png",
                                         Mclass: "bounceIn",
                                        details: ["Arabic", "English"]
                                     },
                                    // {
                                    //     orderid:2,
                                    //     MName: "منهج الفونيكس ",
                                    //     Micon: "student.png",
                                    //     Mclass:"bounceIn",
                                    //    details:["1"]
                                    // },

                                    {
                                         orderid: 3,
                                         MName: "Quran",
                                         Micon: "quran.png",
                                         Mclass: "zoomIn",
                                        details: [
                                        "Making sound recordings of the child during the Holy Quran, which makes it a motive for him to memorize better every time",
                                        "To divide the Koran into parts and distribute them at certain times in a manner appropriate to the child and his abilities.",
                                        "Teaching the stories of the Quran", "Contests and honoring the keepers of the Koran"]
                                     },
                                       {
                                             orderid: 4,
                                             MName: "Activity",
                                             Micon: "active.png",
                                             Mclass: "rubberBand",
                                            details: ["Development of speaking skills", "Developing listening skills", "Drawing skill development", "Developing musical skills"]
                                        },
                                      {
                                                 orderid: 5,
                                                 MName: "Daily Reports",
                                                 Micon: "Report.png",
                                                 Mclass: "bounceIn",
                                                details: ["Providing continuous follow-up", "Sending daily reports via e-mail"]
                                             },
                                    {
                                        orderid:6,
                                        MName: "Cameras Continue",
                                         Micon: "webcam.png",
                                         Mclass: "bounceIn",
                                        details: ["Provide continuous monitoring", "Provide security factors"]
                                    },{
                                                 orderid: 7,
                                                 MName: "Buses",
                                                 Micon: "bus.png",
                                                 Mclass: "lightSpeedIn",
                                                details: ["Schedule", "Provide Safety Factors"]
                                             }, {
                                                 orderid: 8,
                                                 MName: "Classes", 
                                                 Micon: "AirCondition.png",
                                                 Mclass: "bounceInDown",
                                                details: ["Providing a healthy environment for the child"]
                                             }, {
                                                 orderid: 9,
                                                 MName: "Healthcare",
                                                 Micon: "health.png",
                                                 Mclass: "pulse",
                                                details: ["providing health care", "alerting the vaccines needed by the child", "providing continuous follow-up"]
                                             },    {
                                                       orderid: 10,
                                                       MName: "Nursery Appointments",
                                                       Micon: "clock.png",
                                                       Mclass: "pulse",
                                                       details: ["From 7 am to 4 pm", "Additional hours until 6 pm"]
                                                   },
                                      
                                      {
                                          orderid: 11,
                                          MName: "Awareness for mothers",
                                         Micon: "Learn.png",
                                         Mclass: "pulse",
                                         details: ["Awareness lectures by specialists"]
                                      },
                                        {
                                             orderid: 12,
                                             MName: "Entertainment Trips",
                                             Micon: "Zoo.png",
                                             Mclass: "pulse",
                                             details: ["Days for Fun", "Entertainment Trips", "Learning Trips"]
                                         },
                                         {
                                             orderid: 13,
                                             MName: "Special Needs",
                                             Micon: "YouCan.png",
                                             Mclass: "pulse",
                                            details: ["providing continuous care", "providing health care", "providing safety factors"]
                                         },

                             

                                   
                                  
                                    

                                    ];
                                    $scope.Title = "Baby Castle";
                                    $scope.MenuItems = MenuItems;
                                    $scope.PhoneNumbers = ["01550310266", "01550310255"];
                                    
                                   
                                    $scope.filterMenuItem=null;
                                    $scope.ShowDetailsfunction=function(pMenuItem){
                                        $scope.filterMenuItem={MName:pMenuItem};
                                        $("html, body").animate({ scrollTop: 120 }, "slow");
                                      
                                    };
                                    $scope.hideDetailsfunction=function(){
                                      
                                        $scope.filterMenuItem=null;
                                                                          
                                    };
                                    $scope.getYear = function () {
                                        var d = new Date();
                                        return d.getFullYear();
                                    };

                                 


                              
});


  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
     
      $("a[href='#top']").click(function() {
          $('.dropdown').removeClass('open');
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
      });
      $(".nav li").on("click", function () {
          $(".active-nav").removeClass("active-nav");
          $(this).addClass("active-nav");
     
      });

     
     
      $(window).scroll(function () {
          if ($(this).scrollTop() > 200) {
              $('#back-to-top').fadeIn(200);
          } else {
              $('#back-to-top').fadeOut(200);
          }
      });




  });
  