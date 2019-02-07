var app = angular.module("Appflwr",[]);
app.controller("AppCtrl",function($http){
	
    var self = this;
    self.items = [];
    self.sorts = [];
    self.data = {};
    self.basket = [];
    self.arraytypes = [];
    self.arraysorts = [];
    self.basketv = {};
	self.variant = 'types';
	
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
		$http.post('index.php?r=price/flwrlist', self.data)
		.then(successCallback, errorCallback);
		function successCallback(response){
		    self.allFlwr = response.data;
            self.count_all =  response.data ['0']['count_all'];
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
    	      $http.post('index.php?r=price/flwrbuy', self.data)
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
                $http.post('index.php?r=price/flwrtypes', self.data)
                .then(function successCallback(response) {
                    self.types = response.data;   
                    self.request_type = 'select_all';     		
                    for (var i = 0; i < self.types.length; i++) {
                    	self.types[i]['selected'] = 'NO';
                    }

                }, function(errResponse) {
                    console.error('Error while fetching notes');
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
                    $http.post('index.php?r=price/flwrsorts', self.data)
                    .then(function successCallback(response) {
                    	self.sorts = response.data;    
                        self.request_type = 'select_all';     		
                        for (var i = 0; i < self.sorts.length; i++) {
                        	self.sorts[i]['selected'] = 'NO';
                        }
                    }, function(errResponse) {
                        console.error('Error while fetching notes');
                      });
              };
          
});