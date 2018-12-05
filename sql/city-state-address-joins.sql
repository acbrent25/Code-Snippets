SELECT addresses.id as address_id, cities.id as city_id, addresses.city_id as address_cy_id, addresses.state_id as address_st_id, states.id as state_id, addresses.name as company, addresses.house_number, addresses.street, cities.name as city_name, states.name as state_name, states.short, addresses.zip, addresses.phone, addresses.fax, addresses.website, addresses.email, addresses.category, addresses.checked 
FROM addresses
LEFT JOIN cities
ON cities.id = addresses.city_id
LEFT JOIN states
ON states.id = addresses.state_id
GROUP BY addresses.id


SELECT cities.id as city_id, cities.name_url, cities.state_id as city_st_id, states.id as state_id, states.name_url
FROM cities
LEFT JOIN states
ON cities.state_id = states.id