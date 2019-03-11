
<!DOCTYPE html>
<html>

<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		
 <style type="text/css">  
    #items {
    position: absolute;	/* Абсолютное позиционирование */
    width: 50%; /* Ширина слоя в пикселах */
    height: 89%; /* Высота слоя в пикселах */
    left: 1%; /* Положение слоя от левого края */
    top: 9%; /* Положение слоя от верхнего края */
    margin-left: 0px; /* Отступ слева, включает padding и border */
    margin-top: 0px;	/* Отступ сверху */
    background: #fff; /* Цвет фона */
    border: solid 1px black; /* Параметры рамки вокруг */
    padding: 10px; /* Поля вокруг текста */
    overflow: auto; /* Добавление полосы прокрутки */ 
    }   
    #filters {
    position: absolute;	/* Абсолютное позиционирование */
    width: 24%; /* Ширина слоя в пикселах */
    height: 89%; /* Высота слоя в пикселах */
    left: 51%; /* Положение слоя от левого края */
    top: 9%; /* Положение слоя от верхнего края */
    margin-left: 0px; /* Отступ слева, включает padding и border */
    margin-top: 0px;	/* Отступ сверху */
    background: #fff; /* Цвет фона */
    border: solid 1px black; /* Параметры рамки вокруг */
    padding: 10px; /* Поля вокруг текста */
    overflow: auto; /* Добавление полосы прокрутки */ 
    }   
    #basket {
    position: absolute;	/* Абсолютное позиционирование */
    width: 24%; /* Ширина слоя в пикселах */
    height: 89%; /* Высота слоя в пикселах */
    left: 75%; /* Положение слоя от левого края */
    top: 9%; /* Положение слоя от верхнего края */
    margin-left: 0px; /* Отступ слева, включает padding и border */
    margin-top: 0px;	/* Отступ сверху */
    background: #fff; /* Цвет фона */
    border: solid 1px black; /* Параметры рамки вокруг */
    padding: 10px; /* Поля вокруг текста */
    overflow: auto; /* Добавление полосы прокрутки */ 
    }  
    #centerLayer {
    position: absolute;	/* Абсолютное позиционирование */
    width: 360px; /* Ширина слоя в пикселах */
    height: 200px; /* Высота слоя в пикселах */
    left: 50%; /* Положение слоя от левого края */
    top: 50%; /* Положение слоя от верхнего края */
    margin-left: -211px; /* Отступ слева, включает padding и border */
    margin-top: -170px;	/* Отступ сверху */
    background: #fff; /* Цвет фона */
    border: solid 1px black; /* Параметры рамки вокруг */
    padding: 10px; /* Поля вокруг текста */
    overflow: auto; /* Добавление полосы прокрутки */ 
    }   
    .BuyerName.ng-valid {background-color: lightgoldenrodyellow;}
    .BuyerName.ng-dirty.ng-invalid-required {background-color: red;}
    .BuyerName.ng-dirty.ng-invalid-minlength {background-color: lightpink;}    
    .BuyerEmail.ng-valid {background-color: lightgoldenrodyellow;}
    .BuyerEmail.ng-invalid-email.ng-dirty{background-color: red;}   
</style>	
</head>

