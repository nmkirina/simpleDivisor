var utils = {
        maxDevider: { devider: 1 },
        saveDevider: function (locMaxDevider, x, y, value) {
            if(utils.maxDevider.devider < locMaxDevider.devider) {
                locMaxDevider.x = x;
                locMaxDevider.y = y;
                locMaxDevider.value = value;
                utils.maxDevider = locMaxDevider;
            }
        },
        setZero: function (array, devider, value) {
            for (var j = 2 * devider; j <= value; j = j + devider) {
                array[j] = 0;
            }
            return array;
        },
        findMaxSimpleDevider:function(array, value){
            var simpleDeviders = array.map((v, i) => (v === 1) && (value % i === 0) ? i : 0 );
            return Math.max.apply(null, simpleDeviders);
        },
        getMaxDevider(value) {
            var array = _.range(value).map(() => 1);
            array.unshift(null);

            for (var i = 2; i <= value; i++) {
               if (array[i]) {
                   array = utils.setZero(array, i, value);
               }
            }

            return { devider: utils.findMaxSimpleDevider(array, value), array: array};
        }
    } 

    