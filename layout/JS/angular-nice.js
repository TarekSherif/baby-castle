//http://tushariscoolster.github.io/angular-nicescroll/
(function () {
    'use strict';

    angular
        .module('angular-nicescroll', [])
        .directive('ngNicescroll', ngNicescroll);

    ngNicescroll.$inject = ['$rootScope'];

    /* @ngInject */
    function ngNicescroll($rootScope) {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link
        };
        return directive;

        function link(scope, element, attrs, controller) {

        //    var niceOption = scope.$eval(attrs.niceOption);
            var nicescrolConf = {
              
                "background": "#101010",
                "cursorwidth": "10px",
        
            };

        

            var niceScroll = $(element).niceScroll(nicescrolConf);
            niceScroll.onscrollend = function (data) {
                if (data.end.y >= this.page.maxh) {
                    if (attrs.niceScrollEnd) scope.$evalAsync(attrs.niceScrollEnd);

                }
            };


            scope.$on('$destroy', function () {


                niceScroll.remove()
            })


        }
    }


})();