<html>
    <head>
        <meta charset="UTF-8">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container well">
            <div class="hero-unit">
                <h1>Поиск числа с наибольшим простым делителем</h1>
                <p>
                    Cоздайте массив неупорядоченных целых чисел, искомое число найдется сразу после этого. 
                </p>
                <form action="main.php">
                    <button type="submit" class="btn btn-primary btn-large">Сгенерировать</button>
                </form>
                <?php if(isset($_SESSION['array'])):?>
                    <?php $array = $_SESSION['array'];?>
                    <?php if(isset($_SESSION['rows'])){$rows = $_SESSION['rows'];}?>
                    <?php if(isset($_SESSION['columns'])){$columns = $_SESSION['columns'];}?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> </th>
                                <?php for ($i = 0; $i< $rows; $i++):?>
                                <th><?= $i?></th>
                                <?php endfor;?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i< $columns; $i++):?>
                                <tr>
                                    <td><b><?= $i?></b></td>
                                    <?php for ($j = 0; $j < $rows; $j++):?>
                                        <td><?= $array[$i][$j]?></td>
                                    <?php endfor;?>
                                </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                <?php endif;?>
                <?php if (isset($_SESSION['maxItemInfo'])):?>
                    <p>
                        Координаты числа <?= $_SESSION['maxItemInfo']['value']?> с наибольшим простым делителем <?= $_SESSION['maxItemInfo']['divisor']?>:  
                        <strong>(<?= $_SESSION['maxItemInfo']['row']?>, <?= $_SESSION['maxItemInfo']['column']?>)</strong>
                    </p>
                    
                <?php endif;?>
                    
                <p id="js-result"></p>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
        
         <script>
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
                findMaxSimpleDevider:function(array){
                    var maxIndex = Math.max.apply(null, array.map((v, i) => v === 1 ? i : 0 ));
                    console.log(array.map((v, i) => v === 1 ? i : 0 ));
                    return maxIndex;
                },
                getMaxDevider(value) {
                    var array = _.range(value).map(() => 1);
                    array.unshift(null);

                    for (var i = 2; i <= value; i++) {
                       if (array[i]) {
                           array = utils.setZero(array, i, value);
                       }
                    }

                    return { devider: utils.findMaxSimpleDevider(array), array: array};
                }
            } 
             
            console.time('js solution');
            var jsonArray = <?= json_encode($_SESSION['array']); ?>;
            
            _.each(jsonArray, (rowArray, x) => {
                _.each(rowArray, (value, y) => {
                    if(value > utils.maxDevider.devider) {
                        var result = utils.getMaxDevider(value);
                        utils.saveDevider(result, x, y, value);
                    }
                });
            });
            
            var elem = document.getElementById('js-result');
            var endResult = utils.maxDevider;
            elem.innerHTML = `На js нашли результат число ${endResult.value} наибольший простой ${endResult.devider} делитель. строка ${endResult.x} колонка ${endResult.y} `;
            
            console.timeEnd('js solution');
        </script>   
        
    </body>
</html>

