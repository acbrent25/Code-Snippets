 jQuery(document).ready(function($){
            console.log('ready');

            $.ajax({
            method: "GET",
            // url: ADMIN_AJAX_URL,
            // data: {
            //     'action': 'cb_career_omeet'
            // },
            url: '',
            }).done(function(data) {
        
                // Log the data to console
                console.log(data[0]);

                console.log("------------------------------------");
                
                // Set up vars
                var departmentArr = [];
                var locationArr = [];
                var baseUrl = '#';
                
                console.log('base URL: ' + baseUrl);
        
                getData();
        
                function getData(){
        
                    // Loop over API data
                    for(var i = 0; i < data.length; i++){
                        // loop vars
                        var departments = data[i].department;
                        
                        var locations = data[i].location.name;
                        
                        // push data to empty arrays
                        departmentArr.push(departments);
                        locationArr.push(locations);
                    }
                    
                    // Remove dulicate departments
                    var cleanedDepartments = [];
                    $.each(departmentArr, function(i, el){
                        if($.inArray(el, cleanedDepartments) === -1) cleanedDepartments.push(el);
                    });
                    console.log('Cleaned Departments: ' + cleanedDepartments);
                    
                    // Add select options
                    $.each(cleanedDepartments, function(i, el){
                        console.log(el);
                        // replace space with dash and make lowercase               
                        var department = el.replace(/\s+/g, '-').toLowerCase();
                        // remove & symbol
                        var department = department.replace(/&/g, '');
                        // set url
                        var departmentUrl = baseUrl + '?comeet_cat=' + department + '&comeet_all=all&rd"';
                      
                        var link = $("<a/>", {
                            'class': 'dd-item',
                            'href': departmentUrl,
                            'text': el                   
                        }).appendTo("#departmentDropdown");
        
                    });
        
                    // Remove dulicate locations
                    var cleanedLocations = [];
                    $.each(locationArr, function(i, el){
                        if($.inArray(el, cleanedLocations) === -1) cleanedLocations.push(el);
                    });
                    console.log('Cleaned Locations: ' + cleanedLocations);
        
                    // Add select options
                    $.each(cleanedLocations, function(i, el){
                        console.log(el);
                        // replace space with dash and make lowercase
                        var location = el.replace(/\s+/g, '-').toLowerCase();
                        // remove & symbol
                        var location = location.replace(/&/g, '');
                        // set url
                        var locationUrl = baseUrl + '?comeet_cat=' + location + '&comeet_all=all&rd"';
                        
                        var link = $("<a/>", {
                            'class': 'dd-item',
                            'text': el,
                            'href': locationUrl,
                        }).appendTo("#locationDropdown");
        
                    });
                }
        
                // Department Button 
                $("#departmentBtn").click(function(e){
                    e.preventDefault();
                    $("#departmentDropdown").toggleClass("hide");
                });
        
                $("#departmentDropdown").mouseleave(function(){
                    $(this).toggleClass("hide");
                });
        
                // Location Button 
                $("#locationBtn").click(function(e){
                    e.preventDefault();
                    $("#locationDropdown").toggleClass("hide");
                });
        
                $("#locationDropdown").mouseleave(function(){
                    $(this).toggleClass("hide");
                });
        
        
            });
        
        });