<body ng-app="Appflwr" ng-controller="AppCtrl as appCtrl">
    <div>
    <fieldset>
        <div id="items" style="font-size: 10pt">
        	<table class="table">
        	<thead>
               	<th ng-click="appCtrl.setSort('types_name')">Категория</th>
                <th ng-click="appCtrl.setSort('plantation_name')">Плантация</th>
                <th ng-click="appCtrl.setSort('sorts_name')">Сорт</th>
                <th>Фото</th>
                <th><span title="Длина стебля (см)">Размер</span></th>
                <th>Цена</th>
                <th>К-во</th>
                <th><span title="023 - оптимум (0 -меньше, 99 - максимум)">Зрелость</th>       
                <th>&nbsp;</th>
        	</thead>
        	<tbody>
        		<tr ng-repeat="flwr in appCtrl.allFlwr">
                <td>{{flwr.type_name_nl}}</td>
                <td>{{flwr.plantation_name}}</td>
                <td>{{flwr.sort_name}}</td>
               	<td> <img ng-src="{{flwr.referenceddocument_uriid}}" width="30" height="30"/></td>
                <td>{{flwr.size}}</td>
                <td>{{flwr.price}}</td>
                <td>{{flwr.quantity}}</td>
                <td>{{flwr.maturity_stage}}</td>                               
                <td><input type='button' ng-click='appCtrl.select($index, flwr.id, flwr);' value='Выбрать'></td>
        		</tr>
        	</tbody>
        	</table>
        	<div>
                <i>Позиции с {{appCtrl.first}}  по {{appCtrl.last}} (всего {{appCtrl.count_all}} предложения).</i>
                <input type='button' ng-click='appCtrl.previous();' value='Назад'>
                <input type='button' ng-click='appCtrl.next(appCtrl.count_all);' value='Вперёд'>
            </div>
        </div>
    </fieldset>
    </div>

    <div id="filters"> 		                                           <!-- ***** Открыть область "Фильтры, Спецификация выбранной позиции" -->       
        <div ng-switch on="appCtrl.request_type">	           
            <div style="font-size: 12pt" ng-switch-when="select_all">  <!-- ***** Режим отображения "Фильтры" -->                 
            	<div>
               		<b>Фильтровать по: </b>
                  	<input type='button' ng-click='appCtrl.filterVar("types");' value='По Типам'>
                  	<input type='button' ng-click='appCtrl.filterVar("sorts");' value='По Сортам'>    	
                </div>               
                <div ng-switch on="appCtrl.variant">                	               
                    <div ng-switch-when="types">                        <!-- ***** Режим отображения  - фильтр по Типам -->                                                  	
                        <div>&nbsp</div> 
                        <i>Выбраны Типы: <b>{{appCtrl.my_v_types}}</b></i> 
                    	<div>
                        	<input type='button' ng-click='appCtrl.filterTypes($index, type.id, type.name_nl, "all");' value='Выбрать все'>
                            <input type='button' ng-click='appCtrl.filterTypes($index, type.id, type.name_nl, "none");' value='Очистить выбор'>    	
                        </div>  
                        <div>&nbsp</div>                                    
                        <div  ng-scrollbars>	                       <!-- Список доступных Типов	 --> 	
                        	<b ng-repeat="type in appCtrl.types" >
                            	<input
                                type="checkbox"
                                checklist-model="filter_value.types"
                                checklist-value="type.id"
                                ng-model="type.selected"
                                ng-true-value="'YES'"
                            	ng-false-value="'NO'"
                          		ng-click="appCtrl.filterTypes($index, type.id, type.name_nl, 'filter');"
                      		/>   
                         	<label for="filter-type-{{type.id}}">
                            	{{type.name_nl}}  &nbsp ({{type.count}})
                          	</label>
                            <br></b>                               	                       
            			</div>
        			</div>			       					 					 
        			<div style="font-size: 12pt" ng-switch-when="sorts">  <!-- ***** Режим отображения - фильтр по Сортам -->                     
                        <div>&nbsp</div> 
                        <i>Выбраны Сорта: <b>{{appCtrl.my_v_sorts}}</b></i> 
                    	<div>
                        <div>
                        	<input type='button' ng-click='appCtrl.filterSorts($index, sorts.id, sorts.name, "all");' value='Выбрать все'>
                            <input type='button' ng-click='appCtrl.filterSorts($index, sorts.id, sorts.name, "none");' value='Очистить выбор'>    	
                        </div>  
                        <div>&nbsp</div>                          	                          
                        <div style="width: 350px;" ng-scrollbars>	      <!-- Список доступных Сортов	 --> 
                        	<b ng-repeat="sort in appCtrl.sorts" >
                            	<input
                                type="checkbox"
                                checklist-model="filter_value.sorts"
                                checklist-value="sort.id"
                                ng-model="sort.selected"
                                ng-true-value="'YES'"
                        		ng-false-value="'NO'"
                      			ng-click="appCtrl.filterSorts($index, sort.id, sort.name, 'filter');"
                  			/>   
                     		<label for="filter-type-{{sort.id}}">
                          		{{sort.name}}  &nbsp ({{sort.count}})
                      		</label>
                        	<br></b>                               	                       
                        </div>   
        			</div> 
                </div>                                                                           	
        	</div>          	
        	</div>	
        	                   
            <div  style="font-size: 12pt" ng-switch-when="select_by_id">      <!-- ***** Режим отображения - "Выбранная позиция" -->           	              
                <div class="thumbnails" align="left">
                    <div align="left"><b>{{appCtrl.sitems.sort_name}}</b></div>
                    <div>&nbsp</div>
                 	<img ng-src="{{appCtrl.sitems.referenceddocument_uriid}}" align="middle" style="max-width: 300px; height: auto; "/>                 	
                   	<div>&nbsp</div>
                    <div align="left"><b>Категория: </b>{{appCtrl.sitems.type_name_nl}}</div>
                    <div align="left"><b>Плантация: </b>{{appCtrl.sitems.plantation_name}}</div>                       
                    <div align="left"><b>Размер (длина стебля): </b>{{appCtrl.sitems.size}}</div>
                    <div align="left"><b>Цена (евро): </b>{{appCtrl.sitems.price}}</div>
                    <div align="left"><b>В наличии: </b>{{appCtrl.sitems.quantity}}</div>                    
                    <div>&nbsp</div>
                    <div align="left" style="font-size: 12pt"><b>Ваш заказ: </b>&nbsp&nbsp&nbsp                                      
                    	<input id="inp1"
                             class="btn btn-default variable-btn variable-dec-ng" type="button" value="-" data-step="1"
                             ng-click="appCtrl.decrementValue(appCtrl.sitems, 'my_quantity', 1, 1, 1);appCtrl.recalculateCost();"
                             ng-disabled="appCtrl.sitems.my_quantity <= 1"/>                            
                    	<input id="inp1"
                            
                             type="text"
                             value="1"
                             name="my_quantity"
                             size="5"
                             ng-model="appCtrl.sitems.my_quantity"
                             ng-keyup="appCtrl.recalculateCost()"
                    	/>
                    	<input id="inp1"
                             class="btn btn-default variable-btn variable-inc-ng" type="button" value="+" data-step="1"
                             ng-click="appCtrl.incrementValue(appCtrl.sitems, 'my_quantity', 1, 1);appCtrl.recalculateCost()();"
                             ng-disabled="appCtrl.sitems.my_quantity >= appCtrl.sitems.quantity"/>
                        <div class="clearfix"></div>
                        </div>                   	                	
                  	<div>&nbsp</div>
                  	<div align="left" style="font-size: 12pt"><b>Стоимость: </b>{{appCtrl.sitems.cost | number:2}}</div>
                  	<div>&nbsp</div><div>&nbsp</div>
                  	<div align="left" >
                      	<input type='button' ng-click='appCtrl.orderItem();' value='В корзину'>
                      	<input type='button' ng-click='appCtrl.flwrList();' value='Закрыть'>
                    </div>
                    <div>&nbsp</div>                  
                </div>
         	</div>
         	
        </div> 
        </div>       
