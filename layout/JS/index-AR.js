
var app = angular
.module("SchoolModule",['angular-nicescroll'])
.controller("SchoolController", function ($scope, $http,$sce) {
    
      $scope.Partners = [];
      $scope.PartnersUrl="sssss";
      $scope.ShowPartners = function (src) {
        $scope.PartnersUrl = $sce.trustAsResourceUrl(src);
      }

    $http.post('includes/functions/ActionPartners.php?action=PartnerList')
        .then(function (response) {
        $scope.Partners = response.data;
  
    });
   
    var MenuItems = [
    {
        orderid:1,
        MName: "تدريس لغات",
        Micon: "language.png",
        Mclass:"bounceIn",
       details:["عربي","انجليزي"]
    },
    // {
    //     orderid:2,
    //     MName: "منهج الفونيكس ",
    //     Micon: "student.png",
    //     Mclass:"bounceIn",
    //    details:["1"]
    // },

    {
        orderid:3,
        MName: "تحفيظ القران ",
        Micon: "quran.png",
        Mclass:"zoomIn",
       details:[
       "عمل تسجيلات صوتية للطفل أثناء تسميع القرآن الكريم، مما يجعل ذلك دافعاً له للحفظ بشكل أفضل في كل مرة",
       "تقسيم القرآن الكريم إلى أجزاء وتوزيعها على أوقات معينة بشكل مناسب للطفل ولقدراته.",
       "تعليم قصص القرآن"," مسابقات وتكريم حفظة القران "]
    },

     {
        orderid:4,
        MName: "انشطة ",
        Micon: "active.png",
        Mclass:"rubberBand",
       details:["تنمية مهارة التحدث","تنمية مهارة الاستماع ","تنمية مهارة الرسم","تنمية المهارات  الموسيقية"]
   },
    {
        orderid:5,
        MName: "تقارير يوميه",
        Micon: "Report.png",
        Mclass:"bounceIn",
       details:["توفير المتابعة المستمرة","ارسال تقارير يوميه عن طريق الايميل"]
    },
    {
        orderid:6,
        MName: "كاميرات متابعة",
        Micon: "webcam.png",
        Mclass:"bounceIn",
       details:["توفير المتابعة المستمرة","توفير عوامل الأمان"]
    },
            {
        orderid:7,
        MName: "باصات ",
        Micon: "bus.png",
        Mclass:"lightSpeedIn",
       details:[" الالتزام بالمواعيد"," توفير عوامل الأمان "]
    },     {
        orderid:8,
        MName: "فصول مكيفه",
        Micon: "AirCondition.png",
        Mclass:"bounceInDown",
       details:[" توفير مناخ صحي للطفل"]
    }, {
        orderid:9,
        MName: "الرعاية الصحية",
        Micon: "health.png",
        Mclass:"pulse",
       details:["توفير الرعاية الصحية","تنبيه باللقاحات التي يحتاجها الطفل","توفير المتابعة المستمرة"]
    },  {
        orderid: 10,
        MName: "توعية للامهات",
        Micon: "Learn.png",
        Mclass: "pulse",
        details: ["محاضرات توعية يقدمها متخصصين"]
    }, 
      {
          orderid: 11,
          MName: "مواعيد الحضانة",
          Micon: "clock.png",
          Mclass: "pulse",
          details: ["من الساعة 7 صباحا حتى الساعة 4 عصرا", "ساعات إضافية حتى الساعة السادسة مساءا"]
      },
        {
            orderid: 12,
            MName: "رحلات ترفيهية",
            Micon: "Zoo.png",
            Mclass: "pulse",
            details: ["ايام للمرح", " رحلات ترفيهية", " رحلات تعلمية"]
        },
        {
            orderid:13,
            MName: "ذوي الاحتياجات الخاصه",
            Micon: "YouCan.png",
            Mclass:"pulse",
           details:["توفير الرعاية المستمرة","توفير الرعاية الصحية","توفير عوامل الأمان"]
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