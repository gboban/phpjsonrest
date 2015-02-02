/**
 * 
 */
function json_request(method, url, data){
console.log(method);
console.log(url);
console.log(data);
console.log('--');
	 var Httpreq = new XMLHttpRequest(); // a new request
	 Httpreq.open(method,url,false);
	 Httpreq.send(data);
	 return Httpreq.responseText;	 
 }

/*
 * ******** contact REST calls
 */
 /*
 * GET contacts
 */
function get_contacts(pattern, first, count){
	 var jdata = json_request(
			 'GET',
			 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
			 'resource_type=contact' +
			 '&pattern=' + pattern +
			 '&first=' + first +
			 '&count=' + count,
			 null
	 );

	 var data = JSON.parse(jdata);
	 
	 return data;
}
 /*
  * GET contact
  */ 
function get_contact(id){
	 var jdata = json_request(
			 'GET',
			 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
			 'resource_type=contact' +
			 '&id=' + id,
			 null
	);
	 var data = JSON.parse(jdata);
	 return data;
}
 /*
  * DELETE contact
  */
function delete_contact(id){
	var jdata = json_request(
		 'DELETE',
		 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
		 'resource_type=contact' +
		 '&id=' + id,
		 null
	);
console.log(jdata);
	var data = JSON.parse(jdata);
	return data;
}
 /*
  * PUT contact (update existing)
  */
function put_contact(id, obj){
	var jdata = json_request(
			 'PUT',
			 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
			 'resource_type=contact' +
			 '&id=' + id,
			 JSON.stringify(obj)
		);

	var data = JSON.parse(jdata);
	return data;
 }
 /*
  * POST contact (add new)
  */
  function post_contact(obj){
	var jdata = json_request(
			 'POST',
			 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
			 'resource_type=contact',
			 JSON.stringify(obj)
		);
	var data = JSON.parse(jdata);
	return data;
 }
 /*
  * ******* phone REST calls
  */

 /*
  * GET phones
  */
function get_phones(contact_id){
	var jdata = json_request(
			 'GET',
			 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
			 'resource_type=phone' +
			 '&contact_id=' + contact_id,
			 null
		);
	var data = JSON.parse(jdata);
	return data;
 }
 /*
  * PUT phone
  */
 function put_phone(id, obj){
	var jdata = json_request(
			 'PUT',
			 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
			 'resource_type=phone' +
			 '&id=' + id,
			 JSON.stringify(obj)
		);
	var data = JSON.parse(jdata);
	return jdata;
 }
 /*
  * POST phone
  */
function post_phone(obj){
	var jdata = json_request(
			 'POST',
			 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
			 'resource_type=phone',
			 JSON.stringify(obj)
		);
	var data = JSON.parse(jdata);
	return jdata;
}
 /*
  * DELETE phone
  */
 function delete_phone(id){
	var jdata = json_request(
		 'DELETE',
		 'http://localhost/phpjsonrest/ws/ws_json.php?' + 
		 'resource_type=phone' +
		 '&id=' + id,
		 null
	);
	var data = JSON.parse(jdata);
	return jdata;
}
  
/*
 * TESTS 
 *
 *
 *
 */
 /*
 * get_contact
 * get_contacts
 * delete_contact
*/
//var list = get_contacts("%", 0, 10);
//console.log(list);
 
//var item = get_contact(2);
//console.log(item);

//var result = delete_contact(2);
//console.log(result);

//var list = get_contacts("%", 0, 10);
//console.log(list);


/*
 * get_contact
 * get_contacts
 * -------------> put_contact
*/
/*
var dataObj = {
	contact_id: 5,
	name: 'Goran',
	surname: 'Boban',
	city: 'Zagreb',
	desc: 'Ja',
	imgpath: null
};

var list = get_contacts("%", 0, 10);
console.log(list);
 
var item = get_contact(5);
console.log(item);

var result = put_contact(5, dataObj);
console.log(result);

var list = get_contacts("%", 0, 10);
console.log(list);
*/
/*
 * get_contact
 * get_contacts
 * -------------> post_contact
*/
/*
var dataObj = {
	name: 'Goran',
	surname: 'Boban',
	city: 'Zagreb',
	desc: 'Ja drugi (postani)',
	imgpath: null
};

var list = get_contacts("%", 0, 10);
console.log(list);
 
var item = get_contact(2);
console.log(item);

var result = post_contact(dataObj);
console.log(result);

var list = get_contacts("%", 0, 10);
console.log(list);
*/


/*
 * get_phones
 * -------------> post_phone
*/
/*
var dataObj = {
	contact_id: 4,
	number: '+385(1)2223344',
	comment: 'postani telefon novi',
};

var list = get_phones(4);
console.log(list);

var result = put_phone(19, dataObj);
console.log(result);

var list = get_phones(4);
console.log(list);

var list = delete_phone(17);
console.log(list);

var list = get_phones(4);
console.log(list);
*/