<div>     	
    <div id="basket" style="font-size: 12pt">
       	<div>
           	<div ng-show="appCtrl.basketv.my_quantity > 0"><b>Ваша Корзина</b>&nbsp           		
           	<div>&nbsp</div>             	
           	<div ng-repeat="order in appCtrl.basket" >
               	<li>сорт: <b>{{order.sort_name}}</b>
               		кол-во: <b>{{order.my_quantity}}</b>
               		цена: <b>{{order.cost | number:2}}</b> евро 
               	</li>         	
           	</div>  
           	<div>&nbsp</div>
           	<div>&nbsp</div>
    	  	<b>Итого: </b> {{appCtrl.cost  | number:2}}       	
       	</div> 
       	<div>&nbsp</div>      	
       	<div>
       		<input ng-show="appCtrl.basketv.my_quantity > 0" type='button' ng-click='appCtrl.buyItem();' value='Заказать'>
       	</div> 
       	<div align="center">       	
       	  {{appCtrl.order_message}} 
       	</div>          	         	      	
   		</div>   	
	</div>
</div>

<div ng-switch="appCtrl.buyerInit">
	<div id="centerLayer" style="font-size: 12pt" ng-switch-when="init">	      <!-- ***** Режим отображения - "Корзина" --> 
		<b>Ваши контактные данные</b>
        <div>&nbsp</div><div></div>
        <form ng-submit="appCtrl.submitBuyer()" name="myBuyer">
        	<table>
              <tr>
                <td>Имя: </td>
                 <td>
                    <input type="text"
                    class="BuyerName"
                    name = "BuyerName"
                    ng-model="appCtrl.BuyerName"
                    required
                    ng-minlength="5">
                 </td>
                 <span ng-show="myBuyer.BuyerName.$error.minlength"><i>Минимальная длина поля "Имя" 5 знаков</i></span>         
              </tr> 
              <tr> 
             	<td>Почта: </td>
                <td>
                    <input type="email"
                    class="BuyerEmail"
                    name="BuyerEmail"   
                    required          
                    ng-model="appCtrl.BuyerEmail">
                </td>
                <span ng-show="myBuyer.BuyerEmail.$invalid && myBuyer.BuyerEmail.$dirty"><i>Некорректный адрес</i></span>                 
              </tr>    
          </table>    
          <div>&nbsp</div> 
          <input type="submit" value="Подтвердить" ng-disabled="myBuyer.$invalid">         
        </form>
    </div>
</div>
</body>
</html>
 
<?php
    echo $this->registerJsFile("/yii2as/web/js/angular/angular.js");
    echo $this->registerJsFile("/yii2as/web/js/appflwr.js"); 
?>

