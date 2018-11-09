var person = {
   firstName: "Adam ",
   lastName: "Champagne ",
   isAwake: "yes"
   }
   
   
   
   // console 1
   console.log("1 --------------------------");
   console.log(person);
   console.log(person.firstName);
   console.log("--------------------------");
   
   console.log("2 --------------------------");
   console.log("for in loops through enumerable properties");
   var textIn = '';
   for (var x in person) {
       textIn += person[x];
       console.log("var x: " + x);
   }
   console.log("var textIn: " + textIn);
   
   console.log("--------------------------");
   
   console.log("3 --------------------------");
   console.log("for of loops through iterable objects like array, map ,set");
   
   
   
   var array = [3,5,7,9,12];
   
   console.log("itterat array with in loop prints out the indexes");
   for (var i in array) {
       console.log("i in an in loop " + i);
   }
   
   console.log("--------------------------");
   
   console.log("itterat array with of loop prints out the values");
   for (var i of array) {
       console.log("i in an of loop " + i);
   }
   
   
   console.log("--------------------------");
   
   console.log("Looping over array of objects");
   var people = [
       {
           firstName: "Thomas",
           lastName: "Champagne",
           isRelated: "Yes",
       },
       {
           firstName: "Lindsey",
           lastName: "Scharf",
           isRelated: "no",
       }
   ]
   console.log("--------------------------");
   for (var x in people) {
       console.log("firstname: " + people[x].firstName);
       console.log("LastName: " + people[x].lastName);
       console.log("Is Related: " + people[x].isRelated);
   }
   console.log("--------------------------");
   
   /*******************************
   Version 1 Restaurant object
   ********************************/
   var states =[
       {
             abr: "AZ",
             dish: "Red chile chimichanga",
             rest1: {
                   name: "El Norteno",
                   address: "1002 7th Ave, Phoenix, AZ 85007",
               },
             rest2: {
                 name: "Mixteca Mexican Food",
                 address: "6731 W Bell Rd, Glendale, AZ 85308",
             },
             rest3: {
                 name: "Oaxaca Restaurant",
                 address: "321 N State Rte 89A, Sedona, AZ 86336",
             },
             description: "Whether Arizonaâ€™s claim of inventing the chimichanga is irrelevant: the act of dunking a burrito in a deep-fryer is an act of American ingenuity akin to putting hot dogs on a stick, and Arizona makes them better than anyone.",
       },
             ]
   
           for ( var y in states) {
               console.log("ABR: " + states[y].abr);
               console.log("Dish: " + states[y].dish);
               console.log("Description: " + states[y].description);
               
               for (var z of states) {
                   console.log("Restaurant Name: " + states[y].rest1.name);
                   console.log("Restaurant Name: " + states[y].rest1.address);
                   console.log("--------------------------");
                   console.log("Restaurant Name: " + states[y].rest2.name);
                   console.log("Restaurant Name: " + states[y].rest2.address);
                   console.log("--------------------------");
                   console.log("Restaurant Name: " + states[y].rest3.name);
                   console.log("Restaurant Name: " + states[y].rest3.address);
               }
           }
   
           console.log("--------------------------");
   /*****************************************
   Version 2 Better organized Restaurant object
   ******************************************/
   var states =[
       {
           abr: "AZ",
           dish: "Red chile chimichanga",
           restaurants: [
               { 
               name: "El Norteno",
               address: "1002 7th Ave, Phoenix, AZ 85007",
               },
               {
               name: "Mixteca Mexican Food",
               address: "6731 W Bell Rd, Glendale, AZ 85308",
               },
               {
               name: "Oaxaca Restaurant",
               address: "321 N State Rte 89A, Sedona, AZ 86336",
               }
           ],
           description: "Whether Arizonaâ€™s claim of inventing the chimichanga is irrelevant: the act of dunking a burrito in a deep-fryer is an act of American ingenuity akin to putting hot dogs on a stick, and Arizona makes them better than anyone.",
       },
             ]
   
           for ( var y in states) {
               console.log("ABR: " + states[y].abr);
               console.log("Dish: " + states[y].dish);
               console.log("Description: " + states[y].description);
               
               var restaurantArray = states[y].restaurants;
               console.log("Restaurants: " + restaurantArray);
   
               for (var i = 0; i < restaurantArray.length; i++){
                   console.log("restaurant name: " + restaurantArray[i].name);
                   console.log("restaurant name: " + restaurantArray[i].address);
                   console.log("--------------------------");
               }  
           }