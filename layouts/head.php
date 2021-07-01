<!DOCTYPE html>
<html lang="ru">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<title><?php echo "$nameofpage"; ?></title>
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<script src="js/wow.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/styles.css?v=2">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<script src="https://cdn.anychart.com/js/latest/anychart-bundle.min.js"></script>

 <script src="js/wow.min.js"></script>
              <script>
              new WOW().init();
              </script>

<script>

    var param1 = '<?php echo $gr[0];?>'
    var param2 = '<?php echo $gr[1];?>'
    var param3 = '<?php echo $gr[2];?>'
    var param4 = '<?php echo $gr[3]?>'
    var param5 = '<?php echo $gr[4]?>'


    anychart.onDocumentLoad(function() {
    
        var chart = anychart.pie([
        ["Ожидает " + param1, param1],
        ["Прибыл " + param2, param2],
        ["Погружен " + param3, param3],
        ["Отправлен " + param4, param4],
        ["Сдан " + param5, param5]
        ]);
        
        chart.title("Диаграмма: Статусы контейнеров");
        chart.container("graf").draw();
        
    });
    
    anychart.onDocumentLoad(function() {
      // create chart and set data
      var chart = anychart.column([
        ["Январь", 2],
        ["Февраль", 7],
        ["Март", 6],
        ["Апрель", 10]
      ]);
      // set chart title
      chart.title("Оборот контейнеров");
      // set chart container and draw
      chart.container("diagram").draw();
});
    

</script>




<script> 

function showpopup(selector) {
    
    document.querySelector(selector).style.setProperty('--var-display', 'block');

}

function hidepopup(selector) {
    
    document.querySelector(selector).style.setProperty('--var-display', 'none');

}

 

function showpartners(selector) {
    
    window.currentUser = {name: selector };      
    document.getElementById('partners').style.setProperty('--var-display', 'block');
    
}


  


function setvalue (value) {
    
    if (confirm("Добавить контрагента " + value + "?")) {

        var InputSelector = currentUser.name;        
        InputSelector.value = value
        document.getElementById('partners').style.setProperty('--var-display', 'none');
        return false;

    } else {
        
        document.getElementById('partners').style.setProperty('--var-display', 'none');
        
    }

    
}



function shure() {


    if (confirm("Вы подтверждаете удаление? Действие необратимо и контейнер будет удален из других таблиц")) {

        return true;

    } else {

        return false;

    }

}

function editform(o, param) {
    
    if (o.value=='Сохранить') {
        
        return true;
        
    } else {
        
        o.value='Сохранить';
        
        td = o.parentNode;
        
        tr = td.parentNode;
        
        alltd = tr.childNodes;
        
        
        if(alltd.length-1 == 8) {
            
            son = alltd[7].childNodes    
            son[6].style.cssText = "display:block"
            son[4].style.cssText = "display:none"
            
        }

        if(alltd.length-1 == 10) {
            
            son = alltd[9].childNodes    
            
            if(son[6] == undefined) {
                
                son[4].style.cssText = "display:block"
                son[2].style.cssText = "display:none"
                
            } else {
                
                son[6].style.cssText = "display:block"
                son[4].style.cssText = "display:none"
                    
            }

        }
        
        if (alltd.length-1 >= 11) {
        
            temp = alltd[11].childNodes
            
            if(temp[2] != undefined) {
                
                son = alltd[11].childNodes
                son[2].style.cssText = "display:block"
                
            } else {
                
                td.childNodes[4].style.cssText = "display:none"
                td.childNodes[6].style.cssText = "display:block"    
                
            }

        }
        
        for(i=param;i<alltd.length-5;i++) {
            
            son = alltd[i].childNodes
            son[2].disabled = false;
            son[2].style.cssText = "color: blue; border: 1px solid black"
                                    
        }

        return false;
    }
    
}


</script>



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
<script>
/* Локализация datepicker */
$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: 'Предыдущий',
	nextText: 'Следующий',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);
</script>

<script>

$(function(){
	$(".calenpicker").datepicker();
});

</script>

</head>