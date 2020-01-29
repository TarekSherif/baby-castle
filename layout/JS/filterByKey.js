



(function () {
   

    angular
        .module('ng-filterByKey', [])
        .filter('filterByKey', function () {
            return function (items, field) {
                var result = {};

                angular.forEach(items, function (value, key) {
                    var reg = new RegExp(field, 'gi');
                    if (String(key).match(reg)) {
                        result[key] = value;
                    }
                });
                return result;
            };
        });


  

})();