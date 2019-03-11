var app = angular.module("Appflwr",[]);
app.controller("AppCtrl",function($http){
	
    var self = this;
//    var aaa = [{"id":"34875","sort_id":"7","price":2.82,"size":"0","quantity":"1","upd_date":1549732724,"count_all":"133","sort_name":"Huis En Tuindec","plantation_name":"Daro cre","plantation_id":"903","type_name_nl":"\u0414\u0435\u043a\u043e\u0440\u0430\u0446\u0438\u0438 \u0434\u043b\u044f \u0441\u0430\u0434\u0430","type_id":"12","nl_id":"146557963","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X1887748_H_1.jpg","maturity_stage":""},{"id":"34876","sort_id":"8","price":12.55,"size":"0","quantity":"47","upd_date":1549732724,"count_all":"133","sort_name":"\u0420\u0435\u0433\u0438\u0441\u0442\u0440. \u0414\u0430\u043d\u043d\u044b\u0445","plantation_name":"Oriental","plantation_id":"1077","type_name_nl":"\u0422\u043e\u0432\u0430\u0440\u044b \u0434\u043b\u044f \u0444\u043b\u043e\u0440\u0438\u0441\u0442\u043e\u0432","type_id":"25","nl_id":"147182350","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2431333_H_1.jpg","maturity_stage":""},{"id":"34877","sort_id":"142","price":0.2,"size":"100","quantity":"10","upd_date":1549732724,"count_all":"133","sort_name":"Wilde Thijm","plantation_name":"Hans Rei","plantation_id":"967","type_name_nl":"\u0417\u0435\u043b\u0435\u043d\u044c \u0438 \u0434\u0435\u043a\u043e\u0440\u0430\u0442\u0438\u0432\u043d\u044b\u0439 \u0430\u0440\u0442","type_id":"15","nl_id":"169916955","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2355729_V_1.jpg","maturity_stage":""},{"id":"34878","sort_id":"535","price":1.98,"size":"40","quantity":"34","upd_date":1549732724,"count_all":"133","sort_name":"Lavandula Droog","plantation_name":"Kiliflai","plantation_id":"990","type_name_nl":"\u0412 \u0430\u0441\u0441\u043e\u0440\u0442\u0438\u043c\u0435\u043d\u0442\u0435","type_id":"6","nl_id":"172383506","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/156704888_162178909_H_1.jpg","maturity_stage":""},{"id":"34879","sort_id":"1506","price":0.3,"size":"80","quantity":"30","upd_date":1549732724,"count_all":"133","sort_name":"Zant Honeymoon","plantation_name":"Firma G.","plantation_id":"926","type_name_nl":"\u041a\u043b\u0443\u0431\u043d\u0435\u0432\u044b\u0435 \u0446\u0432\u0435\u0442\u044b","type_id":"16","nl_id":"173354752","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2421521_H_1.jpg","maturity_stage":"045"},{"id":"34880","sort_id":"721","price":0.33,"size":"65","quantity":"75","upd_date":1549732724,"count_all":"133","sort_name":"Chr T Stallion ","plantation_name":"Zentoo","plantation_id":"1210","type_name_nl":"\u0425\u0440\u0438\u0437\u0430\u043d\u0442\u0435\u043c\u044b","type_id":"28","nl_id":"173596527","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2409980_H_1.jpg","maturity_stage":"023"},{"id":"34881","sort_id":"1427","price":0.2,"size":"70","quantity":"15","upd_date":1549732724,"count_all":"133","sort_name":"Chr T Jordi","plantation_name":"Kwekerij","plantation_id":"1267","type_name_nl":"\u0425\u0440\u0438\u0437\u0430\u043d\u0442\u0435\u043c\u044b","type_id":"28","nl_id":"173597254","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2406023_H_1.jpg","maturity_stage":"023"},{"id":"34882","sort_id":"2022","price":0.48,"size":"70","quantity":"60","upd_date":1549732724,"count_all":"133","sort_name":"R Gr Atomic","plantation_name":"Alisha","plantation_id":"841","type_name_nl":"\u0420\u043e\u0437\u044b","type_id":"23","nl_id":"173598295","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2410035_H_1.jpg","maturity_stage":"023"},{"id":"34883","sort_id":"11","price":0.57,"size":"120","quantity":"100","upd_date":1549732724,"count_all":"133","sort_name":"Corylus Avellan","plantation_name":"H. van R","plantation_id":"1252","type_name_nl":"\u0417\u0435\u043b\u0435\u043d\u044c \u0438 \u0434\u0435\u043a\u043e \u0430\u0440\u0442 \u043f\u043e\u0448\u0442\u0443\u0447\u043d\u043e","type_id":"14","nl_id":"173610670","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2425598_V_1.jpg","maturity_stage":""},{"id":"34884","sort_id":"148","price":0.13,"size":"70","quantity":"40","upd_date":1549732724,"count_all":"133","sort_name":"Craspedia Paint","plantation_name":"Beauty L","plantation_id":"866","type_name_nl":"\u0412 \u0430\u0441\u0441\u043e\u0440\u0442\u0438\u043c\u0435\u043d\u0442\u0435","type_id":"6","nl_id":"173717846","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2401024_H_1.jpg","maturity_stage":"023"},{"id":"34885","sort_id":"1394","price":0.22,"size":"60","quantity":"60","upd_date":1549732724,"count_all":"133","sort_name":"R Gr Heidi! Ext","plantation_name":"Equinox","plantation_id":"917","type_name_nl":"\u0420\u043e\u0437\u044b","type_id":"23","nl_id":"173834869","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2110761_H_1.jpg","maturity_stage":"023"},{"id":"34886","sort_id":"1509","price":0.19,"size":"70","quantity":"130","upd_date":1549732724,"count_all":"133","sort_name":"Chr T Bartoli D","plantation_name":"Zentoo","plantation_id":"1210","type_name_nl":"\u0425\u0440\u0438\u0437\u0430\u043d\u0442\u0435\u043c\u044b","type_id":"28","nl_id":"173837797","referenceddocument_uriid":"http:\/\/185.34.168.10\/pictures\/X2431280_H_1.jpg","maturity_stage":"023"}];
    self.items = [];
    var vr = '';
    var vra = [];
    self.sorts = [];
    self.data = {};
    self.basket = [];
    self.arraytypes = [];
    self.arraysorts = [];
    self.basketv = {};
	self.variant = 'types';
	
//	self.allFlwr = [];
	
    if(typeof(limit) == "undefined") { 		// ***** определеить начальные установки для Фильтров и Сортировок
	    var limit = 12;
	    var offset = 0;
	    var mytypes = 'all';
	    var mysorts = 'all';
	    var vtypes = 'yes';
	    var vsorts = 'yes';
	    var sortitems = 'NOT';
	    var sortrules = 'ASC';    
	    self.my_v_types = "Все";
	    self.my_v_sorts = "Все";
	    self.cost = 0;
	}

	self.flwrList = function(){		
		  self.data.request_type = 'select_all';
		  self.data.limit = limit;
		  self.data.offset = offset;	
		  self.data.mytypes = mytypes;
		  self.data.mysorts = mysorts;
		  self.data.arraytypes = self.arraytypes;
		  self.data.arraysorts = self.arraysorts;
		  self.data.sortitems = sortitems;
		  self.data.sortrules = sortrules;	
		  self.buyerInit = 'none';	
		  
//		  console.log ("self.data=", self.data);
		  
//		$http.post('index.php?r=price/flwrlist', self.data)
//		  $http.post('index.php/price/flwrlist', self.data)
		  $http.post('flwrlist', self.data)
		.then(successCallback, errorCallback);
		function successCallback(response){

//			console.log ("response=", response.data);
			
			self.allFlwr = response.data.replace ("index.php/price/", "");	
			self.allFlwr = self.allFlwr.replace ("[", "");
			self.allFlwr = self.allFlwr.replace ("]", "");
			self.allFlwr = self.allFlwr.replace (/;/g, "");
			self.allFlwr = self.allFlwr.replace (/},{/g, "};{");
//			self.allFlwr = self.allFlwr.replace ("},{", "};{");
			self.allFlwr = self.allFlwr.split(';');
			
        	for (var i = 0; i < self.allFlwr.length; i++) {
        		vr = self.allFlwr[i];
//        		console.log ("vr=", vr);
        		self.allFlwr[i] = JSON.parse(vr);
        	}

//		    console.log ("self.allFlwr=", self.allFlwr);		    

            self.count_all =  self.allFlwr ['0']['count_all'];
            self.first = offset*limit + 1;
            self.last = offset*limit +limit;
            self.request_type = self.data.request_type;            
            if (vtypes == 'yes') {self.fetchTypes();}
            self.request_type = 'select_all';      
		};
		function errorCallback(error){
			console.log ("error.data=", error.data)
		    alert("Fetch Data Error");
		};
	};

	self.flwrList();
	
    self.submitBuyer = function() {											// ***** определить реквизиты покупателя
    	self.buyerInit = 'yes';
	    self.buyItem();
	  };

      self.filterVar = function(variant) {					
    	self.variant = variant;
    	self.fetchSorts();
  	  };

     	self.setSort = function(column){									// ***** сортировать данные по колонке  "column"
        if (sortitems == column) {
        	if (sortrules == 'ASC') {sortrules = 'DESC';}
        	else {sortrules = 'ASC';}        	
        }
        else {
        	sortitems = column; 
        	sortrules = 'ASC';
        }
        self.flwrList();	
      };
                                 
       	self.next = function(max){	 										// ***** следующая страница данных
       		if (mytypes == 'none') {return;}	
    	   	offset = offset + 1;
    	   	if (offset*limit > max) {offset = offset - 1;}
    	   	self.flwrList();
        };
     
        self.previous = function(index, id){ 								// ***** предыдущая страница данных
        	if (mytypes == 'none') {return;}	
        	if (offset != 0)  
     	   		offset = offset - 1;
        	self.flwrList();
         };

		self.recalculateCost = function (){									// ***** пересчитать стоимость выбранной позиции
			self.sitems ['cost'] = self.sitems ['my_quantity'] * self.sitems ['price']; 
		}

        self.decrementValue = function (obj, value, step, fixed, min) { 	// ***** уменьшить выбранное количество на шаг "step"         
             if (obj[value] == '') obj[value] = 0;
             if(typeof min == 'undefined') min = 0;
			 current = obj[value];
             var rez = current - step;
             if(rez >= min){
            	 obj[value] = rez;
             }
     	}

        self.incrementValue = function (obj, value, step, fixed) {			// ***** увеличить выбранное количество на шаг "step"
             if (obj[value] == '') obj[value] = 0;
			 current = obj[value];
             var rez = current + step;
             obj[value] = rez;
         };    
                    
         self.select = function(index, id, sraw){							// ***** выбрать позицию для заказа
        	self.order_message = '';
      	 	self.data.id = id;   	  
         	self.sitems = '';
         	self.sitems = sraw;  
         	self.request_type = 'select_by_id';
         	self.my_quantity = 1;  
         	self.sitems ['my_quantity'] = 0; 
         	self.sitems ['cost'] = 0;     
            self.recalculateCost ();	
          };      

          self.buyItem = function() { 										// ***** купить выбранне позиции (записать в БД в таблицу "orders")
              if (self.buyerInit == 'none') {
            	  self.buyerInit = 'init';
            	  return;
              }
              if (self.buyerInit == 'init') {
            	  self.buyerInit = 'yes';
              }             
    		  self.data.request_type = 'buy_item';    		  
    		  self.data.basket = self.basket;   
    	      self.data.name = self.BuyerName;
    	      self.data.email = self.BuyerEmail;
//    	      $http.post('index.php?r=price/flwrbuy', self.data)
    	      $http.post('flwrbuy', self.data)
              .then(function successCallback(response) {                 
            	  self.request_type = 'select_by_id';           	    
            	  self.order_message = response.data ['order_message']; 
            	  self.basket = []; 
            	  self.basketv.my_quantity = 0;
            	  self.cost = 0;
            	  self.fetchTypes();
              }, function(errResponse) {
                  console.error('Error while fetching notes');
                });
          };

          self.orderItem = function() { 									// ***** поместить выбранную позицию в корзину
			if (self.sitems.my_quantity > 0) {
        		self.basketv.my_quantity = self.sitems.my_quantity;
    			self.basket[self.basket.length] = {sort_name: self.sitems.sort_name, my_quantity: self.sitems.my_quantity, cost: self.sitems.cost};
    			self.cost = self.cost +  self.sitems.cost;
			}
          };
          
          self.filterTypes = function(index, id, name_nl, fl_types){ 		// ***** фильтрация данных по справочнику "Types" 
        	  	if (fl_types == 'none') {
            	  	for (var i = 0; i < self.types.length; i++) {
            	  		self.types[i]['selected'] = 'NO';
            	  	}
            	  self.arraytypes = [];
            	  mytypes = 'none';
            	  self.my_v_types = "Нет";
        	  	}
            	if (fl_types == 'all') {      		
                	for (var i = 0; i < self.types.length; i++) {
                	  	self.types[i]['selected'] = 'NO';
                	}
                	mytypes = 'all';
                	self.my_v_types = "Все";
                	offset = 0;
                	self.flwrList();
            	} 
            	if (fl_types == 'filter') {
            	  if (mytypes == 'all' || mytypes == 'none') {self.my_v_types = '';};
            	  	mytypes = id;
      			self.arraytypes = self.types;
      			self.my_v_types = self.my_v_types + name_nl + ", ";
              	offset = 0;
              	self.flwrList();
            	}  	 	              
          };       
                    
          self.fetchTypes = function() { 										// ***** получить данные из справочника Типы (types)
      		  self.data.request_type = 'read_types';	
      		  vtypes = 'no';	  
//                $http.post('index.php?r=price/flwrtypes', self.data)
      		$http.post('flwrtypes', self.data)
                .then(function successCallback(response) {
                    
        			self.types = response.data.replace ("index.php/price/", "");	
        			self.types = self.types.replace ("[", "");
        			self.types = self.types.replace ("]", "");
        			self.types = self.types.replace (/;/g, "");
        			self.types = self.types.replace (/},{/g, "};{");
        			self.types = self.types.split(';');        			
                	for (var i = 0; i < self.types.length; i++) {
                		vr = self.types[i];
//                		console.log ("vr=", vr);
                		self.types[i] = JSON.parse(vr);
                	}
//        		    console.log ("self.types=", self.types);
                                        
                    self.request_type = 'select_all';     		
                    for (var i = 0; i < self.types.length; i++) {
                    	self.types[i]['selected'] = 'NO';
                    }

                }, function(errResponse) {
                    console.error('Не выбрано ни одного Типа');
                  });
          };
                   
          self.filterSorts = function(index, id, name, fl_sorts){ 			// ***** фильтрация данных по справочнику "Sorts"          	  
        	  if (fl_sorts == 'none') {
          	  	for (var i = 0; i < self.sorts.length; i++) {
          	  		self.sorts[i]['selected'] = 'NO';
          	  	}
          	  self.arraysorts = [];
          	  mysorts = 'none';
          	  self.my_v_sorts = "Нет";
      	  	}
          	if (fl_sorts == 'all') {      		
              	for (var i = 0; i < self.sorts.length; i++) {
              	  	self.sorts[i]['selected'] = 'NO';
              	}
              	mysorts = 'all';
              	self.my_v_sorts = "Все";
              	offset = 0;
              	self.flwrList();
          	} 
          	if (fl_sorts == 'filter') {
          	  if (mysorts == 'all' || mysorts == 'none') {self.my_v_sorts = '';};
          	  	mysorts = id;
    			self.arraysorts = self.sorts;
    			self.my_v_sorts = self.my_v_sorts + name + ", ";
            	offset = 0;
            	self.flwrList();
          	}  	 	              
        };  
                     
              self.fetchSorts = function() { 								// ***** получить данные из справочника Сорта (sorts)
        		  self.data.request_type = 'read_sorts';	
        		  vsorts = 'no';	  
//                    $http.post('index.php?r=price/flwrsorts', self.data)
        		  $http.post('flwrsorts', self.data)
                    .then(function successCallback(response) {
            
            			self.sorts = response.data.replace ("index.php/price/", "");	
            			self.sorts = self.sorts.replace ("[", "");
            			self.sorts = self.sorts.replace ("]", "");
            			self.sorts = self.sorts.replace (/;/g, "");
            			self.sorts = self.sorts.replace (/},{/g, "};{");
            			self.sorts = self.sorts.split(';');   
            			
                    	for (var i = 0; i < self.sorts.length; i++) {
                    		vr = self.sorts[i];
//                    		console.log ("vr=", vr);
                    		self.sorts[i] = JSON.parse(vr);
                    	}
//            		    console.log ("self.sorts=", self.sorts);
                    	
                        self.request_type = 'select_all';     		
                        for (var i = 0; i < self.sorts.length; i++) {
                        	self.sorts[i]['selected'] = 'NO';
                        }
                        
//                        console.log ("self.sorts=", self.sorts);
                        
                    }, function(errResponse) {
                        console.error('Не выбрано ни одного Сорта');
                      });
              };
          
});